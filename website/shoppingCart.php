<?php 
session_start();
include 'phpFunctions.php';
include 'MySQLiServerConnection.php';


$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="cartStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>eshop</title>
    <link rel="icon" type="image/x-icon" href="img/eshop_logo.ico">
</head>

  <body >
        <header>
            
           <div class="header">  
              <h1>eShop | Cart</h1>
              <h1 id="rowsnum"></h1>
            </div>

        
            <div class="navbar">

                <div class="homePageIcon">
                    <a href="index.php"><span class="material-symbols-outlined">home</span></a>
                </div>

                <div class="dropdown">
                        <button class="dropbtn" onclick="myFunction()">
                        <span class="material-symbols-outlined">expand_more</span> Categories
                        </button>
                        <div class="dropdown-content" id="myDropdown">

                           <?php  categoriesDropdown($dropdownResults); ?>

                        </div>
                </div> 

                <div class="user">

                    <div class="account-dropdown">
                        <button class="acc-dropbtn"><span class="material-symbols-outlined">account_circle</span></button>
                        
                            <div class="acc-dropdown-content">
                            <?php if($userId != null)
                                {
                                  echo "  <p><span class=\"material-symbols-outlined\">account_circle</span>$userName</p>
                                  <a href=\"logOutFromCart.php\" >Log out</a>";
                                }
                                else
                                {
                                  echo " <a href=\"login.php\">Log in</a>";
                                }
                                ?>
                            </div>
                    </div>
                    
                       <a href="shoppingCart.php"> <span class="material-symbols-outlined">shopping_cart</span> </a>            
                </div>
            </div>
        
        </header>

    <div class="cart-container">
        <div class="cart">
                    
            <?php
    
            $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
            if ($userId != null)
            {

                $sql = "SELECT * FROM cart JOIN products ON products.productCode = cart.productId WHERE cart.userId = $userId";
                $result = mysqli_query($conn, $sql);

     
            
                    if (mysqli_num_rows($result) > 0) 
                    {
                        echo "
                        
                                <table id=\"cart\">";
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $brand = $row['brand'];
                                    $price = $row['price'];
                                    $thumbnail = $row['thumbnail'];
                                    $productId=$row['productId'];
                                    $quantity = $row['quantity'];
                                    $model= $row['model'];


                                   
                                    $priceForQuantity= $price*$quantity;

                                    echo "
                                    <tr id=\"$productId\">
                                        <td><img src=\"img/$productId/$thumbnail\"></td>
                                        <td>" .$brand."</td>
                                        <td>".$model."</td>
                                        <td>
                                            <form>
                                            <input type=\"number\" id=\"quantity_$productId\" name=\"quantity\" value=".$quantity." min=\"1\" max=\"90\" onChange=\"quantityChange($userId,$productId);\">
                                            </form>
                                        </td>
                                        <td id=\"price_$productId\">$priceForQuantity €</td>
                                        <td><button onclick=\"deleteFromCart($userId,$productId);\" class=\"delete-button\"><span class=\"material-symbols-outlined\">delete</span></td>
                                    </tr> 
                                    
                                    ";
                                   
                           
                                    
                            }   
                             //deleteFromCart($userId,$productId); is visible and can be changed in inspect (bad)
                            echo "</table>";
                        
                    }
                    else
                    {
                        echo "<p class=\"empty-cart\">Cart is empty</p>";
                    }

                }
                else
                {
                echo "<a href=\"loginForm.php\" >Login</a> to use the cart";
                }
                mysqli_close($conn);
                ?>
                
        </div>
        <?php
            if ($userId != null)
            {
        ?>
            <div class="purchase-box">
            <p>Total: &nbsp; </p><p id="totalCost"></p>
            <a href="#"><button class="payment">proceed to payment</button> </a>
            </div>
        <?php
            }
        ?>
    </div>


        
   </body>
</html>


    <script>

    
        <?php
        echo"
        window.onload =function()
        {
            updateTotalPrice($userId);
        }
        ";
        ?>

        function quantityChange(userId,productId)
        {   
            var xmlhttp = new XMLHttpRequest();
            
            let q = document.getElementById("quantity_"+ productId).value;
            
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200)
                 {
                    document.getElementById("price_"+ productId).innerHTML = this.responseText;
                    if(userId!=null)
                    {
                     updateTotalPrice(userId);
                    }
                }
            }
            xmlhttp.open("GET", "updateQuantity.php?userId=" + userId + "&productCode=" + productId + "&updatedQuantity=" + q, true);
            xmlhttp.send();
        }

        function deleteFromCart(userId,productId)
        {  
            
            var xmlhttp = new XMLHttpRequest();
            
            let q = document.getElementById("quantity_"+ productId).value;

            var cartItemCount = document.getElementById("cart").rows.length-1;
            
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) {
                   // document.getElementById("rowsnum").innerHTML = cartItemCount;
                    document.getElementById(productId).remove();
                    if(userId!=null)
                    {
                    updateTotalPrice(userId);
                    }
                    if(cartItemCount==0)
                    {
                     location.reload();
                    }
                }
            }
            xmlhttp.open("GET", "deleteFromCart.php?userId=" + userId + "&productCode=" + productId + "&updatedQuantity=" + q, true);
            xmlhttp.send();
          
        }

        function updateTotalPrice(userId) 
        {
              var xmlhttp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200)
                 {
                    document.getElementById("totalCost").innerHTML = this.responseText;
                    
                }
            }
            xmlhttp.open("GET", "updateTotalPrice.php?userId=" + userId, true);
            xmlhttp.send();
           
        }

        function myFunction() 
        {
          document.getElementById("myDropdown").classList.toggle("show");
        }


        window.onclick = function(e) 
        {
            if (!e.target.matches('.dropbtn'))
            {
                var myDropdown = document.getElementById("myDropdown");
                    if (myDropdown.classList.contains('show')) 
                    {
                     myDropdown.classList.remove('show');
                    }
            }
        }

    </script>