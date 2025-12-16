<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../ajout_rendezvous.php?error=bad_method');
    exit();
}

if (!isset($_POST['patient']) || !isset($_POST['dateTime'])) {
    header('Location: ../ajout_rendezvous.php?error=missing');
    exit();
}

if (empty(trim($_POST['patient'])) || empty(trim($_POST['dateTime']))) {
    header('Location: ../ajout_rendezvous.php?error=empty');
    exit();
}


if (!filter_var($_POST['patient'], FILTER_VALIDATE_INT)) {
    header('Location: ../ajout_rendezvous.php?error=errorId');
    exit();
}

$patient = htmlspecialchars(($_POST['patient']));
$dateTime = htmlspecialchars(($_POST['dateTime']));

$date = DateTime::createFromFormat('Y-m-d\TH:i', $dateTime);
if (!$date) {
    header('Location: ../ajout_rendezvous.php?error=invalid_date');
    exit();
}


try {
    require_once "db_connect.php";

    $request = $db->prepare("INSERT INTO 
                                appointments (`datehour`, 
                                              `patient_id` 
                                              ) 
                                    VALUES (:dateTime,:patient)");

    $request->execute([
        'dateTime' => $date->format('Y-m-d H:i:s'),
        'patient' => $patient
    ]);

    header("Location: ../ajout_rendezvous.php?success=success_process");
} catch (PDOException $error) {
    header("Location: ../ajout_rendezvous.php?error=" . urlencode($error->getMessage()));
    exit();
}
