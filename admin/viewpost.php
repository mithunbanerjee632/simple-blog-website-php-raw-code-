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
  $viewpostsid = mysqli_real_escape_string( $db->link,$_GET['viewpostid']);

     if(!isset($viewpostsid) && $viewpostsid == NULL){
        echo "<script>window.location('postlist.php')</script>";
     }else{
       $viewpostid = $viewpostsid;
     }

  ?>  

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Post</h2>

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      echo "<script>window.location('postlist.php')</script>";
                 }


                ?>
                <div class="block">              

                <?php
                   $query = "SELECT * FROM tbl_posts WHERE id='$viewpostid' ORDER BY id DESC";
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
                                <input type="text" value="<?php echo $postresult['title']; ?>" class="medium" readonly />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" readonly>
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
                                <label>Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['image']; ?>" height="60px" width="137px"/> <br/>
                                <input type="file" readonly/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly>
                                  <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['tags']; ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $postresult['author']; ?>" class="medium"/>
                                <input type="hidden" name="userid" value="<?php echo session::get('userId'); ?>"  class= "medium"/>
                            </td>
                        </tr>


						             <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>

              <?php } } ?>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



