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

$replyid = mysqli_real_escape_string( $db->link,$_GET['replyid']);

   if(!isset($replyid) || $replyid == NULL ){
      echo "<script>window.location= 'inbox.php'; </script>";
      //header("Location:catlist.php");

   }else{
      $id = $replyid;
   }

?>




   <div class="block">    


        <?php
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $to        = $fm->validation($_POST['toEmail']);
              $from      = $fm->validation($_POST['fromEmail']);
              $subject   = $fm->validation($_POST['subject']);
              $message   = $fm->validation($_POST['message']);

              $sendmail = mail($to,$subject,$message,$from);

              if($sendmail){
                echo "<span class='success'>Message Sent Successfully !</span>";
              }else{
                echo "<span class='success'>Something Went Wrong !</span>";
              }
              
           }


        ?>  


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
           
                 <form action="" method="post">



                 <?php
                  $query = "SELECT * FROM tbl_contact WHERE id = '$id' ";
                  $msg = $db->select($query);

                  if($msg){
                   while($result = $msg->fetch_assoc()){

                   
                ?>
    


                    <table class="form">
                       
                       

                         <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                            <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail"  class="medium" placeholder="Enter Your Email Address" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="subject" placeholder="Enter Your Subject" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td >
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message" >
                                  
                                  
                                </textarea>
                            </td>
                        </tr>

                        


						            <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    </form>

                  <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



