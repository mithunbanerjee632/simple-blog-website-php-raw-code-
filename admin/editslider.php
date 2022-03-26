<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>

    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
        <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>
    <!-- /TinyMCE -->

    <!--jQuery Date Picker-->
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script> 


  <?php
      $editsliderid = mysqli_real_escape_string( $db->link, $_GET['editsliderid']);

     if(!isset($editsliderid) && $editsliderid == NULL){
        echo "<script>window.location('sliderlist.php')</script>";
     }else{
       $sliderid = $editsliderid;
     }

  ?>  

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Slider</h2>

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      $title  = mysqli_real_escape_string($db->link, $_POST['title']);
                     
                      $permitted = array('jpg','jpeg','png','gif');
                      $file_name = $_FILES['image']['name'];
                      $file_size = $_FILES['image']['size'];
                      $file_temp = $_FILES['image']['tmp_name'];

                      $div = explode('.', $file_name);
                      $file_ext = strtolower(end($div));
                      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                      $uploaded_image = "uploads/slider".$unique_image;

                      if($title == "" ){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }else{


               if(!empty($file_name)){

                      if($file_size>1048567){
                         echo "<span class='error'>Image Size Should be less Than 1MB! </span>";
                      }elseif(in_array($file_ext,$permitted) == false){
                        echo "<span class='error'>You can Upload only:-".implode(',',$permitted)."</span>";
                      }else{
                        move_uploaded_file($file_temp, $uploaded_image);

                        $query = "UPDATE tbl_slider SET
                                  
                                  title  = '$title',
                                  image = '$uploaded_image'
                                  

                                  WHERE id ='$sliderid' ";

                    
                        $updated_rows = $db->update($query);

                        if($updated_rows){

                            echo "<span class='success'>Slider Updated Successfully! </span>";
                        }else{
                             echo "<span class='success'>Slider Is Not Updated ! </span>";
                       }

                     }
                   }else{

                     $query = "UPDATE tbl_slider SET
                                  
                                  title = '$title'
                                  
                                  WHERE id ='$sliderid' ";

                    
                        $updated_rows = $db->update($query);

                        if($updated_rows){

                            echo "<span class='success'>Slider Updated Successfully! </span>";
                        }else{
                             echo "<span class='error'>Slider Is Not Updated ! </span>";
                       }

                     }

                   }
                 }


                ?>
                <div class="block">              

                <?php
                   $query = "SELECT * FROM tbl_slider WHERE id='$sliderid'";
                   $getslider = $db->select($query);

                   if($getslider){
                    while($sliderresult=$getslider->fetch_assoc()){


                ?> 
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $sliderresult['title']; ?>" class="medium" name="title" />
                            </td>
                        </tr>
          
                        
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $sliderresult['image']; ?>" height="100px" width="200px"/> <br/>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        
                          
						             <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>

              <?php } } ?>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



