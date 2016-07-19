<?php
  if(!isset($_SESSION)) 
  {
      session_start();
  }
  include("./include/db.php"); 

  if(isset($_POST['command']) || isset($_POST['itemid']))
  {
    if($_POST['command']=='update')
    {
      $date=date('Y-m-d');
      $TotalOrder= $_SESSION['TotalOrder'];
      $CCFullName=$_POST['cardholder'];
      $CCType=$_POST['ccard'];
      $CCNumber=$_POST['ccardnumber'];
      $CCExpMonth=$_POST['ccardmonth'];
      $CCExpYear=$_POST['ccardyear'];
      $CSC=$_POST['csc'];
      $sql="insert into Payment(PaymentDate,PaymentAmount,CCFullName,CCType,CCNumber,CCExpMonth,CCExpYear,CSC) 
          values('$date',$TotalOrder,'$CCFullName',' $CCType',$CCNumber,$CCExpMonth,$CCExpYear,$CSC)";

      $id='';

      if (InsertIntoDB($sql,$id))
      {
        $UserName= $_SESSION['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];        
        $notes = $_POST['notes'];

        $sql="insert into Orders(UserName,OrderDate,ReceiverName,Address,Phone,Email,Notes,PaymentId) 
          values('$UserName','$date','$name','$address','$phone','$email','$notes',$id)";

        $orderid ='';

        if (InsertIntoDB($sql,$orderid))
        {

            $max=count($_SESSION['cart']);

            for($i=0;$i<$max;$i++)
            {
              $iid=$_SESSION['cart'][$i]['itemid'];
              $q=$_SESSION['cart'][$i]['qty'];
              
              $row=GetMenuItem($iid);

              $price=$row['UnitPrice']*$q;

              $sql="insert into OrderDetail(OrderId,ItemId,Quantity,Price) 
              values($orderid,$iid,$q,$price)";

              InsertIntoDB($sql,$OrderDetailId);
             
            }  
                        
            send_sms('','Thank You! your order has been placed!');
            unset($_SESSION['cart']);
            unset($_SESSION['TotalOrder']);
            header("Location:order_thank_you.php");
        }
      }
      else
        die('Error!');
      
    }
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
   <!--
     
      Author: My chau Tu
      Date:   2014/05/01

   -->
      <meta charset="UTF-8" />
      <title>Check out</title>
      <script src="js/modernizr-1.5.js"></script>
      <script src="js/formsubmit.js"></script>
      <link rel="stylesheet" type="text/css" href="payment.css"> 
      <link rel="stylesheet" type="text/css" href="common.css"> 

      <script language="javascript">
      function validate()
      {
        var f=document.form1;
        if(confirm('Are you sure you want to submit?'))
        {
          f.command.value='update';
          f.submit();
        }        
      }
      </script>

   </head>


   <body>
     <div id="container">         
      <?php 
         include "header.php"; 
         include "horizontal_menu.php"; 
         include "vertical_menu.php"; 
       
      ?>

      <section id="main" style="background-color:white">  

         <h1>Order Form</h1>
         <form name="form1" method ="post" onsubmit="return validate()">
            <input type="hidden" name="command" />
            <fieldset id="delivery">
               <legend>Delivery Address (required)</legend>
                  <label for="name">Full Name</label><input type="text" name="name" id="ame" required="required"><br/>                  
                  <label for="adress">Address</label><input type="text" name="address" id = "address" required="required"><br/>                                                   
                  <label for="phone">Phone</label><input type="text" name="phone" id="phone" pattern="[0-9]{1,10}" required="required">                  
                  <!-- pattern="^\d{10}$|^(\(\d{3}\)\s*)?\d{3}[\s-]?\d{4}$" -->
                  <label for="email">Contact Email</label><input type="email" name="email"><br/>
                  <label for="notes">Special Notes</label>
                  <textarea rows="10" cols="50" name="notes"></textarea> <br/>
               </fieldset>

               <fieldset id="creditcard">
                  <legend>Credit Card (required)</legend>
                  <fieldset class="optionGroup">
                     <label><input type="radio" name="ccard" value="Diner" required="required"><img src="./img/diners.png"></label>
                     <label><input type="radio" name="ccard" value="Discover"><img src="./img/discover.png"></label>
                     <label><input type="radio" name="ccard" value="Master"><img src="./img/master.png"></label>
                     <label><input type="radio" name="ccard" value="Visa"><img src="./img/visa.png"></label>
                  </fieldset>
                  <br/>
                  <label for="cardholder">Card Holder Name</label><input type="text" name="cardholder" id="cardholder" required="required"><br/>
                  <label for ="ccardnumber">Credit Card Number</label><input type="text" name="ccardnumber" pattern="[0-9]{1,12}"
                                                              id="ccardnumber" required="required"> <br/>
 <!-- pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$" -->                                    
                  <label for="ccardmonth">Expiration Date</label>
                     <select name="ccardmonth" id="ccardmonth" selectedvalue="00" required="required">
                        <option value="00">--Month--</option>
                        <option value="01">January (01)</option>
                        <option value="02">February (02)</option>
                        <option value="03">March (03)</option>
                        <option value="04">April (04)</option>
                        <option value="05">May (05)</option>
                        <option value="06">June (06)</option>
                        <option value="07">July (07)</option>
                        <option value="08">August (08)</option>
                        <option value="09">September (09)</option>
                        <option value="10">October (10)</option>
                        <option value="11">November (11)</option>
                        <option value="12">December (12)</option>
                     </select>                  
                     <select name="ccardyear" selectedvalue="00" required="required">
                        <option value="00">--Year--</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>                        
                     </select><br/>
                  <label for="csc">CSC</label><input type="text" pattern="^\d{3}$" placeholder="nnn" name="csc" id="csc" maxlength="3" required="required">

               </fieldset> 

               <div align="center">
                <TABLE border="0" >
                  <tr>                     
                     <TD ALIGN=center width="200"><input type='submit' name='submit' value='Submit'/></TD>
                     <TD ALIGN=center width="200"><a href="shoppingcart.php"><input type="button" value="Cancel"/></a></TD>
                  </TR>                               
               </table>
               </div>
         </form>      

      </section>
    <?php include "footer.php";?>
 </div>

   </body>

</html>

