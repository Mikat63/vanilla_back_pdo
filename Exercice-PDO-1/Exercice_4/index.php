<?php
require_once "../bdd_connect.php";

$request = $db->query(
    "SELECT 
        c.lastName,
        c.firstName,
        c.cardNumber
    FROM 
        clients AS c 
    JOIN 
        cards AS ca ON c.cardNumber = ca.cardNumber
   	JOIN 
    	cardtypes AS ct ON ct.id = ca.cardTypesId
    WHERE
    	ct.type = 'Fidélité';
       "
);

$customers = $request->fetchall();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_4</title>
</head>

<body>
    <h1>Voici les clients possédants une carte de fidélité :</h1>
    <?php
    foreach ($customers as $customer) {
    ?>
        <div>
            <p><?= "Nom : " . " " . $customer['lastName']; ?></p>
            <p><?= "Préom : " . " " . $customer['firstName']; ?></p>
            <p><?= "Numéro de carte : " . " " . $customer['cardNumber']; ?></p>
        </div>
        <br>
    <?php
    }
    ?>
</body>

</html>