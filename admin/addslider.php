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


    

        <div class="grid_10">
    
            <div class="box round first grid">
                <h2>Add New Post</h2>

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
                      $uploaded_image = "uploads/slider/".$unique_image;

                      if($title == ""  || $file_name == ""){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }elseif($file_size>1048567){
                         echo "<span class='error'>Image Size Should be less Than 1MB! </span>";
                      }elseif(in_array($file_ext,$permitted) == false){
                        echo "<span class='error'>You can Upload only:-".implode(',',$permitted)."</span>";
                      }else{
                        move_uploaded_file($file_temp, $uploaded_image);

                        $query = "INSERT INTO tbl_slider(title,image) VALUES(

                            '$title', '$uploaded_image')";

                    
                        $inserted_rows = $db->insert($query);

                        if($inserted_rows){

                            echo "<span class='success'>Data Inserted Successfully! </span>";
                        }else{
                             echo "<span class='success'>Data Is Not Inserted ! </span>";
                        }

                      }
                   }


                ?>
                <div class="block">               
                 <form action="addslider.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Slider Title..." class="medium" name="title" />
                            </td>
                        </tr>
                     
                    
                        
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>


                         <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



