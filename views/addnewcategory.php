<?php
include"../inc/navigation.inc.php";
require("../classes/database.class.php");
require("../classes/products.class.php");

if(isset($_POST['add'])) {

    $category_name = $_POST['category'];

    $category = new Products();
    $result = $category->categoryRegist($category_name);

    if($result) {
        $registered == TRUE;
    } else {
        printf("REGISTER ERROR");
            exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <a href="admin.view.php">Atgal</a>
        <form action="addnewcategory.php" method="POST">
            Kategorijos pavadinimas: <input type="text" name="category" class="form-control" autocomplete="off">
            <br>
            <button type="submit" name="add" class="btn btn-primary">Įkelti</button>
        </form>
    </div>
    
</body>
</html>