<?php
require("connection.php");
require("head.php");
require("nav.php");


    
 if(!isset($_GET["id"])){
    header("location:../404.html");
} 


else $id=$_GET["id"];
     $type=$_GET['ty'];
    $uid=$_SESSION['uid'];
      if($type=='df'){
            $sql=$db->prepare("select * from drafts where id = '$id' and uid='$uid' ");
      }
else {
      $sql=$db->prepare("select * from story where id = '$id' and uid='$uid' ");
}
            $sql->execute();
                $row=$sql->fetch();
                    $path=getcwd();
                        $tags=explode(",",$row["tags"]);
                        $cat=$row["categories"];
                            $arr=explode(",",$cat);
                                    $c1="";
                                    $c2="";
                                    $c3="";
                                    $c4="";
                                    $c5="";
                                    $c6="";
                                    $c7="";
                                    $c8="";
                                    $c9="";
                                    $c10="";
                    for ($i=0;$i<sizeof($arr);$i++){
                       if($arr[$i]=="sci-fi"){
                           $c1="checked";
                       }
                        if($arr[$i]=="Fantasy"){
                           $c2="checked";
                       }
                        if($arr[$i]=="Comedy"){
                           $c3="checked";
                       }
                        if($arr[$i]=="Drama"){
                           $c4="checked";
                       }
                        if($arr[$i]=="Romance"){
                           $c5="checked";
                       }
                         if($arr[$i]=="Action"){
                           $c6="checked";
                       }
                        if($arr[$i]=="Thriller"){
                           $c7="checked";
                       }
                        if($arr[$i]=="Mystery"){
                           $c8="checked";
                       }
                        if($arr[$i]=="Adventure"){
                           $c9="checked";
                       }
                        if($arr[$i]=="Fiction"){
                           $c10="checked";
                       }
                       
                        
                   }
        

$_SESSION['KCFINDER'] = array();
$_SESSION['KCFINDER']['disabled'] = false; // Activate the uploader, Users to this page MUST be authenticated
$_SESSION['KCFINDER']['uploadURL'] = "/BahrainStory/Author/".$uid; // Based on my second folder structure
$_SESSION['fold_type'] = "media"; // Based on 

   
?>
<!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
 
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />

<!-- Include JS file. -->


<body>
    <div class="container">
           <h1 class="mt-4 mb-3">
        <small><?php if($type=="st"){echo "Edit Story";}
            else echo "Edit Draft";
            ?></small>
      </h1>
      
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
                <li class="breadcrumb-item">
                    <?php if($type=="st"){
                  echo '<a href="../Author/mystories.php">My Stories</a>';
                        }
                    else echo ' <a href="../Author/Drafts.php">My Drafts</a>';
                    ?>
               
                </li>
                <li class="breadcrumb-item">
                <?php if($type =="st"){
        echo "Edit Story";
    
}
                    else echo "Edit Draft";?></li>
            </ol>
         <form action="update.php" method="post" enctype="multipart/form-data" > 
             
             <input type="hidden" name="type" value="<?php echo $type?>">
             <label>Select Catogories for your story:</label> </br>             
             <table>
            <tr>
                <td><input type="checkbox" name="cat[]" <?php echo $c1; ?> value="sci-fi"> Sci-Fi</td>
                <td ><input type="checkbox" name="cat[]" <?php echo $c2; ?> value="Fantasy"> Fantasy</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="cat[]" <?php echo $c3; ?> value="Comedy"> Comedy</td>
                <td ><input type="checkbox" name="cat[]" <?php echo $c4; ?> value="Drama"> Drama</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="cat[]" <?php echo $c5; ?> value="Romance"> Romance</td>
                <td ><input type="checkbox" name="cat[]" <?php echo $c6; ?> value="Action"> Action</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="cat[]" <?php echo $c7; ?> value="Thriller"> Thriller</td>
                <td ><input type="checkbox" name="cat[]" <?php echo $c8; ?> value="Mystery"> Mystery</td>
            </tr>
               <tr>
                <td><input type="checkbox" name="cat[]"  <?php echo $c9; ?> value="Adventure"> Adventure</td>
                <td ><input type="checkbox" name="cat[]" <?php echo $c10; ?> value="Fiction"> Fiction</td>
            </tr>
        </table>
             <input type="text" hidden name="id" value="<?php echo $id?>">
        <br>
         <div class="form-group">
             <label for="exampleFormControlFile1"><b>You can update cover picture form here<font color="red"> (Optional)</font></b></label>
    <input type="file" placeholder="<?php echo $row['cover']; ?>" class="form-control-file" name="fileToUpload" id="exampleFormControlFile1">
             
  </div>
        <input type="text" name="title"  placeholder="<?php echo $row['title'];?>" class="form-control"/>
        <br>
             
        
        <textarea id="editor" rows="10" name="editor">
             <?php echo $row["text"]?>
             </textarea>
             
        <br>
                     <label>Enter Some Tags for the Story (Each Tag followed by a <font color="red">Comma <b>,</b></font> : </label>
       
           <p> <div class="tags-input" data-name="tags-input">

            

            </div></p> 
             
        <div align="text-align : center;">
 <button type="submit" class="btn-block btn-primary" name="btn" value="publish">Save changes</button>

        <br>
            <hr size="0">
            </div>
 </form> 
    </div>
</body>

<?php require("footer.php");?>
<!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
 
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/js/froala_editor.pkgd.min.js"></script>
 
  <script>
    $(function() {
      $('#editor').froalaEditor({
        // Set the file upload URL.
        imageUploadURL: '../Author/upload_image.php',
 
        imageUploadParams: {
          id: 'editor'
        }
      })
    });
  </script>
<script type="text/javascript">
    [].forEach.call(document.getElementsByClassName('tags-input'), function (el) {

    let hiddenInput = document.createElement('input'),

        mainInput = document.createElement('input'),

        tags = [];

    

    hiddenInput.setAttribute('type', 'hidden');

    hiddenInput.setAttribute('name', el.getAttribute('data-name'));



    mainInput.setAttribute('type', 'text');

    mainInput.classList.add('main-input');

    mainInput.addEventListener('input', function () {

        let enteredTags = mainInput.value.split(',');

        if (enteredTags.length > 1) {

            enteredTags.forEach(function (t) {

                let filteredTag = filterTag(t);

                if (filteredTag.length > 0)

                    addTag(filteredTag);

            });

            mainInput.value = '';

        }

    });



    mainInput.addEventListener('keydown', function (e) {

        let keyCode = e.which || e.keyCode;

        if (keyCode === 8 && mainInput.value.length === 0 && tags.length > 0) {

            removeTag(tags.length - 1);

        }

    });



    el.appendChild(mainInput);

    el.appendChild(hiddenInput);



   



    function addTag (text) {

        let tag = {

            text: text,

            element: document.createElement('span'),

        };



        tag.element.classList.add('tag');

        tag.element.textContent = tag.text;



        let closeBtn = document.createElement('span');

        closeBtn.classList.add('close');

        closeBtn.addEventListener('click', function () {

            removeTag(tags.indexOf(tag));

        });

        tag.element.appendChild(closeBtn);



        tags.push(tag);



        el.insertBefore(tag.element, mainInput);



        refreshTags();

    }



    function removeTag (index) {

        let tag = tags[index];

        tags.splice(index, 1);

        el.removeChild(tag.element);

        refreshTags();

    }



    function refreshTags () {

        let tagsList = [];

        tags.forEach(function (t) {

            tagsList.push(t.text);

        });

        hiddenInput.value = tagsList.join(',');

    }



    function filterTag (tag) {

        return tag.replace(/[^\w -]/g, '').trim().replace(/\W+/g, '-');

    }
            $(document).ready(function(){
    var arr = <?php echo json_encode($tags); ?> ;
    var i ;
    for(i=0;i<arr.length;i++){
        addTag(arr[i]);
    }
});

});
    
  
</script>
<style>
.btn-block {
    height: 70px;
}

td
{
    padding:0 15px 0 15px;
}
    
    :root {

    font-family: Arial, Helvetica, sans-serif;

}



.tags-input {

    border: 1px solid gray;

    display: inline-block;
    width: 100%;

}



.tags-input .tag {

    font-size: 85%;

    padding: 0.5em 0.75em;

    margin: 0.25em 0.1em;

    display: inline-block;

    background-color: #ddd;

    transition: all 0.1s linear;

    cursor: pointer;

}



.tags-input .tag:hover {

    background-color: #3af;

    color: white;

}



.tags-input .tag .close::after {

    content: '×';

    font-weight: bold;

    display: inline-block;

    transform: scale(1.4);

    margin-left: 0.75em;

}



.tags-input .tag .close:hover::after {

    color: red;

}



.tags-input .main-input {

    border: 0;

    outline: 0;

    padding: 0.5em 0.1em;

}
    .fr-wrapper>div>a { display: none!important; }


</style>