<?php

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');

function getConnexion()
{
    $connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$connexion) {
        die('Erreur de connexion MySQL : ' . mysqli_connect_error());
    }

    mysqli_set_charset($connexion, DB_CHARSET);
    return $connexion;
}

