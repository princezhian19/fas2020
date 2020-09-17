<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");



$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');


if(mysqli_connect_errno()){echo mysqli_connect_error();}  
$id = $_GET['id'];
$division = $_GET['division'];
$vrno = $_GET['vrno'];

/* echo $id;
echo '<br>';
echo $division;
exit(); */

$divchief="";
$divpos="";

if($division==1){

$divchief = 'NOEL R. BARTOLABAC';
$divpos="ASST. REGIONAL DIRECTOR";
   
}

else if($division==18){

$divchief = 'GILBERTO L. TUMAMAC';
$divpos="OIC - LGMED Chief";
}

else if($division==17){

$divchief = 'JAY-AR T. BELTRAN';
$divpos="OIC - LGCDD Chief";

}

else if($division==10){

$divchief = 'DR. CARINA S. CRUZ';
$divpos="Chief, FAD";
}
else{

$divchief = '';

}
    

// exit();

                

$view_query = mysqli_query($conn, "SELECT * from vr where id = '$id'");


while ($row = mysqli_fetch_assoc($view_query)) {

$id=$row['id'];
$vrno=$row['vrno'];
$name=$row['name'];
$office=$row['office'];
$purpose=$row['purpose'];
$remarks=$row['remarks'];
$destination=$row['destination'];
$nop=$row['nop'];
//$vrdate=$row['vrdate'];


$vrdate = date('F d, Y',strtotime($row['vrdate']));

$departuredate = date('F d, Y',strtotime($row['departuredate']));
$departuretime = date('H:i A',strtotime($row['departuretime']));

$returndate = date('F d, Y',strtotime($row['returndate']));
$returntime = date('H:i A',strtotime($row['returntime']));

$nod=$row['nod'];
$type=$row['type'];

$status = $row['status'];
$stat="";

if($status=='cancelled'){
$stat='cancelled.png';
}
else{
$stat='';
}

$sign = "DR. CARINA S. CRUZ";
$pos = "Chief FAD";

$passengers = mysqli_query($conn, "SELECT name from vr_passengers where vrid = '$vrno' order by id asc");
while ($row1 = mysqli_fetch_assoc($passengers)) {
$pname = $row1['name'];

$pname1 = $pname;
// echo  $pname;
}



$PHPJasperXML = new PHPJasperXML(); 

if($type=="Drop Off"){
    $PHPJasperXML->arrayParameter=array("vrno"=>$vrno,
    "n"=>$name,
    "office"=>$office,
    "vrdate"=>$vrdate,
    "purpose"=>$purpose,
    "remarks"=>$remarks,
    "destination"=>$destination,
    "nop"=>$nop,
    "choice"=>'correct.png',
    "choice1"=>'check1.png',
    "choice2"=>'check1.png',
    "choice3"=>'check1.png',
    "passengers"=>$pname1,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "sign"=>$sign,
    "pos"=>$pos,
    "cancelled"=>$stat);
}
else if($type=="Pick-Up"){

    $PHPJasperXML->arrayParameter=array("vrno"=>$vrno,
    "n"=>$name,
    "office"=>$office,
    "vrdate"=>$vrdate,
    "purpose"=>$purpose,
    "remarks"=>$remarks,
    "destination"=>$destination,
    "nop"=>$nop,
    "choice"=> 'check1.png',
    "choice1"=>'correct.png',
    "choice2"=>'check1.png',
    "choice3"=>'check1.png',
    "passengers"=>$pname1,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "sign"=>$sign,
    "pos"=>$pos,
    "cancelled"=>$stat);
}
else if($type=="Whole Day"){

    $PHPJasperXML->arrayParameter=array("vrno"=>$vrno,
    "n"=>$name,
    "office"=>$office,
    "vrdate"=>$vrdate,
    "purpose"=>$purpose,
    "remarks"=>$remarks,
    "destination"=>$destination,
    "nop"=>$nop,
    "choice"=> 'check1.png',
    "choice1"=>'check1.png',
    "choice2"=>'correct.png',
    "choice3"=>'check1.png',
    "passengers"=>$pname1,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "sign"=>$sign,
    "pos"=>$pos,
    "cancelled"=>$stat);
}
else{

    $PHPJasperXML->arrayParameter=array("vrno"=>$vrno,
    "n"=>$name,
    "office"=>$office,
    "vrdate"=>$vrdate,
    "purpose"=>$purpose,
    "remarks"=>$remarks,
    "destination"=>$destination,
    "nop"=>$nop,
    "choice"=> 'check1.png',
    "choice1"=>'check1.png',
    "choice2"=>'check1.png',
    "choice3"=>'correct.png',
    "nod"=>$nod,
    "passengers"=>$pname1,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "sign"=>$sign,
    "pos"=>$pos,
    "cancelled"=>$stat);


}

}






$PHPJasperXML->load_xml_file("report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
$PHPJasperXML->outpage("I");
//page output method I:standard output  D:Download file


?>
