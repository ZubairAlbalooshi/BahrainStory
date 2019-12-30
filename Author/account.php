<?php
require("connection.php");
    require("head.php");
        require("nav.php");



    $sql=$db->prepare("select name , email , type from users where id ='$uid'");
        $sql->execute();
            $row=$sql->fetch();
?>

<div class="container"> 
      <h1 class="mt-4 mb-3">
        <small>My Account</small>
      </h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../Author/">Home</a></li>
    <li class="breadcrumb-item">My Account Details</li>
</ol>
        <form>
     <div class="form-group form-group-lg">
      <label class="control-label " for="name">
       Name
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input class="form-control" disabled value="<?php echo $row['name'];?>" type="text"/>
      </div>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="name1">
       Email
      </label>
      <input class="form-control"  disabled value="<?php echo $row['email']; ?>  "  placeholder="<?php echo $row['email']; ?>" type="text"/>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="select">
       Type
      </label>
      <select class="select form-control"  disabled>
          <option selected value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option>
      </select>
     </div>
     <div class="form-group">
      <div>
      </div>
     </div>
    </form
            
    <div align= "center">
    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#Editdetails">Edit Account Details</button>
    <button class="btn btn-danger btn-block"  data-toggle="modal" data-target="#changepassword">change Password</button><hr style=" border:1px solid transparent">
        
            
        <div id="Editdetails" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
          <div class="container">
     <form method="post" action="accountupdate.php">
     <div class="form-group form-group-lg">
      <label class="control-label " for="name">
       Name
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input class="form-control"  name="name" required value="<?php echo $row['name'];?>" type="text"/>
          </div>
      </div>
     
     <div class="form-group form-group-lg">
      <label class="control-label " for="name1">
       Email
      </label>
      <input class="form-control" id="email" disabled name="email" value="<?php echo $row['email']; ?>  "  placeholder="<?php echo $row['email']; ?>" type="text"/>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="select">
       Type
      </label>
      <select class="select form-control" id="select" disabled name="select">
          <option selected value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option>
      </select>
     </div>
     <div class="form-group">
      <div>
       
        <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">
        Save changes
       </button>
          </form>   
         </div>
      </div>
     </div>
    
        </div>
      </div>
    
    </div>

  </div>
</div>
        

<div id="changepassword" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
       <div class="container">
           
    <form method="post" action="passwordupdate.php" onsubmit="return valid()">
     <div class="form-group form-group-lg">
      <label class="control-label " for="name">
       Enter your Current Password
      </label>
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input class="form-control" id="name" name="password" required type="password"/>
          </div>
      </div>
     
     <div class="form-group form-group-lg">
      <label class="control-label " for="name1">
        Enter your New Passowrd
      </label>
      <input class="form-control" id="newpassword"  required name="newpassword" type="password"/>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="select">
       Confirm Password
      </label>
    
         <input class="form-control" id="cpassword"  required name="cpassword" type="password"/>
     </div>
     <div class="form-group">
      <div>
       
        <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">
        Save changes
       </button> 
          </form>
        
       </div>
      </div>
    </div>

  </div>
</div>
        
    </div>
    <hr>
</div>
<?php require("footer.php")?>
    
    <script type="text/javascript">
    function valid(){
        var nps=document.getElementById("newpassword").value;
        var cps=document.getElementById("cpassword").value;
     
        if(nps != cps){
            alert("new password and confirm passoword dont match");
            return false;
        }
        return true;
    }
    </script>
