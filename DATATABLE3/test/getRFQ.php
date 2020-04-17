<?php session_start();
$username = $_SESSION['username'];
error_reporting(0);
ini_set('display_errors', 0);
?>
<?php
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$request=$_REQUEST;
$col =array(
    0   =>  'id',
    1   =>  'pr_no',
    2   =>  'pr_date',
    3   =>  'pmo',
    4   =>  'purpose',
    5   =>  'target_date',
    6   =>  'received_date',
    7   =>  'rfq_no',
    8   =>  'rfq_date',
    9   =>  'submitted_date',
    10   =>  'type',
    11   =>  'stat'
);  //create column like table in database
$sql ="SELECT a.id,a.pr_no,a.pr_date,a.pmo,a.purpose,a.target_date,a.received_date,b.rfq_no,b.rfq_date,a.submitted_date,a.type,a.stat FROM pr as a left join rfq as b ON a.pr_no=b.pr_no ";
$query=mysqli_query($conn,$sql);
$totalData=mysqli_num_rows($query);
$totalFilter=$totalData;
//Search
$sql ="SELECT a.id,a.pr_no,a.pr_date,a.pmo,a.purpose,a.target_date,a.received_date,b.rfq_no,b.rfq_date,a.submitted_date,a.type,a.stat FROM pr as a left join rfq as b ON a.pr_no=b.pr_no WHERE 1=1";
if(!empty($request['search']['value'])){
    $sql.=" AND (a.id Like '".$request['search']['value']."%' ";
    $sql.=" OR a.pr_no Like '".$request['search']['value']."%' ";
    $sql.=" OR b.rfq_no Like '".$request['search']['value']."%' ";
    $sql.=" OR a.purpose Like '".$request['search']['value']."%' )";
}
$query=mysqli_query($conn,$sql);
$totalData=mysqli_num_rows($query);
//Order
$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
$request['start']."  ,".$request['length']."  ";
$query=mysqli_query($conn,$sql);
$data=array();
while($row=mysqli_fetch_array($query)){
    $subdata=array();
    $subdata[]='<a href="ViewPRv.php?id='.$row[0].'&username='.$_SESSION['username'].'"> '.$row[1].' </a>';//pr no
    $subdata[]=date('F d, Y',strtotime($row[2])); //pr date
    $subdata[]=$row[3];//pmo  
    if ($row[10] == 1) {
        $subdata[]="Catering Services";           
    }
    if ($row[10] == 2) {
        $subdata[]="Meals, Venue and Accommodation";           
    }
    if ($row[10] == 3) {
        $subdata[]="Repair and Maintenance";           
    }
    if ($row[10] == 4) {
        $subdata[]="Supplies, Materials and Devices";           
    }
    if ($row[10] == 5) {
        $subdata[]="Other Services";           
    }
    if ($row[10] == 6) {
        $subdata[]="Reimbursement and Petty Cash";           
    }
    $subdata[]=$row[4];//purpose           
    $subdata[]=date('F d, Y',strtotime($row[5]));//target date   
    if ($row[9] == NULL) {
    $subdata[]="DRAFT";//receive date           
}else{
    if($row[9] != NULL AND $row[6] != NULL){

    $subdata[]=date('F d, Y',strtotime($row[6]));//receive date           
}else{
    $subdata[]='<a class="btn btn-success btn-xs"  href="received_pr.php?id='.$row[0].'" title="Receive">Receive </a>  ';//receive date    
}       
}
if ($row[11] == 1) {
   $view_queryrfq = mysqli_query($conn, 'SELECT * FROM rfq where pr_no = "'.$row[1].'" ');
   $rowrfq = mysqli_fetch_array($view_queryrfq);
   $rfqid = $rowrfq['id'];    
    $subdata[]='<a href="RFQdetails.php?id='.$rfqid.'">'.$row[7].'</a>';//rfq_no           
}        
if ($row[11] == 0) {
    $subdata[]='<a class="btn btn-success btn-xs" href="CreateRFQ.php?prID='.$row[0].'" >Create</a>';//rfq_no           
}
if ($row[8] == '') {
    $subdata[]='';//rfq_date           
}
if ($row[8] != '') {
    $subdata[]=date('F d, Y',strtotime($row[8]));//rfq_date           
}
if ($row[11] == 1) {
    $view_queryrfq = mysqli_query($conn, 'SELECT * FROM rfq where pr_no = "'.$row[1].'" ');
    $rowrfq = mysqli_fetch_array($view_queryrfq);
    $rfqid = $rowrfq['id'];
    $query_2 = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfqid ");
    $row_2 = mysqli_fetch_array($query_2);
    $rfq_items_id = $row_2['id'];
    $selectABS = mysqli_query($conn,"SELECT * FROM abstract_of_quote WHERE rfq_id = $rfqid and abstract_no is not NULL");
    $rowABS = mysqli_fetch_array($selectABS);
    $supplier_id = $rowABS['supplier_id'];
    $abstract_id = $rowABS['id'];
    $rowaoq_id = $rowABS['abstract_no'];
    $query_aoq = mysqli_query($conn,"SELECT * FROM  aoq_data WHERE id = '$rowaoq_id'"); 
    $aoq = mysqli_fetch_array($query_aoq);
    $aoq_no =  $aoq['aoq_no'];
    $select_sup = mysqli_query($conn,"SELECT supplier_title from supplier WHERE id = '$supplier_id'");
    $rowSup = mysqli_fetch_array($select_sup);
    $win_supplier = $rowSup['supplier_title'];
    $query_3 = mysqli_query($conn,"SELECT * FROM supplier_quote WHERE rfq_item_id = '$rfq_items_id'");
    if (mysqli_num_rows($query_3) == 0){
        $subdata[]='<a class="btn btn-success btn-xs" href="CreateAoq.php?rfq_id='.$rfqid.'&rfq_items='.$rfq_items_id.'" title="Award"> Award</a>';           
    }else{
        if (mysqli_num_rows($selectABS) > 0){
            $subdata[]='<a  href="UpdateAoq.php?rfq_id='.$rfqid.'&supplier_id='.$supplier_id.'&abstract_id='.$abstract_id.'" title="">'.$aoq_no.'</a>';           
        }else{
            $subdata[]='<a class="btn btn-success btn-xs" href="CreateAoq.php?rfq_id='.$rfqid.'&rfq_items='.$rfq_items_id.'" title="Award"> Award</a>';           
        }
    }
}else{
    $subdata[]='';           
}
if ($row[11] == 1) {
    $view_queryrfq = mysqli_query($conn, 'SELECT * FROM rfq where pr_no = "'.$row[1].'" ');
    $rowrfq = mysqli_fetch_array($view_queryrfq);
    $rfqid = $rowrfq['id'];
    $query_3 = mysqli_query($conn,"SELECT * FROM  selected_quote WHERE rfq_id = '$rfqid'");
    $rowpoid = mysqli_fetch_array($query_3);
    $rowpo_id = $rowpoid['po_id'];
    if (mysqli_num_rows($query_3)>0){
       if ($rowpo_id==NULL){
        if (mysqli_num_rows($selectABS) > 0){
            $subdata[]='<a class="btn btn-success btn-xs"  href="CreatePO.php?rfq_id='.$rfqid.'&supplier_id='.$supplier_id.'" title="Create"> Create </a>';           
        }else{
            $subdata[]='<a class="" href="ViewPO.php?rfq_id='.$rfqid.'&supplier_id='.$supplier_id.'" title="po no">'.$po_no.'</a>';           
        }
    }else{
        $query_4 = mysqli_query($conn,"SELECT * FROM  po WHERE id = '$rowpo_id'");
        $po_id = mysqli_fetch_array($query_4);
        $po_idget = $po_id['id'];
        $po_no = $po_id['po_no'];
        $subdata[]='<a class="" href="ViewPO.php?rfq_id='.$rfqid.'&supplier_id='.$supplier_id.'" title="po no">'.$po_no.'</a>';           
    }
}else{
    $subdata[]='';           
}
}else{
    $subdata[]='';           
}
$data[]=$subdata;


}// end of while 

$json_data=array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);

?>
