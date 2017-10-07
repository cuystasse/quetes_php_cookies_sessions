<?php
session_start();

if (!empty($_SESSION['loginname'])) {
    $username = $_SESSION['loginname'];
    session_destroy();
    $direction = 'login.php?message=logout&username=' . $username;
    header('Location: ' . $direction);
    exit;
}

header('Location: login.php');