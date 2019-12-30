<?php
ob_start();
require("head.php");
?>



  <body>

   <?php require("nav.php")?>

  

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Register An account</h1>
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

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form id="first" method="post" action="signup.php" onsubmit="return check()">
     <div class="form-group ">
      <label class="control-label requiredField" for="name">
       Full Name
       <span class="asteriskField">
        *
       </span>
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input class="form-control" id="name" name="name" required type="text"/>
      </div>
         <div id="ne" style="display:none"><font color="red">**Name cannot be empty**</font></div>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="email" required name="email" type="email"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="select">
       Select an user type 
       <span class="asteriskField">
        *
       </span>
      </label>
      <select class="select form-control" id="select" name="type">
       <option value="Reviewer" onclick="showthat()" >
        Reviewer
       </option>
       <option value="Author" onclick="hidethat()">
        Author
       </option>
      </select>
     </div>
        
        <div id="years" class="form-group">
        <label class="control-label requiredField" for="numberofyears">Number of Years as a Story Reviewer</label>
            <span class="asteriskField">*</span>
            <select class="select form-control" id="noyears" name="noyears">
            <option value="0-1"> 0-1 year </option>
                <option value="2-5"> 2-5 years</option>
                <option value="6-10"> 6-10 years</option>
                <option value="11-15"> 11-15 years</option>
                <option value="16-20">16-20 years</option>
                <option value="20+"> more then 20 years </option>
            </select>
        </div>
        
     <div class="form-group ">
      <label class="control-label requiredField"  for="password">
       Password
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="password" required name="password" type="password"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="cpassword">
       Confirm Password
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control" id="cpassword" required name="cpassword" type="password"/>
         <div id="ps" style="display:none"><font color="red">**password and confirm password dont match**</font></div>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary btn-lg" name="submit" type="submit">
        Register
       </button>
       <button class="btn btn-danger btn-lg"  type="reset">
        Clear
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

<script>
   function hidethat(){
       $("#years").hide();
       $("#years").removeAttr("required");
   } 
    
    function showthat(){
    $("#years").show();
    $("#years").attr("required","required");
    }

function check(){
    
  var namePattern = "[a-zA-Z]";   
  var name = document.getElementById("name").value.trim();
  var ValidName = name.match(namePattern);    
  var password=document.getElementById("password").value;
  var cpassword=document.getElementById("cpassword").value;
  
    
    
if(name.length == 0 || name == null || !ValidName ){
    document.getElementById("ne").style.display="block";
    return false;
    }   

if(password != cpassword){
    document.getElementById("ps").style.display="block";
    return false;
    }
   return true;
    
}
</script>

