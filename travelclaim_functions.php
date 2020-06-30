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

   
    function getTotal()
    {
        include 'connection.php';
        $query1 = "SELECT * FROM tbltravel_claim_info2  WHERE `NAME` = '".$_GET['username']."'";
        $result1 = mysqli_query($conn, $query1);
        
            if($row1 = mysqli_fetch_array($result1))
            {
                    $query2 = "SELECT sum(`TOTAL_AMOUNT`)AS 'total' FROM tbltravel_claim_info  WHERE `TC_ID` = '".$row1['ID']."'";
                
                    $result2 = mysqli_query($conn, $query2);
                    if(mysqli_num_rows($result2) > 0)
                    {
                        if($row2 = mysqli_fetch_array($result2))
                        {
                ECHO '<span style = "margin-left:84%;color:red;font-weight:bold;">₱ &nbsp;'.$row2['total'].'</span>';
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
