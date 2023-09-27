<?php
session_start();

unset($_SESSION['admin']);
unset($_SESSION['user']);

session_destroy();

header('Location: ../index.php');
exit();
