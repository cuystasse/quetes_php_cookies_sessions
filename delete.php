<?php
session_start();
/**
 * Created by PhpStorm.
 * User: wilder8
 * Date: 04/10/17
 * Time: 15:23
 */

// Managing cookies
if (!isset($_SESSION['loginname'])) {
    header('Location: index.php');
    exit;
} else {
    $username = $_SESSION['loginname'];
}

if ($_POST) {
    // delete entry if exist
    $tab = unserialize($_COOKIE[$username . 'articles']);
    if ($_POST['deleteCake'] == 'all') {
        $ids = [];
        foreach ($tab as $id=>$value) {
            $subtab = array_fill(0, $value[1], $value[0]);
            foreach ($subtab as $elm) {
                $ids[] = $elm;
            }
        }
    } else {
        $ids = explode(' ', $_POST['deleteCake']); // delete multiple entries if demanded
    }

    $counter = 0;
    foreach ($ids as $id) {
        if (array_key_exists($id, $tab)) {
            $counter++;

            if ($tab[$id][1] > 1) {
                $tab[$id][1] -= 1;

            } else {
                unset($tab[$id]);
            }
        }
    }

    $cookieEntry = $username . 'articles';
    setcookie($cookieEntry, serialize($tab), time() + 7 * 86400);
}

if (0 == $counter) {
    header('Location: cart.php');
} else if (1 == $counter) {
    header('Location: cart.php?message=delete&id=' . $id);
} else {
    header('Location: cart.php?message=deleteMany&number=' . $counter);
}