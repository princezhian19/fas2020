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
    

/* $view_query = mysqli_query($conn, "SELECT * from ob where id = '$id'");


while ($row = mysqli_fetch_assoc($view_query)) {

$id=$row['id'];

$obno = $row['obno'];


$date = date('F d, Y',strtotime($row['date']));
$office = $row['office'];
$name = $row['name'];
$purpose = $row['purpose'];
$place = $row['place'];
$obdate = date('F d, Y',strtotime($row['obdate']));


$timefrom = date('g:i A',strtotime($row['timefrom']));

$timeto = date('g:i A',strtotime($row['timeto']));



$uc = $row['uc'];
$place1 = $row['place1'];

$status = $row['status'];
$stat="";

if($status=='cancelled'){
$stat='cancelled.png';
}
else{
$stat='';
}

$PHPJasperXML = new PHPJasperXML(); 

if($uc=='yes'){
    $PHPJasperXML->arrayParameter=array(
        "obno"=>$obno,"date"=>$date,
        "name"=>$name,"purpose"=>$purpose,
        "place"=>$place,"obdate"=>$obdate,
        "timefrom"=>$timefrom,"timeto"=>$timeto,"field"=>$divchief,"divpos"=>$divpos,"place1"=>$place1,"yes"=>'correct.png',"no"=>'check1.png',"cancelled"=>$stat);
}
else if ($uc=='no'){
    $PHPJasperXML->arrayParameter=array(
        "obno"=>$obno,"date"=>$date,
        "name"=>$name,"purpose"=>$purpose,
        "place"=>$place,"obdate"=>$obdate,
        "timefrom"=>$timefrom,"timeto"=>$timeto,"field"=>$divchief,"divpos"=>$divpos,"place1"=>$place1,"yes"=>'check1.png',"no"=>'correct.png',"cancelled"=>$stat);
}
else{

    $PHPJasperXML->arrayParameter=array(
        "obno"=>$obno,"date"=>$date,
        "name"=>$name,"purpose"=>$purpose,
        "place"=>$place,"obdate"=>$obdate,
        "timefrom"=>$timefrom,"timeto"=>$timeto,"field"=>$divchief,"divpos"=>$divpos,"place1"=>$place1,"yes"=>'correct.png',"no"=>'check1.png',"cancelled"=>$stat);
}




    
} */

$PHPJasperXML->load_xml_file("report1.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
$PHPJasperXML->outpage("I");
//page output method I:standard output  D:Download file


?>
