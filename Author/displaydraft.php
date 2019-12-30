<?php
require("connection.php");
require("head.php");
require("nav.php");

if(isset($_GET["st"])){
     $_GET["st"];
     $uid=$_SESSION["uid"];
     $id=$_GET["st"];
     $sql=$db->prepare("select * from drafts where uid='$uid' and id='$id'");
     $sql->execute();
     $row=$sql->fetch();

}
else header("location:../404.html");
?>
<body>
    <div class="container">
         <h1 class="mt-4 mb-3">
             <small><?php echo ucfirst($row["title"]);?></small>
         </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
                <li class="breadcrumb-item"><a href="../Author/Drafts.php">My Drafts</a> </li>
                    
                    <li class="breadcrumb-item"><?php echo ucfirst($row["title"]);?></li>
                <li class="breadcrumb-item"><a href="download3.php?id=<?php echo $id."&tp=d";?>" class="btn-lg btn-danger">Download as PDF</a> </li>
            </ol>
        <p><?php  echo $row["text"]; ?> </p>
        
    </div>
    
</body>

<?php  require("footer.php")?>


<style>
    

  html{
    
  min-height:  100%;
      
}
</style>