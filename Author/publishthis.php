<?php 
    require("connection.php");
    require("head.php");
    require("nav.php");

    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $uid=$_SESSION['uid'];
        
        $sql=$db->prepare("select * from drafts where id = '$id' and uid = '$uid'");
        $sql->execute();
        $row=$sql->fetch();
        $count=$sql->rowCount();
        
        if($count==0){
            header("location:../404.html");
            exit();
        }
        else{
            $title=$row['title'];
            $text=$row['text'];
            $cover=$row['cover'];
            $cat=$row['categories'];
            $tags=$row["tags"];
              
            try{
         $stmt=$db->prepare("insert into story (id,title,text,cover,categories,tags,uid)values (null,:title,:text,:cover,:categories,:tags,:uid)");
                    $stmt->bindParam(":title",$title);
                    $stmt->bindParam(":text",$text);
                    $stmt->bindParam(":cover",$cover);
                    $stmt->bindParam(":categories",$cat);
                    $stmt->bindParam(":tags",$tags);
                    $stmt->bindParam(":uid",$uid);
                    $stmt->execute();  
                    $insert=true;
            } 
            
            catch(Exception $e){
                $insert=false; $e->getMessage();
            }
            
            if($insert){
                try{
                    $sql=$db->prepare("delete from drafts where id='$id' and uid ='$uid'");
                    $sql->execute();
                    $delete=true;
                }
                catch(Exception $e){
                    $delete=false;$e->getMessage();
                }
            }
                    
        }
    }

    else{
        header("location:../404.html");
    }
?>
<div class="container">
    <h1 class="mt-4 mb-3">
            <small>Publish Draft</small>
    </h1>
      
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../Author/">Home</a>
                </li>
                    <li class="breadcrumb-item">
                        <a href="../Author/Drafts.php">My Drafts</a>
                    </li>
                <li class="breadcrumb-item">Publish Draft</li>
            </ol>
    
        <div id="d1" align="center" style="border: 1px solid blue; height='500'; ">
            <?php if($insert && $delete){
            echo "<h3>The draft hase been successfully published you can view it from <a href='mystories.php'> This Link !</a></h3>";
            }?>
        </div>
    
</div>
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