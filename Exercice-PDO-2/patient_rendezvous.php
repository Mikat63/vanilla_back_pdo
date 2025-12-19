<?php
$pageTitle = "Hopital - rendez-vous patient";
require_once "process/db_connect.php";

if (isset($_GET['id'])) {
    $request = $db->prepare(
        "SELECT
            pa.*,
            ap.id AS id_rendezvous,
            ap.datehour
        FROM
            appointments AS ap
        JOIN patients AS pa ON pa.id = ap.patient_id
        WHERE
            ap.id = :id;"
    );

    $request->execute([
        'id' => $_GET['id']
    ]);

    $patient = $request->fetch();
}

include "partials/header.php";
?>

<div class="main_nav_container">
    <?php include "partials/nav.php"; ?>

    <main class="main_container_patient_profile">
        <div>
            <h2>Rendez-vous du patient</h2>
        </div>


        <div class="main_gestion_container">
            <div class="patient_container">
                <div class="add_patient_container">
                    <?php if ($patient) {
                        $date = new DateTime($patient['datehour']);
                        $dateAfficher = $date->format('d/m/Y à H:i');
                    ?>
                        <div class="patient">
                            <p><strong><?= $patient['lastname'] . " " . $patient['firstname'] ?></strong></p>
                            <p><?= "<strong>Date de naissance : </strong>" . $patient['birthdate'] ?></p>
                            <p><?= "<strong>Email : </strong>" . $patient['mail'] ?></p>
                            <p><?= "<strong>Téléphone : </strong>" . $patient['phone'] ?></p>
                            <p><?= "<strong>Rendez-vous le : </strong>" . $dateAfficher ?></p>
                            <p><?= "<strong>Motif : </strong>" ?></p>
                        </div>
                </div>
                <hr>
                <div class="add_rendezvous_container">
                    <form class="form_container" action="./process/update_rendezvous.php" method="POST">
                        <div>
                            <input type="hidden" name="id_patient" value="<?= $patient['id'] ?>">
                        </div>
                        <div>
                            <input type="hidden" name="id_rendezvous" value="<?= $patient['id_rendezvous'] ?>">
                        </div>
                        <div>
                            <label for="dateTime">Date et heure:</label>
                            <input class=input_form type="datetime-local" name="dateTime" id="dateTime" required>
                        </div>
                        <div class="button_container">
                            <button class="form_button" type="submit">Modifier</button>
                        </div>
                    </form>
                    <?php
                        if (isset($_GET['success'])) {
                            echo "<p class='green'>Rendez-vous modifié avec succès</p>";
                        } else if (isset($_GET['error'])) {
                            switch (($_GET['error'])) {
                                case 'bad_method':
                                    echo "<p class='red'>Méthode incorrecte</p>";
                                    break;
                                case 'missing':
                                    echo "<p class='red'>La date doit être renseignée</p>";
                                    break;
                                case 'empty':
                                    echo "<p class='red'>La date doit être renseignée</p>";
                                    break;
                                case 'errorId':
                                    echo "<p class='red'>Patient introuvable</p>";
                                    break;
                                case 'erroridrendezvous':
                                    echo "<p class='red'>Rendez-vous introuvable </p>";
                                    break;
                                case 'errorDate':
                                    echo "<p class='red'>Le rendez-vous ne peut être inférieur à la date du jour</p>";
                                    break;
                                case 'invalidDate':
                                    echo "<p class='red'>La date est invalide</p>";
                                    break;
                                default:
                                    echo "<p class='red'>Erreur inconnue</p>";
                                    break;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <div>
            <button class="button_delete" type="button">Supprimer</button>
        </div>

        <div class="modal_confirm">
            <?php
                        $processLink = "process/delete_rendezvous";
                        $nameRendezVous = "id_rendezvous";
                        $modalValue = $patient['id_rendezvous'];
                        require_once "partials/modal_confirm.php";
            ?>
        </div>
    <?php

                    } else {
    ?>

        <div class="error_message">
            <p class="red">Rendez-vous introuvable</p>
        </div>
    <?php
                    }
    ?>
</div>


</main>
</div>

<?php
include "partials/footer.php";
?>