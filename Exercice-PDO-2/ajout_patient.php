<?php
$pageTitle = "Hopital - Ajout patient";
include "partials/header.php";

?>


<div class="main_nav_container">

    <?php
    include "partials/nav.php";
    ?>

    <main class="main_container">
        <div class="main_title_container">
            <h2>Ajouter un patient</h2>
        </div>
        <form class="form_container" action="./process/patient.php" method="POST">
            <div>
                <label for="lastName">Nom :</label>
                <input class=input_form type="text" name="lastName" id="lastName" minlength="3" maxlength="50" placeholder="Entrez un nom" required>
            </div>

            <div>
                <label for="firstName">Prénom:</label>
                <input class=input_form type="text" name="firstName" id="firstName" minlength="3" maxlength="50" placeholder="Entrez un prénom" required>
            </div>
            <div>
                <label for="birthDate">Date de naissance :</label>
                <input class=input_form type="date" name="birthDate" id="birthDate" minlength="3" maxlength="50" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input class=input_form type="email" name="email" id="email" minlength="3" maxlength="50" placeholder="Entrez une adresse email" required>
            </div>
            <div>
                <label for="phone">Téléphone :</label>
                <input class=input_form type="tel" name="phone" id="phone" minlength="3" maxlength="50" placeholder="Entrez un téléphone" required>
            </div>

            <div>
                <button class="form_button" type="submit">Créer</button>
            </div>
        </form>
        <?php
        if (isset($_GET['success'])) {
            echo "<p class='green'>patient créé avec succès</p>";
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
    </main>
</div>

<?php
include "partials/footer.php";
?>