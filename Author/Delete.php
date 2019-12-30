<?php
    require("connection.php");
    require("head.php");
    require("nav.php");

$uid=$_SESSION["id"];
$id=$_GET["id"];

$type=$_GET["type"];


if($type=="df"){
    
    try {
        $sql=$db->prepare("delete from drafts where uid ='$uid'  and id ='$id' ");
        $sql->execute();
        $delete = true;
        }
 
    catch(Exception $e){
        $delete= false;
        $e->getMessage();
    }
}

else{
    
    try {
        $sql0=$db->prepare("delete from comment where stid='$id'");
        $sql0->execute();
        $sql1=$db->prepare("delete from story where uid ='$uid'  and id ='$id' ");
        $sql1->execute();
        $delete = true;
        }
 
    catch(Exception $e){
        $delete= false;
        $e->getMessage();
    }
}

?>  
<body>
    <div class="container">
         <h1 class="mt-4 mb-3">
        <small>Deleting story ...</small>
      </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
            <?php if($type=="df"){
                echo '<li class="breadcrumb-item"><a href="../Author/Drafts.php">Drafts</a></li>';
                    }
                else echo '<li class="breadcrumb-item"><a href="../Author/mystories.php">My Stories</a></li>';
                ?>
            <li class="breadcrumb-item">Deleting story...</li>
            </ol>
    </div>
    
    <?php if($delete == true && $type=="df"){
    echo "<h3 align='center' style='positon:absolute , top: 50%;'>Your draft has been deleted</h3>";   
                           }
    if($delete == true && $type=="st"){
    echo "<h3 align='center' style='positon:absolute , top: 50%;'>Your Story has been successfully deleted</h3>";   
                           }
    
    if($delete == false && $type == "st"){ 
     echo "<h3 align='center' style='positon:absolute , top: 50%;'>there was a problem deleting the Story </h3>",$e;
    }
    
      if($delete == false && $type == "df"){ 
     echo "<h3 align='center' style='positon:absolute , top: 50%;'>there was a problem deleting the draft </h3>",$e;
    }
    ?>
    
    <?php 
    if($type == "df"){
        header( "Refresh:3; url=../Author/Drafts.php", true, 303);
    }
    else{
        header( "Refresh:3; url=../Author/mystories.php", true, 303);
    }
    ?>
</body>


<?php 
    require("footer.php");
?>
<style>
footer {
    margin-top: 0;
   position:absolute;
   bottom:0;
   width:100%;
   /* Height of the footer */
   
}
    html {
    position: relative;
    min-height: 100%;
}
</style>