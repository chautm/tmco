
<!DOCTYPE html>
<html>

   <head>
   <!--
      ASTCO
      Author: MY CHAU TU
      Date:   2015/02/19

      Filename:        index.php
      Supporting files: modernizr-1.5.js, notice.png, rblogo.png,
                        redbar.png, slice.png, toppings.png
      
   -->

      <meta charset="UTF-8" />
      <title>ASTCO</title>
      <script src="./js/modernizr-1.5.js"></script>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <link rel="stylesheet" type="text/css" href="common.css">
      <link rel="stylesheet" type="text/css" href="main.css">

   </head>

   <body>
      <div id="container">         
         <?php include "header.php"; ?>
		 <hr>
         <?php include "horizontal_menu.php"; ?>
		 <hr>

         <section id="main">     
			<div>
				<img src="./img/main.jpeg" alt="" />
			</div>
			<div>
				
				<p align="justify">Our dedication, technical ability, knowledge, efficiency and experience help us provide our clients with efficient structural designs 
				that are practical and cost-effective.  From large projects to small projects, servicing the needs of our clients is our first priority 
				and we pride ourselves on providing excellent engineering combined with unmatched service.  
				Because of our philosophy, we have enjoyed a tremendous amount of repeat business from our clients and 
				have developed long-term client relationships in all type of markets.
				</p>
				
			</div>
			
				<div class="coupon"  style="background-image: url('./img/commercial.jpg')">
					<h1>Commercial</h1>
				</div>
				
				<div class="coupon"  style="background-image: url('./img/residential.jpg')">
					
					<h1>Residential</h1>
				</div>
				<div class="coupon" style="color:white; background-color: black; font-size: 45px;text-align: left;letter-spacing: 2px; ">
							<!--  background-image: url('./img/commercial.jpg'); -->
					<p>"Dedicated to quality and client satisfaction by providing innovative, practical, and cost-effective structural designs and solutions."
					</p>
					<p>--Astco engineers--</p>
                 </div>
			
         </section>

         <?php 
       
          include 'footer.php';
         ?>

      </div>

   </body>

</html>