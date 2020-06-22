<?php
session_start();

function getCompleteName()
{
    include 'connection.php';
    $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo ucfirst(strtolower($row['FIRST_M'])).' '.ucfirst(strtolower($row['LAST_M']));
    }
}
function getPosition()
{
    include 'connection.php';
    $query = "SELECT POSITION_M FROM tblpersonneldivision 
              INNER JOIN tblemployeeinfo on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C 
              INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
              where tblemployeeinfo.UNAME = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo $row['POSITION_M'];
    }
}
function getOffice()
{
    include 'connection.php';
    $query = "SELECT DIVISION_M FROM tblpersonneldivision 
              INNER JOIN tblemployeeinfo on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C 
              INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
              where tblemployeeinfo.UNAME = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo $row['DIVISION_M'];
    }
}
function showData()
{

    include 'connection.php';
    $query = "SELECT * FROM tbltravel_claim_info2 where ID = ".sample()."";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
        
                echo '<input 
                type = "text" 
                style = "width:89%;padding:5px;border:1px solid gray;"
                value = "'.$row['RO_TO_OB'].'"
                />'; 
        }
    }else{
        echo ' <button
        class = "btn btn-success btn-md"
        style = "width:10.5%;"
        data-toggle="modal"  
        data-target="#editModal" 
        id= "editbtn" 
        class = "btn btn-primary btn-xs">
        
    
        Add Travel
        </button>';
    }

    
}
function sample()
{
    $id = '';
    $id1 =$_GET['id'];
    include 'connection.php';
    $query = "SELECT * FROM tbltravel_claim_info2 order by ID desc limit 1";
    $result = mysqli_query($conn, $query);
    if($row = mysqli_fetch_array($result))
    {
    }
    if ($id1 = '')
    {
        $id = $row['ID']+1;

    }else{
        $id = $id1;
    }
       return $id;
}
    

?>
