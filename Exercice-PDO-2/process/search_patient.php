<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../ajout_patient.php?error=bad_method');
    exit();
}

if (!isset($_POST['search_patient'])) {
    header('Location: ../liste_patients.php?error=missing');
    exit();
}

if (empty(trim($_POST['search_patient']))) {
    header('Location: ../liste_patients.php?error=empty');
    exit();
}

if (strlen($_POST['search_patient']) < 3) {
    header('Location: ../liste_patients.php?error=min');
    exit();
}

if (strlen($_POST['search_patient']) > 30) {
    header('Location: ../liste_patients.php?error=max');
    exit();
}

$regexLastname = '/^[\p{L} \'-]+$/u';

if (!preg_match($regexLastname, $_POST['search_patient'])) {
    header('Location: ../liste_patients.php?error=format_String');
    exit();
}


$lastName = htmlspecialchars(strip_tags(strtoupper($_POST['search_patient'])));

header("Location: ../liste_patients.php?lastname=$lastName");
