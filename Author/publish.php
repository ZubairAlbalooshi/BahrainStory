<?php
    if(isset($_SESSION) == false){
        session_start();
    }

?>

<?php require("head.php"); ?>

<!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
 
    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css" />

<!-- Include JS file. -->


<?php require("nav.php"); ?>



<body>
    <div class="container">
              <h1 class="mt-4 mb-3">
        <small>Write and publish a story</small>
      </h1>
           <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
            <li class="breadcrumb-item">
               Write and publish a story
               </li>
            </ol>
    <form action="upload.php" method="post" enctype="multipart/form-data" >   
        <label>Select Catogories for your story:</label> </br>
        <table>
            <tr>
                <td><input type="checkbox" name="cat[]" value="sci-fi"> Sci-Fi</td>
                <td ><input type="checkbox" name="cat[]" value="Fantasy"> Fantasy</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="cat[]" value="Comedy"> Comedy</td>
                <td ><input type="checkbox" name="cat[]" value="Drama"> Drama</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="cat[]" value="Romance"> Romance</td>
                <td ><input type="checkbox" name="cat[]" value="Action"> Action</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="cat[]" value="Thriller"> Thriller</td>
                <td ><input type="checkbox" name="cat[]" value="Mystery"> Mystery</td>
            </tr>
               <tr>
                <td><input type="checkbox" name="cat[]" value="Adventure"> Adventure</td>
                <td ><input type="checkbox" name="cat[]" value="Fiction"> Fiction</td>
            </tr>
        </table>
        <br>
         <div class="form-group">
    <label for="exampleFormControlFile1">Please upload a cover picture for your story</label>
    <input type="file" class="form-control-file" name="fileToUpload" required  id="exampleFormControlFile1">
                
  </div>
        <input type="text" name="title" required  placeholder="Enter the title of the story here" class="form-control"/>
        <br>
        
        <textarea id="editor" name="editor"></textarea>
        <br>
        <label>Enter Some Tags for the Story (Each Tag followed by a <font color="red">Comma <b>,</b></font> : </label>
       
           <p> <div class="tags-input" data-name="tags-input">

            

            </div></p><script src="tags.js"></script>   
        <div align="text-align : center;">
 <button type="submit" class="btn-block btn-primary" name="btn" value="publish">Publish</button>
<button type="submit" class="btn-block btn-danger" name="btn" value="draft">Save As Daft</button>
        <br>
            <hr size="0">
            </div>
 </form> 
        
</body>
        </div>    
<?php require("footer.php"); ?>
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


<style>
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

