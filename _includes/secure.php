<?php

if (empty($_SESSION['inet_credentials']))
{
	header("Location: login.php?page=".basename($_SERVER['PHP_SELF']));
	exit();
}
if(empty($_SESSION['inet_credentials']['access_type']) || empty($_SESSION['inet_credentials']['uname']) || empty($_SESSION['inet_credentials']['psword']))
{
	unset($_SESSION['inet_credentials']);
	header("Location: login.php" );
	exit();
}
if (!empty($_GET['logout']))
{
	dbaselogs("logout ".$_SERVER['PHP_SELF'], "", "");
	txtlogs("logout ".$_SERVER['PHP_SELF'], "", "");
	unset($_SESSION['inet_credentials']);
	header("Location: login.php" );
	exit();
}

/* Check If user is blocked? */
$checkQueryBlock = "SELECT EMP_N, CONCAT(UPPER(FIRST_M),' ',UPPER(LAST_M)) as cname FROM tblemployeeinfo WHERE md5(CODE)='".md5($_SESSION['inet_credentials']['code'])."' AND BLOCK = 'Y'";
if (ifRecordExist($checkQueryBlock))
{
	dbaselogs("Blocked ".$_SERVER['PHP_SELF'], "", "");
	txtlogs("Blocked ".$_SERVER['PHP_SELF'], "", "");
	unset($_SESSION['inet_credentials']);
	$_SESSION['message'] = "Contact administrator to obtain permission!";
	header("Location: login.php" );
	exit();	
}

$checkQueryBlock = "SELECT * from global_setting where web_stat='7cef8a734855777c2a9d0caf42666e69'";
if(!ifRecordExist($checkQueryBlock)){
  	header("Location: fatalerror.php");
	exit();
}




?>
