<?php
require_once "../bdd_connect.php";

$request = $db->query(
    "SELECT 
        lastName,
        firstName 
    FROM 
        `clients` 
    WHERE 
        lastName 
            like 'M%'
    ORDER BY 
        lastName ASC;"
);

$customers = $request->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_5</title>
</head>

<body>
    <h1>Voici les clients dont le nom commence par un M :</h1>

    <?php
    foreach ($customers as $customer) {
    ?>
        <div>
            <p><?= "Nom : " . $customer['lastName'] ?></p>
            <p><?= "Prénom : " . $customer['firstName'] ?></p>
        </div>
        <br>
    <?php
    }
    ?>
</body>

</html>