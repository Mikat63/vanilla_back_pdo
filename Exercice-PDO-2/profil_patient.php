<?php
$pageTitle = "Hopital - profil patient";
require_once "process/db_connect.php";

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
}

include "partials/header.php";
?>

<div class="main_nav_container">
    <?php include "partials/nav.php"; ?>
    <main class="main_container_patient_profile">
        <div>
            <h2>Fiche patient</h2>
        </div>

        <div class=patient_container>
            <?php if ($patient) {
            ?>
                <div class="patient">
                    <p><strong><?= $patient['lastname'] . " " . $patient['firstname'] ?></strong></p>
                    <p><?= "<strong>Date de naissance : </strong>" . $patient['birthdate'] ?></p>
                    <p><?= "<strong>Email : </strong>" . $patient['mail'] ?></p>
                    <p><?= "<strong>Téléphone : </strong>" . $patient['phone'] ?></p>
                </div>
            <?php } else { ?>
                <div class="error_message">
                    <p class=" red">Patient introuvable</p>
                </div>
            <?php } ?>

            <hr>

            <form class="form_container" action="./process/update_patient.php" method="POST">
                <div>
                    <input type="hidden" name="id" value="<?= $patient['id'] ?>">
                </div>

                <div>
                    <label for="lastName">Nom :</label>
                    <input type="text" name="lastName" id="lastName" minlength="3" maxlength="50" value="<?= isset($_POST['lastName']) ? htmlspecialchars(strip_tags(strtoupper($_POST['lastName']))) : htmlspecialchars(strtoupper($patient['lastname'])) ?>" required>
                </div>

                <div>
                    <label for="firstName">Prénom:</label>
                    <input type="text" name="firstName" id="firstName" minlength="3" maxlength="50" value="<?= isset($_POST['firstName']) ? htmlspecialchars(strip_tags(ucfirst($_POST['firstName']))) : htmlspecialchars(ucfirst($patient['firstname'])) ?>" required>
                </div>
                <div>
                    <label for="birthDate">Date de naissance :</label>
                    <input type="date" name="birthDate" id="birthDate" minlength="3" maxlength="50" value="<?= isset($_POST['birthDate']) ? htmlspecialchars(strip_tags($_POST['birthDate'])) : htmlspecialchars($patient['birthdate']) ?>" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" minlength="3" maxlength="50" value="<?= isset($_POST['email']) ? htmlspecialchars(strip_tags(($_POST['email']))) : htmlspecialchars($patient['mail']) ?>" required>
                </div>
                <div>
                    <label for="phone">Téléphone :</label>
                    <input type="tel" name="phone" id="phone" minlength="3" maxlength="50" value="<?= isset($_POST['phone']) ? htmlspecialchars(strip_tags(($_POST['phone']))) : htmlspecialchars($patient['phone']) ?>" required>
                </div>

                <div>
                    <button class="form_button" type="submit">Modifier</button>
                </div>
            </form>
            <?php
            if (isset($_GET['success'])) {
                echo "<p class='green'>Les informations ont été modifiés avec succès</p>";
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
                    default:
                        echo "Erreur inconnue";
                        break;
                }
            }
            ?>
        </div>
    </main>
</div>

<?php
include "partials/footer.php";
?>