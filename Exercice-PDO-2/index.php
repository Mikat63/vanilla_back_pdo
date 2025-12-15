<!DOCTYPE html>
<html lang="fr">

<head>
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
    <title>Hopital - Accueil</title>
</head>

<body>
    <header>
        <h1>Hopital</h1>
    </header>

    <div class="main_aside_container">
        <aside>
            <nav>
                <ul>
                    <li><a href="ajout_patient.php">Ajouter un patient</a></li>
                    <li><a href="liste_patients.php">Liste des patients</a></li>
                </ul>
            </nav>
        </aside>

        <main>
        </main>
    </div>

    <footer></footer>
</body>

</html>