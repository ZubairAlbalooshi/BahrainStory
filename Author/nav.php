 <!-- Navigation -->
<?php
    require("connection.php");
   
    if(!isset($_SESSION))
    {
        session_start();
    }
    if(isset($_SESSION["type"]) && isset($_SESSION["email"])){
        if($_SESSION["type"]!="Author"){
            
            header("location:../404.html");
            exit();
        }
        $email=$_SESSION["email"];
        $sql=$db->prepare("select id from users where email ='$email'");
        $sql->execute();
        $r=$sql->fetch();
        $uid=$r['id'];
        $_SESSION["uid"]=$uid;
    }

    else {
            
         header("location:../404.html");
         exit();
    }   
?>
 <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="../Author/">Bahrain Story</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="account.php">My account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="mystories.php">My stories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../about.html">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">logout</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>

