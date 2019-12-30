<?php
    require("connection.php");
    require("head.php");
    require("nav.php");
?>

<body>
    <?php

        $uid=$_SESSION["uid"];
       
        // the number of results we want per page 
        $NoOfResults=10;
        // calculate how many results we may have in total 
        $sql=$db->prepare(" select count(*) from drafts where uid = '$uid'");
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
        

        $sql=$db->prepare("select * from drafts where uid ='$uid' ORDER BY id DESC  limit ".$limitnumber.",".$NoOfResults);
        $sql->execute();
        $row=$sql->fetch();
        $count=$sql->rowCount();
    
        ?>
    <div class="container">
        
           <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
            
                <div class="modal-body">
                    <p>You are about to delete this draft, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>

        
    <h1 class="mt-4 mb-3">
        <small>My Drafts</small>
      </h1>
      
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
            <li class="breadcrumb-item">
            My Drafts
            </ol>
            <div class="row">      
            <?php for($rec=0;$rec<$count;$rec++){
                ?>
            
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="<?php echo "displaydraft.php?st=".$row["id"]; ?>"><img class="card-img-top" width="300" height="300" src="<?php if($row["cover"]==""){echo "http://placehold.it/700x400";} else echo "uploads/".$row["cover"]?>" alt="http://placehold.it/700x400"></a>
                            <div class="card-body">
                                <h4 class="card-title" align="center">
                                    <a href="<?php echo "displaydraft.php?st=".$row["id"]; ?>"><?php echo $row['title'] ;?></a>
                                    <hr>
                                    <a href="publishthis.php?id=<?php echo $row["id"];?>" class="btn btn-info" role="button">Publish</a>
                                    
                                    <a href="Edit.php?id=<?php echo $row["id"];?>&ty=df" class="btn btn-warning" role="button">Edit</a>
                                    
                                    <a href="#" data-href="Delete.php?id=<?php echo $row["id"];?>&type=df" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" role="button">Delete</a>
                                    
                                </h4>
                                
                            </div>
                    </div>   
                </div>
            
            <?php  $row=$sql->fetch(); } ?>

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

</body>
<?php require("footer.php");?>
        <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>

<style>


</style>