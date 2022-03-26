<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
 $cattid = mysqli_real_escape_string( $db->link, $_GET['catid']);

   if(!isset($cattid) || $cattid == NULL ){
      echo "<script>window.location= 'catlist.php'; </script>";
      //header("Location:catlist.php");

   }else{
      $id = $cattid;
   }

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 

                 <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      $name = $_POST['name']; 
                      $name = mysqli_real_escape_string($db->link, $name);
                     
                      if(empty($name)){
                        echo "<span class='error'>The Field Must Not Be Empty !</span>";
                      }else{

                        $query = "UPDATE tbl_cat SET name='$name' WHERE id='$id'" ;
                        $update_cat = $db->update($query);

                        if($update_cat){
                            echo "<span class='success'>Category updated Successfully !</span>";
                        }else{
                           echo "<span class='success'>Category dosen't updated !</span>"; 
                        }
                      }
                   }
       
                ?>

                <?php
                  $query = "SELECT * FROM tbl_cat WHERE id = '$id' ORDER BY id DESC";
                  $showcat = $db->select($query);

                   while($result = $showcat->fetch_assoc()){

                   
                ?>          
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						            <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>

                  <?php }?>
                </div>
            </div>
        </div>
  
<?php include 'inc/footer.php'; ?>      

