<!DOCTYPE html>
<html>

   <head>
   <!--
      
      ASTCO
      Author: My chau Tu
      Date:   2015/02/20

   -->

      <meta charset="UTF-8" />
      <title>TMCO</title>
      <script src="modernizr-1.5.js"></script>
      <script src="formsubmit.js"></script>
      <link href="common.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="contactus.css">

   </head>


   <body>
      <div id="container">   
        <?php include "header.php"; ?>
		  <hr>
          <?php include "horizontal_menu.php"; ?>
		  <hr>
		  <?php  require "vendor/autoload.php";
          require_once("./include/db.php");?>

         <section id="main">
               
                  <fieldset id="address">
						</br></br>
                      	<p>Addresse: 312-4800 Boulevard Decarie</br>
						Montreal, QC  H3X 2H5 </br>
						Email: tmco_info@tumychau.com</br>									                           
						</p>
						</br>
                  </fieldset>
 
                  <form ation="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">                 
                     <fieldset id="info">
                        
                           <label for="name">Your Name:</label><input type="text" name="name" required="required"><br/>
                           <label for="email">Your Email:</label><input type="text" name="email" required="required"><br/>
                           <label for="message">Your Message:</label>
                           <textarea rows="7" cols="100" name="message" required="required"></textarea> <br/>
                       </fieldset>      
                  
                           <p>
                              <input type="submit" name="submit" value="Send Email"/>         
                           </p>
                 </form>

                 <?php                    
                 
                     if(isset($_POST["submit"]))
                     {
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $message = $_POST["message"];
                        if (($name=="")||($email=="")||($message=="")) 
                        {
                           echo "All fields are required, please fill the form again.";
                        }
                        else
                        {
                            
                           $to="chautm@gmail.com";
                           $from ="From: $name<$email>";
                           $subject="Message from the web ASTCO";   
                           // In case any of our lines are larger than 70 characters, we should use wordwrap()
                            $message = wordwrap($message, 70, "\r\n");                                                                         
                            
							$SENDGRID_USERNAME="app26775163@heroku.com";
							$SENDGRID_PASSWORD = "14e2o9ga";
							
							$sendgrid = new SendGrid($SENDGRID_USERNAME,$SENDGRID_PASSWORD);
							$email    = new SendGrid\Email();
							$email->addTo($to)->
							setFrom($email)->
							setSubject($subject)->
							setText($message)->
							setHtml('<strong>Hello World!</strong>');

							$sendgrid->send($email);
							
                           // $ok=mail($to, $subject, $message); //the mail service is not working in school.
						   
                            send_sms($to,$from." ".$message);
                            echo "<h1> Mail Sent</h1>";                                
                        }                    
                      }
                      
                  ?>  
          </section>
		<footer style="height:100px;" >
		</footer>
     <!--   <?php //include "footer.php"; ?>-->
      </div>
   </body>
</html>

