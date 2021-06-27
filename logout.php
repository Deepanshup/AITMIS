<?php
session_start();
unset($_SESSION['login_user']);
session_destroy();
header("Location: http://localhost/projects/aitmis/index.php"); // Redirecting To Home Page
?>