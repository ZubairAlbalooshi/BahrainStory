<?php
require("connection.php");
require("head.php");
require("nav.php");

     $_GET["st"];
     $id=$_GET["st"];
     $sql=$db->prepare("select * from story where id='$id'");
     $sql->execute();
     $row=$sql->fetch();
     $uid=$row['uid'];
     $sql=$db->prepare("select name from users where id = '$uid'");
     $sql->execute();
     $row2=$sql->fetch();
     $cat=$row['categories'];
    
     
 $similarst="";
    $counter=0;
   function lookup($cat , $db){
       $stm2=$db->prepare("select distinct(title) as title , id  from story where categories like '%$cat%'");
       $stm2->execute();
    $var=$stm2->fetchall();
     return $var;
       
   }
?>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<body>
    
      <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Similar Stories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="display:block">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php 
         
             $var=lookup($cat,$db);

          foreach($var as $rec) {?>
            
              <a class="btn btn-success btn-block" href="displaystory.php?st=<?php echo $rec['id']?>"><?php echo $rec['title'];?></a>
                 
         <?php } 
          ?>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    
    <div class="container">
         <h1 class="mt-4 mb-3">
             <small><?php echo ucfirst($row["title"]); ?> By Author: <a href="author.php?id=<?php echo $uid?>"> <?php echo $row2[0];?></a>  </small>
         </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="index.php">Home</a>
            </li>
                    <li class="breadcrumb-item"><?php echo ucfirst($row["title"]);?></li>
                              <!--  <li class="breadcrumb-item"><a href="download.php?id=<?php //echo $id."&tp=s";?>" class="btn-lg btn-danger">Download as PDF</a> </li> 
                                -->
                    <li class="breadcrumb-item"><a onclick="openm(); return false;" href="#">View Similar Stories</a></li>
            </ol>
            <div class="container" align="center">
                <button id="smr" class="btn btn-lg btn-default">A-</button>
                <button id="nor" class="btn btn-lg btn-default">A</button> 
                <button id="lr" class="btn btn-lg btn-default">A+</button>
            </div>
                <div class="fr-view">
        <p><?php echo $row["text"]; ?></p></div>
        <br><hr><br>
        
    </div>

<?php require("footer.php")?>
</body>

<script>

    var $affectedElements = $("p");
    
    $affectedElements.each( function(){
  var $this = $(this);
  $this.data("orig-size", $this.css("font-size") );
});

$("#lr").click(function(){
  changeFontSize(1);
})

$("#smr").click(function(){
  changeFontSize(-1);
})

$("#nor").click(function(){
  $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , $this.data("orig-size") );
   });
})

function changeFontSize(direction){
    $affectedElements.each( function(){
        var $this = $(this);
        $this.css( "font-size" , parseInt($this.css("font-size"))+direction );
    });
}
    
    function openm(){
        $("#exampleModal3").modal();
       
    }
</script>

<style>

    html {
    position: relative;
    min-height: 100%;
}
</style>