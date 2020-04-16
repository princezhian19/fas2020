<?php
$connect=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$columns = array('sn', 'procurement', 'id','pmo_title','code','item_category_title','mode_of_proc_title','source_of_funds_title');

$query = "SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
FROM app 
LEFT JOIN item_category ic on ic.id = app.category_id 
LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
LEFT JOIN pmo on pmo.id = app.pmo_id 
LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
";

if(isset($_POST["search"]["value"]))
{
	$query .= '
	WHERE procurement LIKE "%'.$_POST["search"]["value"].'%" 
	OR pmo_title LIKE "%'.$_POST["search"]["value"].'%" 
	OR sn LIKE "%'.$_POST["search"]["value"].'%"
	';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
	';
}
else
{
	$query .= 'ORDER BY app.id DESC ';
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
	$id = $row['id'];
	$sub_array = array();
	$sub_array[] = '<div>' . $row["sn"] . '</div>';
	$sub_array[] = '<div>' . $row["code"] . '</div>';
	$sub_array[] = '<div>' . $row["item_category_title"] . '</div>';
	$sub_array[] = '<div>' . $row["procurement"] . '</div>';
	$sub_array[] = '<div>' . $row["pmo_title"] . '</div>';
	$sub_array[] = '<div>' . $row["mode_of_proc_title"] . '</div>';
	$sub_array[] = '<div>' . $row["source_of_funds_title"] . '</div>';
	$sub_array[] = '<a  href="UpdateAPP.php?id='.$id.' " title="Edit" class="btn btn-primary btn-xs"> <i class="fa">&#xf044;</i>Edit</a>';
          $select = mysqli_query($connect,"SELECT items FROM pr_items WHERE items = $id");
          if (mysqli_num_rows($select)>0) {
	$sub_array[] = '<a  href="ViewApp_History.php?id='.$id.'" title="View" class="btn btn-info btn-xs"><i class="fa">&#xf06e;</i>  History </a>';
          }else{
	$sub_array[] = '';

          }
	$data[] = $sub_array;
}

function get_all_data($connect)
{
	$query = "SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
	FROM app 
	LEFT JOIN item_category ic on ic.id = app.category_id 
	LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
	LEFT JOIN pmo on pmo.id = app.pmo_id 
	LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id ";
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