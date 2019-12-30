<?php
require("connection.php");
require("head.php");
require("nav.php");
?>

<div class="container">
       <h1 class="mt-4 mb-3">
        <small>My Bookmarks</small>
      </h1>
                    <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="index.php">Home</a>
            </li>
                <li class="breadcrumb-item">My Bookmarks</li>
                </ol>
    
    <?php 
    $uid=$_SESSION['uid'];
    $NoOfResults=9;
    $sql=$db->prepare("select  count(s.id) from story s , bookmarks b 
    where s.id = b.stid and b.uid ='$uid' 
    ");
        $sql->execute();
        $row=$sql->fetch();
        $totalresults=$row[0];
    $NoOfPages=ceil($totalresults/$NoOfResults);    
    
            if(!isset($_GET["pages"])){
            $currentpage=1;
        }  
         else{
           $currentpage=$_GET["pages"];
        }
        $limitnumber=($currentpage-1)*$NoOfResults;
         $sql=$db->prepare("select * from story s , bookmarks b where s.id = b.stid and b.uid = '$uid' ORDER BY b.id DESC  limit ".$limitnumber.",".$NoOfResults);
        $sql->execute();
        $row=$sql->fetch();
        $count=$sql->rowCount();
    ?>
    <div class="row">
             <?php for($rec=0;$rec<$count;$rec++){
                ?>
            
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="<?php echo "displaystory.php?st=".$row["stid"]; ?>"><img class="card-img-top" width="300" height="300" src="<?php if($row["cover"]==""){echo "http://placehold.it/700x400";} else echo "../Author/uploads/".$row["cover"]?>" alt="http://placehold.it/700x400"></a>
                            <div class="card-body">
                                <h4 class="card-title" align="center">
                                    <a href="<?php echo "displaystory.php?st=".$row["id"]; ?>"><?php echo $row['title'] ;?></a>
                                </h4>
                                
                            </div>
                    </div>   
                </div>
            
            <?php    $row=$sql->fetch(); }  ?>
        </div>
</div>

    <ul class="pagination justify-content-center">
                <li class="page-item">
                     <a class="page-link" href="<?php if ($currentpage ==1){echo $_SERVER["PHP_SELF"]."?pages=".$currentpage;}
                        else {$currentpage--;
                            echo $_SERVER["PHP_SELF"]."?pages=".$currentpage;}
                     ?>" aria-label="Previous">
                         <span aria-hidden="true">&laquo;</span>
                         <span class="sr-only">Previous</span>
                    </a>
                </li>

      <?php 
        for($pages=1; $pages<=$NoOfPages ; $pages++){?>
             <li class="page-item">
            <a class="page-link" href="<?php echo $_SERVER["PHP_SELF"].'?pages='.$pages; ?>"> <?php echo $pages?> </a>
            </li>

      <?php     
                                }
      ?>
            
        <li class="page-item">
          <a class="page-link" href="<?php
          if($currentpage==$NoOfPages){
              echo $_SERVER["PHP_SELF"].'?pages='.$currentpage;
          }
          else{$currentpage++;
            echo $_SERVER["PHP_SELF"].'?pages='.$currentpage;   
        }
          ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>

      </ul>
<?php 
require("footer.php");
?>