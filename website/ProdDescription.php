<?php
session_start();
include 'MySQLiServerConnection.php';
include 'phpFunctions.php';

  $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
  $userName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;


  $selectedCategory = $_GET['category'];
  $selectedCategoryId = $_GET['ProductTypeId'];
  $SelectedProductCode = $_GET['productCode'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="img/eshop_logo.ico">
    <link rel="stylesheet" href="ProdDescriptStyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>eshop</title>
</head>

  <body>
          <header>
              
            <div class="header">  
                 <h1> eshop</h1>
                <a class="home" href="index.php">&nbsp;Home </a><a>></a><?php echo "<a class=\"prods\" href=\"productsPage.php?category=$selectedCategory&ProductTypeId=$selectedCategoryId\"> $selectedCategory</a>" ?>
              </div> 
          
          </header>
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
                                <?php
                                  if($userId != null)
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


            <div class="products">
               
              <?php
               prodDescription($SelectedProductCode,$selectedCategory,$selectedCategoryId); 
               ?>

            </div>

            

          


    </body>
</html>


        <script>
          

          function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
            }


            window.onclick = function(e) {
            if (!e.target.matches('.dropbtn'))
            {
                var myDropdown = document.getElementById("myDropdown");
                    if (myDropdown.classList.contains('show')) 
                    {
                      myDropdown.classList.remove('show');
                    }
            }
            }

                    var slideIndex = 1;
                    showDivs(slideIndex);

                    function plusDivs(n)
                    {
                      showDivs(slideIndex += n);
                    }

                    function showDivs(n) 
                    {
                      var i;
                      var x = document.getElementsByClassName("mySlides");
                      if (n > x.length) 
                      {
                       slideIndex = 1;
                      }
                      else if (n < 1)
                      {
                        slideIndex = x.length;
                      }

                      for (i = 0; i < x.length; i++) 
                      {
                        x[i].style.display = "none";  
                      }
                       x[slideIndex-1].style.display = "block";  
                    }

                    function loginPopup() 
                    {
                      var popup = document.getElementById("myPopup");
                      popup.classList.toggle("show");
                    }

                    function addedTocart(event)
                    {
                      event.preventDefault();
                      var cartMessage = document.querySelector(".cart-message");
                      cartMessage.classList.toggle("visible");

                      setTimeout(function() {
                        event.target.submit();
                      }, 250);
                    }

          </script>


<?php


      function prodDescription($SelectedProductCode,$selectedCategory,$selectedCategoryId)
      {
          include 'MySQLiServerConnection.php';

          $sql = "SELECT * FROM products  WHERE products.productCode = '$SelectedProductCode'";

          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result))
              {
                  $userId = isset($_SESSION['id']) ? $_SESSION['id'] : null;
                  $brand = $row['brand'];
                  $model = $row['model'];
                  $price = $row['price'];
                  $descrpition= $row['description'];
                  $image1=$row['image1'];
                  $image2=$row['image2'];
                  $image3=$row['image3'];
                  $image4=$row['image4'];
                  $productCode = $row['productCode'];
                  $thumbnail = $row['thumbnail'];

                
                  if($SelectedProductCode==$productCode)
                  echo "
                        <div class=\"img-slide\">

                          <button class=\"left-Button\" onclick=\"plusDivs(-1)\">
                          <span class=\"material-symbols-outlined\">arrow_back_ios_new</span>
                          </button>

                          <div class=\"img-container\">

                          <img class=\"mySlides\" src=\"img/$productCode/$image1\" onerror=\"this.onerror=null; this.remove();\">
                          <img  class=\"mySlides\" src=\"img/$productCode/$image2\" onerror=\"this.onerror=null; this.remove();\">
                          <img  class=\"mySlides\" src=\"img/$productCode/$image3\" onerror=\"this.onerror=null; this.remove();\">
                          <img  class=\"mySlides\" src=\"img/$productCode/$image4\"onerror=\"this.onerror=null; this.remove();\"> 

                        </div>

                          <button class=\"right-button\" onclick=\"plusDivs(1)\">
                          <span class=\"material-symbols-outlined\">arrow_forward_ios</span>
                          </button>

                        </div>
                        <div class=\"descrption-container\">
                              <div class=\"brand\">
                                  <p>$brand<br>$model</p><br>
                              </div>

                              <div class=\"description\">
                              <p>description:<br><br>$descrpition</p>
                              </div>
                            <p class=\"cart-message\">Product added to cart</p>
                            <div class=\"add-to-cart\">  ";
                            
                            if($userId != null) 
                            {echo "
                                <form action=\"addToCart.php\" method=\"POST\" onsubmit=\"addedTocart(event)\">
                                      
                                      <input type=\"hidden\" name=\"userId\" value=\"$userId\">
                                      <input type=\"hidden\" name=\"brand\" value=\"$brand\">
                                      <input type=\"hidden\" name=\"model\" value=\"$model\">
                                      <input type=\"hidden\" name=\"price\" value=\"$price\">
                                      <input type=\"hidden\" name=\"selectedCategory\" value=\"$selectedCategory\">
                                      <input type=\"hidden\" name=\"selectedCategoryId\" value=\"$selectedCategoryId\">
                                      <input type=\"hidden\" name=\"productCode\" value=\"$productCode\">

                                      <button  class=\"add-to-cart-button\" >
                                      <p>Add to cart</p>
                                    </button>
                              </form>
                                      ";
                            }
                            else
                            {
                            echo "
                                  <div class=\"popup\" onclick=\"loginPopup()\">
                                  <button class=\"add-to-cart-button\">
                                  <p>Add to cart</p>
                                  </button>
                                    <span class=\"popuptext\" id=\"myPopup\">
                                        <div class=\"popup\" onclick=\"loginPopup()\">
                                                <form action=\"login.php\" method=\"post\">
                                                    <span class=\"material-symbols-outlined\" onclick=\"loginPopup()\">close</span>
                                                    <h2> LOGIN</h2>
                                                    <label>User Name</label>
                                                    <input type=\"text\" name=\"uname\" placeholder=\"User Name\"><br>
        
                                                    <label>Password</label>
                                                    <input type=\"password\" name=\"password\" placeholder=\"Password\"><br>
        
                                                    <button type=\"submit\">Login</button>
                                                    <a href=\"signup.php\" class=\"ca\">Create an account</a>
                                                </form>
                                        </div>
                                    </span> 
                                  </div>";
                            }

                            echo "  <div class=\"price\">
                                  <p>$price €</p>
                                  <div>

                              </div>
                              
                        </div>
                  ";

              }
          } else {
              echo "No products found.";
          }
      }


?>

