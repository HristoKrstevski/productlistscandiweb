<?php

spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['card']) && is_array($_POST['card'])) {
        $data = $_POST['card'];

        $product = new Product();
        $product->delete($_POST['card']);
        header("Location: index.php");
        exit();
    }
}



