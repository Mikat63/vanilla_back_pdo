<?php
$pageTitle = "Hopital - Liste rendez-vous";

require_once "process/db_connect.php";
include "partials/header.php";

$request = $db->query("SELECT 
                        pa.id AS id_patient,
                        pa.lastname,
                        pa.firstname,
                        ap.id AS id_rendezvous,
                        ap.datehour
                        FROM 
                            appointments AS ap
                        JOIN patients AS pa ON pa.id = ap.patient_id  
                        ORDER BY 
                            datehour ASC;");
                            
$patients = $request->fetchAll();
?>

<div class="main_nav_container">

    <?php include "partials/nav.php"; ?>

    <main class="main_container">
        <div class="main_title_container">
            <h2>Historique des rendez-vous</h2>
        </div>
        <ul>
            <?php foreach ($patients as $patient): ?>
                <li>
                    <a href="patient_rendezvous.php?id=<?= $patient['id_rendezvous'] ?>">
                        <?= htmlspecialchars($patient['datehour']) . " - " . htmlspecialchars($patient['lastname'] . " " . $patient['firstname']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</div>

<?php
include "partials/footer.php";
?>