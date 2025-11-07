<?php 

//* On demarre la session AVANT tout contenu HTML
session_start();

//* on verifie si l'utilisateur est connecté
if(!isset($_SESSION['email'])){
    header("Location: ./index.php");
}


require_once("./templates/_header.php"); ?>

<h1>Accueil</h1>
<a href="./requete/logout.php">se déconnecter</a>
<a href="./product.php">Ajouter un Produit</a>
<?php require_once("./templates/_footer.php"); ?>