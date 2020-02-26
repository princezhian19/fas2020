<?php

function dbConnect() {
	$DB = new mysqli('localhost','calaba9_intra','{^-LouqU_vpV','calaba9_intranetdb');            //{^-LouqU_vpV
	if (mysqli_connect_errno()) {
		echo 'Cannot connect to database: ' . mysqli_connect_error();
		//mail("ber2x@yahoo.com", "URGENT ATTENTION: PCF Website Cannot Connect to the Database","Development Team, Please give attention! The PCF Website cannot connect to the database!".mysqli_connect_error(),"CC: phagemaster@gmail.com");
    }

	return $DB;
        // $DB->close();

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
