<?php

$connect = mysqli_connect("localhost","root","","db_dilg_pmis");	
$columns = array('items', 'unit', 'balanceone','code');

$query = "SELECT * FROM old_stock ";

if(isset($_POST["search"]["value"]))
{
	$query .= '
	WHERE items LIKE "%'.$_POST["search"]["value"].'%" 
	OR unit LIKE "%'.$_POST["search"]["value"].'%" 
	OR code LIKE "%'.$_POST["search"]["value"].'%" 
	OR balanceone LIKE "%'.$_POST["search"]["value"].'%"
	';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
	';
}
else
{
	$query .= 'ORDER BY items DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
	$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
	$sub_array = array();
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="code">' . $row["code"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="items">' . $row["items"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="unit">' . $row["unit"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="balanceone">' . $row["balanceone"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="one">' . $row["one"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="delivery">' . $row["delivery"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="avail_balance">' . $row["avail_balance"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="issue_month">' . $row["issue_month"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="balancetwo">' . $row["balancetwo"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="two">' . $row["two"] . '</div>';
	$sub_array[] = '<div contenteditable class="update" data-id="'.$row["id"].'" data-column="current_price">' . $row["current_price"] . '</div>';
	// $sub_array[] = '<td><button type="button" name="view" id="view" class="btn btn-primary btn-xs">View</button></td>';




	$data[] = $sub_array;
}

function get_all_data($connect)
{
	$query = "SELECT * FROM old_stock";
	$result = mysqli_query($connect, $query);
	return mysqli_num_rows($result);
}

$output = array(
	"draw"    => intval($_POST["draw"]),
	"recordsTotal"  =>  get_all_data($connect),
	"recordsFiltered" => $number_filter_row,
	"data"    => $data
);

echo json_encode($output);

?>