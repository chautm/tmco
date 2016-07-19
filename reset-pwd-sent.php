<?php

if(!isset($_SESSION)) 
{
     session_start();
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Thank you!</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
 
  <header>
  <img src="./img/rblogo.png" alt="My Chau Vietnamese Restaurant" />
</header>

	<div id='fg_membersite_content'>

		<h3>Your password is reset successfully.</h3>
		Your new password is  <?php echo $_SESSION['password']  ?><br/>

		<!-- $fgmembersite->UserPassword(); -->
		<a href="index.php">Go back HomePage</a>
	</div>

	<br/>
	<?php include "footer.php" ?>

</body>
</html>
