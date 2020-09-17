<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include('../../../db.class.php'); // call db.class.php
$mydb = new db(); 

$conn1 = $mydb->connect();


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

//exit();     

        

$view_query = mysqli_query($conn, "SELECT * from vr where id = '$id'");


$results = $conn1->prepare("SELECT name from vr_passengers where vrid = '$vrno' order by id asc");
$results->execute();
while($row1 = $results->fetch(PDO::FETCH_ASSOC))
{
    $pname = $row1['name'].'';
    
  /*   echo  $pname.'<br>'; */



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

$departuredate = date('M d, Y',strtotime($row['departuredate']));
$departuretime = date('H:i A',strtotime($row['departuretime']));

$returndate = date('M d, Y',strtotime($row['returndate']));
$returntime = date('H:i A',strtotime($row['returntime']));

$nod=$row['nod'];
$type=$row['type'];


$receiveddate = date('M d, Y',strtotime($row['receiveddate']));
$receivedby = $row['receivedby'];

$av = $row['av'];
$ad = $row['ad'];
$plate = $row['plate'];

$av1 = $row['av1'];
$ad1 = $row['ad1'];
$plate1 = $row['plate1'];

$av2 = $row['av2'];
$ad2 = $row['ad2'];
$plate2 = $row['plate2'];

$flag = $row['flag'];

$status = $row['status'];
$stat="";

if($status=='cancelled'){
$stat='cancelled.png';
}
else{
$stat='';
}


if($flag=="Calamba"){
$sign = "DR. CARINA S. CRUZ";
$pos = "Chief FAD";

}
else{
$sign = "ARIEL O. IGLESIA";
$pos = "Regional Director";

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
    "passengers"=>$pname,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "receiveddate"=>$receiveddate,
    "receivedby"=>$receivedby,
    "av"=>$av,
    "ad"=>$ad,
    "plate"=>$plate,
    "av1"=>$av1,
    "ad1"=>$ad1,
    "plate1"=>$plate1,
    "av2"=>$av2,
    "ad2"=>$ad2,
    "plate2"=>$plate2,
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
    "passengers"=>$pname,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "receiveddate"=>$receiveddate,
    "receivedby"=>$receivedby,
    "av"=>$av,
    "ad"=>$ad,
    "plate"=>$plate,
    "av1"=>$av1,
    "ad1"=>$ad1,
    "plate1"=>$plate1,
    "av2"=>$av2,
    "ad2"=>$ad2,
    "plate2"=>$plate2,
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
    "passengers"=>$pname,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "receiveddate"=>$receiveddate,
    "receivedby"=>$receivedby,
    "av"=>$av,
    "ad"=>$ad,
    "plate"=>$plate,
    "av1"=>$av1,
    "ad1"=>$ad1,
    "plate1"=>$plate1,
    "av2"=>$av2,
    "ad2"=>$ad2,
    "plate2"=>$plate2,
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
    "passengers"=>$pname,
    "ddate"=>$departuredate,
    "dtime"=>$departuretime,
    "rdate"=>$returndate,
    "rtime"=>$returntime,
    "receiveddate"=>$receiveddate,
    "receivedby"=>$receivedby,
    "av"=>$av,
    "ad"=>$ad,
    "plate"=>$plate,
    "av1"=>$av1,
    "ad1"=>$ad1,
    "plate1"=>$plate1,
    "av2"=>$av2,
    "ad2"=>$ad2,
    "plate2"=>$plate2,
    "sign"=>$sign,
    "pos"=>$pos,
    "cancelled"=>$stat);

}



}

}



$PHPJasperXML->load_xml_file("report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
$PHPJasperXML->outpage("I");
//page output method I:standard output  D:Download file


?>
