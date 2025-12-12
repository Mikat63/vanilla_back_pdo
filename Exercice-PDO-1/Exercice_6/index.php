<?php
require_once "../bdd_connect.php";

$request =  $db->query(
    "SELECT 
	    title,
        performer,
        date,
        startTime
    FROM	
	    shows
    ORDER BY
	    title
    	    ASC;"
);

$shows = $request->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice_6</title>
</head>

<body>
    <div>
        <?php
        foreach ($shows as $show) {
            $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
            $formatDate = $formatter->format(strtotime($show['date']));

            $time = new DateTime($show['startTime']);
            $timeFormat = $time->format('H:i');
        ?>
            <p><?= $show['title'] . " par " . $show['performer'] . ", aura lieu le " . $formatDate . " à " . $timeFormat ?></p>

        <?php
        }
        ?>
    </div>
</body>

</html>