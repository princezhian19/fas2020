<?php
session_start();
date_default_timezone_set("Asia/Manila");

$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
		$fieldsName = ' DIVISION_M, `id`, `office`, `title`, `color`, events.`start`, events.`end`, `description`, `venue`, `enp`, `postedby`, `posteddate`, `realenddate`, `cancelflag`, events.`status`, `isRead`, `isGenerateRO`, `remarks`';
		$table = 'events';
		$join = ' left join tblemployeeinfo te ON events.postedby = te.emp_n left join tblpersonneldivision tp on tp.DIVISION_N = events.office ';
		$WHERE = "  ORDER BY start desc ";

	
    // }else{
	// 	$fieldsName = '`DIVISION_N`, `DIVISION_M`, `DIVISION_COLOR`, `DIVISION_LONG_M`, `D_GROUP`, `GROUP_N`, `PGROUP_N`';
	// 	$table = 'tblpersonneldivision';
	// 	$join = 'INNER JOIN tbltechnical_assistance on tblpersonneldivision.DIVISION_M = tbltechnical_assistance.OFFICE';
	// 	$WHERE = "WHERE tbltechnical_assistance.REQ_BY = '$complete_name'";
	// }


/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
// DB table to use





				
				
// Table's primary key
$primaryKey = 'ID';
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$division  = $_SESSION['division'];

$columns = array(
    array('db' => 'title', 'dt' => 0),
    array('db' => 'office', 'dt' => 1),
    array('db' => 'start', 'dt' => 2),
    array('db' => 'DIVISION_M', 'dt' => 3),
    array('db' => 'DIVISION_M', 'dt' => 4),
    array('db' => 'DIVISION_M', 'dt' => 5),
    array('db' => 'DIVISION_M', 'dt' => 6),
    array('db' => 'DIVISION_M', 'dt' => 7),
    array('db' => 'DIVISION_M', 'dt' => 8),
    array('db' => 'DIVISION_M', 'dt' => 9),
    array('db' => 'DIVISION_M', 'dt' => 10)

    


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
