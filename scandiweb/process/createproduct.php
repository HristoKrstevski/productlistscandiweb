<?php

spl_autoload_register(function ($class) {
    include '../class/' . $class . '.php';
});



if (isset($_POST['sku']) && !empty($_POST['sku'])) {
    $sku = $_POST['sku'];
} else {
    $sku = '';
}

if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = '';
}

if (isset($_POST['price']) && !empty($_POST['price'])) {
    $price = $_POST['price'];
} else {
    $price = '';
}

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = '';
}

if (isset($_POST['size']) && !empty($_POST['size'])) {
    $size = $_POST['size'];
} else {
    $size = NULL;
}

if (isset($_POST['height']) && !empty($_POST['height'])) {
    $height = $_POST['height'];
} else {
    $height = NULL;
}

if (isset($_POST['width']) && !empty($_POST['width'])) {
    $width = $_POST['width'];
} else {
    $width = NULL;
}

if (isset($_POST['length']) && !empty($_POST['length'])) {
    $length = $_POST['length'];
} else {
    $length = NULL;
}

if (isset($_POST['weight']) && !empty($_POST['weight'])) {
    $weight = $_POST['weight'];
} else {
    $weight = NULL;
}

$product = new Product();

$product->setSku($sku);
$product->setName($name);
$product->setPrice($price);
$product->setAction($action);
$product->setSize($size);
$product->setHeight($height);
$product->setWidth($width);
$product->setLength($length);
$product->setWeight($weight);
$product = $product->save();


if($product instanceof Product) {
    header('Location: /index.php');
} else if (empty($product)) {
    header('Location: /index.php');
} else {
    header('Location: /createproduct.php?error='.$product);
}

