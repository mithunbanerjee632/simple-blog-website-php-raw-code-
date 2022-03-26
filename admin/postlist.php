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
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="15%">Description</th>
							<th width="10%">category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="15%">Date</th>
							<th width="15%">Action</th>
							
						</tr>
					</thead>
					<tbody>

						<?php
                          $query = "SELECT tbl_posts.*,tbl_cat.name FROM tbl_posts INNER JOIN tbl_cat
                              ON tbl_posts.cat = tbl_cat.id 
                              ORDER BY  tbl_posts.title DESC ";

                              $post = $db->select($query);

                              if($post){
                              	$i=0;
                              	while($result=$post->fetch_assoc()){
                                $i++;
                              	
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
							<td><?php echo $fm->textShorten($result['body'],50); ?></td>
							<td><?php echo $result['name']; ?>"</td>
							<td><img src="<?php echo $result['image']; ?> " height="50px" width="50px"/></td>
							<td><?php echo $result['author']; ?></td>
							<td><?php echo $result['tags']; ?></td>
							<td><?php echo $fm->formatDate( $result['date']); ?></td>

							<td>
								<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>" >View</a>
						 <?php		

								if(session::get('userId')== $result['userid'] || session::get('userRole') == ' 0'){  ?>

								      ||<a href="editpost.php?editpostid=<?php echo $result['id']; ?>" >Edit</a>
								                        || 
								 <a href="deletepost.php?delpostid=<?php echo $result['id']; ?>" onclick="return confirm('Are You Sure To Delete!');">Delete</a>

						<?php	}      ?>
                       
								
							</td>
						</tr>

					<?php } } ?>
						
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?> 


