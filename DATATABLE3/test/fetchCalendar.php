<?php
session_start();
$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$request=$_REQUEST;
$col =array(
    0   =>  'office',
    1   =>  'title',
    2   =>  'start',
    3   =>  'end',
    4   =>  'venue',
    5   =>  'remarks',
    6   =>  'postedby'
 
);  //create column like table in database

$sql ="SELECT * FROM events 
left join tblemployee te ON events.postedby = te.emp_n  
left join tblpersonneldivision tp on tp.DIVISION_N = events.office";
$query=mysqli_query($con,$sql);

$totalData=mysqli_num_rows($query);

$totalFilter=$totalData;

//Search
$sql ="SELECT * FROM events left join tblemployee te ON events.postedby = te.emp_n  
left join tblpersonneldivision tp on tp.DIVISION_N = events.office WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (id Like '".$request['search']['value']."%' ";
    $sql.=" OR DIVISION_M Like '".$request['search']['value']."%' ";
    $sql.=" OR title Like '".$request['search']['value']."%' ";
    $sql.=" OR start Like '".$request['search']['value']."%' ";
    $sql.=" OR end Like '".$request['search']['value']."%' ";
    $sql.=" OR venue Like '".$request['search']['value']."%' ";
    $sql.=" OR postedby Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($con,$sql);
$totalData=mysqli_num_rows($query);

//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
    $request['start']."  ,".$request['length']."  ";

$query=mysqli_query($con,$sql);

$data=array();
$i = 1;
while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]=$row['DIVISION_M']; 
    $subdata[]=$row['title']; 
    $subdata[]=date('F d, Y',strtotime($row['start']));          
    $subdata[]=date('F d, Y',strtotime($row['end']));           
    $subdata[]=$row['venue'];           
    $subdata[]=$row['remarks'];           
    $subdata[]=$row['UNAME'];         
    if($_SESSION['planningofficer'] == 1)
    {
        $subdata[]='
        <center>
            <a href="ViewEvent.php?eventid='.$row['id'].'" class = "btn btn-success btn-xs">
                <i class="fa fa-eye"></i> View
            </a>&nbsp;
            <a href="EditEvent.php?eventid='.$row['id'].'" class = "btn btn-primary btn-xs">
                <i class="fa">&#xf044;</i> Edit
            </a>&nbsp;
            <a id = "sweet-14" class = "btn btn-danger btn-xs"> 
                <i class="fa fa-trash"></i> Delete
            </a>
        </center>';
        $data[]=$subdata;
    }

    //create event on click in button edit in cell datatable for display modal dialog           $row[0] is id in table on database
   
}

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>
