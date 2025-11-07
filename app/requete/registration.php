<?php
//* On demarre la session AVANT tout contenu HTML
session_start();

require_once('../config/database.php');
require_once('../tools/functions.php');

global $connexion;
//*on verifie qu'on recoit bien bien les data du formulaire
if (isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password'])) {
    //* on déclare et sécurise les variables
    $nickname = validate($_POST['nickname']);
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);
    $is_active = true;

    //*on va hasher le MDP
    $pass_hash = password_hash($password, PASSWORD_BCRYPT);

    // *verification des champs vides et de la validité des données
    if (empty($nickname)) {
        header("Location: ../register.php?error=Veuillez renseigner un pseudo");
        exit();
    } else if (empty($email)) {
        header("Location: ../register.php?error=Veuillez renseigner un email");
        exit();
    } else if (empty($password)) {
        header("Location: ../register.php?error=Veuillez renseigner un mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=Veuillez renseigner un email valide");
        exit();
    } else if (!check_password($password)) {
        header("Location: ../register.php?error=Le mot de passe doit contenir au moins 1 majuscule, 1 miniscule, 1 chiffre et 8 caractères minimum");
        exit();
    } else {
        //si on arrive ici c'est que tout va bien
        //*on vérifie si l'email existe déja dans la bdd 
        // dans une variable on va ecrire la requete
        $query = "SELECT * FROM `user` WHERE email= ?";
        // on va préparer la requete
        if ($stmt = mysqli_prepare($connexion, $query)) {
            // si la requete s'est bien préparer on peu bind les paramètres
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
                if (mysqli_num_rows($result) > 0) {
                    header("Location: ../register.php?error=L'email existe déja");
                    exit();
                } else {
                    //* on peut inserer l'utilisateur dans la bdd
                    $query_post = "INSERT INTO `user` (nickname, email, password, is_active) VALUES (?,?,?,?)";
                    //* on prépare la requete
                    if ($stmt_post = mysqli_prepare($connexion, $query_post)) {
                        // si la requete s'est bien preparer on peut bind les params
                        mysqli_stmt_bind_param(
                            $stmt_post,
                            "sssi",
                            $nickname,
                            $email,
                            $pass_hash, //attention mot de passe hashé ici
                            $is_active
                        );
                        //* on execute la preparation
                        $execute_post = mysqli_stmt_execute($stmt_post);
                        if ($execute_post) {
                            //* si on est ici c'est que l'utilisateur est inseré en bdd
                            $stmt_get = mysqli_prepare($connexion, $query);
                            mysqli_stmt_bind_param(
                                $stmt_get,
                                "s",
                                $email
                            );
                            $execute_get = mysqli_stmt_execute($stmt_get);
                            if ($execute_get) {
                                $result_get = mysqli_stmt_get_result($stmt_get);
                                if (mysqli_num_rows($result_get) > 0) {
                                    //*ici on recupère les info de l'user fraichement inscrit, on creer la session et on redirige sur l'accueil 
                                    $new_user = mysqli_fetch_assoc($result_get);
                                    //*on crée la session
                                    $_SESSION['email'] = $new_user['email'];
                                    $_SESSION['nickname'] = $new_user['nickname'];
                                    $_SESSION['id'] = $new_user['id'];
                                    $_SESSION['is_active'] = $new_user['is_active'];
                                    header("Location: ../home.php");
                                    exit();
                                }
                            }
                        }
                    }
                }
            } else {
                header("Location: ../register.php?error=Erreur lors de l'execution de la requête");
                exit();
            }
        } else {
            header("Location: ../register.php?error=Erreur lors de la préparation de la requête");
            exit();
        }
    }
} else {
    var_dump("Erreur de formulaire");
}
