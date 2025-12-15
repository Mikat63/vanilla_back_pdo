<?php
require_once "process/db_connect.php";

$request = $db->query("SELECT
                            *
                       FROM
                            patients
                       ORDER BY
                            lastname ASC ;");

$patients = $request->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Hopital - Liste des patients</title>
</head>

<body>
    <header>
        <h1>Hopital</h1>
    </header>

    <div class="main_aside_container">
        <aside>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="ajout_patient.php">Ajouter un patient</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main_container">
            <div class="main_title_container">
                <h2>Historique des patients</h2>
            </div>

            <section class="main_patient_container">
                <?php foreach ($patients as $patient) {
                ?>
                    <article class="patient_container">
                        <h4><?= $patient['lastname'] . " " . $patient['firstname'] ?></h4>
                        <p><?= "<strong>Date de naissance : </strong>" . $patient['birthdate'] ?></p>
                        <p><?= "<strong>Email : </strong>" . $patient['mail'] ?></p>
                        <p><?= "<strong>Téléphone : </strong>" . $patient['phone'] ?></p>
                    </article>
                <?php
                }
                ?>
            </section>
        </main>
    </div>

    <footer></footer>
</body>

</html>