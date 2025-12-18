<?php
$pageTitle = "Hopital - Liste patient";

require_once "process/db_connect.php";
include "partials/header.php";


if (isset($_GET['lastname'])) {
    $requestSearch = $db->prepare(
        "SELECT
                                      *
                                    FROM
                                        patients
                                    WHERE
                                        lastname 
                                            LIKE :lastname_search;"
    );

    $requestSearch->execute([
        'lastname_search' => "%" . $_GET['lastname'] . "%"
    ]);

    $patients = $requestSearch->fetchAll();
} else {
    $request = $db->query("SELECT 
                            * 
                       FROM 
                            patients 
                       ORDER BY 
                            lastname 
                                ASC;");
    $patients = $request->fetchAll();
}
?>

<div class="main_nav_container">

    <?php include "partials/nav.php"; ?>

    <main class="main_container">
        <div class="main_title_container">
            <h2>Historique des patients</h2>
        </div>

        <form class="search_form" action="process/search_patient.php" method="POST">
            <input class=input_form name="search_patient" type="text" aria-label="Rechercher un patient" minlength="3" maxlength="30" placeholder="Entrez un nom">
            <button class="form_button" type="submit">Rechercher</button>
        </form>

        <div>
            <?php
            if ($patients && count($patients) > 0) {
            ?>
                <ul>
                    <?php foreach ($patients as $patient): ?>
                        <li>
                            <a href="profil_patient.php?id=<?= $patient['id'] ?>">
                                <?= htmlspecialchars($patient['lastname'] . " " . $patient['firstname']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php
            } else {
            ?>
                <p>Aucun patient</p>
            <?php
            }
            ?>
        </div>
    </main>
</div>

<?php
include "partials/footer.php";
?>