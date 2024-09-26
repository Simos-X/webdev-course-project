<?php
include 'MySQLiServerConnection.php';

    
            $userId = $_POST["userId"];
            $brand = $_POST["brand"];
            $model = $_POST["model"];
            $price = $_POST["price"];
            $category =  $_POST['selectedCategory'];
            $categoryId =  $_POST['selectedCategoryId'];
            $productCode = $_POST['productCode'];

            $checkIfExists = "SELECT * FROM cart WHERE userId = $userId AND brand = '$brand' AND model = '$model'";
            $resultCheck = mysqli_query($conn, $checkIfExists);

            if (mysqli_num_rows($resultCheck) > 0) 
            {
                $row = mysqli_fetch_assoc($resultCheck);

                $quantity = $row['quantity'] + 1;

                $newPrice = $quantity * $price;

                $updateQuery = "UPDATE cart SET quantity = $quantity, price = $newPrice WHERE userId = $userId AND brand = '$brand' AND model = '$model'";
            

                if (mysqli_query($conn, $updateQuery)) {
                    header("Location: ProdDescription.php?category=$category&ProductTypeId=$categoryId&model=$model&productCode=$productCode");
                } 

            } 
            
            else {
                $quantity = 1;
                $insertQuery = "INSERT INTO cart (productId,userId, brand, model, price, quantity) 
                                VALUES ($productCode, $userId, '$brand', '$model', $price, $quantity)";

                if (mysqli_query($conn, $insertQuery))
                {
                    header("Location: ProdDescription.php?category=$category&ProductTypeId=$categoryId&model=$model&productCode=$productCode");
                } 
            }

            mysqli_close($conn);
    
