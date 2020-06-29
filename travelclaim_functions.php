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
    $query = "SELECT OFFICE_STATION   from tblemployeeinfo where UNAME = '".$_SESSION['username']."' ";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
        switch ($row['OFFICE_STATION']) {
            case '1':
                ?>
                     <select required id="mySelect2" class="form-control" name="office" disabled>
                        <option selected disabled></option>
                        <option value="1" selected>Regional Office</option>
                        <option value="2">Provincial/HUC Office</option>
                        <option value="3">Cluster Office</option>
                        <option value="4">City/Municipal Office</option>
                    </select>
                <?PHP
                break;
            case '2':
                ?>
                        <select required id="mySelect2" class="form-control" name="office" disabled>
                        <option selected disabled></option>
                        <option value="1" >Regional Office</option>
                        <option value="2" selected>Provincial/HUC Office</option>
                        <option value="3">Cluster Office</option>
                        <option value="4">City/Municipal Office</option>
                    </select>
                <?PHP
                break;
            case '3':
                ?>
                        <select required id="mySelect2" class="form-control" name="office" disabled>
                        <option selected disabled></option>
                        <option value="1" >Regional Office</option>
                        <option value="2" >Provincial/HUC Office</option>
                        <option value="3" selected>Cluster Office</option>
                        <option value="4">City/Municipal Office</option>
                    </select>
                <?PHP
                break;
            case '4':
                ?>
                        <select required id="mySelect2" class="form-control" name="office" disabled>
                        <option selected disabled></option>
                        <option value="1" >Regional Office</option>
                        <option value="2" >Provincial/HUC Office</option>
                        <option value="3" >Cluster Office</option>
                        <option value="4" selected>City/Municipal Office</option>
                    </select>
                <?PHP
                break;
            
            default:
                # code...
                break;
        }
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
    $saved = array();

    if(mysqli_num_rows($result1) > 0)
    {
        while($row1 = mysqli_fetch_array($result1))
        {
            $saved[] = $row1["ID"]; // you are missing []

            if($row1['DATE'] == $row1['DATE'])
            {
                
               if($row1['ID'] > $saved[0] ){
                    ?>
            <td></td>

                    <?PHP
               }else{
                   ?>
            <td><input readonly id = "travel_date" type = "text" class = "form-control" value = "<?php echo date('F d, Y', strtotime($row1['DATE']));?>"/></td>

                   <?php
               }
                
            }else{
        ?>
        
   <tr>
      
            <?php }?>
            <td><textarea readonly cols = 50 style = "resize:none;background:#ECEFF1;border:1px solid #CFD8DC;"><?php echo $row1['PLACE'];?></textarea></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['ARRIVAL']));?>"/></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo date('g:i A',strtotime($row1['DEPARTURE']));?>"/></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['MOT'];?>"/></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['TRANSPORTATION'];?>"/></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['PERDIEM'];?>"/></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['OTHERS'];?>"/></td>
            <td><input readonly type = "text" class = "form-control" value = "<?php echo $row1['TOTAL_AMOUNT'];?>"/></td>
        </tr>
        
        <?php
        $row1['DATE'] = '';
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
function getDistance()
{
    include 'connection.php';
    $query1 = "SELECT DISTANCE FROM tbltravel_claim_info2  WHERE `NAME` = '".$_GET['username']."'";
    $result1 = mysqli_query($conn, $query1);
    
        if($row1 = mysqli_fetch_array($result1))
        {
            echo $row1['DISTANCE'];
        }
}

    

?>
