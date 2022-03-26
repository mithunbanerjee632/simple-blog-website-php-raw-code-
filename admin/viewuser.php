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
  $userid = mysqli_real_escape_string( $db->link,$_GET['userid']);

     if(!isset($userid) || $userid == NULL ){
        echo "<script>window.location= 'userlist.php'; </script>";
        //header("Location:catlist.php");

     }else{
        $userid =$userid;
     }

?>
  

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Profile</h2>

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        echo "<script>window.location= 'userlist.php'; </script>";
                     }
                  

                ?>
                <div class="block">              

                <?php
                   $query = "SELECT * FROM tbl_user WHERE id='$userid' ";
                   $getuser = $db->select($query);

                   if($getuser){
                    while($userresult=$getuser->fetch_assoc()){


                ?> 
                 <form action="" method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $userresult['name']; ?>" class="medium" name="name" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $userresult['username']; ?>" class="medium" name="username" />
                            </td>
                        </tr>
                     

                         <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $userresult['email']; ?>" class="medium" name="email" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce" name="details">
                                  <?php echo $userresult['details']; ?>
                                </textarea>
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



