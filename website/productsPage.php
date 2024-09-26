<?php
session_start();
include 'MySQLiServerConnection.php';
include 'phpFunctions.php';

  $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
  $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
 
  $selectedCategory = $_GET['category'];
  $selectedCategoryId = $_GET['ProductTypeId'];

  $brandFilter = isset($_GET['brand']) ? $_GET['brand'] : null;


  $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
  $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="img/eshop_logo.ico">
    <link rel="stylesheet" href="productsPageStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>eshop</title>
</head>

<body>
        <header>
            
           <div class="header">  
              <h1>eshop |<?php echo  $selectedCategory ?></h1>
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
            
        <div class="products-nav-container">
            <div class="products">
            
              
              <?php 
                displayProducts($selectedCategoryId,$brandFilter,$minPrice,$maxPrice); 
              ?>

            </div>

            <div class="filter">
                      <p><span class="material-symbols-outlined">filter_list</span></p>

                    <form method="get" action="productsPage.php" id="filterForm">

                      <label for="brand">Brand:</label>
                      <select name="brand" id="brand">
                       
                          <option value="">All Brands</option>
                          <?php 
                              $uniqueBrands = getUniqueBrands($selectedCategoryId);
                              foreach ($uniqueBrands as $brand) : 
                           ?>
                              <option value="<?php echo $brand; ?>" <?php echo ($brand == $brandFilter) ? 'selected' : ''; ?>><!--($brand == $brandFilter)afou pathsw submit krataei to epilegmeno ws epilogh-->
                                  <?php echo $brand; ?>
                              </option>

                          <?php endforeach; ?>

                      </select>

                      <label for="priceRange">Price Range:</label><br>
                
                          <label>Min price</label>
                          <input type="number" name="minPrice" placeholder="Min price"  value="<?php echo $minPrice; ?>"><br>

                          <label>Max price</label>
                          <input type="number" name="maxPrice" placeholder="Max price" value="<?php echo $maxPrice; ?>"><br>
                

                      <input type="hidden" name="category" value="<?php echo $selectedCategory; ?>">
                      <input type="hidden" name="ProductTypeId" value="<?php echo $selectedCategoryId; ?>">
                      
                         <?php 
                          if($maxPrice)
                          { 
                            echo "<p class=\"priceRangeViewer\">Price range: $minPrice €- $maxPrice € <span class=\"material-symbols-outlined\" onclick=\"resetPrices()\">close</span></p> ";
                          }
                          ?>

                      <button type="submit">Apply Filters</button>

                  </form>
             </div>
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

                  function resetPrices()
                  {
                      document.querySelector('input[name="minPrice"]').value = null;
                      document.querySelector('input[name="maxPrice"]').value = null;
                      document.getElementById("filterForm").submit();
                  }
          </script>

<?php

            function displayProducts($selectedCategoryId,$brandFilter = null,$minPrice = null,$maxPrice = null )
            {
                include 'MySQLiServerConnection.php';
            
                $sql = "SELECT * FROM categories 
                        JOIN products ON categories.id = products.productType 
                        WHERE categories.id = $selectedCategoryId "; 
               
                if ($brandFilter) {
                    $sql .= " AND products.brand = '$brandFilter'";
                }
    
                if ($maxPrice) {
                    $sql .= " AND products.price BETWEEN $minPrice AND $maxPrice";
                }
    
                $result = mysqli_query($conn, $sql);
            
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result))
                     {
                        $category = $row["category"];
                        $categoryId = $row["id"];
                        $brand = $row['brand'];
                        $model = $row['model'];
                        $price = $row['price'];
                        $productCode = $row['productCode'];
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
                                  <p>$price €</P>
                                  </div>
                             </div>
                         </a>";
    
                    }
                } else {
                    echo "No products found.";
                }
             }


             
         function getUniqueBrands($categoryId)
         {
             include 'MySQLiServerConnection.php';
 
             $sql = "SELECT DISTINCT brand FROM  products
                     JOIN categories  ON categories.id = products.productType 
                     WHERE categories.id = $categoryId" ;
 
             $result = mysqli_query($conn, $sql);
             
             while ($row = mysqli_fetch_assoc($result)) 
             {
                 $brands[] = $row['brand'];      
             }  
             return $brands;
         }
       
    
?>