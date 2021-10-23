<?php
    $dsn = '';
    $user = '';
    $password = '';

    try {
        $dbTyping = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
?>