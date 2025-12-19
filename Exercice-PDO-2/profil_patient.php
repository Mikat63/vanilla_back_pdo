<?php
$pageTitle = "Hopital - profil patient";
require_once "process/db_connect.php";


// patient request
if (isset($_GET['id'])) {
    $request = $db->prepare(
        "SELECT
                                *
                            FROM
                                patients
                            WHERE
                                id = :id;"
    );

    $request->execute([
        'id' => $_GET['id']
    ]);

    $patient = $request->fetch();

    // rendezvous request
    $rendezVousList = $db->prepare(
        "SELECT
                                *
                            FROM
                                appointments
                            WHERE
                                patient_id = :id;"
    );

    $rendezVousList->execute([
        'id' => $_GET['id']
    ]);

    $rendezVous = $rendezVousList->fetchall();
}

include "partials/header.php";
?>

<div class="main_nav_container">
    <?php include "partials/nav.php"; ?>

    <main class="main_container_patient_profile">
        <div>
            <h2>Fiche patient</h2>
        </div>

        <div class="main_gestion_container">
            <div class="patient_container">
                <div class="fiche_patient">
                    <?php if ($patient) { ?>
                        <div class="patient">
                            <p><strong><?= $patient['lastname'] . " " . $patient['firstname'] ?></strong></p>
                            <p><?= "<strong>Date de naissance : </strong>" . $patient['birthdate'] ?></p>
                            <p><?= "<strong>Email : </strong>" . $patient['mail'] ?></p>
                            <p><?= "<strong>Téléphone : </strong>" . $patient['phone'] ?></p>
                        </div>


                </div>


                <hr>


                <div class="form_profil_container">
                    <form class="form_container" action="process/update_patient.php" method="POST">
                        <div>
                            <input type="hidden" name="id" value="<?= $patient['id'] ?>">
                        </div>
                        <div>
                            <label for="lastName">Nom :</label>
                            <input class=input_form type="text" name="lastName" id="lastName" minlength="3" maxlength="50" value="<?= htmlspecialchars(strip_tags(strtoupper($patient['lastname']))) ?>" required>
                        </div>
                        <div>
                            <label for="firstName">Prénom:</label>
                            <input class=input_form type="text" name="firstName" id="firstName" minlength="3" maxlength="50" value="<?= htmlspecialchars(strip_tags(ucfirst($patient['firstname']))) ?>" required>
                        </div>
                        <div>
                            <label for="birthDate">Date de naissance :</label>
                            <input class=input_form type="date" name="birthDate" id="birthDate" value="<?= htmlspecialchars(strip_tags($patient['birthdate'])) ?>" required>
                        </div>
                        <div>
                            <label for="email">Email :</label>
                            <input class=input_form type="email" name="email" id="email" minlength="3" maxlength="50" value="<?= htmlspecialchars(strip_tags($patient['mail'])) ?>" required>
                        </div>
                        <div>
                            <label for="phone">Téléphone :</label>
                            <input class=input_form type="tel" name="phone" id="phone" minlength="3" maxlength="50" value="<?= htmlspecialchars(strip_tags($patient['phone'])) ?>" required>
                        </div>
                        <div>
                            <button class="form_button" type="submit">Modifier</button>
                        </div>
                    </form>
                    <?php
                        if (isset($_GET['success'])) {
                            echo "<p class='green'>Les informations du patient ont été modifiés avec succès</p>";
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
                                case 'min':
                                    echo "<p class='red'>Les champs doivent avoir minimum 3 caractères</p>";
                                    break;
                                case 'max':
                                    echo "<p class='red'>Les champs doivent avoir maximum 30 caractères</p>";
                                    break;
                                case 'minMaxPhone':
                                    echo "<p class='red'>Le format téléphone est incorrect</p>";
                                    break;
                                case 'invalidMail':
                                    echo "<p class='red'>L'email est invalide</p>";
                                    break;
                                case 'errorId':
                                    echo "<p class='red'>Patient introuvable</p>";
                                    break;
                                case 'format_string':
                                    echo "<p class='red'>Le champ nom et prénom doivent contenir que des lettres</p>";
                                    break;
                                case 'format_phone':
                                    echo "<p class='red'>le champ téléphone doit contenir que des chiffres</p>";
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

            <div class="rendezvous_container">
                <h2>Rendez-vous</h2>
                <?php
                        if ($rendezVous && count($rendezVous) > 0) {
                ?>
                    <ul>
                        <?php
                            foreach ($rendezVous as $eachRendezVous) {
                                $date = new DateTime($eachRendezVous['datehour']);
                                $dateAfficher = $date->format('d/m/Y à H:i');
                        ?>
                            <li><?= htmlspecialchars($dateAfficher) ?></li>
                        <?php
                            }
                        ?>
                    </ul>
                <?php
                        } else {
                ?>
                    <p>Aucun rendez-vous</p>
                <?php
                        }
                ?>
            </div>

            <div>
                <button class="button_delete" type="button">Supprimer</button>
            </div>

            <div class="modal_confirm">
                <?php
                        $processLink = "process/delete_patient_rendezvous.php";
                        $nameRendezVous = "id_patient";
                        $modalValue = $patient['id'];
                        require_once "partials/modal_confirm.php";
                ?>
            </div>
        <?php
                    } else {
        ?>

            <div class="error_message">
                <p class="red">Patient introuvable</p>
            </div>
        <?php } ?>
        </div>
    </main>
</div>

<?php
include "partials/footer.php";
?>