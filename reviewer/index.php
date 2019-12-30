<?php
ob_start();
    require("connection.php");
        require("head.php");
?>

  <body>

   <?php require("nav.php");
      
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

    <header>
   
    </header>

    <!-- Page Content -->
      
    <div class="container">
        
        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adding to bookmarks</h5>
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="display:block">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <div class="modal-body">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
  <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
  <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 "/>
</svg>
          <p class="success">Story Bookmarked for later reading</p>
      </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        
        
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adding to bookmarks</h5>
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="display:block">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <div class="modal-body">
          <p class="success">You have Already Bookmarked This story</p>
      </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>    
        
         <h1 class="mt-4 mb-3">
        <small>Reviewer's Page</small>
      </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="index.php">Home</a>
            </li></ol>        <form method="get" action="adsearch.php">
            <div align="center" class="row">
                <div class="col">
                <input type="text" name="title" placeholder="Search for a story" class="form-control"><br>
                </div>
                <div class="col">
                <a href="adsearch.php">Advanced Search</a>
                </div>
            </div>
        </form>
        <div class="jumbotron">
            
          <div class="container">
              <div align="center"><h3>Featured Stories</h3></div> <br>
              <div class="row">
              <?php 
              $stm=$db->prepare("select s.id, s.title , s.cover  from story s , featured f where s.id = f.stid");
              $stm->execute();
              $fstm=$stm->fetchall();
              
              foreach($fstm as $nrow){?>
              
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="<?php echo "displaystory.php?st=".$nrow["id"]; ?>"><img class="card-img-top" width="300" height="300" src="<?php if($nrow["cover"]==""){echo "http://placehold.it/700x400";} else echo "../Author/uploads/".$nrow["cover"]?>" alt="http://placehold.it/700x400"></a>
                            <div class="card-body">
                                <h4 class="card-title" align="center">
                                    <a href="<?php echo "displaystory.php?st=".$nrow["id"]; ?>"><?php echo $nrow['title'] ;?></a>
                                    
                                    <a onclick="openm(<?php echo $nrow["id"];    ?>); return false;"  href="#"><img src="bookmark.png" width="30" height="30"></a>
                                    
                                </h4>
                                
                            </div>
                    </div>   
                </div>
    
              <?php }?>
                  </div>
          </div>
        </div>
    <div class="row">
         <?php for($rec=0;$rec<$count;$rec++){
                ?>
            
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="<?php echo "displaystory.php?st=".$row["id"]; ?>"><img class="card-img-top" width="300" height="300" src="<?php if($row["cover"]==""){echo "http://placehold.it/700x400";} else echo "../Author/uploads/".$row["cover"]?>" alt="http://placehold.it/700x400"></a>
                            <div class="card-body">
                                <h4 class="card-title" align="center">
                                    <a href="<?php echo "displaystory.php?st=".$row["id"]; ?>"><?php echo $row['title'] ;?></a>
                                    <a onclick="openm(<?php echo $row['id']?>); return false;"  href="#"><img src="bookmark.png" width="30" height="30"></a> 
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
      require("nav.php");
    ?>

  <script>
           function openm(id){
        
               var stid=id;
               var uid=<?php echo $uid;?>;
               $.ajax({
                   url:"bookmark.php",
                   type:"POST",
                   data:{stid:stid, uid:uid},
                   success:function(res){
                       
                    if(res=="Already Bookmarked"){ 
                        $("#exampleModal2").modal();
                    }
                    
                    if(res=="Done"){
                        $("#exampleModal3").modal();
                    }   
                    
                       if(res=="Problem"){
                           alert("There was a problem bookmarking your story");
                       }
                   }
                      });
       
    }
      </script>
  </body>
<?php
  require("footer.php");
?>
</script>

<style>
svg {
  width: 100px;
  display: block;
  margin: 40px auto 0;
}

.path {
  stroke-dasharray: 1000;
  stroke-dashoffset: 0;
  &.circle {
    -webkit-animation: dash .9s ease-in-out;
    animation: dash .9s ease-in-out;
  }
  &.line {
    stroke-dashoffset: 1000;
    -webkit-animation: dash .9s .35s ease-in-out forwards;
    animation: dash .9s .35s ease-in-out forwards;
  }
  &.check {
    stroke-dashoffset: -100;
    -webkit-animation: dash-check .9s .35s ease-in-out forwards;
    animation: dash-check .9s .35s ease-in-out forwards;
  }
}

p {
  text-align: center;
  margin: 20px 0 60px;
  font-size: 1.25em;
  &.success {
    color: #73AF55;
  }
  &.error {
    color: #D06079;
  }
}


@-webkit-keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes dash {
  0% {
    stroke-dashoffset: 1000;
  }
  100% {
    stroke-dashoffset: 0;
  }
}

@-webkit-keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}

@keyframes dash-check {
  0% {
    stroke-dashoffset: -100;
  }
  100% {
    stroke-dashoffset: 900;
  }
}

</style>

