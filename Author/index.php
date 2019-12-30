<?php
ob_start();
require("head.php");
require("connection.php");

function calc($stid,$rating){

    $db = new PDO('mysql:host=localhost;dbname=bahrainstory;charset=utf8', 'root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $sql2=$db->prepare("select stid from comment where stid = '$stid' and rating is not null");
    $sql2->execute();
    $count=$sql2->rowcount();
    //echo $count;
    
   $rating=$rating/$count;
    //var_dump($row10);
   return $rating;
}
?>

  <body>

   <?php require("nav.php");
     
$sql=$db->prepare("SELECT s.id , s.title , sum(c.rating) as rating 
from story as s,comment as c , users as u
where s.id = c.stid and c.rating is not null and u.id=s.uid and u.id='$uid'
GROUP by s.id 
ORDER by rating desc");
 
$sql->execute();
$row=$sql->fetchall();
$arr=array();
      $arr2=array();
      foreach($row as $rec){
         $arr2[]=array("label"=> $rec['title'], "y"=> calc($rec['id'],$rec['rating'])); 
      }
      $arr=$arr2;

      $dataPoints = $arr;
	


      ?>

    <header>
   
    </header>

    <!-- Page Content -->
      
    <div class="container">
         <h1 class="mt-4 mb-3">
        <small>Author's Page</small>
      </h1>
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
            <a href="../Author/">Home</a>
            </li>
            
            </ol>
            <div class="row">
            <div class="col-lg-3 mb-4">
            <div class="list-group">
            <a href="publish.php" class="list-group-item">Write and publish a story</a>
            <a href="Drafts.php" class="list-group-item">Drafts</a>
            <a href="ReadStory/" class="list-group-item">Read Stories</a>
                </div>
          </div>
        <div class="col-lg-9 mb-4">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            
        </div>
        </div>

    </div>
    <!-- /.container -->

    <?php 
      require("nav.php");
    ?>

  
  </body>
<?php
  require("footer.php");
?>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Highest Rated Story Publishd by you"
	},
	axisY: {
		suffix: "%",
		scaleBreaks: {
			autoCalculate: true
		}
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0\"\"",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
