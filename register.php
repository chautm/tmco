<?PHP
require_once("./include/membersite_config.php");
require_once("./include/db.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        send_sms('','Your user has been created successfuly.Thank you for registering at My Chau Website.');
        $fgmembersite->RedirectToURL("thank-you.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Register</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='js/gen_validatorv31.js'></script>
    <script src="js/pwdwidget.js" type="text/javascript"></script>      
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
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
        <form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8' >
        <fieldset >
            <legend>Register</legend>

            <input type='hidden' name='submitted' id='submitted' value='1'/>

            <div class='short_explanation'>* required fields</div>
            
            <input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

            <div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
            
            <div class='container'>
                <label for='firstname' >First Name*: </label><br/>
                <input type='text' name='firstname' id='firstname' value='<?php echo $fgmembersite->SafeDisplay('firstname') ?>' maxlength="50" /><br/>
                <span id='register_firstname_errorloc' class='error'></span>
            </div>

            <div class='container'>
                <label for='lastname' >Last Name*: </label><br/>
                <input type='text' name='lastname' id='lastname' value='<?php echo $fgmembersite->SafeDisplay('lastname') ?>' maxlength="50" /><br/>
                <span id='register_lastname_errorloc' class='error'></span>
            </div>

            <div class='container'>
                <label for='address' >Address: </label><br/>
                <input type='text' name='address' id='address' value='<?php echo $fgmembersite->SafeDisplay('address') ?>' maxlength="50" /><br/>
                <span id='register_address_errorloc' class='error'></span>
            </div>

            <div class='container'>
                <label for='city' >City: </label><br/>
                <input type='text' name='city' id='city' value='<?php echo $fgmembersite->SafeDisplay('city') ?>' maxlength="50" /><br/>
                <span id='register_city_errorloc' class='error'></span>
            </div>

            <div class='container'>
                <label for='postalcode' >Postal Code: </label><br/>
                <input type='text' name='postalcode' id='postalcode' value='<?php echo $fgmembersite->SafeDisplay('postalcode') ?>' maxlength="50" /><br/>
                <span id='register_postalcode_errorloc' class='error'></span>
            </div>

            <!--pattern="[789][0-9]{9}"-->
            <div class='container'>
                <label for='phone' >Phone: </label><br/>
                <input type='text' name='phone' id='phone' value='<?php echo $fgmembersite->SafeDisplay('phone') ?>' maxlength="50" /><br/>
                <span id='register_phone_errorloc' class='error'></span>
            </div>


            <div class='container'>
                <label for='email' >Email Address*:</label><br/>
                <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
                <span id='register_email_errorloc' class='error'></span>
            </div>

            <div class='container'>
                <label for='username' >UserName*:</label><br/>
                <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
                <span id='register_username_errorloc' class='error'></span>
            </div>

            <div class='container' style='height:80px;'>
                <label for='password' >Password*:</label><br/>
                <div class='pwdwidgetdiv' id='thepwddiv' ></div>
                <noscript><input type='password' name='password' id='password' maxlength="50" /></noscript>    
                <div id='register_password_errorloc' class='error' style='clear:both'></div>
            </div>

            <div class='container'>
                <input type='submit' name='Submit' value='Submit' />
            </div>

        </fieldset>
        </form>

        <!-- client-side Form Validations:
            Uses the excellent form validation script from JavaScript-coder.com-->

        <script type='text/javascript'>
// <![CDATA[
            var pwdwidget = new PasswordWidget('thepwddiv','password');
            pwdwidget.MakePWDWidget();
    
            var frmvalidator  = new Validator("register");
            frmvalidator.EnableOnPageErrorDisplay();
            frmvalidator.EnableMsgsTogether();

            frmvalidator.addValidation("firstname","req","Please provide your first name");
            frmvalidator.addValidation("lastname","req","Please provide your last name");            

            frmvalidator.addValidation("email","req","Please provide your email address");

            frmvalidator.addValidation("email","email","Please provide a valid email address");

            frmvalidator.addValidation("username","req","Please provide a username");
    
            frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
        </script>
		</div>
     </section>

    <?php 
  //  include "aside.php";
    include "footer.php";
     ?>
</div>
</body>

</html>