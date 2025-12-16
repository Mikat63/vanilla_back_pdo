<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?php echo isset($pageTitle) ? $pageTitle : "Hospital"; ?></title>
    <!-- general meta -->
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
    <title>Hopital</title>
</head>

<body>
    <header>
        <h1>Hopital</h1>
    </header>