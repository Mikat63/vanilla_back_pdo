<?php
require_once "../bdd_connect.php";

$request = $db->query(
    "SELECT 
        lastName,
        firstName 
    FROM 
        clients 
    LIMIT 
        20"
);
    
$customers = $request->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_1</title>
</head>

<body>
    <h1>Voici els 20 premiers clients :</h1>
    <ul>
        <?php
        foreach ($customers as $customer) {
        ?>


            <li><?= $customer['lastName'] . " " . $customer["firstName"] ?></li>

        <?php
        }
        ?>
    </ul>
</body>

</html>