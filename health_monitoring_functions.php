<?php
session_start();
date_default_timezone_set('Asia/Manila');
    function getFullName()
    {
        include 'connection.php';
        $query = "SELECT FIRST_M, concat(FIRST_M,' ', LAST_M) as 'fullname' from tblemployeeinfo  order by FIRST_M" ;
        $result = mysqli_query($conn, $query);
        echo '<option VALUE = "">ALL</option>';
        while($row = mysqli_fetch_array($result))
        {
            echo '<option>'.$row['fullname'].'</option>';
            
        }
    }
    function getDateE()
    {
        include 'connection.php';
        $query = "SELECT `DATE` from tblhealth_monitoring GROUP BY `DATE` order by `DATE`" ;
        $result = mysqli_query($conn, $query);
        echo '<option VALUE = "">ALL</option>';
        while($row = mysqli_fetch_array($result))
        {
            echo '<option>'.$row['DATE'].'</option>';
            
      
        }
    }

    function getOff()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblpersonneldivision  ";
        $result = mysqli_query($conn, $query);
        echo '<option VALUE = "">ALL</option>';
        while($row = mysqli_fetch_array($result))
        {
            echo '<option>'.$row['DIVISION_M'].'</option>';
            
      
        }

    }
    function getPositionFilter(){
        include 'connection.php';
        $query = "SELECT * FROM tbldilgposition  ";
        $result = mysqli_query($conn, $query);
        echo '<option VALUE = "">ALL</option>';
        while($row = mysqli_fetch_array($result))
        {
            echo '<option>'.$row['POSITION_M'].'</option>';
            
      
        }
    }
    function getEmpNo()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            
            echo $row['EMP_NUMBER'];
        }
    }
    function getLast()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(ucfirst(strtoupper($row['LAST_M'])));
            echo $name;
        }
    }
    function getFirst()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(ucfirst(strtoupper($row['FIRST_M'])));
            echo $name;
        }
    }
    function getMiddle()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(ucfirst(strtoupper($row['MIDDLE_M'])));
            echo $name;
        }
    }

    function getSignature()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $first = ucwords(ucfirst(strtoupper($row['FIRST_M'])));
            $middle = ucwords(ucfirst(strtoupper($row['MIDDLE_M'])));
            $last = ucwords(ucfirst(strtoupper($row['LAST_M'])));

            echo $first.'&nbsp;&nbsp;'.$middle.'&nbsp;&nbsp;'.$last;
        }
    }
    function getContact()
    {
        include 'connection.php';
        $query = "SELECT MOBILEPHONE FROM tblemployeeinfo where tblemployeeinfo.UNAME  =  '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $no = $row['MOBILEPHONE'];
            echo $no;
        }
    }
    function getEmail()
    {
        include 'connection.php';
        $query = "SELECT EMAIL FROM tblemployeeinfo where tblemployeeinfo.UNAME  =  '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $email = $row['EMAIL'];
            echo $email;
        }
    }
    function getAddress()
    {
        include 'connection.php';
        $query = "SELECT CURRENT_ADDRESS FROM tblemployeeinfo where tblemployeeinfo.UNAME  =  '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $address = $row['CURRENT_ADDRESS'];
            echo $address;
        }
    }
    function calculateAge(){
        include 'connection.php';
        $query = "SELECT BIRTH_D FROM tblemployeeinfo WHERE UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $birthDate = date('m/d/Y',strtotime($row['BIRTH_D']));


            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
              ? ((date("Y") - $birthDate[2]) - 1)
              : (date("Y") - $birthDate[2]));
            echo $age;
        }
    }
    function getGender(){
        include 'connection.php';
        $query = "SELECT SEX_C FROM tblemployeeinfo WHERE UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            echo $row['SEX_C'];
        }
    }
    function getOffice()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo a 
                  LEFT JOIN tblpersonneldivision b on b.DIVISION_N = a.DIVISION_C 
                  LEFT JOIN tbldesignation c on c.DESIGNATION_ID = a.DESIGNATION 
                  LEFT JOIN tbldilgposition d on d.POSITION_ID = a.POSITION_C WHERE UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            echo $row['DIVISION_M'];
        }
    }
    function getOfficeExport()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblpersonneldivision  ";
        $result = mysqli_query($conn, $query);
        echo '<select class="form-control " id="selectYear" style="width: 20%;">';
        
        while($row = mysqli_fetch_array($result))
        {
            
            echo '<option value = "'.$row['DIVISION_M'].'">'.$row['DIVISION_M'].'</option>';
        }
        echo ' </select> ';

    }
    

    // ======================= inserting =====================
    function add()
    {
          include 'connection.php';
$gender = $_POST['gender'];
if($gender == 'Male')
{
$last_period = '';
}else if($gender == 'Female'){
$last_period = date('Y-m-d',strtotime($_POST['lastperiod']));


}else{
$last_period = '';

}


        $insert ="INSERT INTO `tblhealth_monitoring`(`ID`, `DATE`,`LAST_PERIOD`, `UNAME`,`GENDER`,`BODY_TEMPERATURE`, `CURRENT_ADDRESS`, `WORK_ARRANGEMENT`, `QUESTION_1`, `QUESTION_2`, `QUESTION_3`, `QUESTION_4`, `QUESTION_5`, `DETAILS_1`, `DETAILS_2`, `DETAILS_3`, `DETAILS_4`,`DETAILS_5`,`IS_SUBMIT`) VALUES 
        (null,
        '".date('Y-m-d')."',
        '".$last_period."',
        '".$_SESSION['username']."',
        '".$_POST['gender']."',
        '".$_POST['body_temp']."',
        '".$_POST['curraddress']."',
        '".$_POST['work_arrangement']."',
        '".$_POST['ans1']."',
        '".$_POST['ans2']."',
        '".$_POST['ans3']."',
        '".$_POST['ans4']."',
        '".$_POST['ans5']."',
        '".$_POST['ans1_details']."',
        '".$_POST['ans2_details']."',
        '".$_POST['ans3_details']."',
        '".$_POST['ans4_details']."',
        '".$_POST['ans5_details']."',
        '1'
        )";
        

       
       if (mysqli_query($conn, $insert)) {
    } else {
    }
     
    


    $update = "UPDATE `tblemployeeinfo` SET `CURRENT_ADDRESS`= '".$_POST['curraddress']."' WHERE UNAME = '".$_SESSION['username']."' ";
    if (mysqli_query($conn, $update)) {
    } else {
    }
     
    }



if(isset($_GET['action'])){
    if($_GET['action'] == 'add')
    {
        add();
        header('Location:home.php?division='.$_SESSION['division'].'&username='.$_SESSION['username'].'');
    }
    if($_GET['action'] == 'add1')
    {
        add();
        header('Location:home1.php?division='.$_SESSION['division'].'&username='.$_SESSION['username'].'');
    }
    if($_GET['action'] == 'add2')
    {
        add();
        header('Location:home2.php?division='.$_SESSION['division'].'&username='.$_SESSION['username'].'');
    }
    
}
    
    

?>