<?php
  include "../lib/Session.php";
  Session::checkSession();
?>

<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>

<!--object-->

    <?php
      
      $db = new Database();
     
    ?>
<!--object-->

 <?php
   $delpagesid = mysqli_real_escape_string( $db->link, $_GET['delpageid']);

     if(!isset($delpagesid) && $delpagesid == NULL){
        echo "<script>window.location('index.php')</script>";
     }else{
       $delpageid = $delpagesid;

       $sql = "DELETE FROM tbl_page WHERE id = '$delpageid' ";
       $delpage = $db->delete($sql);
       if($delpage){
           echo "<script>alert('Page Deleted Successfully! ');</script>";
           echo "<script>window.location = 'index.php';</script>";
       }else{
           echo "<script>alert(' Page is not Deleted ! ');</script>";
           echo "<script>window.location = 'index.php';</script>";
       }
       	  	
       	  }
       

       
     

  ?>