<?php
try {
    $dsn = "mysql:host=localhost;dbname=hospitale2n";
    $user = "root";
    $password = "";

    $db = new PDO($dsn, $user, $password);
} catch (PDOException $error) {
    header("Location: ../ajout_patient.php?error=$error");
}
