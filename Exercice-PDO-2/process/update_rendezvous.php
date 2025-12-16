<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../patient_rendezvous.php?error=bad_method');
    exit();
}

if (!isset($_POST['dateTime'])) {
    header('Location: ../patient_rendezvous.php?error=missing');
    exit();
}

if (empty(trim($_POST['dateTime']))) {
    header('Location: ../patient_rendezvous.php?error=empty');
    exit();
}


if (!filter_var($_POST['id_patient'], FILTER_VALIDATE_INT)) {
    header('Location: ../patient_rendezvous.php?error=errorId');
    exit();
}

if (!filter_var($_POST['id_rendezvous'], FILTER_VALIDATE_INT)) {
    header('Location: ../patient_rendezvous.php?error=erroridrendezvous');
    exit();
}

$patient = htmlspecialchars(($_POST['id_patient']));
$rendezVous = htmlspecialchars(($_POST['id_rendezvous']));
$dateTime = htmlspecialchars(($_POST['dateTime']));

$date = DateTime::createFromFormat('Y-m-d\TH:i', $dateTime);

if (!$date) {
    header('Location: ../patient_rendezvous.php?error=invalid_date');
    exit();
}


try {
    require_once "db_connect.php";

    $request = $db->prepare("UPDATE 
                                appointments 
                             SET 
                                datehour = :dateTime
                            WHERE 
                                id = :rendezVous");

    $request->execute([
        'dateTime' => $date->format('Y-m-d H:i:s'),
        'rendezVous' => $rendezVous
    ]);

    header("Location: ../patient_rendezvous.php?id=$rendezVous&success=success_process");
} catch (PDOException $error) {
    header("Location: ../patient_rendezvous.php?error=" . urlencode($error->getMessage()));
    exit();
}
