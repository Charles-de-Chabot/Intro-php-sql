<?php

require_once __DIR__ . '/config.php';

$connexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//* On verifie la connexion
if(!$connexion){
    die('Erreure de connexion' . mysqli_connect_error());
}

//* on force l'encodage utf8
mysqli_set_charset($connexion, 'utf8');
