<?php
$pageTitle = "Hopital - Liste patient";

require_once "process/db_connect.php";
include "partials/header.php";

$request = $db->query("SELECT 
                            * 
                       FROM 
                            patients 
                       ORDER BY 
                            lastname 
                                ASC;");
$patients = $request->fetchAll();
?>

<div class="main_nav_container">

    <?php include "partials/nav.php"; ?>

    <main class="main_container">
        <div class="main_title_container">
            <h2>Historique des patients</h2>
        </div>
        <ul>
            <?php foreach ($patients as $patient): ?>
                <li>
                    <a href="profil_patient.php?id=<?= $patient['id'] ?>">
                        <?= htmlspecialchars($patient['lastname'] . " " . $patient['firstname']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>
</div>

<?php
include "partials/footer.php";
?>