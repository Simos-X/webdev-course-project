<?php 
session_start();
include 'phpFunctions.php';



$userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
$userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>eshop | Home</title>
    <link rel="icon" type="image/x-icon" href="img/eshop_logo.ico">
</head>

  <body>
        <header>
            
           <div class="header">  
              <h1>eShop</h1>
            </div>
        
            <div class="navbar">
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
                                  <a href=\"logout.php\">Log out</a>";
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

        <div class="products">
       <?php displayProducts() ?>
        </div>
        
   </body>
</html>

    <script>

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

    
<?php

    function displayProducts()
    {
        include 'MySQLiServerConnection.php';

       
        $categories='SELECT *FROM categories';
        $catresults= mysqli_query($conn,$categories);

        
        while($catrow = mysqli_fetch_assoc($catresults))
        {  
                 $categoryId = $catrow["id"];
                 $category = $catrow["category"];

                 echo "
                 <div class=\"category-container\">
                 <h1>$category</h1>";

                 $sql = "SELECT * FROM categories 
                 JOIN products ON categories.id = products.productType 
                 WHERE categories.id = $categoryId"; 

                 $result = mysqli_query($conn, $sql);

           
                    if (mysqli_num_rows($result) > 0) 
                    {        
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $brand =  $row['brand'];
                                $model = $row['model'];
                                $price = $row['price'];
                                $productCode =  $row['productCode'];
                                $thumbnail = $row['thumbnail'];

                                    echo "
                                    <a href=\"ProdDescription.php?category=$category&ProductTypeId=$categoryId&productCode=$productCode\">
                                        <div class=\"productContainer\">
                                            <div class=\"imgBox\"> 
                                            <img src=\"img/$productCode/$thumbnail\">
                                            </div>
                                            <div class=\"brand\">
                                                <p>$brand<br><br>$model</p>
                                                </div>
                                            <div class=\"price\">
                                            <p>$price  €</P>
                                            </div>
                                        </div>
                                    </a>";
                        
                            }
                        echo"</div>";
            }
           
        }
       
    }


    ?>