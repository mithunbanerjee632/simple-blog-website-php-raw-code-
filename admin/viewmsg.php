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
  $msgid = mysqli_real_escape_string( $db->link, $_GET['msgid']);

   if(!isset($msgid) || $msgid == NULL ){
      echo "<script>window.location= 'inbox.php'; </script>";
      //header("Location:catlist.php");

   }else{
      $id = $msgid;
   }

?>




   <div class="block">    


        <?php
           if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
              echo "<script>window.location= 'inbox.php'; </script>";
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
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname']; ?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $fm->formatDate($result['date']); ?>" class="medium" />
                            </td>
                        </tr>
                     
                       
                        <tr>
                            <td >
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" >
                                  
                                  <?php echo $fm->textshorten($result['body']); ?>
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

                  <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



