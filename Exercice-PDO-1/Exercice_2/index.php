<?php
require_once "../bdd_connect.php";

$request = $db->query("SELECT * FROM showtypes");

$showTypes = $request->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_2</title>
</head>

<body>
    <h1>Voici les différents types de spéctacles :</h1>
    <ul>
    <?php
    foreach ($showTypes as $showType) {
    ?>
        <li><?= $showType['type']?></li>
    <?php  
    }
    ?>
    </ul>
</body>

</html>