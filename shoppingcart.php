<?php
if(!isset($_SESSION)) 
{
     session_start();
}

include("./include/db.php");

$msg='';	


if(isset($_POST['command']) || isset($_POST['itemid']))
{

	if($_POST['command']=='delete' && $_POST['pid']>0)
	{
		remove_product($_POST['pid']);
	}
	else if($_POST['command']=='clear')
	{
		unset($_SESSION['cart']);
		$_SESSION['TotalOrder']=0;
	}
	else if($_POST['command']=='update')
	{
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++)
		{
			$iid=$_SESSION['cart'][$i]['itemid'];
			
			$q=intval($_POST['item'.$iid]);
			
			if($q>0 && $q<=999)
			{
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else
			{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="common.css">

<title>Shopping Cart</title>

<script language="javascript">
	function del(pid)
	{
		if(confirm('Do you really mean to delete this item'))
		{
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}

	function place_order(logged_in)
	{
		if(logged_in!=1)
		{
			if(confirm('Please log in before ordering!'))	
			{								
				
			}
		}
		else
		{
			window.location='checkout.php';
		}
	}

	function clear_cart()
	{
		if(confirm('This will empty your shopping cart, continue?'))
		{
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}

	function update_cart()
	{
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
</head>

<body>

<div id="container">

<?php
	include "header.php" ;
	 include "horizontal_menu.php"; 
	 include "vertical_menu.php"; 
?>

<form name="form1" id="cartform" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />

	<div style="margin:0px auto; width:600px;" >

    <div style="padding-bottom:10px">
    	<h2 align="center">Your Cart</h2>
    <!--<input type="button" value="Continue Shopping" onclick="window.location='menuitem.php'" />-->
    </div>

    	<div style="color:#F00"><?php echo $msg?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
    	<?php
    		
			if(isset($_SESSION['cart']))
			{
			
				echo '<tr bgcolor="#FFFFFF" style="font-weight:bold">
            			<td align="center">No.</td>
            			<td>Name</td>
            			<td>Unit Price</td>
            			<td>Qty</td>
            			<td>Amount</td>
            			<td>Options</td>
            		  </tr>';


            	$Total=0;
				$max=count($_SESSION['cart']);
			
				for($i=0;$i<$max;$i++)
				{
					$iid=$_SESSION['cart'][$i]['itemid'];

					$q=$_SESSION['cart'][$i]['qty'];

					$row=  GetMenuItem($iid); //$itemname=get_product_name($iid);
					

					$itemname = $row['ItemName'];
					$unitprice = $row['UnitPrice'];
					$Total =$Total + ($unitprice*$q);

					if($q==0) continue;
		?>
            		<tr bgcolor="#FFFFFF">
            			<td align="center"><?php echo $i+1?></td>
            			<td><?php echo $itemname?></td>
                    	<td>$ <?php echo $unitprice ?></td>
                    	<td><input type="text" name="item<?php echo $iid?>" value="<?php echo $q?>" maxlength="3" size="2" /></td>                    
                    	<td>$ <?php echo $unitprice*$q ?></td>
                    	<td><a href="javascript:del(<?php echo $iid?>)">Remove</a></td>
                    </tr>
            <?php					
				}
			?>
				<tr>
					<td><b>Order Total: $<?php echo $Total; $_SESSION['TotalOrder']=$Total; ?></b></td> <!--get_order_total() -->
					<td colspan="5" align="right"><input type="button" value="Clear Cart" onclick="clear_cart()">
												  <input type="button" value="Update Cart" onclick="update_cart()">
												  <input type="button" value="Place Order" 
												  	onclick="place_order(<?php echo isset($_SESSION['logged_in'])?$_SESSION['logged_in']:'' ?>)">
												  <!--<input type="button" value="Place Order" onclick="window.location='billing.php'">-->
					</td>
				</tr>
		<?php
            }
			else
			{
				echo "There are no items in your cart!";
			}
		?>
        </table>
    </div>
</form>

<?php include "footer.php" ; ?>

</div>
</body>
</html>