<?php
require_once  "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../patient_rendezvous.php?error=bad_method');
    exit();
}

if (!isset($_POST['id_patient'])) {
    header('Location: ../patient_rendezvous.php?error=errorId');
    exit();
}

$id = htmlspecialchars(strip_tags($_POST['id_patient']));

try {
    // delete rendez-vous
    $request = $db->prepare(
        "DELETE 
                            FROM 
                                appointments
                            WHERE 
                                patient_id = :id_patient;"
    );

    $deletePatient = $request->execute([
        'id_patient' => $_POST['id_patient']
    ]);

    // delete patient
    $request = $db->prepare(
        "DELETE 
                            FROM 
                                patients
                            WHERE 
                                id = :id_patient;"
    );

    $deleteRendezVous = $request->execute([
        'id_patient' => $_POST['id_patient']
    ]);


    header("Location: ../liste_patients.php");
    exit();
} catch (PDOException $error) {
    header("Location: ../liste_patient.php?id=" . $id . "&error=" . urlencode($error->getMessage()));
    exit();
}
