
<?php
//include('../@classes/db.php');


$datereceived = json_decode($_POST["datereceived"]);


$datereprocessed = json_decode($_POST["datereprocessed"]);
//$d2 = date('Y-m-d', strtotime($datereprocessed));

$datereturned = json_decode($_POST["datereturned"]);
/* $datereturned = $_GET['datereturned'];
if($datereturned==''){
    $d3 = "";
}
else{
    $d3 =date('Y-m-d', strtotime($datereturned));
} */


$datereleased = json_decode($_POST["datereleased"]);
//$d4 = date('Y-m-d', strtotime($datereleased));

$ors = json_decode($_POST["ors"]);

$po = json_decode($_POST["ponum"]);
$payee = json_decode($_POST["payee"]);
$supplier = json_decode($_POST["supplier"]);
$particular = json_decode($_POST["particular"]);
$saronum = json_decode($_POST["saronum"]);
$ppa = json_decode($_POST["ppa"]);
$uacs = json_decode($_POST["uacs"]);
$amount = json_decode($_POST["amount"]);
$remarks = json_decode($_POST["remarks"]);
$sarogroup = json_decode($_POST["sarogroup"]);
$status = json_decode($_POST["status"]);


$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

for ($i = 0; $i < count($datereceived); $i++) {
if($ors[$i] != ""){ /*not allowing empty values and the row which has been removed.*/ 

    if($supplier[$i]==""){
     
       $sql = "INSERT INTO saroob (datereceived,datereprocessed,datereturned,datereleased,ors,ponum,payee,particular,saronumber,ppa,uacs,amount,remarks,sarogroup,status) 
       VALUES (now(),now(),'0000-00-00',now(),'$ors[$i]','$po[$i]','$payee[$i]','$particular[$i]','$saronum[$i]','$ppa[$i]','$uacs[$i]','$amount[$i]','$remarks[$i]','$sarogroup[$i]','$status[$i]')";
       
       
       if (!mysqli_query($con,$sql))
       {
       die('Error: ' . mysqli_error($con));
      // Print "Error";
       }
       
       else{
       
     
         //updating obligation
         $update = mysqli_query($con,"Update saro set obligated = obligated + $amount[$i] where saronumber = '$saronum[$i]' and uacs = '$uacs[$i]' ");
         //updating balance
         $update = mysqli_query($con,"Update saro set balance = amount - obligated where saronumber = '$saronum[$i]' and uacs = '$uacs[$i]' ");
         $dvinsert = mysqli_query($con,"INSERT INTO disbursement (ors,sr,ppa,uacs,payee,particular,amount) VALUES ('$ors[$i]','$saronum[$i]','$ppa[$i]','$uacs[$i]','$payee[$i]','$particular[$i]','$amount[$i]')");

       }
    }

    if($payee[$i]==""){
    
        $sql1 = "INSERT INTO saroob (datereceived,datereprocessed,datereturned,datereleased,ors,ponum,payee,particular,saronumber,ppa,uacs,amount,remarks,sarogroup,status) 
        VALUES (now(),now(),'0000-00-00',now(),'$ors[$i]','$po[$i]','$supplier[$i]','$particular[$i]','$saronum[$i]','$ppa[$i]','$uacs[$i]','$amount[$i]','$remarks[$i]','$sarogroup[$i]','$status[$i]')";
     if (!mysqli_query($con,$sql1))
     {
     die('Error: ' . mysqli_error($con));
     Print "Error";
     }
     
     else{
        
       //updating obligation
       $update1 = mysqli_query($con,"Update saro set obligated = obligated + $amount[$i] where saronumber = '$saronum[$i]' and uacs = '$uacs[$i]' ");
       //updating balance
       $update1 = mysqli_query($con,"Update saro set balance = amount - obligated where saronumber = '$saronum[$i]' and uacs = '$uacs[$i]' ");
       $dvinsert1 = mysqli_query($con,"INSERT INTO disbursement (ors,sr,ppa,uacs,payee,particular,amount) VALUES ('$ors[$i]','$saronum[$i]','$ppa[$i]','$uacs[$i]','$payee[$i]','$particular[$i]','$amount[$i]')");
     }
  
    } 
}

}

Print "Obligation added Successfully !";
mysqli_close($con);
?>