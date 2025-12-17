<?php
require_once "process/db_connect.php";
$pageTitle = "Hopital - Ajout rendez-vous";
include "partials/header.php";

$request = $db->query(
    "SELECT
                          id,
                          lastname,
                          firstname
                       FROM
                            patients
                       ORDER BY 
                           lastName 
                                ASC;"

);

$patients = $request->fetchAll();
?>


<div class="main_nav_container">

    <?php
    include "partials/nav.php";
    ?>

    <main class="main_container">
        <div class="main_title_container">
            <h2>Ajouter un rendez-vous</h2>
        </div>

        <form class="form_container" action="./process/rendezvous.php" method="POST">
            <div>
                <label for="patient">Patient :</label>
                <select type="text" name="patient" id="patient" minlength="3" maxlength="50" required>
                    <option value="">Selectionner un patient</option>
                    <?php
                    foreach ($patients as $patient) { ?>
                        <option value="<?= htmlspecialchars($patient['id']) ?>"><?= htmlspecialchars($patient['lastname']) . " " . htmlspecialchars($patient['firstname']) ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="dateTime">Date et heure:</label>
                <input type="datetime-local" name="dateTime" id="dateTime" minlength="3" maxlength="50" placeholder="Entrez un prénom" required>
            </div>

            <div>
                <button class="form_button" type="submit">Créer</button>
            </div>
        </form>
        <?php
        if (isset($_GET['success'])) {
            echo "<p class='green'>Rendez-vous créé avec succès</p>";
        } else if (isset($_GET['error'])) {
            switch (($_GET['error'])) {
                case 'bad_method':
                    echo "<p class='red'>Méthode incorrecte</p>";
                    break;
                case 'missing':
                    echo "<p class='red'>Tous les champs sont requis</p>";
                    break;
                case 'empty':
                    echo "<p class='red'>Les champs ne peuvent être vides</p>";
                    break;
                case 'errorId':
                    echo "<p class='red'>Patient introuvable</p>";
                    break;
                default:
                    echo "Erreur inconnue";
                    break;
            }
        }
        ?>
    </main>
</div>

<?php
include "partials/footer.php";
?>