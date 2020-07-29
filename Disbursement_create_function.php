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
//include('../@classes/db.php');
//nta
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
  
    $sql = "INSERT INTO disbursement (dv,ors,datereceived,date_proccess,payee,particular,amount,tax,gsis,pagibig,philhealth,other,total,net,datereleased,remarks,status,flag) 
    VALUES ('$dv','$burs','$orsdate','$dvdate','$payee','$particular','$amount','$tax','$gsis','$pagibig','$philhealth','$other','$deductions','$net','$dvdate','$remarks','$status','BURS')";
    if (!mysqli_query($con,$sql))
    {
    die('Error: ' . mysqli_error($con));
   
    }
 
    else{

      if(isset($_POST["submit"]))
      {
            for($i=0;$i < count($_POST['charge']); $i++)
            {
                /* https://stackoverflow.com/questions/7856980/jquery-input-array-form-ajax */

                $charge  = $_POST['charge'][$i];
                $ntano  = $_POST['ntano'][$i];
                $ntaamount  = $_POST['ntaamount'][$i];
                $insert = mysqli_query($con,"INSERT INTO dv_nta (dv, type, accno, amount) values ('$dv','".$_POST['charge'][$i]."','".$_POST['ntano'][$i]."','".$_POST['ntaamount'][$i]."')"); 
                
                $nta = mysqli_query($con,"UPDATE nta set obligated = obligated+".$_POST['ntaamount'][$i].", balance = amount-obligated where particular = '".$_POST['ntano'][$i]."' "); 

               /*  echo "UPDATE nta set obligated = ".$_POST['ntaamount'][$i].", balance = amount-obligated where particular = '".$_POST['ntano'][$i]."' ";
                exit(); */
            }
        
        }  
   
      $update = mysqli_query($con,"Update saroobburs set dvstatus = '$status'  where burs = '$burs'");
     
    }
        mysqli_close($con);
        if($insert){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Disbursement Added Successfully!')
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
    $sql = "INSERT INTO disbursement (dv,ors,datereceived,date_proccess,payee,particular,amount,tax,gsis,pagibig,philhealth,other,total,net,datereleased,remarks,status,flag) 
    VALUES ('$dv','$ors','$orsdate','$dvdate','$payee','$particular','$amount','$tax','$gsis','$pagibig','$philhealth','$other','$deductions','$net','$dvdate','$remarks','$status','ORS')";
    if (!mysqli_query($con,$sql))
    {
    die('Error: ' . mysqli_error($con));
   
    }
    
    else{


      if(isset($_POST["submit"]))
      {
      
    
            for($i=0;$i < count($_POST['charge']); $i++)
            {
                /* https://stackoverflow.com/questions/7856980/jquery-input-array-form-ajax */
                $charge  = $_POST['charge'][$i];
                $ntano  = $_POST['ntano'][$i];
                $ntaamount  = $_POST['ntaamount'][$i];
              
                $insert = mysqli_query($con,"INSERT INTO dv_nta (dv, type, accno, amount) values ('$dv','".$_POST['charge'][$i]."','".$_POST['ntano'][$i]."','".$_POST['ntaamount'][$i]."')");
                
                $nta = mysqli_query($con,"UPDATE nta set obligated = obligated+".$_POST['ntaamount'][$i].", balance = amount-obligated where particular = '".$_POST['ntano'][$i]."' ");
                
                
            }
        
         }  
    
    
      $update = mysqli_query($con,"Update saroob set dvstatus = '$status'  where ors = '$ors'");
     
      mysqli_close($con);
      if($insert){
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Disbursement Added Successfully!')
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




    }

   
// Print $datestr;
// Print "Disbursement added Successfully !";

?>