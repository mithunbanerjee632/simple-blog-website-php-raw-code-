<?php
  include "../lib/Session.php";
  Session::checkSession();
?>

<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/format.php"; ?>

<!--object-->

    <?php
      
      $db = new Database();
     
    ?>
<!--object-->

 <?php
     $deletesliderid = mysqli_real_escape_string( $db->link, $_GET['deletesliderid']);

     if(!isset($deletesliderid) && $deletesliderid == NULL){
        echo "<script>window.location('slidertlist.php')</script>";
     }else{
       $delsliderid = $deletesliderid;

       $query = "SELECT * FROM tbl_slider WHERE id = '$delsliderid' ";
       $getdelslider = $db->select($query);
       if($getdelslider){
       	  while($delimg = $getdelslider->fetch_assoc()){
       	  	$getdelimg = $delimg['image'];
       	  	unlink($getdelimg);
       	  }
       }

       $sql = "DELETE FROM tbl_slider WHERE id = '$delsliderid' ";
       $getdelData = $db->delete($sql);
       if($getdelData){
       	   echo "<script>alert('Slider Deleted Successfully! ');</script>";
       	   echo "<script>window.location = 'sliderlist.php';</script>";
       }else{
       	   echo "<script>alert(' Slider is not Deleted ! ');</script>";
       	   echo "<script>window.location = 'sliderlist.php';</script>";
       }
     }

  ?>