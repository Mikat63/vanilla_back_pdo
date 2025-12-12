<?php

try {
    $dsn = 'mysql:host=localhost;dbname=colyseum';
    $user = 'root';
    $password = "";

    $db = new PDO($dsn,$user,$password);
} catch (PDOException $error) {
    echo "Erreur de connexion : $error";
}
