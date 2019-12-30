<?php
require("connection.php");
require("head.php");
require("nav.php");

     $_GET["st"];
            $id=$_GET["st"];
            $_SESSION["stid"]=$id;
                $sql=$db->prepare("select * from story where id='$id'");
                        $sql->execute();
                                $row=$sql->fetch();
                                        $uid=$row['uid'];
                                    $sql=$db->prepare("select name from users where id = '$uid'");
                                $sql->execute();
                        $row2=$sql->fetch();
                    $uid=$_SESSION['uid'];
                $sql=$db->prepare("select * from users where id ='$uid'");
            $sql->execute();
     $row3=$sql->fetch();

$sql3=$db->prepare("select rating from comment where stid = '$id' and rating is not null");
    $sql3->execute();
        $nofratings=$sql3->rowCount();
$sql4=$db->prepare("select sum(rating) from comment where stid = '$id' and rating is not null");
    $sql4->execute();
        $row4=$sql4->fetch();
           $sum=$row4['sum(rating)'];
                if($nofratings != 0){
                    $rating=$sum/$nofratings;
                }
                else {
                    $rating="not Yet Rated";
                }


$sql=$db->prepare("select * from story where id='$id'");
     $sql->execute();
     $row22=$sql->fetch();
     $uid=$row22['uid'];
     $sql=$db->prepare("select name from users where id = '$uid'");
     $sql->execute();
     $row30=$sql->fetch();
     $cat=$row22['categories'];
    
     
 $similarst="";
    $counter=0;
   function lookup($cat , $db){
       $stm2=$db->prepare("select distinct(title) as title , id  from story where categories like '%$cat%'");
       $stm2->execute();
    $var=$stm2->fetchall();
     return $var;
       
   }
?>



<body>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    
    <div class="container">
        
        <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reporting Author or story</h5>
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="display:block">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="report"> <?php $id = $_SESSION['uid']; $stid = $_GET['st'];?>
            <input type="hidden" id="reportedid"  value="<?php echo $uid ;?>">
            <input type="hidden" id="reporterid" value="<?php echo $id ;?>">
            <input type="hidden" id="stid" value="<?php echo $stid ;?>">
            <label>Reason for reporting</label>
            <textarea  style="width:100%" rows="10" id="reason">
                
            </textarea>  
            
        
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Submit</button>
          </form>
      </div>
    </div>
  </div>
</div>
        
        
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
        
        
        <h1 class="mt-4 mb-3">
            
             <small><?php echo ucfirst($row["title"]); ?> By Author: <a href="author.php?id=<?php echo $uid?>"> <?php echo $row2[0];?></a></small>
         </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="index.php">Home</a>
            </li>
                    <li class="breadcrumb-item"><?php echo ucfirst($row["title"]);?></li>    
                <li class="breadcrumb-item"><?php echo "<b>Rated :"." ".$rating."/5 stars</b>"?></li>
                <!--  <li class="breadcrumb-item"><a href="download.php?id=<?php //echo $id."&tp=s";?>" class="btn-lg btn-danger">Download as PDF</a> </li> 
                                -->
                <li class="breadcrumb-item"><a onclick="openm(); return false;" href="#">View Similar Stories</a></li>
            </ol>
                  <div class="container" align="center">
                <button id="smr" class="btn btn-lg btn-default">A-</button>
                <button id="nor" class="btn btn-lg btn-default">A</button> 
                <button id="lr" class="btn btn-lg btn-default">A+</button>
                      
                </div>
        <p><div class="container"><div class="fr-view"><?php echo $row["text"]; ?></div></div></p>
    <a href="#" onclick="openm2(); return false;" class="btn btn-danger btn-block">Report This!</a>
      
<h2><span  class="line-center">Rate & Comment</span></h2>
     <form method="post" id="commentform">
    <div class="stars" align="center">
        <div id="divCheckbox" style="visibility: hidden"> <input class="star star-6" id="star-6" type="radio" name="star" checked=true value="NULL"/> </div>  
    <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
    <label class="star star-5" for="star-5"></label>
    <input class="star star-4" id="star-4" type="radio" name="star" value = "4"/>
    <label class="star star-4" for="star-4"></label>
    <input class="star star-3" id="star-3"  type="radio" name="star" value = "3"/>
    <label class="star star-3" for="star-3"></label>
    <input class="star star-2" id="star-2" type="radio" name="star" value = "2"/>
    <label class="star star-2" for="star-2"></label>
    <input class="star star-1" id="star-1" type="radio" name="star" value = "1" />
    <label class="star star-1" for="star-1"></label>
    </div>
     <div class="form-group form-group-lg">
      <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
          <input type="hidden" name="stid" value="<?php echo $id;?>">
       <input class="form-control" id="name"  value="<?php echo $row3['name'];?>" disabled type="text"/>
          <input type="hidden" name="name" value="<?php echo $row3['name'];?>"/>
      </div>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="message">
       Comment
      </label>
        <input type="hidden" name="comment_id" id="comment_id" value="0" /> 
      <textarea class="form-control" cols="40" required id="message" name="message" rows="10"></textarea>
     </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary" name="submit" type="submit">
        Submit Rate and Comment
       </button>
          <button class="btn btn-danger" type="reset">
              Clear 
          </button>
      </div>
     </div>
          <hr>
       
    
    </form>
          
         <span id="commentmessage"></span>
    <br>
   <div class="ds"></div>
    </div>
        
 

</body>
<?php require("footer.php")?>

 <script>
           function openm2(){
        
                    
                        $("#exampleModal4").modal();
                 
       
    }
      </script>

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
    
$(document).ready(function(){
   $('#commentform').on('submit',function(event){
    event.preventDefault();
    var form_data=$(this).serialize();
       $.ajax({
           url:"addcomment.php",
           method:"POST", 
           data:form_data, 
           dataType:"JSON",
           success:function(data){
               if(data.error != ''){
                $('#commentform')[0].reset();
                $('#commentmessage').html(data.error);   
                $('#comment_id').val('0');
                load_comment();
                }
           }
       })
   });
    
    load_comment();
    function load_comment(){
        $.ajax({
            url:"fetchcomment.php",
            method:"POST",
            success:function(data)
            {
            $("#commentmessage").html(data);
        }
        })
    }
});
    
    function clicked(data){
        var comment_id=data;
        document.getElementById("comment_id").value=comment_id;
        document.getElementById("message").focus();
    }
    
</script>

<script>
$('#report').submit(function(event){
    event.preventDefault();  
    
    var reportedid= document.getElementById("reportedid").value;
    var reporterid= document.getElementById("reporterid").value;
    var stid= document.getElementById("stid").value;
    var reason= document.getElementById("reason").value;
    
    $.ajax({
       method : "post",
       data : {reportedid: reportedid , reporterid :reporterid , stid :stid , reason : reason},
       url : "report.php",
       success: function(res){
           alert(res);
           $("#exampleModal").modal();      }
    });
    
});
</script>

<style>
    .line-center{
    margin:0;padding:0 10px;
    background:#fff;
    display:inline-block;
    }
    h2{

    text-align:center;
    position:relative;
    z-index:2;

    }
    h2:after{
    content:"";
    position:absolute;
    top:50%;
    left:0;
    right:0;
    border-top:solid 1px red;
    z-index:-1;
    }
    
    div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\2605';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\2605';
}

.boxsizingBorder {
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
            box-sizing: border-box;
}
 
</style>


