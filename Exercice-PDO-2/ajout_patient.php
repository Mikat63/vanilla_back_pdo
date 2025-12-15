<!DOCTYPE html>
<html lang="fr">

<!-- general meta -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- SEO metas -->
<meta name="description" content="Gestion des patients de l'Hopital 2N. Ajout, liste et informations patients.">
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Hospital",
        "name": "Hopital 2N",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "1 rue de la Santé",
            "addressLocality": "Ville",
            "postalCode": "12345",
            "addressCountry": "FR"
        },
        "telephone": "+33 1 23 45 67 89"
    }
</script>

<!-- CSS&JS files -->
<link rel="stylesheet" href="style.css">
<title>Hopital - Ajout patient</title>
</head>

<body>
    <header>
        <h1>Hopital</h1>
    </header>

    <div class="main_aside_container">
        <aside>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="ajout_patient.php">Ajouter un patient</a></li>
                    <li><a href="liste_patients.php">Liste des patients</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main_container">
            <div class="main_title_container">
                <h2>Ajouter un patient</h2>
            </div>
            <form class="form_container" action="./process/patient.php" method="POST">
                <div>
                    <label for="lastName">Nom :</label>
                    <input type="text" name="lastName" id="lastName" minlength="3" maxlength="50" placeholder="Entrez un nom" required>
                </div>

                <div>
                    <label for="firstName">Prénom:</label>
                    <input type="text" name="firstName" id="firstName" minlength="3" maxlength="50" placeholder="Entrez un prénom" required>
                </div>
                <div>
                    <label for="birthDate">Date de naissance :</label>
                    <input type="date" name="birthDate" id="birthDate" minlength="3" maxlength="50" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" minlength="3" maxlength="50" placeholder="Entrez une adresse email" required>
                </div>
                <div>
                    <label for="phone">Téléphone :</label>
                    <input type="tel" name="phone" id="phone" minlength="3" maxlength="50" placeholder="Entrez un téléphone" required>
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
                    default:
                        echo "Erreur inconnue";
                        break;
                }
            }
            ?>
    </div>
    </main>
    </div>

    <footer></footer>
</body>

</html>