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
//$name = $_GET['pos'];


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
    

$view_query = mysqli_query($conn, "SELECT * from travel_order where id = '$id'");



while ($row = mysqli_fetch_assoc($view_query)) {

$id=$row['id'];

$kita=$row['kita'];


$lastdate1 = $row['lastdate'];
if($lastdate1=='0000-00-00'){
  $lastdate = '';
}else{
$lastdate = date('F d, Y',strtotime($row['lastdate']));
}

//$lastdate = date('F d, Y',strtotime($row['lastdate']));
$tono = $row['tono'];


$date = date('F d, Y',strtotime($row['date']));

$office = $row['office'];
$name = $row['name'];
$purpose = $row['purpose'];
$place = $row['place'];



$fromdate = date('F d, Y',strtotime($row['fromdate']));


$todate = date('F d, Y',strtotime($row['todate']));



$timefrom = date('g:i A',strtotime($row['timefrom']));

$timeto = date('g:i A',strtotime($row['timeto']));


$uc = $row['uc'];

$fromplace = $row['fromplace'];
$contact = $row['contact'];
$vehicle = $row['vehicle'];
$pos = $row['pos'];

}



$PHPJasperXML = new PHPJasperXML(); 

    $PHPJasperXML->arrayParameter=array(
        "date"=>$date,"tono"=>$tono,"name"=>$name,"position"=>$pos,"kita"=>$kita,"place"=>$fromplace,"toplace"=>$place,
        "contact"=>$contact,"fromdate"=>$fromdate,"timefrom"=>$timefrom,"timeto"=>$timeto,"purpose"=>$purpose,
        "vehicle"=>$vehicle,"lastdate"=>$lastdate,"divchief"=>$divchief,"divpos"=>$divpos);






    


$PHPJasperXML->load_xml_file("report3.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
$PHPJasperXML->outpage("I");
//page output method I:standard output  D:Download file


?>
