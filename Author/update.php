<?php
        require("connection.php");
        require("head.php");
        require("nav.php"); 
    
   function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$id=$_POST['id'];
$type=$_POST['type'];
    
if(!empty($_FILES['fileToUpload']['name'])){
    $file=true;
    if($type=="df"){
      $sql=$db->prepare("select cover from drafts where id='$id'");
    }
    else $sql=$db->prepare("select cover from story where id='$id'");
    
    $sql->execute();
    $row=$sql->fetch();
    $oldcover=$row['cover'];
  //      unlink("uploads/".$oldcover);
   
    
    $array= explode('.',$_FILES["fileToUpload"]["name"]);
        $ext=end($array);
        $rstring=generateRandomString().".".$ext;
        $target_dir = "uploads/";
        $_FILES["fileToUpload"]["name"]=$rstring;
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            echo $_FILES["fileToUpload"]["name"];
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
             // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $cover=basename($_FILES["fileToUpload"]["name"]); 
            if($type=="df"){    
            $sql=$db->prepare("update drafts set cover = '$cover' where id='$id' ");
           
            }
            else{  $sql=$db->prepare("update story set cover = '$cover' where id='$id' ");
               
                } 
            $sql->execute();}    
    
}
}
    
    
if($_POST['editor']){
    $text=$_POST['editor'];
    if($type=="df"){
    $sql=$db->prepare("update drafts set text = '$text' where id = '$id'");
    }
    else $sql=$db->prepare("update story set text = '$text' where id = '$id'");
    $sql->execute();
    sleep(2);
}
    
    
if($_POST['title']){
    $title=$_POST['title'];
    if($type=='df'){
    $sql=$db->prepare("update drafts set title = '$title' where id = '$id'");
    }
    else $sql=$db->prepare("update story set title = '$title' where id = '$id'");
    $sql->execute();
}

if($_POST["tags-input"]){
    $tags=$_POST['tags-input'];
    if($type=="df"){
    $sql=$db->prepare("update drafts set tags = '$tags' where id = '$id'");
    }
    else $sql=$db->prepare("update story set tags = '$tags' where id = '$id'");
    $sql->execute();
}

if(isset($_POST["cat"])){
    $cat=$_POST["cat"];
    $string='';
    for($i=0; $i < sizeof($cat) ; $i++){
        if($i==0){
            $string=$cat[$i];
        }
        
        else{
            $string=$string.",".$cat[$i];
        }
    }
    if($type=="df"){
    $sql=$db->prepare("update drafts set categories = '$string' where id = '$id'");}
    else $sql=$db->prepare("update story set categories = '$string' where id = '$id'");
    $sql->execute();
}

//$_POST=array();





?>
<div class="container">
       <h1 class="mt-4 mb-3">
        <small>Editing results</small>
      </h1>
           <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
               <li class="breadcrumb-item"><?php if($type == "df"){echo '<a href="Drafts.php">Drafts</a>';} else echo '<a href="mystories.php">My Stories</a>'?></li>
            <li class="breadcrumb-item">
               Editing done...
               </li>
            </ol>
        <div id="d1" align="center" style="border: 1px solid blue; height='500'; ">
            <?php if($type=='df'){
            echo '<h3>Draft has been successfully edited. Would you like to publish it ?
            </h3>';
            echo '<a href="publishthis.php?id='.$id.'" class="btn btn-primary btn-lg">Yes</a>';
            echo '<a href="Drafts.php" class="btn btn-danger btn-lg">No</a>';
                }
            else echo "<h3>Story has been successfully edited.</h3>";       
            
            ?>
                
            </h3>
        </div>
</div>

<?php require("footer.php");?>
<style>
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