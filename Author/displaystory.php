<?php
require("connection.php");
require("head.php");
require("nav.php");

if(isset($_GET["st"])){
     $_GET["st"];
     $uid=$_SESSION["uid"];
     $id=$_GET["st"];
     $sql=$db->prepare("select * from story where uid='$uid' and id='$id'");
     $sql->execute();
     $row=$sql->fetch();

}
else header("location:../404.html");
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css"/>
<body>
    <div class="container">
         <h1 class="mt-4 mb-3">
             <small><?php echo ucfirst($row["title"]);?></small>
         </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
                <li class="breadcrumb-item"><a href="../Author/mystories.php">My Stories</a> </li>
                    <li class="breadcrumb-item"><?php echo ucfirst($row["title"]);?></li>
                                <li class="breadcrumb-item"><a href="download3.php?id=<?php echo $id."&tp=s";?>" class="btn-lg btn-danger">Download as PDF</a> </li>
            </ol>
                  <div class="container" align="center">
                <button id="smr" class="btn btn-lg btn-default">A-</button>
                <button id="nor" class="btn btn-lg btn-default">A</button> 
                <button id="lr" class="btn btn-lg btn-default">A+</button>
            </div>
        <div class="fr-view"><p><?php echo $row["text"]; ?></p></div>
        
    </div>
</body>
<?php require("footer.php")?>
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
</script>

<style>

    html {
    position: relative;
    min-height: 100%;
}
</style>