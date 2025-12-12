<?php
require_once "../bdd_connect.php";

$request = $db->query(
    "SELECT
	    lastName,
        firstName,
        birthDate,
        card,
        cardNumber
    FROM
	    clients;"
);

$customers = $request->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_7</title>
</head>

<body>
    <?php
    foreach ($customers as $customer) {
        $birthDate = new DateTime($customer['birthDate']);
        $formatBirthDate = $birthDate->format('d/m/Y');
    ?>
        <div>
            <p><?= "Nom : " . $customer['lastName'] ?></p>
            <p><?= "Prénom : " . $customer['firstName'] ?></p>
            <p><?= "Date de naissance : " . $formatBirthDate ?></p>
            
            <?php
            if ($customer['card'] === 1) {
            ?>
                <p><?= "Carte de fidélité : oui " ?></p>
                <p><?= "Numéro de carte : " . $customer['cardNumber'] ?></p>
            <?php
            } else {
            ?>
                <p><?= "Carte de fidélité : non" ?></p>
            <?php
            };
            ?>
        </div><br>
    <?php
    }
    ?>
</body>

</html>