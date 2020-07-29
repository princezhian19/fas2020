<?php
session_start();
date_default_timezone_set("Asia/Manila");
$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

		$get = $_POST['filter_data'];

		$fieldsName = 'type,accno,amount';
		$table = 'dv_nta';
		$join = '';
		$WHERE = " WHERE dv = '$get' ";

		/* echo "select $fieldsName from $table $WHERE" ;
		exit(); */

				
// Table's primary key54
$primaryKey = 'id';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes


$columns = array(
    array('db' => 'type', 'dt' => 0),
    array('db' => 'accno', 'dt' => 1),

    array('db' => 'amount', 'dt' => 2,
   
	'formatter' => function( $d, $row ) {
		
		$d1 = number_format($d,2);
		return $d1;
		
        }),
    // array('db' => 'status', 'dt' => 5),	
);


// SQL server connection information
$sql_details = array(
	'user' => 'fascalab_2020',
	'pass' => 'w]zYV6X9{*BN',
	'db'   => 'fascalab_2020',
	'host' => 'localhost'

);
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
require('ssp.class.php');
echo json_encode(
	SSP::simple($_GET, $sql_details,$fieldsName, $table,$join, $primaryKey, $columns,$WHERE)
);	