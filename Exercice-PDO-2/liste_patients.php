<?php
$pageTitle = "Hopital - Liste patient";

require_once "process/db_connect.php";
include "partials/header.php";

// elements by page
$patientsByPage = 10;


// control GET if int and positiv value
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

if ($page < 1) {
    $page = 1;
}

// pffset declaration
$offset = ($page - 1) * $patientsByPage;

// pagination request
$requestPagination = $db->prepare(
    "SELECT
                                    *
                                FROM
                                    Patients 
                                ORDER BY 
                                    lastname ASC
                                        LIMIT :limit
                                        OFFSET :offset;"
);

$requestPagination->bindValue(':limit', $patientsByPage, PDO::PARAM_INT);
$requestPagination->bindValue(':offset', $offset, PDO::PARAM_INT);
$requestPagination->execute();

// total request
$totalPatients = $db->query(
    "SELECT
                                COUNT(*)
                            FROM 
                                patients;"
)->fetchColumn();

// total pages
$totalPages = ceil($totalPatients / $patientsByPage);

if (isset($_GET['lastname'])) {
    // query for search patient
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
    $patients = $requestPagination->fetchAll();
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

            <?php if (isset($_GET['error'])) {
                switch (($_GET['error'])) {
                    case 'bad_method':
                        echo "<p class='red'>Méthode incorrecte</p>";
                        break;
                    case 'missing':
                        echo "<p class='red'>Le champs est requis</p>";
                        break;
                    case 'empty':
                        echo "<p class='red'>Le champs ne peut être vides</p>";
                        break;
                    case 'min':
                        echo "<p class='red'>Le champs doit avoir minimum 3 caractères</p>";
                        break;
                    case 'max':
                        echo "<p class='red'>Le champs doit avoir maximum 30 caractères</p>";
                        break;
                    default:
                        echo "<p class='red'>Erreur inconnue</p>";
                        break;
                }
            } ?>
        </form>

        <div class="list_patient_container">
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

        <div class="pagination_list_container">
            <ul class="pagination_list">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i === $page) { ?>
                        <li class="links_list_patient"><?= $i; ?></li>

                    <?php
                    } else { ?>
                        <a href='?page=$i'><?= $i ?></a>
                <?php
                    }
                } ?>
            </ul>
        </div>
    </main>
</div>

<?php
include "partials/footer.php";
?>