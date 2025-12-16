<?php



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../profil_patient.php?error=bad_method');
    exit();
}

if (!isset($_POST['id']) || !isset($_POST['lastName']) || !isset($_POST['firstName']) || !isset($_POST['birthDate']) || !isset($_POST['email']) || !isset($_POST['phone'])) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=bad_method');
    exit();
}

if (empty(trim($_POST['id'])) || empty(trim($_POST['lastName'])) || empty(trim($_POST['firstName'])) || empty(trim($_POST['birthDate'])) || empty(trim($_POST['email'])) || empty(trim($_POST['phone']))) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=bad_method');
    exit();
}

if (strlen($_POST['id']) < 1) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=errorId');
    exit();
}

if (strlen($_POST['lastName']) < 3 || strlen($_POST['firstName']) < 3 || strlen($_POST['birthDate']) < 3 || strlen($_POST['email']) < 3) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=bad_method');
    exit();
}

if (strlen($_POST['lastName']) > 30 || strlen($_POST['firstName']) > 30 || strlen($_POST['birthDate']) > 30 || strlen($_POST['email']) > 30) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=bad_method');
    exit();
}

if (strlen($_POST['phone']) < 5 || strlen($_POST['phone']) > 15) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=bad_method');
    exit();
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('Location: ../profil_patient.php?id=' . $_POST['id'] . '&error=bad_method');
    exit();
}

$id = htmlspecialchars(strip_tags($_POST['id']));
$lastName = htmlspecialchars(strip_tags(strtoupper($_POST['lastName'])));
$firstName = htmlspecialchars(strip_tags(ucfirst($_POST['firstName'])));
$birthDate = htmlspecialchars(strip_tags($_POST['birthDate']));
$email = htmlspecialchars(strip_tags($_POST['email']));
$phone = htmlspecialchars(strip_tags($_POST['phone']));

try {
    require_once "db_connect.php";

    $request = $db->prepare(
        "UPDATE patients
         SET lastname = :lastName,
             firstname = :firstName,
             birthdate = :birthDate,
             phone = :phone,
             mail = :mail
         WHERE id = :id"
    );

    $request->execute([
        'id' => $id,
        'lastName' => $lastName,
        'firstName' => $firstName,
        'birthDate' => $birthDate,
        'phone' => $phone,
        'mail' => $email
    ]);

    header("Location: ../profil_patient.php?id=" . $id . "&success=success_process");
    exit();
} catch (PDOException $error) {
    header("Location: ../profil_patient.php?id=" . $id . "&error=" . urlencode($error->getMessage()));
    exit();
}
