<?php

	$db_username = 'fascalab_2020';
	$db_password = '';
	$db_name = 'fascalab_2020';
	$db_host = 'localhost';
	$item_per_page = 7;
	
	
	try
	{
		$dbcon = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_username,$db_password);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

?>