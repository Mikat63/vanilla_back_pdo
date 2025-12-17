<?php
require_once  "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../patient_rendezvous.php?error=bad_method');
    exit();
}

if (!isset($_POST['id_rendezvous'])) {
    header('Location: ../patient_rendezvous.php?error=errorId');
    exit();
}

$id = htmlspecialchars(strip_tags($_POST['id_rendezvous']));

try {
    $request = $db->prepare(
        "DELETE 
                            FROM 
                                appointments 
                            WHERE 
                                id = :id_rendezvous;"
    );

    $deleteRendezVous = $request->execute([
        'id_rendezvous' => $_POST['id_rendezvous']
    ]);

    header("Location: ../liste_rendezvous.php");
    exit();
} catch (PDOException $error) {
    header("Location: ../patient_rendezvous.php?id=" . $id . "&error=" . urlencode($error->getMessage()));
    exit();
}
