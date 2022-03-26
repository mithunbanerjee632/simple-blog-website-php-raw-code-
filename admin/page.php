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


    <style>
        .actiondel{margin-left:10px;}
        .actiondel a{
            border: 1px solid #ddd;
            color:#444;
            cursor: pointer;
            font-size: 20px;
            padding: 2px 10px;
        }
    </style>


    

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2> Pages</h2>

  <?php
  $pageid = mysqli_real_escape_string( $db->link, $_GET['pageid']);

     if(!isset($pageid) && $pageid == NULL){
        echo "<script>window.location('index.php')</script>";
     }else{
       $pageid = $pageid;
     }

  ?>  

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      $name    = mysqli_real_escape_string($db->link, $_POST['name']);
                      $body    = mysqli_real_escape_string($db->link, $_POST['body']);
                     

                      if($name == "" || $body == "" ){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }else{
                        

                        $query = "UPDATE tbl_page SET
                                  
                                  name   = '$name',
                                  body = '$body'
                                
                                  WHERE id ='$pageid' ";

                    
                        $updated_rows = $db->update($query);

                        if($updated_rows){

                            echo "<span class='success'>Page Updated Successfully! </span>";
                        }else{
                             echo "<span class='success'>Page Is Not Updated ! </span>";
                        }

                      }
                   }


                ?>
                <div class="block">               
                 <form action="" method="post" >

                <?php
                   $query = "SELECT * FROM tbl_page WHERE id='$pageid' ";
                   $getpage = $db->select($query);

                   if($getpage){
                    while($updatepage=$getpage->fetch_assoc()){


                ?> 
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $updatepage['name']; ?>"  class="medium" name="name" />
                            </td>
                        </tr>
                    
                    
                        
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $updatepage['body']; ?>

                                </textarea>
                            </td>
                        </tr>

                       


						  <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                               <span class="actiondel"><a href="delpage.php?delpageid=<?php echo $updatepage['id'];?>" onclick="return confirm('Are You Sure To Delete!');">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>

                <?php  } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



