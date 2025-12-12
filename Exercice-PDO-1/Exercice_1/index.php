<?php
    require_once "../bdd_connect.php";

    $request = $db->query("SELECT 
                                lastname,
                                firstname
                            FROM
                                clients"
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
   <ul>
    <h1>Voici la liste des clients :</h1>
    <?php
        foreach ($customers as $customer) {
    ?>
        <li><?= $customer['lastname'] . " " . $customer['firstname'];?></li>
    <?php
        }
    ?>
   </ul>
</body>
</html>