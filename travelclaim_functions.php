<?php
function getCompleteName()
{
    include 'connection.php';
    $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        echo ucwords(strtolower($row['FIRST_M'])).' '.ucfirst(strtolower($row['LAST_M']));
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
function fill()
{
    include 'connection.php';
    $query = "SELECT * FROM tbltravel_claim_info2 where ID = ".sample()."";
    echo $query.'<br>';
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
        }
    }
}
function aa($id)
{
    include 'connection.php';

    $query1 = "SELECT * FROM tbltravel_claim_info2 INNER JOIN tbltravel_claim_info on tbltravel_claim_info2.ID = tbltravel_claim_info.TC_ID WHERE tbltravel_claim_info.`TC_ID` = '".$id."'";
    $result1 = mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1) > 0)
    {
        while($row1 = mysqli_fetch_array($result1))
        {
        ?>
        
        <tr>
            <td><input type = "text" class = "form-control" value = "<?php echo date('F d, Y', strtotime($row1['DATE']));?>"/></td>
            <td><textarea cols = 50 style = "resize:none;"><?php echo $row1['PLACE'];?></textarea></td>
            <td><input type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['ARRIVAL']));?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['DEPARTURE']));?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row1['MOT'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row1['TRANSPORTATION'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row1['PERDIEM'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row1['OTHERS'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row1['TOTAL_AMOUNT'];?>"/></td>
        </tr>
        
        <?php
        }
    }

}
function showData()
{
    include 'connection.php';
    $query = "SELECT * FROM tbltravel_claim_info2  WHERE `NAME` = '".$_GET['username']."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)    
    {
        while($row = mysqli_fetch_array($result))
        {
        ?>
        <tr>
            <td colspan = 9 style = "background-color:#B0BEC5;">
        <?php echo '<b>'.$row['RO_TO_OB'].'</b>'; ?>
            </td>
        </tr>
       
        
       
        <?php
        aa($row['ID']);
        }
        ?>
        <tr>
            <td colspan = 9>
                <?php 
                if(mysqli_num_rows($result) > 0)
                    {
                        ?>
                            <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                            <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
                        <?php
                    }else{
                        ?>
                            <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                            <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
                        <?php
                    }
                    ?>
                    
            </td>
        </tr>
        <?php
    }else{
        $query = "SELECT * FROM tbltravel_claim_info2 WHERE `NAME` = '".$_GET['username']."'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                ?>
        <tr>
            <td colspan = 9 style = "background-color:#B0BEC5;">
                <!-- <input type = "checkbox"> -->
                <input type = "text" style = "width:100%;padding:5px;border:1px solid gray;" value = "<?php echo $row['RO_TO_OB']; ?>" readonly />
            </td>
        </tr>
        <tr>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['DATE'];?>"/></td>
            <td><textarea ><?php echo $row['PLACE'];?></textarea></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['ARRIVAL'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['DEPARTURE'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['MOT'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['TRANSPORTATION'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['PERDIEM'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['OTHERS'];?>"/></td>
            <td><input type = "text" class = "form-control" value = "<?php echo $row['TOTAL_AMOUNT'];?>"/></td>
        </tr>
       
        <?php
            }
        }
        ?>
          <tr>
            <td colspan = 9>
                <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
            </td>
        </tr>

        <?php
    }

    
}
function getTotal()
{
    include 'connection.php';
    $query1 = "SELECT * FROM tbltravel_claim_info2  WHERE `NAME` = '".$_GET['username']."'";
    $result1 = mysqli_query($conn, $query1);
    
        if($row1 = mysqli_fetch_array($result1))
        {
                $query2 = "SELECT sum(`TOTAL_AMOUNT`)AS 'total' FROM tbltravel_claim_info  WHERE `TC_ID` = '".$row1['TC_ID']."'";
                $result2 = mysqli_query($conn, $query2);
                if(mysqli_num_rows($result2) > 0)
                {
                    if($row2 = mysqli_fetch_array($result2))
                    {
                        echo $row2['total'];
                    }
                }
            }
        
}

    

?>
