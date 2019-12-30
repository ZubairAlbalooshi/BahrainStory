<?php 
require("connection.php");
require("head.php");
require("nav.php");

if(!isset($_GET['id'])){
    header("location:404.php"); 
}

    if($_GET['id']==""){header("location:404.php"); }
            
    $id=$_GET['id'];
        
    $sql=$db->prepare("select name from users where id = '$id' ");
    $sql->execute();
    $row=$sql->fetch();
    $name=$row[0];

    $sql1=$db->prepare("select title,id from story where uid='$id'");
    $sql1->execute();
    $row1=$sql1->fetchall();
        
?>
<div class="container">
           <h1 class="mt-4 mb-3">
             <small><?php  echo $name;?></small>
         </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="index.php">Home</a>
            </li>
                    <li class="breadcrumb-item">Author</li>
                    <li class="breadcrumb-item"><?php echo $name;?></li>        
                 
            </ol>
    <section>
        <h3>Stories by <?php echo $name;?></h3>
    </section>
    
    <?php 
    
    foreach($row1 as $rec){?>
        <a href="displaystory.php?st=<?php echo $rec['id']?>" class="btn btn-success btn-block"><?php echo $rec['title'];?></a>
    <?php }
    ?>

    
</div>

<?php 
require("footer.php");
?>