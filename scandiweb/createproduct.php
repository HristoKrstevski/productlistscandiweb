<?php

spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});
$error = false;
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>JuniorDeveloperTest-Hristo-Krstevski</title>
</head>
<body>
<div class="container">
    <div class="row" style="padding-top: 50px">
        <div class="col-md-3">
            <h1>Create Product</h1>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-1">
            <label for="submit-form" tabindex="0" class="btn"
                   style="border: 2px solid black; padding: 4px; position: relative; right: -50px">Save</label>
        </div>
        <div class="col-md-2">
            <a href="/index.php" class="btn"
               style="border: 2px solid black; padding: 4px; position: relative; right: -50px">Cancel</a>
        </div>
    </div>
    <hr class="solid-black" style="border: 1px solid black">
    <form id="product-form" method="post" action="/process/createproduct.php">
        <div class="form-group row">
            <label for="sku" class="col-sm-2 col-form-label"><h6>SKU</h6></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="sku" name="sku" required
                       oninvalid="this.setCustomValidity('Please, submit required data')"
                       oninput="this.setCustomValidity('')"/>

                <span class="cm-error"><?php echo $error; ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label"><h6>Name</h6></label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="name" name="name" required
                       oninvalid="this.setCustomValidity('Please, submit required data')"
                       oninput="this.setCustomValidity('')"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="price" class="col-sm-2 col-form-label"><h6>Price ($)</h6></label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="price" required name="price"
                       min="0" step=".01"
                       oninvalid="this.setCustomValidity('Please, submit required data')"
                       oninput="this.setCustomValidity('')"/>
            </div>
        </div>
        <br>
        <div>
            <label for="action" style="width: 200px"><h5> Type Switcher</h5></label>
            <select id="productType" name="action" onchange='onSelectChangeHandler()'>
                <option selected>Choose Type</option>
                <option value="dvd">DVD</option>
                <option value="furniture">Furniture</option>
                <option value="book">Book</option>
            </select>
        </div>
        <br>
        <br>
        <br>
        <div id="dvd" class="formOption">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div id="form">
                        <h5>Please, provide size!</h5>
                        <br>
                        <label for="size">Size (MB)</label>
                        <input type="number" name="size" placeholder="#size"><br>
                    </div>
                </div>
            </div>
        </div>
        <div id="furniture" class="formOption">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="dimensions">
                        <h5>Please, provide dimensions!</h5>
                        <br>
                        <label for="height" >Height (CM)</label>
                        <input type="number" id="height" name="height" placeholder="#height"><br>
                        <label for="width" >Width (CM)</label>
                        <input type="number" id="width" name="width" placeholder="#width"><br>
                        <label for="length">Length (CM)</label>
                        <input type="number" id="length" name="length" placeholder="#length"><br>
                    </div>
                </div>
            </div>
        </div>
        <div id="book" class="formOption">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div id="delete_section">
                        <h5>Please, provide weight</h5>
                        <br>
                        <label for="weight">Weight (KG)</label>
                        <input type="number" min="0" step=".01" id="delete_com_in" name="weight" placeholder="#weight"><br>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" id="submit-form" class="hidden" hidden>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
    <script>
        function onSelectChangeHandler() {
            var val = document.getElementById("productType").value;
            let optionElements = document.getElementsByClassName("formOption");
            for (let i = 0; i < optionElements.length; i++) {
                optionElements[i].style.display = "none";
            }
            document.getElementById(`${val}`).style.display = "block";
            /*
            switch (val) {
                case "dvd":
                    document.getElementById("dvd").style.display = "block";
                    document.getElementById("furniture").style.display = "none";
                    document.getElementById("book").style.display = "none";
                    console.log("Show form Add");
                    break;

                case "furniture":
                    document.getElementById("dvd").style.display = "none";
                    document.getElementById("furniture").style.display = "block";
                    document.getElementById("book").style.display = "none";
                    console.log("Show form Modify");
                    break;

                case "book":
                    document.getElementById("dvd").style.display = "none";
                    document.getElementById("furniture").style.display = "none";
                    document.getElementById("book").style.display = "block";
                    console.log("Show form Delete");
                    break;
            }
             */
        }
    </script>
    <footer>
        <hr class="solid-black" style="border: 1px solid black">
        <h6 style="text-align: center">Scandiweb Test Assignment</h6>
    </footer>
</div>
</body>
</html>