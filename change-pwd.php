<?PHP
require_once("./include/membersite_config.php");
require_once("./include/db.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->ChangePassword())
   {
        send_sms('','Your password at My Chau Website has changed successfully!');
        $fgmembersite->RedirectToURL("changed-pwd.html");
       
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Change password</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />      
      <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
      <script type="text/javascript" src="js/pwdwidget.js" ></script>       
	  <script type='text/javascript' src='js/gen_validatorv31.js'></script>
	  <link rel="stylesheet" type="text/css" href="common.css"> 
</head>

<body>

<div id="container">     

 
<?php
  include "header.php" ;
  include "horizontal_menu.php"; 
  include "vertical_menu.php"; 
?>

<section id="main">
<!-- Form Code Start -->
	<div id='fg_membersite' style="background-color:white;" align="center">
	
	<form id='changepwd' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
	<fieldset >
	<legend>Change Password</legend>

	<input type='hidden' name='submitted' id='submitted' value='1'/>

	<div class='short_explanation'>* required fields</div>

	<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
	<div class='container'>
		<label for='oldpwd' >Old Password*:</label><br/>
		<div class='pwdwidgetdiv' id='oldpwddiv' ></div><br/>
		<noscript>
			<input type='password' name='oldpwd' id='oldpwd' maxlength="50" />
		</noscript>    
		<span id='changepwd_oldpwd_errorloc' class='error'></span>
	</div>

	<div class='container'>
		<label for='newpwd' >New Password*:</label><br/>
		<div class='pwdwidgetdiv' id='newpwddiv' ></div>
		<noscript>
			<input type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
		</noscript>
		<span id='changepwd_newpwd_errorloc' class='error'></span>
	</div>

	<br/><br/><br/>
	<div class='container'>
		<input type='submit' name='Submit' value='Submit' />		
	</div>

	</fieldset>
	</form>
	<!-- client-side Form Validations:
	Uses the excellent form validation script from JavaScript-coder.com-->

	<script type='text/javascript'>
// <![CDATA[
		var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
		pwdwidget.enableGenerate = false;
		pwdwidget.enableShowStrength=false;
		pwdwidget.enableShowStrengthStr =false;
		pwdwidget.MakePWDWidget();
    
		var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
		pwdwidget.MakePWDWidget();
    
        var frmvalidator  = new Validator("changepwd");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();

		frmvalidator.addValidation("oldpwd","req","Please provide your old password");
    
		frmvalidator.addValidation("newpwd","req","Please provide your new password");
	// ]]>
	</script>

	</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
	</section>
	<br/>
	<?php include "footer.php" ?>

</div>

</body>
</html>