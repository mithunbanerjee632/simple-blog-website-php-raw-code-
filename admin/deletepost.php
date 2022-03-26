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
   $delpostid = mysqli_real_escape_string( $db->link, $_GET['delpostid']);

     if(!isset( $delpostid) &&  $delpostid == NULL){
        echo "<script>window.location('postlist.php')</script>";
     }else{
       $delpostid = $delpostid;

       $query = "SELECT * FROM tbl_posts WHERE id = '$delpostid' ";
       $getdelpost = $db->select($query);
       if($getdelpost){
       	  while($delimg = $getdelpost->fetch_assoc()){
       	  	$getdelimg = $delimg['image'];
       	  	unlink($getdelimg);
       	  }
       }

       $sql = "DELETE FROM tbl_posts WHERE id = '$delpostid' ";
       $getdelData = $db->delete($sql);
       if($getdelData){
       	   echo "<script>alert('Data Deleted Successfully! ');</script>";
       	   echo "<script>window.location = 'postlist.php';</script>";
       }else{
       	   echo "<script>alert(' Data is not Deleted ! ');</script>";
       	   echo "<script>window.location = 'postlist.php';</script>";
       }
     }

  ?>