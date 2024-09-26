  
  <?php
        include 'MySQLiServerConnection.php';

         
         $sql = 'SELECT * FROM categories';
         $dropdownResults = mysqli_query($conn, $sql);
         
        function categoriesDropdown($dropdownResults)
        {
         
               if (mysqli_num_rows($dropdownResults) > 0) 
               {
                  while($row = mysqli_fetch_assoc($dropdownResults)) 
                  {
                     $category = $row["category"];
                     $categoryId = $row["id"];
                     echo "<a href=\"productsPage.php?category=$category&ProductTypeId=$categoryId\">". $row["category"]."</a> ";
                     
                  }
               } 
               else {
               echo "0 results";
               }
        }



   ?>
  
