<?php
session_start();
date_default_timezone_set("Asia/Manila");

$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

		$fieldsName = 'tbltravel_claim.`ID`, `ENTITY_NAME`, `FUND_CLASTER`, tbltravel_claim.`NAME`, `NO`, `DATE_OF_TRAVEL`, `PURPOSE`, `POSITION`, `OFFICIAL_STATION`,`RO_TO_OB`';
		$table = 'tbltravel_claim';
		$join = 'INNER JOIN tbltravel_claim_info2';
		$WHERE = "";

	
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
    array('db' => 'RO_TO_OB', 'dt' => 0),
	array('db' => 'NAME', 'dt' => 1),
	array(
        'db'        => 'ENTITY_NAME',
        'dt'        => 2
	    ),
	
	array(
		'db' => 'DATE_OF_TRAVEL', 
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
		'db' => 'POSITION', 
		'dt' => 4
    ),
    	
	array(
		'db' => 'OFFICIAL_STATION', 
        'dt' => 5,
        'formatter' => function($d, $row)
        {
            if($d == '1')
            {
                $d = 'Regional Office';
            }else if($d == '2')
            {
                $d = 'Provincial/HUC Office';
            }
            else if($d == '3')
            {
                $d = 'cluster Office';
            }
            else if($d == '4')
            {
                $d = 'City/Municipal Office';
            }
            return $d;
        } )
    


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
