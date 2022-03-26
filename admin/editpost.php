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
     $editpostid = mysqli_real_escape_string( $db->link, $_GET['editpostid']);
     
     if(!isset($editpostid) && $editpostid == NULL){
        echo "<script>window.location('postlist.php')</script>";
     }else{
       $postid = $editpostid;
     }

  ?>  

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Post</h2>

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      $title  = mysqli_real_escape_string($db->link, $_POST['title']);
                      $cat    = mysqli_real_escape_string($db->link, $_POST['cat']);
                      $body   = mysqli_real_escape_string($db->link, $_POST['body']);
                      $tags   = mysqli_real_escape_string($db->link, $_POST['tags']);
                      $author = mysqli_real_escape_string($db->link, $_POST['author']);
                      $userid = mysqli_real_escape_string($db->link, $_POST['userid']);
                     

                      $permitted = array('jpg','jpeg','png','gif');
                      $file_name = $_FILES['image']['name'];
                      $file_size = $_FILES['image']['size'];
                      $file_temp = $_FILES['image']['tmp_name'];

                      $div = explode('.', $file_name);
                      $file_ext = strtolower(end($div));
                      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                      $uploaded_image = "uploads/".$unique_image;

                      if($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "" ){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }else{


               if(!empty($file_name)){

                      if($file_size>1048567){
                         echo "<span class='error'>Image Size Should be less Than 1MB! </span>";
                      }elseif(in_array($file_ext,$permitted) == false){
                        echo "<span class='error'>You can Upload only:-".implode(',',$permitted)."</span>";
                      }else{
                        move_uploaded_file($file_temp, $uploaded_image);

                        $query = "UPDATE tbl_posts SET
                                  
                                  cat   = '$cat',
                                  title = '$title',
                                  body  = '$body',
                                  image = '$uploaded_image',
                                  author= '$author',
                                  tags  = '$tags',
                                  userid= '$userid'

                                  WHERE id ='$postid' ";

                    
                        $updated_rows = $db->update($query);

                        if($updated_rows){

                            echo "<span class='success'>Data Updated Successfully! </span>";
                        }else{
                             echo "<span class='success'>Data Is Not Updated ! </span>";
                       }

                     }
                   }else{

                     $query = "UPDATE tbl_posts SET
                                  
                                  cat   = '$cat',
                                  title = '$title',
                                  body  = '$body',
                                  author= '$author',
                                  tags  = '$tags',
                                  userid  = '$userid'

                                  WHERE id ='$postid' ";

                    
                        $updated_rows = $db->update($query);

                        if($updated_rows){

                            echo "<span class='success'>Data Updated Successfully! </span>";
                        }else{
                             echo "<span class='success'>Data Is Not Updated ! </span>";
                       }

                     }

                   }
                 }


                ?>
                <div class="block">              

                <?php
                   $query = "SELECT * FROM tbl_posts WHERE id='$postid'";
                   $getpost = $db->select($query);

                   if($getpost){
                    while($postresult=$getpost->fetch_assoc()){


                ?> 
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $postresult['title']; ?>" class="medium" name="title" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>

                                    <?php
                                      $query = "SELECT * FROM tbl_cat";
                                      $category = $db->select($query);

                                      if($category){
                                        while($result=$category->fetch_assoc()){

                                    ?>
                                    
                                    <option
                                       <?php 
                                         if($postresult['cat'] == $result['id']){ ?>
                                           selected = "selected"

                                      <?php   }  ?>
                                       
                                   
                                     value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>

                                <?php } } ?>
                                </select>
                            </td>
                        </tr>
                   
                    
                        
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['image']; ?>" height="60px" width="137px"/> <br/>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                  <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postresult['author']; ?>" class="medium"/>
                                <input type="hidden" name="userid" value="<?php echo session::get('userId'); ?>"  class= "medium"/>
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

              <?php } } ?>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



