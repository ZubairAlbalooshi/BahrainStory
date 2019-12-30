<?php
    require("connection.php");
    require("head.php");
    require("nav.php");

   
    $sql=$db->prepare("SELECT  DISTINCT(u.name) as name , u.id as id
                      from users u, story s 
                      where u.type='Author' and u.id = s.uid");
    $sql->execute();
    $row=$sql->fetchall();
  //      var_dump($row);
     if(!isset($_POST['searched']) && !isset($_GET['title'])){
    
?>

    <div class="container">

      <h1 class="my-4">Advanced Search</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Advanced Search</li>
      </ol>
        <form method="post" action="adsearch.php">
    <div class="row">
        <div class="col">
        <input type="text" name="title" placeholder="Name of the story or related tags" class="form-control">  <br> 
        </div>    
        </div>
        
        <div class="row">
            <div class="col">Categories:</div>
        </div>
                <table>
                 <tr>
                <td><input type="checkbox" name="s" value="sci-fi"> Sci-Fi</td>
                <td ><input type="checkbox" name="f" value="Fantasy"> Fantasy</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="c" value="Comedy"> Comedy</td>
                <td ><input type="checkbox" name="d" value="Drama"> Drama</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="r" value="Romance"> Romance</td>
                <td ><input type="checkbox" name="a" value="Action"> Action</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="t" value="Thriller"> Thriller</td>
                <td ><input type="checkbox" name="m" value="Mystery"> Mystery</td>
            </tr>
               <tr>
                <td><input type="checkbox" name="ad" value="Adventure"> Adventure</td>
                <td ><input type="checkbox" name="fc" valcue="Fiction"> Fiction</td>
            </tr>
                </table>
                        <br>
        <div class="row">
        <div class="col">
            <label>Author:</label></div>
        </div>
            <div class="row">
                <div class="col">
                 <select name="Author" class="form-control">
                     <option selected disabled hidden>Select An Author</option>
                    <?php
                     foreach($row as $row){
                         $Author = $row['name'];
                          $id=$row['id'];
                         echo"<option  name='Author' value='$id'>".$Author."</option>";
                     }
                     ?>
                 </select>
                </div>
            </div><br>
        
            <button type="submit" name="searched" class="btn-primary btn-block">Search</button> <br>
            </form>

            </div>
    


<?php 
    require("footer.php");
    }

else{
     if(isset($_POST['title'])){$title=$_POST['title']; }
     if(isset($_GET['title'])){$title=$_GET['title']; }
     $title='%'.$title;
     $title=$title.'%';
     $sqls="select s.id as id, s.title as title , s.cover as cover from story s , users u where s.uid = u.id and (title like '$title' or tags like '$title') ";
         if(isset($_POST['s'])){$sqls=$sqls."AND (categories like '%sci-fi%') ";}
         if(isset($_POST['f'])){$sqls=$sqls."AND (categories like '%Fantasy%') ";}
         if(isset($_POST['c'])){$sqls=$sqls."AND (categories like '%Comedy%') ";}
         if(isset($_POST['d'])){$sqls=$sqls."AND (categories like '%Drama%') ";}
         if(isset($_POST['r'])){$sqls=$sqls."AND (categories like '%Romance%' )";}
         if(isset($_POST['a'])){$sqls=$sqls."AND (categories like '%Action%' )";}
         if(isset($_POST['t'])){$sqls=$sqls."AND (categories like '%Thriller%' )";}
         if(isset($_POST['m'])){$sqls=$sqls."AND (categories like '%Mystery%' )";}
         if(isset($_POST['ad'])){$sqls=$sqls."AND (categories like '%Adventure%') ";}
         if(isset($_POST['fc'])){$sqls=$sqls."AND (categories like '%Fiction%') ";}
         if(isset($_POST['Author'])){
             $Author=$_POST['Author'];
             $sqls=$sqls."AND u.id =  s.uid and u.id = '$Author'";}
          
             
     $sql=$db->prepare($sqls);
    $sql->execute(); 
    $row2=$sql->fetchall();
    
?>
     <div class="container">

      <h1 class="my-4">Advanced Search</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Advanced Search</li>
      </ol>
              <form method="post" action="adsearch.php">
    <div class="row">
        <div class="col">
        <input type="text" name="title" placeholder="Name of the story or related tags" class="form-control"><br> 
        </div>    
        </div>
        
        <div class="row">
            <div class="col">Categories:</div>
        </div>
                <table>
                 <tr>
                <td><input type="checkbox" name="s" value="sci-fi"> Sci-Fi</td>
                <td ><input type="checkbox" name="f" value="Fantasy"> Fantasy</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="c" value="Comedy"> Comedy</td>
                <td ><input type="checkbox" name="d" value="Drama"> Drama</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="r" value="Romance"> Romance</td>
                <td ><input type="checkbox" name="a" value="Action"> Action</td>
            </tr>
            <tr>
                <td><input type="checkbox" name="t" value="Thriller"> Thriller</td>
                <td ><input type="checkbox" name="m" value="Mystery"> Mystery</td>
            </tr>
               <tr>
                <td><input type="checkbox" name="ad" value="Adventure"> Adventure</td>
                <td ><input type="checkbox" name="fc" value="Fiction"> Fiction</td>
            </tr>
                </table>
                        <br>
        <div class="row">
        <div class="col">
            <label>Author:</label></div>
        </div>
            <div class="row">
                <div class="col">
                 <select name="Author" class="form-control">
                     <option selected disabled hidden>Select An Author</option>
                    <?php
                     foreach($row as $row){
                         $Author = $row['name'];
                         $id = $row['id'];
                         echo"<option name='Author' value='$id'>".$Author."</option>";
                     }
                     ?>
                 </select>
                </div>
            </div><br>
        
            <button type="submit" name="searched" class="btn-primary btn-block">Search</button> <br>
            </form>
         <hr>
         <h5 align="center">Results</h5>
 
         <?php 
         foreach($row2 as $row2){?>
                 <div class="row">
        <div class="col-md-7">

          <a href="displaystory.php?st=<?php echo $row2['id'];?>">

            <img class="img-fluid rounded mb-3 mb-md-0" src="Author/uploads/<?php echo $row2['cover'];?>" width="300" height="700" alt="">

          </a>

        </div>

        <div class="col-md-5">

          <h3><?php echo $row2['title'];?></h3> 

          <a class="btn btn-primary" href="displaystory.php?st=<?php echo $row2['id'];?>">View Story

            <span class="glyphicon glyphicon-chevron-right"></span>

          </a>

        </div>

      </div>

      <!-- /.row --><hr>
        <?php }
         ?>
             
         <br>
         
</div>
   <?php require("footer.php");
}
?>


