<?php
include 'MySQLiServerConnection.php';

    $userId = $_GET["userId"];


    $sql_totPrice = "SELECT SUM(price) AS total FROM cart WHERE userId = $userId";
    $result_totPrice= mysqli_query($conn, $sql_totPrice);

    if (mysqli_num_rows($result_totPrice) > 0) 
    {
        $row = mysqli_fetch_assoc($result_totPrice);
        $totalPrice = $row['total'];
        
        if($totalPrice>0)
        {
             echo $totalPrice . " €";
        }
        else
        {
             echo "0 €"; 
        }
    } 

    
    
    mysqli_close($conn);
    