<?php
include 'MySQLiServerConnection.php';

    $userId = $_GET['userId'];
    $productCode = $_GET['productCode'];
    $quantity = $_GET['updatedQuantity'];


    $sql_product = "SELECT price FROM products WHERE productCode = $productCode";
    $result_product = mysqli_query($conn, $sql_product);
    if (mysqli_num_rows($result_product) > 0) 
    {
        $row_product = mysqli_fetch_assoc($result_product);
        $productPrice = $row_product['price'];
    } 

    $newPrice = $quantity * $productPrice;


    $updateQuery = "UPDATE cart SET quantity = $quantity, price = $newPrice WHERE userId = $userId AND productId = $productCode";

    if (mysqli_query($conn, $updateQuery))
     {
        echo $newPrice."€";
    } 

    
    mysqli_close($conn);