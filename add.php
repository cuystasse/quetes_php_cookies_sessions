<?php
session_start();
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 04/10/17
 * Time: 15:23
 */

// Managing cookies
/*
 * $tab is like [ id_article, number_of_article  ]
 */

if (!isset($_SESSION['loginname'])) {
    header('Location: index.php');
    exit;
} else {
    $username = $_SESSION['loginname'];
}

if ($_POST) {
    // create if not exist (redondant with login >> security ? look for better method with teacher ?
    if (!isset($_COOKIE[$username . 'articles'])) {
        $cookieEntry = $username . 'articles';
        setcookie($cookieEntry, serialize([]), time() + 7 * 86400);
    }

    // add only if cake is not already in cookie_article array
    $tab = unserialize($_COOKIE[$username . 'articles']);

    $id = intval($_POST['addCake']); // id of cookie in bdd

    $nb = (array_key_exists($id, $tab)) ? $tab[$id][1] + 1 : 1; // set number of an article to 1 if not exist to nb+1 if exist

    $tab[$id] = [$_POST['addCake'], $nb];

    $cookieEntry = $username . 'articles';
    setcookie($cookieEntry, serialize($tab), time() + 7 * 86400);

    header('Location: index.php?message=add&id=' . $id);
    exit;
}

header('Location: index.php');