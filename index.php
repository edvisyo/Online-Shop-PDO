<?php
include_once "classes/database.class.php";
require("classes/products.class.php");
require("classes/getproducts.class.php");

session_start();

if(isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    

$db = new Products();
$getAllProducts = $db->getProducts("SELECT * FROM products");  


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- My CSS -->
    <link href="CSS/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" /> 
    <title>ShoppingPage</title>
</head>
<body>
    <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid" style="width: 80%">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            <!-- <a href="views/login.view.php">Prisijungimas</a>
            <a href="views/register.view.php">Registracija</a> -->
            <a href="views/cart.view.php"><i class="fas fa-shopping-cart fa-lg" style="margin-left: 15px"></i></a>
            <?php 
                if(isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                    echo "<span>$count</span>";
                } else {
                    echo "<span>0</span>";
                }
            ?>
            <a href="#" id="user_menu"><h6 style="color: black"><?php echo($_SESSION['username']); ?></h6></a>
            <div class="hidden_logout_btn" id="hidden_logout_btn">
            <a href="inc/logout.php">Atsijungti</a>
            </div>
            </form>
        </div>
        </div>
        </nav>
    </header>  
    <main>         
    <div class="container">
        <div class="row justify-content-between">
    <?php if($getAllProducts) { ?>
    <?php foreach($getAllProducts as $product) { ?>

        <div class="" style="width: 18rem; margin-top: 70px; margin-bottom: 40px">
            <img src="IMG/<?php echo $product->getImage(); ?>" class="card-img-top" height="300" width="300" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $product->getName(); ?></h5>
                
                <p><?php echo $product->getPrice(); ?>&euro;</p>
                <a href="views/product.view.php?product_id=<?php echo $product->getId(); ?>" class="btn btn-primary">Plačiau</a>
            </div>
        </div>
            
   <?php } ?>
<?php } ?>
    </div>
    </div>

    </main>
    <?php include "inc/footer.php"; ?>
    

<?php } else { ?>
     
    <?php echo '<script>alert("Neteisingai ivesti duomenys")</script>'; ?>
    <?php header("Refresh:0.1; url=views/login.view.php"); ?>
<?php } ?>

<!-- jQuery Script CDN -->
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<!-- JS for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- My Script -->
<script src="Script/myscript.js"></script>
</body>
</html>