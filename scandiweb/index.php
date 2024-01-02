<?php
session_start();
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>JuniorDeveloperTest-Hristo-Krstevski</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
<form method="post" action="/deleteproduct.php">
    <div class="container">
        <div class="row" style="padding-top: 50px">
            <div class="col-md-3">
                <h1>Product List</h1>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-1">
                <a href="/createproduct.php" class="btn btn-cstm">ADD</a>
            </div>
            <div class="col-md-2">
                <input id="massdelete" value="MASS DELETE" type="submit" class="btn btn-cstm">
            </div>
        </div>
        <hr class="solid-black" style="border: 1px solid black">
        <div class="row">
            <?php
            $data = new Product();
            $products = $data->getInner('product', 'properties', 'properties_id', 'id');

            foreach ($products as $product) :?>
                <div class=" col-sm-6 col-md-4 col-lg-3 optional card-parent">
                    <div class="card">
                        <label class="delete" for="checkbox" hidden><?php echo $product->product_id ?></label>
                        <input type="checkbox" class="delete-checkbox" name="card[]" value="<?php echo $product->product_id ?>" style="position: absolute; top: 0; left: 0">
                        <div class="card-body">
                            <?php if ($product->sku): ?>
                                <h6 class="card-title"><?php echo $product->sku ?></h6>
                            <?php endif; ?>
                            <?php if ($product->name): ?>
                                <div class="card-text"><p><?php echo $product->name ?></p></div>
                            <?php endif; ?>
                            <?php if ($product->price): ?>
                                <div class="card-text"><p><?php echo $product->price ?>$</p></div>
                            <?php endif; ?>
                            <?php if ($product->action): ?>
                                <div class="card-text action" hidden data-id="<?php echo $product->id ?>" style="text-align: center"><p><?php echo $product->action ?></p></div>
                            <?php endif; ?>
                            <?php if ($product->size): ?>
                                <div class="card-text formOption" id="dvd-<?php echo $product->id ?>" style="text-align: center"><p>Size <?php echo $product->size ?> MB</p></div>
                            <?php endif; ?>
                            <?php if ($product->weight): ?>
                                <div class="card-text formOption" id="book-<?php echo $product->id ?>" style="text-align: center"><p>Weight <?php echo $product->weight ?> KG</p></div>
                            <?php endif; ?>
                            <?php if ($product->height || $product->weight || $product->length): ?>
                                <div class="card-text formOption" id="furniture-<?php echo $product->id ?>" style="text-align: center"><p>Dimensions: <?php echo $product->height ?>x<?php echo $product->width ?>x<?php echo $product->length ?></p></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

<footer>
    <hr class="solid-black" style="border: 1px solid black">
    <h6 style="text-align: center">Scandiweb Test Assignment</h6>
</footer>
</body>
</html>
