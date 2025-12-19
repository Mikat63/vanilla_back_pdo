<?php

// control METHOD
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php?error=bad_method');
    exit();
}

// control patient and rendezvous form
if (!isset($_POST['lastName']) || !isset($_POST['firstName']) || !isset($_POST['birthDate']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['dateTime'])) {
    header('Location: ../index.php?error=missing');
    exit();
}

if (empty(trim($_POST['lastName'])) || empty(trim($_POST['firstName'])) || empty(trim($_POST['birthDate'])) || empty(trim($_POST['email'])) || empty(trim($_POST['phone'])) || empty(trim($_POST['dateTime']))) {
    header('Location: ../index.php?error=empty');
    exit();
}

if (strlen($_POST['lastName']) < 3 || strlen($_POST['firstName']) < 3 || strlen($_POST['birthDate']) < 3 || strlen($_POST['email']) < 3) {
    header('Location: ../index.php?error=min');
    exit();
}

if (strlen($_POST['lastName']) > 30 || strlen($_POST['firstName']) > 30 || strlen($_POST['birthDate']) > 30 || strlen($_POST['email']) > 30) {
    header('Location: ../index.php?error=max');
    exit();
}

if (strlen($_POST['phone']) < 5 || strlen($_POST['phone']) > 15) {
    header('Location: ../index.php?error=minMaxPhone');
    exit();
}

// control input string
$regexLastnameFirstname = '/^[\p{L} \'-]+$/u';

if (!preg_match($regexLastnameFirstname, $_POST['lastName']) || !preg_match($regexLastnameFirstname, $_POST['firstName'])) {
    header('Location: ../index.php?error=format_String');
    exit();
}

// control input int phone
$regexPhone = '/^(0|\+33 ?)[1-9]( ?\d{2}){4}$/';

if (!preg_match($regexPhone, $_POST['phone'])) {
    header('Location: ../index.php?error=format_Phone');
    exit();
}


if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: ../index.php?error=invalidMail');
    exit();
}

// variables ready
$lastName = htmlspecialchars(strip_tags(strtoupper($_POST['lastName'])));
$firstName = htmlspecialchars(strip_tags(ucfirst($_POST['firstName'])));
$birthDate = htmlspecialchars(strip_tags($_POST['birthDate']));
$email = htmlspecialchars(strip_tags($_POST['email']));
$phone = htmlspecialchars(strip_tags($_POST['phone']));
$dateTime = htmlspecialchars(strip_tags($_POST['dateTime']));

// Gestion des dates
$dateBirthday = DateTime::createFromFormat('Y-m-d', $birthDate);
$dateRendezVous = DateTime::createFromFormat('Y-m-d\TH:i', $dateTime);
$dateNow = new DateTime();

if (!$dateRendezVous) {
    header('Location: ../index.php?error=invalid_date');
    exit();
}

if ($dateRendezVous < $dateNow) {
    header('Location: ../index.php?error=errorDate');
    exit();
}

if (!$dateBirthday) {
    header('Location: ../index.php?error=invalid_date');
    exit();
}
if ($dateBirthday > $dateNow) {
    header('Location: ../index.php?error=errorDate');
    exit();
}


try {
    require_once "db_connect.php";

    // add patient 
    $request = $db->prepare("INSERT INTO 
                                patients (`lastname`, 
                                          `firstname`, 
                                          `birthdate`, 
                                          `phone`, 
                                          `mail`) 
                                    VALUES (:lastName,
                                            :firstName,
                                            :birthDate,
                                            :phone,
                                            :mail);");

    $request->execute([
        'lastName' => $lastName,
        'firstName' => $firstName,
        'birthDate' => $birthDate,
        'phone' => $phone,
        'mail' => $email
    ]);


    // patient id added
    $patientId =  $db->lastInsertId();

    // add rendez-vous
    $request = $db->prepare(
        "INSERT INTO appointments (datehour, patient_id)
         VALUES (:dateTime, :patient_id)"
    );
    $request->execute([
        'dateTime' => $dateRendezVous->format('Y-m-d H:i:s'),
        'patient_id' => $patientId
    ]);

    header("Location: ../index.php?success=success_process");
} catch (PDOException $error) {
    header("Location: ../index.php?error=" . urlencode($error->getMessage()));
    exit();
}
