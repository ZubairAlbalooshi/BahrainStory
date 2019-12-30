<?php
ob_start();
session_start();
require("head.php");
?>



  <body>

   <?php require("nav.php")?>

  

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Login</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Register </li>
      </ol>
      <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .form-group button, .bootstrap-iso form input.form-control, .bootstrap-iso form textarea.form-control, .bootstrap-iso form select.form-control, .bootstrap-iso form .form-group-lg input.form-control, .bootstrap-iso form .form-group-lg textarea.form-control, .bootstrap-iso form .form-group-lg select.form-control, .bootstrap-iso form .form-group-sm input.form-control, .bootstrap-iso form .form-group-sm textarea.form-control, .bootstrap-iso form .form-group-sm select.form-control{-webkit-border-radius: 20px;-moz-border-radius: 20px; border-radius: 20px;}.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}.bootstrap-iso form .input-group-addon {color:#555555; background-color: #eeeeee; border-radius: 20px; padding-left:15px}</style>

<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .form-group button, .bootstrap-iso form input.form-control, .bootstrap-iso form textarea.form-control, .bootstrap-iso form select.form-control, .bootstrap-iso form .form-group-lg input.form-control, .bootstrap-iso form .form-group-lg textarea.form-control, .bootstrap-iso form .form-group-lg select.form-control, .bootstrap-iso form .form-group-sm input.form-control, .bootstrap-iso form .form-group-sm textarea.form-control, .bootstrap-iso form .form-group-sm select.form-control{-webkit-border-radius: 20px;-moz-border-radius: 20px; border-radius: 20px;}.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}.bootstrap-iso form .input-group-addon {color:#555555; background-color: #eeeeee; border-radius: 20px; padding-left:15px}</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
        <?php 
        if(isset($_SESSION["email"])){
            if($_SESSION["email"]=="exists"){
                echo "<h3>This email already has an account please login instead</h3>";
            }
            
            else if($_SESSION["email"]=="registered") {
                echo "<h3>You have successfully Registered please login using your credentials</h3>";
            }
            
            else if($_SESSION["email"]=="wrong"){
                echo"<h3>wrong cerdintials<h3>";
            }
            
             else if($_SESSION["email"]=="newpassword"){
                echo"<h3>Your password has been changed you can login with ur new credentials<h3>";
            }
            
             else if($_SESSION["email"]=="Inactive"){
                echo"<h3>Your Request for Registration has been sent to the Admin please try to login after 24 hours </h3>";
             }
        }
        ?>    
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post" action="login.php">
     <div class="form-group form-group-lg">
      <label class="control-label requiredField" for="email">
       Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input class="form-control" id="email" required name="email" type="email"/>
      </div>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label requiredField" for="name">
       Password
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="password" required name="password" type="password"/>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary btn-lg" name="submit" type="submit">
        Login
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>

    </div>
    <?php 
      require("nav.php");
    ?>

  </body>

  <?php
    require("footer.php");
  ?>
<style>
    html {
    position: relative;
    min-height: 100%;
}
</style>

