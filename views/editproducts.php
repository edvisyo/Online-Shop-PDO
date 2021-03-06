<?php
ob_start();
include_once "../inc/navigation.inc.php";
require_once("../classes/database.class.php");
require_once("../classes/pagination.class.php");

$pagination = new Pagination('products');
$allProducts = $pagination->getData();
$pages = $pagination->getPageNumbers();

if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $result = $pagination->deleteProduct($id);

    if($result) {
        echo '<script>alert("Produktas pašalintas")</script>';
        header("Refresh:0.1; url=editproducts.php");
    } 
    
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- My CSS -->
    <link href="../CSS/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" /> 
    <title>Esamu prekiu redagavimas</title>
</head>
<body>
    <div class="container">
    <div style="margin-top: 20px">
    <a href="admin.view.php">Atgal</a>
    </div>
    <h3 style="margin-top: 30px; margin-bottom: 50px">Prekių redagavimo puslapis</h3>
        <?php if(!empty($_SESSION['message'])) { ?>
        <div class="alert alert-success" role="alert" style="text-align: center">
            <?php echo $_SESSION['message']; ?>
        </div>
            <?php unset($_SESSION['message']); ?>
        <?php } ?>
            <table class="table">
        <thead>
            <tr>
            <th scope="col">Paveiksėlis</th>
            <th scope="col">Pavadinimas</th>
            <th scope="col">Aprašymas</th>
            <th scope="col">Redaguoti informaciją</th>
            <th scope="col">Pašalinti produktą</th>
            </tr>
        </thead>
        <tbody>
        <?php if($allProducts) { ?>
            <?php foreach($allProducts as $product) { ?>
            <tr>
            <td><img src="../IMG/<?php echo $product->image; ?>" width="120" height="120"></td>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->description; ?></td>
            <td><a href="edit_product_info.php?edit_id=<?php echo $product->id; ?>" class="btn btn-warning">Redaguoti produktą</a></td>
            <td><a href="editproducts.php?delete_id=<?php echo $product->id; ?>" class="btn btn-danger">Ištrinti produktą</a></td>
            </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
        </table>

        <nav aria-label="Page navigation example" style="margin-bottom: 80px">
        <ul class="pagination justify-content-center">
            <li class="page-item">
            <a class="page-link" href="editproducts.php?page=<?php echo $pagination->prevPage(); ?>" tabindex="-1" aria-disabled="true">Atgal</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++) { ?>
            <li class="page-item <?php echo $pagination->is_active($page); ?>"><a class="page-link" href="editproducts.php?page=<?php echo $page; ?>"><?php echo $page ?></a></li>
            <?php } ?>
            <li class="page-item">
            <a class="page-link" href="editproducts.php?page=<?php echo $pagination->nextPage($page); ?>">Pirmyn</a>
            </li>
        </ul>
        </nav>

    </div>
    <?php include "../inc/footer.php"; ?>
   <?php ob_end_flush(); ?> 
</body>
</html>