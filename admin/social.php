<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>


<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

    
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>

                <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                     $facebook = $fm->validation($_POST['facebook']);
                     $twitter = $fm->validation($_POST['twitter']);
                     $linkedin = $fm->validation($_POST['linkedin']);
                     $googleplus = $fm->validation($_POST['googleplus']);
                     
                     $facebook  = mysqli_real_escape_string($db->link,$facebook );
                     $twitter = mysqli_real_escape_string($db->link, $twitter);
                     $linkedin  = mysqli_real_escape_string($db->link,$linkedin );
                     $googleplus = mysqli_real_escape_string($db->link, $googleplus);

                     if($facebook == "" || $twitter == ""  || $linkedin == "" || $googleplus == "" ){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }else{

                        $query = "UPDATE tbl_social SET
                                  
                                
                                  facebook    = '$facebook',
                                  twitter     = '$twitter',
                                  linkedin    = '$linkedin',
                                  googleplus  = '$googleplus'
                                 

                                  WHERE id ='1' ";

                    
                        $updated_rows = $db->update($query);

                        if($updated_rows){

                            echo "<span class='success'>Data Updated Successfully! </span>";
                        }else{
                             echo "<span class='success'>Data Is Not Updated ! </span>";
                       }
                    }

                 }

                     ?>


                <div class="block">  

                <?php
                  $query = "SELECT * FROM tbl_social WHERE id='1' ";
                  $socialmedia = $db->select($query);

                  if($socialmedia){

                    while($getsocial = $socialmedia->fetch_assoc()){
                       
                ?>             
                 <form action="social.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $getsocial['facebook']; ?>" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $getsocial['twitter']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $getsocial['linkedin']; ?>" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" value="<?php echo $getsocial['googleplus']; ?>" class="medium" />
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

                <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>    


