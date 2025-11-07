<?php

//* On demarre la session AVANT tout contenu HTML
session_start();
//* on verifie si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: ./index.php");
}


require_once("./templates/_header.php"); ?>

<h1>Nouveau produits</h1>
<a href="./home.php">Revenir à l'accueil</a>

<form action="./requete/add-product.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="">ajouter titre</label>
        <input type="text" name="title">
    </div>
    <div>
        <label for="">Saisire descrition</label>
        <textarea name="description" cols="10" rows="8" id=""></textarea>
    </div>
    <div>
        <label for="">ajouter prix</label>
        <input type="number" name="price">
    </div>
    <div>
        <label for="">Ajouter une image</label>
        <input type="file" name="image">
        <button type="submit">creer le produit</button>
    </div>
</form>

<?php require_once("./templates/_footer.php"); ?>