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
                <h2>Add New Page</h2>

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      $name  = mysqli_real_escape_string($db->link, $_POST['name']);
                      $body    = mysqli_real_escape_string($db->link, $_POST['body']);
                     

                      if($name == "" || $body == "" ){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }else{
                        

                        $query = "INSERT INTO tbl_page(name,body) VALUES(

                            '$name', '$body')";

                    
                        $inserted_rows = $db->insert($query);

                        if($inserted_rows){

                            echo "<span class='success'>Page Created Successfully! </span>";
                        }else{
                             echo "<span class='success'>Page Is Not Created ! </span>";
                        }

                      }
                   }


                ?>
                <div class="block">               
                 <form action="" method="post" ">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Enter Post Title..." class="medium" name="name" />
                            </td>
                        </tr>
                    
                    
                        
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>

                       


						             <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>     



