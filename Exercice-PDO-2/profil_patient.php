<?php
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

?>

<!DOCTYPE html>
<html lang="en">

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
<title>Hopital - Profil patient</title>
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

        <main class="main_container_patient_profile">
            <div>
                <h2>Fiche patient</h2>
            </div>

            <?php if ($patient) {
            ?>
                <div class="patient_container">
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
        </main>
    </div>

    <footer></footer>
</body>

</html>