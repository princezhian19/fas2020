<?php		
	$keyword = strval($_POST['query']);
	$search_param = "%{$keyword}%";
	$conn =new mysqli('localhost', 'root', '' , 'db_dilg_pmis');

	$sql = $conn->prepare("SELECT * FROM iar WHERE po_no LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$countryResult[] = $row["po_no"];
		}
		echo json_encode($countryResult);
	}
	$conn->close();
?>

