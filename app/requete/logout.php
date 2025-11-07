<?php

session_start();
//*on detruit la session
session_destroy();
//*on redirige vers le formulaire de login
header("Location: ../index.php?erro=Vous êtes déconnecté");
exit();