<?php

if(!isset($_SESSION)) 
{
     session_start();
}

	require_once("./include/db.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="PHP Shopping Cart Using Sessions" /> 
<meta name="keywords" content="shopping cart tutorial, shopping cart, php, sessions" />
<link rel="stylesheet" type="text/css" href="common.css">



<title>Menu</title>


</head>

<body>
<div id="container">

	<?php 
 	include "header.php" ;
 	include "horizontal_menu.php";
 	include "vertical_menu.php" ;

	$actionMenu=isset( $_GET['menu'])?$_GET['menu']:''; //the action from the URL 	

	$item_id=isset( $_GET['id'])?$_GET['id']:'';

	$action=isset( $_GET['action'])?$_GET['action']:''; //the action from the URL 		

	if(($action=='add') && ($item_id!=''))
	{	//decide what to do		
		addtocart($item_id,1);			
	}
	
	?>

	 <section > 
		<table id ="itemlist">

		<?php
			
			$sql = "SELECT m.ItemId, m.ItemName, m.UnitPrice,i.ItemTypeDesc 
							FROM MenuItem m, ItemType i 
							WHERE m.ItemTypeID=i.ItemTypeID and m.ItemTypeID=".$actionMenu.";";		
			
		
			//$sql = "SELECT m.ItemId, m.ItemName, m.UnitPrice,i.ItemTypeDesc FROM MenuItem m, ItemType i WHERE m.ItemTypeID=i.ItemTypeID;";		
			//function Exec_Query($query, &$result)
			if (Exec_Query($sql,$result))
			{					
								
					
				while(list($id, $name, $price,$typedesc) = mysqli_fetch_row($result)) 
				{
					$caption=$typedesc;
					echo "<tr>";							
					
					echo "<td style=\"width:250px;text-align:center\"><img src=\"./img/menu/item$id.jpeg\"/></td>";														
					
					echo "<td style=\"width:250px;text-align:right\">
							$name<br/>
							Unit price: $price<br/>
														  
							<div style=\"font-size:12px\"><a href=\"$_SERVER[PHP_SELF]?action=add&id=$id&menu=$actionMenu\">Add To Cart</a></div>
							<div style=\"font-size:12px\"><a href=\"shoppingcart.php\">View Cart</a></div>
						  </td>";					
							
					echo "</tr>";
				}
				echo "<caption>$caption</caption>";				
			}
		?>
		</table>
		
		<!--<a href="cart.php">View Cart</a>-->
	</section>

	
	<?php include "footer.php" ?>

</div>
</body>
</html>
