<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 

                    <?php
                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                     $note = $fm->validation($_POST['note']);
                     $note = mysqli_real_escape_string($db->link, $note);

                     if($note == ""  ){                       
                        echo "<span class='error'>Field Must Not Be Empty! </span>";
                      }else{

                        $query = "UPDATE tbl_footer SET
                                  
                                
                                  note    = '$note'
                               

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


                <?php
                  $query = "SELECT * FROM tbl_footer WHERE id='1' ";
                  $footer_note = $db->select($query);

                  if($footer_note){

                    while($note = $footer_note->fetch_assoc()){
                       
                ?>   
                 <form  action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $note['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
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
