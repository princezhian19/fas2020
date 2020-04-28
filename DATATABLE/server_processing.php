<?php
session_start();
date_default_timezone_set("Asia/Manila");

$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$return_arr = array();
$name = $_SESSION['username'];
$division  = $_SESSION['division'];
$complete_name = $_SESSION['complete_name'];
// ===============================================================================
$query = "SELECT * from tblemployee where UNAME = '$name'";
$result = mysqli_query($con,$query);
if($row = mysqli_fetch_array($result))
{
    $division = $row['DIVISION_C'];
	$uname    = $row['UNAME'];
	
	
	if ($division = 10 || $division == 14 || $division == 16 || $division == 11 || $division == 12 || $division == 13)
	{
		$fieldsName = '`ID`, `CONTROL_NO`, `REQ_DATE`, `REQ_TIME`, `REQ_BY`, `OFFICE`, `POSITION`, `CONTACT_NO`, `EMAIL_ADD`, `EQUIPMENT_TYPE`, `BRAND_MODEL`, `PROPERTY_NO`, `SERIAL_NO`, `IP_ADDRESS`, `MAC_ADDRESS`, `TYPE_REQ`, `TYPE_REQ_DESC`, `TEXT1`, `TEXT2`, `TEXT3`, `TEXT4`, `TEXT5`, `TEXT6`, `TEXT7`, `TEXT8`, `ISSUE_PROBLEM`, `START_DATE`, `START_TIME`, `STATUS_DESC`, `COMPLETED_DATE`, `COMPLETED_TIME`, `ASSIST_BY`, `PERSON_ASSISTED`, `TIMELINESS`, `QUALITY`, `STATUS`, `STATUS_REQUEST`';
		$table = 'tbltechnical_assistance';
		$join = '';
		$WHERE = "WHERE `REQ_DATE` != '0000-00-00'";
	}else{
		$fieldsName = '`ID`, `CONTROL_NO`, `REQ_DATE`, `REQ_TIME`, `REQ_BY`, `OFFICE`, `POSITION`, `CONTACT_NO`, `EMAIL_ADD`, `EQUIPMENT_TYPE`, `BRAND_MODEL`, `PROPERTY_NO`, `SERIAL_NO`, `IP_ADDRESS`, `MAC_ADDRESS`, `TYPE_REQ`, `TYPE_REQ_DESC`, `TEXT1`, `TEXT2`, `TEXT3`, `TEXT4`, `TEXT5`, `TEXT6`, `TEXT7`, `TEXT8`, `ISSUE_PROBLEM`, `START_DATE`, `START_TIME`, `STATUS_DESC`, `COMPLETED_DATE`, `COMPLETED_TIME`, `ASSIST_BY`, `PERSON_ASSISTED`, `TIMELINESS`, `QUALITY`, `STATUS`, `STATUS_REQUEST`';
		$table = 'tbltechnical_assistance';
		$join = '';
		$WHERE = "WHERE `REQ_DATE` != '0000-00-00' and `REQ_BY` LIKE '%$complete_name%' ";
	}

		
	
    // }else{
	// 	$fieldsName = '`DIVISION_N`, `DIVISION_M`, `DIVISION_COLOR`, `DIVISION_LONG_M`, `D_GROUP`, `GROUP_N`, `PGROUP_N`';
	// 	$table = 'tblpersonneldivision';
	// 	$join = 'INNER JOIN tbltechnical_assistance on tblpersonneldivision.DIVISION_M = tbltechnical_assistance.OFFICE';
	// 	$WHERE = "WHERE tbltechnical_assistance.REQ_BY = '$complete_name'";
	// }
}

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
	array('db' => 'CONTROL_NO', 'dt' => 0),
	array(
        'db'        => 'REQ_DATE',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            return date( 'M d, Y', strtotime($d));
        }
	),
	array(
        'db'        => 'REQ_TIME',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            return date( 'g:i A', strtotime($d));
        }
    ),
	array(
		'db' => 'START_DATE', 
		'dt' => 3,
		'formatter' => function( $d, $row ) {
			if($d == '0000-00-00' || $d == null)
			{
				$d = '';
				return $d;
			}else{
			return date( 'M d, Y', strtotime($d));
			}


        }
	),
	array(
		'db' => 'START_TIME', 
		'dt' => 4,
		'formatter' => function( $d, $row ) {
			if($d == '' || $d == null)
			{
				$d = '';
				return $d;
			}else{
				return date( 'g:i A', strtotime($d));

			}
        }
	),
	array('db' => 'REQ_BY', 'dt' => 5),
	array('db' => 'OFFICE', 'dt' => 6),
	array('db' => 'ISSUE_PROBLEM', 'dt' => 7),
	array('db' => 'TYPE_REQ', 'dt' => 8,
'formatter' => function($d,$row){
	if($row['TYPE_REQ'] == 'Others' || $row['TYPE_REQ'] == 'OTHERS')
	{
	return $row['TYPE_REQ'].'<BR>'.'('.$row['TEXT6'].','.$row['TEXT7'].')';
	}
	
	return $row['TYPE_REQ'].'<BR>'.'('.$row['TYPE_REQ_DESC'].')';
}
),
    array('db' => 'ASSIST_BY', 'dt' => 9),
    array(
		'db' => 'STATUS_REQUEST', 
		'dt' => 10,  
		'formatter' => function( $d, $row ) {
			if($d == 'Submitted')
			{
				$d = '<span class="badge badge-pill" style = "background-color:red;">'.$d.'</span>';
			}else if($d == 'For action')
			{
				$d = '<span class="badge badge-pill" style = "background-color:blue;">'.$d.'</span>';
			}else if($d == 'Completed')
			{
				$d = '<span class="badge badge-pill" style = "background-color:green;">'.$d.'</span>';
			}
			else if($d == 'Received')
			{
				$d = '<span class="badge badge-pill" style = "background-color:orange;">'.$d.'</span>';
			}
			return $d;
	})


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
