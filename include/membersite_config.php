<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('www.tumychau.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('chautm@gmail.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time

		$db_hostname = "us-cdbr-east-06.cleardb.net";
		$db_name     = "heroku_aea1cdaa9a72f3b";
		$db_username = "b89960d4cda89c";
		$db_password = "6aff7ef0";
/*	
		$db_hostname = "localhost";
		$db_name     = "onlinerestaurant";
		$db_username = "root";
		$db_password = "";
*/
$fgmembersite->InitDB(/*hostname*/$db_hostname,
                      /*username*/$db_username,
                      /*password*/$db_password,
                      /*database name*/$db_name,
                      /*table name*/'user');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

?>