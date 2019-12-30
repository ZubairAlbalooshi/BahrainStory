<?php
    require("connection.php");
    session_start();
    $stid=$_SESSION["stid"];
    
    $sql=$db->prepare("select * from comment where parrent_comment_id = 0 and stid='$stid' order by comment_id desc");
    $sql->execute();
    $output="";
    $row=$sql->fetch();
    $count=$sql->rowCount();
$output='';
    for($i=0; $i<$count;$i++){
        $output .= '
 <div class="panel panel-default">
  <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
  <div class="panel-body">'.$row["comment"].'</div>
  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'" onclick="clicked('.$row["comment_id"].')" >Reply</button></div>
 </div>
 ';
        
            
      $output .= get_reply_comment($row["comment_id"]); 
        $row=$sql->fetch();
    }
echo $output;
    
function get_reply_comment($parent_id , $marginleft = 0)
{   $output=" ";
    
    $db = new PDO('mysql:host=localhost;dbname=bahrainstory;charset=utf8', 'root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql=$db->prepare("select * from comment where parrent_comment_id = '$parent_id'");
    $sql->execute();
    $row=$sql->fetch();
    $count=$sql->rowCount();

    
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  for($i=0; $i< $count ; $i++)
  {
   $output .= '
   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["username"].'</b> on <i>'.$row["date"].'</i></div>
    <div class="panel-body">'.$row["comment"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'" onclick="clicked('.$row["comment_id"].')" ">Reply</button></div>
   </div>
   ';
   $output .= get_reply_comment($row["comment_id"], $marginleft);
      $row=$sql->fetch();
  }
 }
    
 return $output;
}


?>
