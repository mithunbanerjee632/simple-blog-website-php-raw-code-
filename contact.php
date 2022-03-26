<?php include "inc/header.php"; ?>


<?php

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

     $firstname = $fm->validation($_POST['firstname']);
     $lastname = $fm->validation($_POST['lastname']);
     $email = $fm->validation($_POST['email']);
     $body = $fm->validation($_POST['body']);
     
    
     $firstname = mysqli_real_escape_string( $db->link, $firstname);
     $lastname = mysqli_real_escape_string( $db->link, $lastname);
     $email = mysqli_real_escape_string( $db->link, $email);
     $body = mysqli_real_escape_string( $db->link, $body);

     $error = "";

     if(empty($firstname)){
     	$error = "First name must not be Empty! ";
     }elseif(empty($lastname)){
     	$error = "Last Name must not be Empty! ";
     }elseif(empty($email)){
     	$error = "Email Must Not be Empty !";
     }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     	$error = "Email Address is Invalid";
     }elseif(empty($body)){
     	$error = "Message Must Not be Empty";
     }else{
     	$sql = "INSERT INTO tbl_contact(firstname,lastname,email,body)VALUES('$firstname','$lastname','$email','$body') ";
        $inserted_rows = $db->insert($sql);

        if($inserted_rows){
        	$msg = "Message Sent Successfully !";
        }else{
        	$error = "Message Not Sent !";
        }
     }
    }

?>


<?php
   
?>


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>

				<?php

                   if(isset($error)){
                   	echo "<span style='color:red'> $error </span>";
                   }

                   if(isset($msg)){
                   	echo "<span style='color:green'> $msg </span>";
                   }

				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		<?php include "inc/sidebar.php"; ?>
		<?php include "inc/footer.php"; ?>