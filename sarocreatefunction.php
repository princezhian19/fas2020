
<?php
//include('../@classes/db.php');


//$date = json_decode($_POST["date"]);
$saronumber = json_decode($_POST["saronumber"]);

$fund = json_decode($_POST["fund"]);
$legalbasis = json_decode($_POST["legalbasis"]);
$ppa = json_decode($_POST["ppa"]);
$expenseclass = json_decode($_POST["expenseclass"]);
$particulars = json_decode($_POST["particulars"]);
$uacs = json_decode($_POST["uacs"]);
$amount = json_decode($_POST["amount"]);
$obligated = json_decode($_POST["obligated"]);
$balance = json_decode($_POST["balance"]);
$group = json_decode($_POST["group"]);


    $con=mysqli_connect("localhost","root","","db_dilg_pmis");
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    

    for ($i = 0; $i < count($saronumber); $i++) {
        if(($saronumber[$i] != "")){ /*not allowing empty values and the row which has been removed.*/
            
        
            $sql = "INSERT INTO saro (sarodate,saronumber,fund,legalbasis,ppa,expenseclass,particulars,uacs,amount,obligated,balance,sarogroup) 
            VALUES (now(),'$saronumber[$i]','$fund[$i]','$legalbasis[$i]','$ppa[$i]','$expenseclass[$i]','$particulars[$i]','$uacs[$i]','$amount[$i]','$obligated[$i]','$amount[$i]','$group[$i]')";
               if (!mysqli_query($con,$sql))
               {
               die('Error: ' . mysqli_error($con));
              
               }else{
             
               }
              
            }
            else{
                Print "Fund Source Field Canot be Empty";

            }
        
        }
        Print "Data added Successfully !";
        mysqli_close($con);

/* if($query){
    
    //if query is successful
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Data Added Successfully!')
    window.location.href='../@saro.php';
    </SCRIPT>");

    //header('Location:../@obligation.php?message=Data Added Successfully!');

}
else{

    //if query has error
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    
    window.alert('Error!')
    
    window.location.href='../@saro.php?message=Error!';
    </SCRIPT>");
    
} */

/* } */
?>
