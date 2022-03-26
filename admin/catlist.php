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
                <h2>Category List</h2>

                <?php
                  $delcat = mysqli_real_escape_string( $db->link, $_GET['delcat']);

                   if(isset($delcat)){
                   	 $del_id = $delcat;
                   	 $del_query = "DELETE FROM tbl_cat WHERE id='$del_id' ";

                   	 $del_cat = $db->delete($del_query);

                   	 if($del_cat){
                   	 	echo "<span class='success'>Category Deleted Successfully !</span>";
                   	 }else{
                   	 	echo "<span class='success'>Category Deleted Successfully !</span>";
                   	 }
                   }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

			<?php
			   $query = "SELECT * FROM tbl_cat ORDER BY id DESC";

			   $category = $db->select($query);

			   if($category){
			   	$i = 0;

			   	   while($result = $category->fetch_assoc()){
                       
                       $i++;


			?>			
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td>
                <a href="editcat.php?catid=<?php echo $result['id']; ?>">View</a>
                <a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a>

                 ||
                 <a onclick="return confirm('Are You Sure To Delete!');"  href="?delcat=<?php echo $result['id']; ?>">Delete</a>
              </td>
						</tr>
						
						<?php } } ?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?> 



