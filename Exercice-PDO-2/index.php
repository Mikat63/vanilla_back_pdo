<?php
$pageTitle = "Hospital - Accueil";
include "partials/header.php"
?>

<div class="main_nav_container">

    <?php
    include "partials/nav.php";
    ?>


    <main class="main_container_patient_profile">
        <div>
            <h2>Création patient et prise de rendez-vous</h2>
        </div>

        <div class="main_gestion_container">
            <form class="form_patient_rendezvous_container" action="" method="POST">

                <div class="patient_container">
                    <div class="add_patient_container">
                        <h3 class="form_title">Ajouter patient</h3>
                        <div class="add_patient">
                            <div>
                                <label for="lastName">Nom :</label>
                                <input class="input_form" type="text" name="lastName" id="lastName" minlength="3" maxlength="50" required>
                            </div>
                            <div>
                                <label for="firstName">Prénom:</label>
                                <input class="input_form" type="text" name="firstName" id="firstName" minlength="3" maxlength="50" required>
                            </div>
                            <div>
                                <label for="birthDate">Date de naissance :</label>
                                <input class="input_form" type="date" name="birthDate" id="birthDate" minlength="3" maxlength="50" required>
                            </div>
                            <div>
                                <label for="email">Email :</label>
                                <input class="input_form" type="email" name="email" id="email" minlength="3" maxlength="50" required>
                            </div>
                            <div>
                                <label for="phone">Téléphone :</label>
                                <input class="input_form" type="tel" name="phone" id="phone" minlength="3" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="add_rendezvous_container">
                        <div>
                            <h3>Ajouter un rendez-vous</h3>
                        </div>
                        <div>
                            <label for="dateTime">Date et heure:</label>
                            <input class="input_form" type="datetime-local" name="dateTime" id="dateTime" minlength="3" maxlength="50" placeholder="Entrez un prénom" required>
                        </div>
                    </div>
                </div>
                <div class="message_container">
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
                            default:
                                echo "Erreur inconnue";
                                break;
                        }
                    }
                    ?>
                </div>
                <div>
                    <button class="form_button" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </main>
</div>

<?php
include "partials/footer.php"
?>