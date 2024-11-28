<?php
session_start();

if (!isset($_SESSION['products_ids'])) {
    $_SESSION['products_ids'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'remove' && isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $index = array_search($product_id, $_SESSION['products_ids']);
        if ($index !== false) {
            unset($_SESSION['products_ids'][$index]);
            $_SESSION['products_ids'] = array_values($_SESSION['products_ids']);
        }

    }
}

?>