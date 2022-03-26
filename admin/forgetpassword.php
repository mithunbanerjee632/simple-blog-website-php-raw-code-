<?php
  include "../lib/Session.php";
  Session::checkLogin();
?>

<?php include "../config/config.php"; ?>
<?php include "../lib/Database.php"; ?>
<?php include "../helpers/format.php"; ?>

<!--object-->

	<?php
	  
	  $db = new Database();
	  $fm = new Format();
	 
	?>
<!--object-->

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $email = $fm->validation($_POST['email']);
     $email = mysqli_real_escape_string($db->link,$email);

         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "<span style='color:red;font-size:20px;'>Email Address is Invalid</span>";
         }else{
         
             $mailquery = "SELECT * FROM tbl_user WHERE email= '$email' LIMIT 1 ";
             $mailcheck = $db->select($mailquery);
            
             if($mailcheck != false){
                while($value = $mailcheck->fetch_assoc()){
                 $userid = $value['id'];
                 $username = $value['username'];

                }

                    $text = substr($email,0,3);
                    $rand = rand(100000,999999);
                    $new_password="$text.$rand";
                    $password = md5($new_password);

                    $password_query = "UPDATE tbl_user SET password='$password' WHERE id='$userid'" ;
                    $update_password = $db->update($password_query);

                    $to = "$email";
                    $from = "mithunbanerjee632@gmail.com";
                    $headers = "From: $from\n";
                    $headers .= 'MIME-Version: 1.0'."\r\n";
                    $headers  .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
                    $subject = "Your Password";
                    $message = "Your Username is: ".$username."And Password is: ".$new_password;

                    $send_mail = mail($to, $subject, $message, $headers);

                    if( $send_mail){
                        echo "<span style='color:green;font-size:20px;'>Please Check Your Email Address.</span>";
                    }else{
                        echo "<span style='color:red;font-size:20px;'>Email Not Sent</span>";
                    }

                
             }else{
             	echo "<span style='color:red;font-size:20px;'>Email Not Exist!</span>";
             }
            
          }


      }

?>		
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email Address" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->

        <div class="button">
            <a href="login.php">Log in!</a>
        </div><!-- button -->

        <div class="button">
            <a href="#">&copy;Mithun Banerjee</a>
        </div><!-- button -->

		
	</section><!-- content -->
</div><!-- container -->



</body>
</html>