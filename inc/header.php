<?php include "config/config.php"; ?>
<?php include "lib/Database.php"; ?>
<?php include "helpers/format.php"; ?>

<!--object-->

	<?php
	  
	  $db = new Database();
	  $fm = new Format();
	 
	?>
<!--object-->


<!DOCTYPE html>
<html>
<head>



	<?php include 'scripts/meta.php'; ?>
	<?php include 'scripts/css.php'; ?>
	<?php include 'scripts/js.php'; ?>
	
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">


				  <?php
	                  $query = "SELECT * FROM title_slogan WHERE id='1' ";
	                  $getslogan = $db->select($query);

	                  if($getslogan){

	                    while($getresult = $getslogan->fetch_assoc()){
                       
                ?>


				<img src="admin/<?php echo $getresult['logo']; ?>"  alt="Logo"  />
				<h2><?php echo $getresult['title']; ?></h2>
				<p><?php echo $getresult['slogan']; ?></p>

			   <?php } } ?>

			</div>

			
		</a>
		<div class="social clear">
			<div class="icon clear">
				  <?php
	                  $query = "SELECT * FROM tbl_social WHERE id='1' ";
	                  $socialmedia = $db->select($query);

	                  if($socialmedia){

	                    while($getsocial = $socialmedia->fetch_assoc()){
                       
                ?>
				<a href="<?php echo  $getsocial['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo  $getsocial['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo  $getsocial['linkedin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo  $getsocial['googleplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>

			<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>

<div class="navsection templete">

	<?php 
        $path = $_SERVER['SCRIPT_FILENAME'];   //browsing path
        $currentpage = basename($path, '.php');

	?>

	<ul>

		<li><a <?php if($currentpage == "index"){echo "id='active' "; } ?>
             href="index.php">Home</a></li>
					 <?php
			              $query = "SELECT * FROM tbl_page  ";
			              $page = $db->select($query);

			              if($page){

			                while($getpage = $page->fetch_assoc()){
			                   
			                ?>

                              <li><a 
                                 <?php 
                                    if(isset($_GET['pageid']) && $_GET['pageid'] == $getpage['id']){
                                    	echo "id='active'";
                                    }
                                  ?>

                              	href="page.php?pageid=<?php echo $getpage['id']; ?>"><?php echo $getpage['name']; ?></a> </li> 

                           <?php }  } ?>	
		<li><a  <?php if($currentpage == "contact"){echo "id='active' "; } ?>  href="contact.php">Contact</a></li>
	</ul>
</div>
