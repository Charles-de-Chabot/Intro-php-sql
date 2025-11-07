<?php

//* On demarre la session AVANT tout contenu HTML
session_start();
//* on verifie si l'utilisateur est connecté
if (isset($_SESSION['email'])) {
    header("Location: ./home.php");
}


require_once("./templates/_header.php"); ?>

<h1>Connexion</h1>
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error'] ?></p>
<?php } ?>

<form action="./requete/login.php" method="post">
    <div>
        <label for="">Saisir votre email:</label> <br>
        <input type="email" name="email">
    </div>
    <div>
        <label for="">Saisir votre passe:</label><br>
        <input type="password" name="password">
    </div>
    <div>
        <button type="submit">se connecter </button>
    </div>
    <p>Vous n'avez pas de compte<a href="./register.php">Inscivez-vous</a></p>
</form>

<?php require_once("./templates/_footer.php"); ?>