<?php
require_once "process/db_connect.php";

$request = $db->query("SELECT
                            *
                       FROM
                            patients
                       ORDER BY
                            lastname ASC ;");

$patients = $request->fetchAll();
?>

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
    <title>Hopital - Liste patients</title>
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
                </ul>
            </nav>
        </aside>

        <main class="main_container">
            <div class="main_title_container">
                <h2>Historique des patients</h2>
            </div>
            <ul>
                <?php foreach ($patients as $patient) {
                ?>
                    <li><a href="profil_patient.php?id=<?= $patient['id'] ?>"><?= $patient['lastname'] . " " . $patient['firstname'] ?></a></li>
                <?php
                }
                ?>
            </ul>
        </main>
    </div>

    <footer></footer>
</body>

</html>