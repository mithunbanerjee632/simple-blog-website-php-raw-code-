<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

  <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>

    

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update User</h2>

                <?php
                $deluser = mysqli_real_escape_string( $db->link, $_GET['deluser']);
                
                   if(isset($deluser)){
                   	 $del_id = $deluser;
                   	 $del_query = "DELETE FROM tbl_user WHERE id='$del_id' ";

                   	 $del_user = $db->delete($del_query);

                   	 if($del_user){
                   	 	echo "<span class='success'>User Deleted Successfully !</span>";
                   	 }else{
                   	 	echo "<span class='error'>User Not Deleted!</span>";
                   	 }
                   }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th> Name</th>
              <th> Username</th>
              <th> Email</th>
              <th> Details</th>
              <th> Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
			   $query = "SELECT * FROM tbl_user ORDER BY id DESC";

			   $user = $db->select($query);

			   if($user){
			   	$i = 0;

			   	   while($result = $user->fetch_assoc()){
                       
                       $i++;


			?>			
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
              <td><?php echo $result['username']; ?></td>
              <td><?php echo $result['email']; ?></td>
              <td><?php echo $result['details']; ?></td>
              <td>
                <?php
                  if($result['role'] == '0'){
                        echo "Admin";
                    }elseif($result['role'] == '1'){
                        echo "Author";
                    }elseif($result['role'] == '2'){
                        echo "Editor";
                    }
                ?>
                  
              </td>
							<td><a href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a>

             <?php if(session::get('userRole') == '0'){ ?>

               || <a onclick="return confirm('Are You Sure To Delete!');"  href="?deluser=<?php echo $result['id']; ?>">Delete</a></td>

            <?php } ?>
						</tr>
						
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?> 



