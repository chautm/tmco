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
      <title>Reset Password Request</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <link rel="stylesheet" type="text/css" href="common.css">
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>

<body>

<?PHP
  require_once("./include/membersite_config.php");
 

if(isset($_POST['submitted']))
{

   if($fgmembersite->ResetPassword($new_password))
   {
        $_SESSION['password'] = $new_password;// $new_password;

        $fgmembersite->RedirectToURL("reset-pwd-sent.php");     
        send_sms('','Your new password is $new_password');
        //exit;
   }
}

?>


<div id="container">     

 
<?php
 include "header.php" ;
  include "horizontal_menu.php"; 
  include "vertical_menu.php"; 

?>

  <section id="main">
  <!-- Form Code Start -->
  <div id='fg_membersite' style="background-color:white;" align="center">
    <form id='resetreq' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
      <fieldset >
        <legend>Reset Password</legend>

          <input type='hidden' name='submitted' id='submitted' value='1'/>

          <div class='short_explanation'>* required fields</div>

          <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>

          <div class='container'>
            <label for='username' >Your Email*:</label><br/>
            <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
            <span id='resetreq_email_errorloc' class='error'></span>
          </div>

          <div class='short_explanation'>A link to reset your password will be sent to the email address.<br/>              
          </div>

          <div class='container'>
            <input type='submit' name='Submit' value='Submit'/>                   
          </div>

      </fieldset>
    </form>
      <!-- client-side Form Validations:
          Uses the excellent form validation script from JavaScript-coder.com-->

    <script type='text/javascript'>

      var frmvalidator  = new Validator("resetreq");
      frmvalidator.EnableOnPageErrorDisplay();
      frmvalidator.EnableMsgsTogether();

      frmvalidator.addValidation("email","req","Please provide the email address used to sign-up");
      frmvalidator.addValidation("email","email","Please provide the email address used to sign-up");
    </script>

  </div>  
  </section>
   
   <?php 
 //  include "aside.php" ;
   include "footer.php" ;
   ?>
</div>

</body>
</html>