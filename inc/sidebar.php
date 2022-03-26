<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>

						<?php
                          $query = "SELECT * FROM  tbl_cat";
                          $category = $db->select($query);
                          if($category){
                          	while($catResult = $category->fetch_assoc()){


						?>
						<li><a href="posts.php?category=<?php echo $catResult['id']?>"><?php echo $catResult['name']?></a></li>

					<?php } }else{?>
                         
                         <li>No Category List</li>

				    <?php }?>		
											
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>

		 <?php
              $query = "SELECT * FROM tbl_posts LIMIT 5";
              $post = $db->select($query);

              if($post){

                 while($result=$post->fetch_assoc()){

             

			?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>

						<?php echo $fm->textShorten($result['body'],108); ?>
					</div>
					
			<?php } ?> <!--end while loop-->
			<?php }else{header("Location:404.php");} ?>
	
			</div>
			
		</div>