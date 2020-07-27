
<?php
//include('../@classes/db.php');
//nta



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

      /*   if(isset($_POST["charge"]))
        { */
    
            for($i=0;$i < count($_POST['charge']); $i++)
            {
                /* https://stackoverflow.com/questions/7856980/jquery-input-array-form-ajax */

                $charge  = $_POST['charge'][$i];
                $ntano  = $_POST['ntano'][$i];
                $ntaamount  = $_POST['ntaamount'][$i];
              
                include 'connection.php';
              
                // ===============================================================
                $insert ="INSERT INTO dv_nta (dv, type, accno, amount) values ('$dv',".$_POST['charge'][$i].",".$_POST['ntano'][$i].",".$_POST['ntaamount'][$i].")";
                if (mysqli_query($con, $insert)) {
                } else {
                    
                }
              }
        
        // }  
   
      $update = mysqli_query($con,"Update saroobburs set dvstatus = 'Disbursed'  where burs = '$burs'");
      /* //updating balance
      $update = mysqli_query($con,"Update saro set balance = amount - obligated where saronumber = '$saronum[$i]' and uacs = '$uacs[$i]' ");
      $dvinsert = mysqli_query($con,"INSERT INTO disbursement (ors,sr,ppa,uacs,payee,particular,amount) VALUES ('$ors[$i]','$saronum[$i]','$ppa[$i]','$uacs[$i]','$payee[$i]','$particular[$i]','$amount[$i]')"); */
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


      for($i=0;$i < count($_POST['charge']); $i++)
      {
          /* https://stackoverflow.com/questions/7856980/jquery-input-array-form-ajax */

          $charge  = $_POST['charge'][$i];
          $ntano  = $_POST['ntano'][$i];
          $ntaamount  = $_POST['ntaamount'][$i];
        
          include 'connection.php';
        
          // ===============================================================
          $insert ="INSERT INTO dv_nta (dv, type, accno, amount) values ('$dv',".$_POST['charge'][$i].",".$_POST['ntano'][$i].",".$_POST['ntaamount'][$i].")";
          if (mysqli_query($con, $insert)) {
          } else {
              
          }
        }
    
    
      $update = mysqli_query($con,"Update saroob set dvstatus = 'Disbursed'  where ors = '$ors'");
      /* //updating balance
      $update = mysqli_query($con,"Update saro set balance = amount - obligated where saronumber = '$saronum[$i]' and uacs = '$uacs[$i]' ");
      $dvinsert = mysqli_query($con,"INSERT INTO disbursement (ors,sr,ppa,uacs,payee,particular,amount) VALUES ('$ors[$i]','$saronum[$i]','$ppa[$i]','$uacs[$i]','$payee[$i]','$particular[$i]','$amount[$i]')"); */
    }

}





// Print $datestr;
Print "Disbursement added Successfully !";
mysqli_close($con);
?>