<?php
  require("connection.php");
    require("head.php");
    require("nav.php");

// the number of results we want per page 
        $NoOfResults=9;
        // calculate how many results we may have in total 
        $sql=$db->prepare(" select count(*) from story ");
        $sql->execute();
        $row=$sql->fetch();
        $totalresults=$row[0]; 
        // Calculate the number of pages we need to display all the results
        $NoOfPages=ceil($totalresults/$NoOfResults);
        //to check which we are at now 
        if(!isset($_GET["pages"])){
            $currentpage=1;
        }  
        else{
           $currentpage=$_GET["pages"];
        }
         $limitnumber=($currentpage-1)*$NoOfResults;
        

        $sql=$db->prepare("select * from story  ORDER BY id DESC  limit ".$limitnumber.",".$NoOfResults);
        $sql->execute();
        $row=$sql->fetch();
        $count=$sql->rowCount();
     

?>

<div class="container">
          <h1 class="mt-4 mb-3">
        <small>Read Stories</small>
      </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../../Author/">Home</a>
            </li>
                 <li class="breadcrumb-item">
            Read Stories
            </li>
            </ol>
    
  <div class="row">
         <?php for($rec=0;$rec<$count;$rec++){
                ?>
            
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="<?php echo "displaystory.php?st=".$row["id"]; ?>"><img class="card-img-top" width="300" height="300" src="<?php if($row["cover"]==""){echo "http://placehold.it/700x400";} else echo "../../Author/uploads/".$row["cover"]?>" alt="http://placehold.it/700x400"></a>
                            <div class="card-body">
                                <h4 class="card-title" align="center">
                                    <a href="<?php echo "displaystory.php?st=".$row["id"]; ?>"><?php echo $row['title'] ;?></a>
                                </h4>
                                
                            </div>
                    </div>   
                </div>
            
            <?php    $row=$sql->fetch(); }  ?>
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
    </div>
    <!-- /.container -->

   

  

<?php
  require("footer.php");
?>
<style>
