<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../ajout_patient.php?error=bad_method');
    exit();
}

if (!isset($_POST['lastName']) || !isset($_POST['firstName']) || !isset($_POST['birthDate']) || !isset($_POST['email']) || !isset($_POST['phone'])) {
    header('Location: ../ajout_patient.php?error=missing');
    exit();
}

if (empty(trim($_POST['lastName'])) || empty(trim($_POST['firstName'])) || empty(trim($_POST['birthDate'])) || empty(trim($_POST['email'])) || empty(trim($_POST['phone']))) {
    header('Location: ../ajout_patient.php?error=empty');
    exit();
}

if (strlen($_POST['lastName']) < 3 || strlen($_POST['firstName']) < 3 || strlen($_POST['birthDate']) < 3 || strlen($_POST['email']) < 3) {
    header('Location: ../ajout_patient.php?error=min');
    exit();
}

if (strlen($_POST['lastName']) > 30 || strlen($_POST['firstName']) > 30 || strlen($_POST['birthDate']) > 30 || strlen($_POST['email']) > 30) {
    header('Location: ../ajout_patient.php?error=max');
    exit();
}

$regexLastnameFirstname = '/^[\p{L} \'-]+$/u';

if (!preg_match($regexLastnameFirstname, $_POST['lastName']) || !preg_match($regexLastnameFirstname, $_POST['firstName'])) {
    header('Location: ../ajout_patient.php?error=format_String');
    exit();
}


if (strlen($_POST['phone']) < 5 || strlen($_POST['phone']) > 15) {
    header('Location: ../ajout_patient.php?error=minMaxPhone');
    exit();
}

$regexPhone = '/^(0|\+33 ?)[1-9]( ?\d{2}){4}$/';

if (!preg_match($regexPhone, $_POST['phone'])) {
    header('Location: ../ajout_patient.php?error=format_Phone');
    exit();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: ../ajout_patient.php?error=invalidMail');
    exit();
}

$lastName = htmlspecialchars(strip_tags(strtoupper($_POST['lastName'])));
$firstName = htmlspecialchars(strip_tags(ucfirst($_POST['firstName'])));
$birthDate = htmlspecialchars(strip_tags($_POST['birthDate']));
$email = htmlspecialchars(strip_tags($_POST['email']));
$phone = htmlspecialchars(strip_tags($_POST['phone']));

try {
    require_once "db_connect.php";

    $request = $db->prepare("INSERT INTO 
                                patients (`lastname`, 
                                          `firstname`, 
                                          `birthdate`, 
                                          `phone`, 
                                          `mail`) 
                                    VALUES (:lastName,:firstName,:birthDate,:phone,:mail);");

    $request->execute([
        'lastName' => $lastName,
        'firstName' => $firstName,
        'birthDate' => $birthDate,
        'phone' => $phone,
        'mail' => $email
    ]);

    header("Location: ../ajout_patient.php?success=success_process");
} catch (PDOException $error) {
    header("Location: ../ajout_patient.php?error=" . urlencode($error->getMessage()));
    exit();
}
