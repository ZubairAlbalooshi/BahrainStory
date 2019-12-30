<html>
<?php
 require("connection.php"); 
        if(isset($_SESSION)=="false"){
            session_start();
            $email=$_SESSION["email"];
        }
    
    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


if(isset($_POST)){
    $draft=false;
    if($_POST["btn"]=="draft"){
        $draft=true;
    }
    
    $title=$_POST["title"];
    $text=$_POST["editor"];
    $tags=$_POST["tags-input"];
        if(isset($_POST["cat"])){
            $cat=$_POST["cat"];
            $true=true;
        }
    else {$cat=""; $true=false;}
    $string='';
 if($true){
         for($i=0; $i < sizeof($cat) ; $i++){
        if($i==0){
            $string=$cat[$i];
        }
        
        else{
            $string=$string.",".$cat[$i];
        }
    }
 }
    

   
    
    session_start();
    $email=$_SESSION["email"];
    $sql=$db->prepare("select id from users where email = '$email' limit 1");
    $sql->execute();
    $r=$sql->fetch();
    $uid=$r['id'];
    $_SESSION["uid"]=$uid;
    
    
    try{
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
        if($draft==false){        
                    $stmt=$db->prepare("insert into story (id,title,text,cover,categories,tags,uid)values (null,:title,:text,:cover,:categories,:tags,:uid)");
                    $stmt->bindParam(":title",$title);
                    $stmt->bindParam(":text",$text);
                    $stmt->bindParam(":cover",$cover);
                    $stmt->bindParam(":categories",$string);
                    $stmt->bindParam(":tags",$tags);
                    $stmt->bindParam(":uid",$uid);
                    $stmt->execute();    
                    $publish=true;
                        }
                
        IF($draft==true){
            $stmt=$db->prepare("insert into drafts (id,title,text,cover,categories,tags,uid)values (null,:title,:text,:cover,:categories,:tags,:uid)");
                    $stmt->bindParam(":title",$title);
                    $stmt->bindParam(":text",$text);
                    $stmt->bindParam(":cover",$cover);
                    $stmt->bindParam(":categories",$string);
                    $stmt->bindParam(":tags",$tags);
                    $stmt->bindParam(":uid",$uid);
                    $stmt->execute();    
                    $draftsaved=true;
            
        }        
                
            
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
       
    }
    
    catch(Exception $e){
        $e->getMessage();
        $publish=false;
    }
       
}
?>

<?php require("head.php");?>

<body>
<?php require("nav.php");?>
    <div class="container">
    <h1 class="mt-4 mb-3">
        <small>The publishing / Saving As Draft results</small>
      </h1>
         <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
             <li class="breadcrumb-item">
             <a href="../Author/publish.php">Write and publish a story </a>
             </li>
              <li class="breadcrumb-item">
               Publishing Results
               </li>
           
        </ol>
        <?php if(isset($publish)){
            if($publish==true){
            echo "<h3 align='center' style='positon:absolute , top: 50%;'>Your story has been successfully Published you can view it by clicking  on <a href='mystories.php'> This Link !</a></h3>";}
                                
            
                if($publish==false){
                echo"<h3>There was a problem with publishing your story please try agin </h3>",$e->getMessage();
                                 }}
            
              if(isset($draftsaved)){
                  if($draftsaved==true){
            echo "<h3 align='center' style='positon:absolute , top: 50%;'>Your draft has been successfully Saved as a draft you can view it by clicking  on <a href='Drafts.php'> This Link !</a></h3>";
                                }}
            
            
        ?>
    </div>
</body>

        
<?php require("footer.php");?>
    </html>
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