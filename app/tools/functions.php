<?php

/** 
 ** méthode qui permet de valider et sécuriser les inputs
 * @param string $data
 * @return string  $data
 */

function validate ($data){
//   $data = htmlspecialchars($data); //! convertit les caractères spéciaux en entité HTML
//   $data = stripslashes($data);     //! enlève les "\"
//   $data = trim($data);             //! supprime les espaces en début et fin de chaine

return trim(stripslashes(htmlspecialchars($data))); 
}

/**
 ** Méthode qui vérifie la conformité du mot de passe
 * 1 majuscule, 1 minuscule, 1 chiffre et au moins 8 caractère
 * @param string $password
 * @return bool 
 */

function check_password($password){
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';
    return preg_match($regex, $password);
}
