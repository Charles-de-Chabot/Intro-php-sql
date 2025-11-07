<?php
//* On demarre la session AVANT tout contenu HTML
session_start();

require_once('../config/database.php');
require_once('../tools/functions.php');

global $connexion;
//*on verifie qu'on recoit bien bien les data du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    //* on déclare et sécurise les variables
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);

    // *verification des champs vides et de la validité des données
    if (empty($email)) {
        header("Location: ../index.php?error=Veuillez renseigner un email");
        exit();
    } else if (empty($password)) {
        header("Location: ../index.php?error=Veuillez renseigner un mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?error=Veuillez renseigner un email valide");
        exit();
    } else {
        //si on arrive ici c'est que tout va bien
        //*on vérifie si l'email existe déja dans la bdd 
        // dans une variable on va ecrire la requete
        $query = "SELECT * FROM `user` WHERE email= ?";
        // on va préparer la requete
        if ($stmt = mysqli_prepare($connexion, $query)) {
            //* si la requete s'est bien préparer on peu bind les paramètres
            mysqli_stmt_bind_param(
                $stmt, // on passe en 1er paramètre la preparation
                "s", // on definit le type de chaque ? dans l'ordre (s: string, i: integer, d: decimal)
                $email, // on donne la valeur de chaque ? dans l'ordre
            );
            // *on execute la preparation
            $execute = mysqli_stmt_execute($stmt);
            //*on verifie que l'execution s'est bien passé
            if ($execute) {
                //* si elle s'est bien executé on recupère les resultats
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) < 1) {
                    mysqli_close($connexion);
                    header("Location: ../index.php?error=L'email est/ou mot de passe incorrect");
                    exit();
                }

                //* si on a des resultats on les parcours et on verifie le combo email/mdp
                while ($user = mysqli_fetch_assoc($result)) {
                    if ($user['email'] === $email && password_verify($password, $user['password'])) {
                        // on stock les infos 
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['nickname'] = $user['nickname'];
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['is_active'] = $user['is_active'];
                        header("Location: ../home.php");
                        exit();
                    } else {
                        header("Location: ../index.php?error=Email et/ou mot de passe incorrect");
                        exit();
                    }
                }
            } else {
                header("Location: ../index.php?error=Erreur lors de l'execution de la requête");
                exit();
            }
        } else {
            header("Location: ../index.php?error=Erreur lors de la préparation de la requête");
            exit();
        }
    }
} else {
    var_dump("Erreur de formulaire");
}
