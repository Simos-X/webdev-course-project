<?php
include 'MySQLiServerConnection.php';

    $userId = intval($_GET["userId"]);
    $productCode = intval($_GET['productCode']);
   
  $sql= " DELETE FROM cart WHERE userId = $userId AND productId = $productCode ";
  mysqli_query($conn, $sql);

  mysqli_close($conn);