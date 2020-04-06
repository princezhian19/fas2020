<?php

function dbConnect() {
	$DB = new mysqli('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');            
		if (mysqli_connect_errno()) {
			echo 'Cannot connect to database: ' . mysqli_connect_error();
		}
		return $DB;
	}
	function ifRecordExist($sql){

		$DBConn = dbConnect();
		if (!$DBConn)
		{
			return false;
		}

		$queryUser = $DBConn->query( $sql );

		if (!$queryUser->num_rows) return false;
		else return true;
	}

	 function numRows($query) {
        $result  = mysqli_query($this->DBConn, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
    
	function getData($conn,$query){

		$result = $conn->query($query);

		$data = array();
		foreach ($result as $row ) {
			$data[] = $row ;
		}
		return $data;

		$result->close();
        // $conn->close(); CTODI
		exit();
	}
	function getDatawhere($conn,$where,$columna,$columnb,$tblname){

		$query = "SELECT $columna from $tblname where $columnb= '".$where."'";

		$result = $conn->query($query);

		$data = array();
		foreach ($result as $row ) {
			$data[] = $row ;
		}
		return $data;

		$result->close();
	}
	function print_debug($object){
		echo "<pre>";
		print_r($object);
		echo "</pre>";

	}
	function completion_validation($request){
		$error = [];


		foreach ($request as $key => $value) {
			if (empty($value)) {
				$error[]=$key;
			}
		}
		return $error;
	}
	?>