<?php
session_start();

// Réinitialisation des sessions possible
unset($_SESSION['admin']);
unset($_SESSION['user']);

// Destruction de la session active
session_destroy();

// Redirection vers la page login.php
header('Location: ../login.php');
exit();
