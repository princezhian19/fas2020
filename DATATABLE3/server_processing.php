
<?php

$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");



$return_arr = array();

$query = 'SELECT * FROM supplier order by supplier_title asc';

$result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result)){
	$id = $row["id"];
	$supplier_title = $row["supplier_title"];
	$supplier_address = $row["supplier_address"];  
	$contact = $row["contact_details"];

    $return_arr[] = array(
                    "id" => $id,
                    "supplier_title" => $supplier_title,
                    "supplier_address" => $supplier_address,
                    "contact_details" => $contact);
          
}

// Encoding array in JSON format
echo json_encode($return_arr);