<?php
	if(!isset($_SESSION)) 
	{
    	 session_start();
	}

	require_once('twilio-php/Services/Twilio.php');

	function send_sms($to, $msg)
	{
		$to="+15144882161";
		$from = "+14387938759";
		$account_sid = 'ACef26b6de997f7034c73987e7940a9553';
		$auth_token = 'd6b8236a04b40ec27cd32978c13d1e39';
		$client = new Services_Twilio($account_sid, $auth_token);
		$client->account->messages->sendMessage($from, $to, $msg);
	}


	function connect_db()
	{
	/*
	$SENDGRID_USERNAME="app26775163@heroku.com";
	$SENDGRID_PASSWORD = "14e2o9ga";
	*/
	
	/*
		$db_hostname = "localhost";
		$db_name     = "onlinerestaurant";
		$db_username = "root";
		$db_password = "";
	*/	
	
		$db_hostname = "us-cdbr-east-06.cleardb.net";
		$db_name     = "heroku_aea1cdaa9a72f3b";
		$db_username = "b89960d4cda89c";
		$db_password = "6aff7ef0";
	
		$db = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

		if($db->connect_errno > 0)
		{
    		die('Unable to connect to database [' . $db->connect_error . ']');
		}

		return $db;
	}

	function close_db($db)
	{
		$db->close();
	}

	function Exec_Query($query, &$result)
	{
		// Database connection
		$db = connect_db();
		$found = 0;

		$result = mysqli_query($db, $query);
		
		if ($result) 
		{
			$found = 1;				
			
		}
		// Close connection with database
		close_db($db);

		return ($found == 1);
	}   

	function InsertIntoDB($query, &$id)
	{
		// Database connection
		$db = connect_db();
		$found = 0;

		$result = mysqli_query($db, $query);
		
		if ($result) 
		{
			$found = 1;				
			$id=  mysqli_insert_id($db); 			
		}
		// Close connection with database
		close_db($db);

		return ($found == 1);
	}   


	//function to check if a menu item exists
	function MenuItemExists($item_id) 
	{
			//use sprintf to make sure that $item_id is inserted into the query as a number - to prevent SQL injection
			$query = sprintf("SELECT * FROM MenuItem WHERE ItemID = %d;",
							$item_id); 

			$db = connect_db();						

			$rows = mysqli_num_rows ( mysqli_query($db, $query));			

			close_db($db);

			return $rows;
			
	}

	function GetMenuItem($item_id) 
	{
			//use sprintf to make sure that $item_id is inserted into the query as a number - to prevent SQL injection
			$query = sprintf("SELECT * FROM MenuItem WHERE ItemID = %d;",$item_id); 

			$db = connect_db();						

			$row=mysqli_fetch_array( mysqli_query($db, $query));			

			close_db($db);

			return $row;
			
	}
	
	function remove_product($item_id)
	{
		$item_id=intval($item_id);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++)
		{
			if($item_id==$_SESSION['cart'][$i]['itemid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}

	function addtocart($item_id,$q)
	{
		if($item_id<1 or $q<1) return;
		
		if(isset($_SESSION['cart']))
		{
			if(product_exists($item_id)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['itemid']=$item_id;
			$_SESSION['cart'][$max]['qty']=$q;
		}
		else
		{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['itemid']=$item_id;
			$_SESSION['cart'][0]['qty']=$q;
		}
	}

	function product_exists($item_id)
	{
		$flag=0;

		if(isset($_SESSION['cart']))
		{
			$item_id=intval($item_id);
			$max=count($_SESSION['cart']);
					
			for($i=0;$i<$max;$i++)
			{
				if($item_id==$_SESSION['cart'][$i]['itemid'])
				{
					$flag=1;
					break;
				}
			}
		}
		
		return $flag;
	}

?>