<?php
require_once "../bdd_connect.php";

$request = $db->query(
    "SELECT 
        lastName,
        firstName,
        cardNumber
    FROM 
        clients 
    WHERE 
        cardNumber 
            is not null;"
);

$customers = $request->fetchall();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_1</title>
</head>

<body>
    <h1>Voici les clients possédants une carte de fidélité :</h1>
        <?php
            foreach ($customers as $customer) {
        ?>
        <div>
            <p><?= "Nom : " . " " . $customer['lastName'];?></p>
            <p><?= "Préom : " . " " . $customer['firstName'];?></p>
            <p><?= "Numéro de carte : " . " " . $customer['cardNumber'];?></p>
        </div>
        <br>
        <?php
            }
        ?>
</body>

</html>