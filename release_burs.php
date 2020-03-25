<?php
$conn = mysqli_connect("localhost","root","","fascalab_2020");
$id = $_GET['id'];
$select = mysqli_query($conn,"SELECT burs_id FROM saroob WHERE id = '$id '");
$row = mysqli_fetch_array($select);
$burs_id = $row['burs_id'];
$validate = mysqli_query($conn,"SELECT * FROM disbursement WHERE burs_id = '$burs_id' ");
$validate2 = mysqli_query($conn,"SELECT * FROM dv WHERE burs_id = '$burs_id' ");

if (mysqli_num_rows($validate)>0) {
	$get_data = mysqli_query($conn,"SELECT * FROM saroob WHERE burs_id = '$burs_id' ");
	$rowUpdate = mysqli_fetch_array($get_data);
	$burs_id_saroo = $rowUpdate['burs_id'];
	$payee = $rowUpdate['payee'];
	$particular = $rowUpdate['particular'];
	$ppa = $rowUpdate['ppa'];
	$uacs = $rowUpdate['uacs'];
	$amount = $rowUpdate['amount'];


	 $query = mysqli_query($conn,"UPDATE disbursement SET ors ='$ors', sr = '$saronum', burs_id = '$burs_id_saroo', payee = '$payee', particular = '$particular', ppa = '$ppa', uacs = '$uacs', amount = '$amount' WHERE burs_id = '$burs_id' ");
}else{
	$query = mysqli_query($conn,"INSERT INTO disbursement(burs_id,ors,sr,office,po_no,payee,particular,ppa,uacs,amount) SELECT burs_id,ors,saronumber,office,ponum,payee,particular,ppa,uacs,amount FROM saroob WHERE id = '$id' ");
}

if ($query) {
	$update = mysqli_query($conn,"UPDATE saroob SET datereleased = now() WHERE id = '$id'");
	$updateE = mysqli_query($conn,"UPDATE burs SET status = 5, date_release = now() WHERE id = '$burs_id'");
if (mysqli_num_rows($validate2)>0) {
	// $get_data2 = mysqli_query($conn,"SELECT * FROM dv WHERE burs_id = '$burs_id' ");
	// $row2 = mysqli_fetch_array($get_data2);
	// $office = $row2['office'];
	// $office = $row2['po_no'];
	// $office = $row2['supplier'];
	// $office = $row2['address'];
	// $office = $row2['purpose'];
	// $office = $row2['amount'];


}else{
	$insert_d = mysqli_query($conn,"INSERT INTO dv(burs_id,office,po_no,supplier,address,purpose,amount) SELECT id,office,po_no,supplier,address,purpose,amount FROM burs WHERE id = '$burs_id' ");

}

	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Successfuly Saved!')
		window.location.href = '@obligation.php';
		</SCRIPT>");
}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Erro Occured!')
		window.location.href = '@obligation.php';
		</SCRIPT>");
}



?>