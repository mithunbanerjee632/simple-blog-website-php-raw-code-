<?php
      if(isset($_GET['pageid'])){

      	$pagetitleid = $_GET['pageid'];

      	$sql = "SELECT * FROM tbl_page WHERE id= '$pagetitleid' ";

      	$getpagetitleid = $db->select($sql);

        if($getpagetitleid){

        	while($result = $getpagetitleid->fetch_assoc()){  ?>

        		<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>

       <?php } } }elseif(isset($_GET['id'])){

      	$postid = $_GET['id'];

      	$sql = "SELECT * FROM tbl_posts WHERE id= '$postid' ";

      	$getpostid = $db->select($sql);

        if($getpostid){

        	while($getpostresult = $getpostid->fetch_assoc()){  ?>

        		<title><?php echo $getpostresult['title']; ?>-<?php echo TITLE; ?></title>

       <?php } } }else{  ?>

     
       	      <title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>

       <?php }?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">

<?php
	  if(isset($_GET['id'])){
	  	$keywordId = $_GET['id'];
        $sql = "SELECT * FROM tbl_posts WHERE id= '$keywordId' ";

      	$getkeywords = $db->select($sql);

      	if($getkeywords){
      		while($keyRes= $getkeywords->fetch_assoc()){  ?>

               <meta name="keywords" content="<?php echo $keyRes['tags']; ?>">

      	<?php	} } }else{    ?>

            <meta name="keywords" content="<?php echo KEYWORDS; ?>">

	<?php   }   ?>
      	



	
	<meta name="author" content="Mithun">