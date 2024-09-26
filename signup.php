<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
	<title>eshop | SIGN UP</title>
     <link rel="icon" type="image/x-icon" href="img/eshop_logo.ico">
	<link rel="stylesheet" type="text/css" href="LoginStyle.css">
</head>
<body>
     <form action="signup-check.php" method="post">

     	<h2>SIGN UP</h2>
     	<?php 
          if (isset($_GET['error'])) 
          { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php 
          } 
          ?>

          <?php 
          if (isset($_GET['success']))
           { 
          ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php
           }
           ?>

          <label>Name</label>
          <?php 
          if (isset($_GET['name']))
           { ?>
               <input type="text"  name="name"  placeholder="Name" value="<?php echo $_GET['name']; ?> " minlength="3"><br>
          <?php 
           }
           else
           { 
          ?>
               <input type="text"  name="name"  placeholder="Name"><br>
          <?php
           }
           ?>
          
          <label>User Name</label>
          <?php
           if (isset($_GET['uname'])) 
           { 
          ?>
               <input type="text"  name="uname"  placeholder="User Name" value="<?php echo $_GET['uname']; ?>" minlength="3"><br>
          <?php 
          }else
          {
          ?>
               <input type="text"  name="uname"  placeholder="User Name" minlength="3"><br>
          <?php 
          }
          ?>


     	<label>Password</label>
     	<input type="password"  name="password"  placeholder="Password" minlength="4"><br>

          <label>Confirm Password</label>
          <input type="password"  name="Confirm_password"  placeholder="Confirm Password" minlength="4"><br>

     	<button type="submit">Sign Up</button>
          <a href="loginForm.php" class="ca">Already have an account?</a>
          
     </form>
</body>
</html>