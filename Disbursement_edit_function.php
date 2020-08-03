<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username1 = $_SESSION['username'];
}

?>
<?php
if(isset($_POST["submit"]))
{

$mode = $_POST["mode"];
$burs = $_POST["ors"];
$ors = $_POST["ors1"];
$orsdate1= $_POST["orsdate"];
$orsdate = date('Y-m-d', strtotime($orsdate1));
$dv = $_POST["dv"];
$dvdate1 = $_POST["dvdate"];
$dvdate = date('Y-m-d', strtotime($dvdate1));
$payee = $_POST["payee"];
$particular = $_POST["particular"];
$amount = $_POST["amount"];
$deductions = $_POST["deductions"];
$net = $_POST["net"];
$tax = $_POST["tax"];
$gsis = $_POST["gsis"];
$pagibig = $_POST["pagibig"];
$philhealth = $_POST["philhealth"];
$total = $_POST["total"];
$other = $_POST["other"];
$remarks = $_POST["remarks"];
$status = $_POST["status"];
$charge = $_POST["charge"];
$ntano  = $_POST['ntano'];
$ntaamount  = $_POST['ntaamount'];

$con=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if($mode=="BURS"){
  
    $sql = "UPDATE disbursement set dv='$dv',ors='$burs',datereceived='$orsdate',date_proccess='$dvdate',payee='$payee',particular='$particular',amount='$amount',tax='$tax',gsis='$gsis',pagibig='$pagibig',philhealth='$philhealth',other='$other',total='$total',net='$net',datereleased='$dvdate',remarks='$remarks',status='$status',flag='BURS' where dv = '$dv' ";
    if (!mysqli_query($con,$sql))
    {
    die('Error: ' . mysqli_error($con));
   
    }
    else{
   
      $update = mysqli_query($con,"Update saroobburs set dvstatus = '$status'  where burs = '$burs'");
     
    }
        mysqli_close($con);
        if($update){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Disbursement Updated Successfully!')
        window.location.href='disbursement.php';
        </SCRIPT>"); 

        }
        else{

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Error!')

        window.location.href='disbursement.php';
        </SCRIPT>");
        }
}
else{
   $sql = "UPDATE disbursement set dv='$dv',ors='$ors',datereceived='$orsdate',date_proccess='$dvdate',payee='$payee',particular='$particular',amount='$amount',tax='$tax',gsis='$gsis',pagibig='$pagibig',philhealth='$philhealth',other='$other',total='$total',net='$net',datereleased='$dvdate',remarks='$remarks',status='$status',flag='ORS' where dv = '$dv' ";
    if (!mysqli_query($con,$sql))
    {
    die('Error: ' . mysqli_error($con));
   
    }
    
    else{

      $update = mysqli_query($con,"Update saroobburs set dvstatus = '$status'  where burs = '$burs'");
     
    }
        mysqli_close($con);
        if($update){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Disbursement Updated Successfully!')
        window.location.href='disbursement.php';
        </SCRIPT>"); 

        }
        else{

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Error!')

        window.location.href='disbursement.php';
        </SCRIPT>");
        }
}


}

   
// Print $datestr;
// Print "Disbursement added Successfully !";

?>