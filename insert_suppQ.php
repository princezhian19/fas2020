<?php
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
if(isset($_POST["supplier_id_show"], $_POST["remarks_sup"], $_POST["item_id_sup"], $_POST["ppu_sup"]))
{
	for($count = 0; $count < count($_POST["ppu_sup"]); $count++){

		$supplier_id_show = mysqli_real_escape_string($conn, $_POST["supplier_id_show"][$count]);
		$remarks_sup = mysqli_real_escape_string($conn, $_POST["remarks_sup"][$count]);
		$item_id_sup = mysqli_real_escape_string($conn, $_POST["item_id_sup"][$count]);
		$ppu_sup = mysqli_real_escape_string($conn, $_POST["ppu_sup"][$count]);

		$query = "INSERT INTO supplier_quote(supplier_id,rfq_item_id,ppu,remarks) VALUES('$supplier_id','$item_id','$ppu','$remarks')";
		if(mysqli_query($conn, $query))
		{
			echo 'Data Inserted';
		}
		else{
			echo 'Data Error';
		}

	}


}
?>