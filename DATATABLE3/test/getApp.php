<?php
$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$request=$_REQUEST;
$col =array(
    0   =>  'id',
    1   =>  'sn',
    2   =>  'code',
    3   =>  'item_category_title',
    4   =>  'procurement',
    5   =>  'pmo_title',
    6   =>  'mode_of_proc_title',
    7   =>  'source_of_funds_title'
);  //create column like table in database
$sql ="SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
FROM app 
LEFT JOIN item_category ic on ic.id = app.category_id 
LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
LEFT JOIN pmo on pmo.id = app.pmo_id 
LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id ORDER BY app.id DESC";
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);
$totalFilter=$totalData;
//Search
$sql ="SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
FROM app 
LEFT JOIN item_category ic on ic.id = app.category_id 
LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
LEFT JOIN pmo on pmo.id = app.pmo_id 
LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (app.id Like '".$request['search']['value']."%' ";
    $sql.=" OR app.procurement Like '".$request['search']['value']."%' ";
    $sql.=" OR app.sn Like '".$request['search']['value']."%' ";
    $sql.=" OR pmo.pmo_title Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);
//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";
$query=mysqli_query($con,$sql);
$data=array();
while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row[1];
    $subdata[]=$row[2]; 
    $subdata[]=$row[3];           
    $subdata[]=$row[4];           
    $subdata[]=$row[5];           
    $subdata[]=$row[6];           
    $subdata[]=$row[7];           
    $subdata[]='<a href="UpdateApp.php?id='.$row[0].'" class = "btn btn-primary btn-xs"> <i class="fa">&#xf044;</i> Edit</a>';

     $select = mysqli_query($con,'SELECT items FROM pr_items WHERE items ='.$row[0].' ');
          if (mysqli_num_rows($select)>0) {
    $subdata[] = '<a  href="ViewApp_History.php?id='.$row[0].'" title="View" class="btn btn-info btn-xs"><i class="fa">&#xf06e;</i>  History </a>';
          }else{
    $subdata[] = '';

          }
    $data[]=$subdata;
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>
