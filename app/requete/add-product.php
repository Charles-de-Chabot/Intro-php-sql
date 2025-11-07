<?php

session_start();

require_once('../config/database.php');
require_once('../tools/functions.php');

global $connexion;

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price'])) {
    //on declare les variables
    $title = validate($_POST['title']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);

    $is_available = true;
    $created_at = time();
    $user_id = $_SESSION['id'];

    $image_name = $_FILES['image']['name'];

    if (empty($title) || empty($description) || empty($price)) {
        header("Location: ../product.php?error=Veuillez remplir tous les champs");
        exit();
    } else {
        //on regarde si $image_name n'est pas vide
        if (!empty($image_name)) {
            // on traite l'image uploadé
            //on vérifie que l'image est au bon format
            $format = $_FILES['image']['type'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $dir_name = '../uploads/images/'; //chemin ou je veux que mon fichier soit déplacé
            if (
                $format !== "image/jpeg" &&
                $format !== "image/png"  &&
                $format !== "image/jpg"  &&
                $format !== "image/gif"  &&
                $format !== "image/webp"
            ) {
                header("Location: ../product.php?error=Format d'image non conforme (jpeg, jpg, png, gif, webp)");
                exit();
            } else {
                //on peut traiter l'image
                //on lui donne un nom unique
                $uniq_name = uniqid() . "_" . $image_name;
                //on va deplacer l'image physique dans son dossier de destination et si success on a joute en bdd les infos
                if (move_uploaded_file($tmp_name, $dir_name . $uniq_name)) {
                    //on crée la requete
                    $query = "INSERT INTO `product` (title, description, price, is_available, created_at, user_id, image) VALUES (?,?,?,?,?,?,?)";
                    //on prepare la requete
                    if ($stmt = mysqli_prepare($connexion, $query)) {
                        //on bind les params
                        mysqli_stmt_bind_param(
                            $stmt,
                            "ssiiiis",
                            $title,
                            $description,
                            $price,
                            $is_available,
                            $created_at,
                            $user_id,
                            $uniq_name
                        );

                        //on execute la requete
                        if (mysqli_stmt_execute($stmt)) {
                            mysqli_close($connexion);
                            //on redirige vers la page d'accueil
                            header("Location: ../home.php");
                        } else {
                            header("Location: ../product.php?error=Erreur lors de l'execution de la requete");
                            exit();
                        }
                    } else {
                        header("Location: ../product.php?error=Erreur lors de la preparation de la requete");
                        exit();
                    }
                } else {
                    header("Location: ../product.php?error=Erreur lors du deplacement de l'image");
                    exit();
                }
            }
        } else {

            //on crée la requete
            $query = "INSERT INTO `product` (title, description, price, is_available, created_at, user_id) VALUES (?,?,?,?,?,?)";
            //on prepare la requete
            if ($stmt = mysqli_prepare($connexion, $query)) {
                //on bind les params
                mysqli_stmt_bind_param(
                    $stmt,
                    "ssiiii",
                    $title,
                    $description,
                    $price,
                    $is_available,
                    $created_at,
                    $user_id

                );

                //on execute la requete
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_close($connexion);
                    //on redirige vers la page d'accueil
                    header("Location: ../home.php");
                } else {
                    header("Location: ../product.php?error=Erreur lors de l'execution de la requete");
                    exit();
                }
            } else {
                header("Location: ../product.php?error=Erreur lors de la preparation de la requete");
                exit();
            }
        }
    }
} else {
    header("Location: ../product.php?error=Erreur du formulaire");
    exit();
}
