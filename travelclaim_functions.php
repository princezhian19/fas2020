<?php
session_start();
    function getCompleteName()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(strtoupper($row['FIRST_M'])).' '.ucfirst(strtoupper($row['LAST_M']));
            echo $name;
        }
    }
    function viewCompleteName($emp_name)
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo inner join tbltravel_claim_info2 on tblemployeeinfo.UNAME = tbltravel_claim_info2.NAME where CONCAT(tblemployeeinfo.FIRST_M,' ',tblemployeeinfo.LAST_M) = '".$emp_name."'";
        $result = mysqli_query($conn, $query);
        if($row = mysqli_fetch_array($result))
        {
            $name = ucwords(strtoupper($row['FIRST_M'])).' '.ucfirst(strtoupper($row['LAST_M']));
            echo $name;
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
    function viewPosition($emp_name)
    {
        include 'connection.php';
        $query = "SELECT POSITION_M FROM tblpersonneldivision 
                INNER JOIN tblemployeeinfo on tblpersonneldivision.DIVISION_N = tblemployeeinfo.DIVISION_C 
                INNER JOIN tbldilgposition on tblemployeeinfo.POSITION_C = tbldilgposition.POSITION_ID
                where CONCAT(tblemployeeinfo.FIRST_M,' ',tblemployeeinfo.LAST_M) = '".$emp_name."' ";
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
    function viewOffice($emp_name)
    {
        include 'connection.php';
        $query = "SELECT OFFICE_STATION   from tblemployeeinfo where CONCAT(tblemployeeinfo.FIRST_M,' ',tblemployeeinfo.LAST_M) ='".$emp_name."' ";
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
        $query1 = "SELECT * FROM tbltravel_claim_info2  WHERE `NAME` = '".$_SESSION['username']."'  ORDER BY ID DESC LIMIT 1";
        $result1 = mysqli_query($conn, $query1);
        
            if($row1 = mysqli_fetch_array($result1))
            {
                    $query2 = "SELECT sum(`TOTAL_AMOUNT`)AS 'total' FROM tbltravel_claim_info inner join tbltravel_claim_info2 on  tbltravel_claim_info.TC_ID = tbltravel_claim_info2.ID  WHERE `RO_TO_OB` = '".$_GET['ro']."'";
                    $result2 = mysqli_query($conn, $query2);
                    if(mysqli_num_rows($result2) > 0)
                    {
                        if($row2 = mysqli_fetch_array($result2))
                        {
                ECHO '<span style = "margin-left:79%;color:red;font-weight:bold;">₱ &nbsp;'.sprintf("%.2f",$row2['total']).'</span>';
                        }
                    }else{
                    }
                }
            
    }
    function getDistance()
    {
        include 'connection.php';
        $query1 = "SELECT DISTANCE FROM tbltravel_claim_info2  WHERE `RO_TO_OB` = '".$_GET['ro']."'";
        $result1 = mysqli_query($conn, $query1);
        
            if($row1 = mysqli_fetch_array($result1))
            {
                echo str_replace('km', '', $row1['DISTANCE']);
            }
    }
    function deleteTravelOrder()
    {
        include 'connection.php';
        $insert ="DELETE FROM `tbltravel_claim_info` WHERE `ID` = '".$_POST['id']."' ";
        if (mysqli_query($conn, $insert)) {
        } else {
        }
    }
    function deleteAll()
    {
        
        include 'connection.php';
        $del1 ="DELETE FROM `tbltravel_claim_info2` WHERE `RO_TO_OB` = '".$_POST['ro']."' ";
        if (mysqli_query($conn, $del1)) {
        } else {
        }
        echo $del1;
        $del2 ="DELETE FROM `tbltravel_claim_info` WHERE `RO`= '".$_POST['id']."' ";
        if (mysqli_query($conn, $del2)) {
        } else {
        }

        $del3 ="DELETE FROM `tbltravel_claim_ro` WHERE `ID`= '".$_POST['id']."' ";
        if (mysqli_query($conn, $del3)) {
        } else {
        }
    }
    function getPurposeTravel($username)
    {
        include 'connection.php';
        $query1 = "SELECT RO_TO_OB FROM tbltravel_claim_info2  WHERE `NAME` = '".$username."'";
        $result1 = mysqli_query($conn, $query1);
        
            while($row1 = mysqli_fetch_array($result1))
            {
                echo $row1['RO_TO_OB']; // returns 'd'
            }
    }
    function add()
    {
        include 'connection.php';

        $query = "SELECT OFFICE_STATION   from tblemployeeinfo where UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        $station = '';
        if($row = mysqli_fetch_array($result))
        {

        $station = $row['OFFICE_STATION'];
        
        $insert ="INSERT INTO `tbltravel_claim`(`ID`, `ENTITY_NAME`, `FUND_CLASTER`, `NAME`, `NO`, `DATE_OF_TRAVEL`, `PURPOSE`, `POSITION`, `OFFICIAL_STATION`,`IS_SUBMIT`) VALUES 
        (null,'".$_POST['entity_name']."','".$_POST['fund_cluster']."','".$_POST['complete_name']."','".$_POST['numero']."','".date('Y-m-d',strtotime($_POST['date_of_travel']))."','".$_POST['purpose_of_travel']."','".$_POST['position']."','".$station ."',1)";
     
     
     
        if (mysqli_query($conn, $insert)) {
            } else {
            }
        
            header('Location:CreateTravelClaim.php?username='.$_SESSION['username'].'&division='.$_SESSION['division'].'');
            }   
    }
    function showActivityTitle()
    {
        include 'connection.php';
        $query = "SELECT RO_OT_OB FROM `tbltravel_claim_ro` WHERE UNAME = '".$_SESSION['username']."'  order by id desc limit 1 ";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)    
        {
        while($row = mysqli_fetch_array($result))
        {
            ?>
                <input type = "text" name = "ro[]" class = "form-control " value = "<?php echo $row['RO_OT_OB']?>" required/>
            <?php
           
       
        }
        }
        else{
            ?>
            <input type = "text" name = "ro" class = "form-control " value = "<?php echo $row['RO_OT_OB']?>" required/>
        <?php
        }
 
    }
    function editTravelData()
    {
        for($a=0;$a < count($_POST['mot']); $a++)
        {
            echo $_POST['mot'][$a];
        }
    }
    function mealsCheckBoxes($breakfast,$lunch,$dinner)
    {
    
        if($breakfast == 1 && $lunch == 1 && $dinner == 1 )
        {
        ?>
        <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
        <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast" checked> Breakfast
        <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" checked> Lunch
        <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" checked> Dinner
        <?php
        }
        else if($breakfast != 1 && $lunch == 1 && $dinner == 1 ){
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast" > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" checked> Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" checked> Dinner
          <?php
        }
        else if($breakfast== 1 && $lunch != 1 && $dinner == 1 ){
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast" checked > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" > Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" checked> Dinner
          <?php
        }
        else if($breakfast== 1 && $lunch == 1 && $dinner != 1 ){
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast" checked > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" checked > Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" > Dinner
          <?php
        }
        else if($breakfast== 1 && $lunch != 1 && $dinner != 1 ){
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast" checked > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch"  > Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" > Dinner
          <?php
        }
        else if($breakfast!= 1 && $lunch == 1 && $dinner != 1 ){
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast"  > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" checked> Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" > Dinner
          <?php
        }
        else if($breakfast!= 1 && $lunch != 1 && $dinner == 1 ){
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" checked> <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast"  > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" > Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" checked> Dinner
          <?php
        }else{
          ?>
          <input type="checkbox" name="meals"  class="minimal-red checkboxgroup1 cb1" > <b>Will Claim Meals</b><br>
          <input style = "margin-left:14px" type="checkbox" name="breakfast[]" class="minimal-red checkboxgroup breakfast"  value = "breakfast"  > Breakfast
          <input type="checkbox" name="lunch[]" class="minimal-red checkboxgroup lunch"  value = "lunch" > Lunch
          <input type="checkbox" name="dinner[]"  class="minimal-red checkboxgroup dinner"  value = "dinner" > Dinner
          <?php
        }
        
        
        
    }
    function modifyTravelDate()
    {
        for($a=0;$a < count($_POST['date']); $a++)
        {
            if(isset($_POST['breakfast'][$a]) || isset($_POST['lunch'][$a]) || isset($_POST['dinner'][$a]) || isset($_POST['wor_txt'][$a])) 
                { 
                    $breakfast = $_POST['breakfast'][$a]; 
                    $lunch = $_POST['lunch'][$a]; 
                    $dinner = $_POST['dinner'][$a]; 
                    $receipt = $_POST['wor_txt'][$a]; 
                    $distance = $_POST['distance'][$a];
                    $distance_value = 0;
                    
                    if($breakfast == 'breakfast') 
                    { 
                        $breakfast = 1; 
                    } 
                    if($lunch == 'lunch') 
                    { 
                        $lunch = 1; 
                    } 
                    if($dinner == 'dinner') 
                    { 
                        $dinner = 1; 
                    } 
                    if($receipt == 'Without Receipt') 
                    { 
                        $receipt = 1100; 
                    } 
                    if($distance > 50)
                    {
                        $distance_value = 440;
                    }
                    else{
                        $distance_value = 0.00;
                    }
                    $perdiem = $breakfast+$lunch+$dinner+$receipt+$distance_value; 
                    $transpo = $_POST['fare'][$a];
                    $total_amount = $breakfast+$lunch+$dinner+$receipt+$distance_value+$transpo; 
                }else
                { 
                    $perdiem = 0; 
                    $breakfast = 0.00;
                    $lunch = 0.00;
                    $dinner = 0.00;
                    $receipt = 0.00;
                    $total_amount = 0.00;
                }
            $id = $_POST['ID'][$a];
            $RO = $_POST['RO'][$a];
            $tc_id = $_POST['TC_ID'][$a];
            $ro = $_POST['RO'][$a];
            $title = $_POST['ro'][$a];
            $date = date('Y-m-d',strtotime($_POST['date'][$a]));
            $departure = date('h:m:s',strtotime($_POST['departure'][$a]));
            $arrival = date('h:m:s',strtotime($_POST['arrival'][$a]));
            $others = $_POST['others'][$a];
            $from = $_POST['from1'][$a];
            $to = $_POST['to1'][$a];
            $mot = $_POST['mot'][$a];
            $fare = $_POST['fare'][$a];

            include 'connection.php';

            $UPDATE =" UPDATE `tbltravel_claim_info` SET 
            `TC_ID`='".$tc_id."',
            `RO`='".$ro."',
            `DATE`='".$date."',
            `PLACE`='".$from." to ".$to."',
            `ARRIVAL`='".$arrival."',
            `DEPARTURE`='".$departure."',
            `MOT`='".$mot."',
            `TRANSPORTATION`='".$fare."',
            `BREAKFAST`='".$breakfast."',
            `LUNCH`='".$lunch."',
            `DINNER`='".$dinner."',
            `ACCOMODATION`='',
            `RECEIPT`='".$receipt."',
            `PERDIEM`='".$perdiem."',
            `OTHERS`='".$others."',
            `TOTAL_AMOUNT`='".$total_amount."' WHERE  `ID` = '".$id."'";
            if (mysqli_query($conn, $UPDATE)) {
            } else {
            }

            $UPDATE2 = "UPDATE `tbltravel_claim_ro` SET `RO_OT_OB`='".$title."' WHERE  `ID` = '".$RO."'";
            if (mysqli_query($conn, $UPDATE2)) {
            } else {
            }
      echo $UPDATE2;
      exit();
            header('Location:CreateTravelClaim.php?username='.$_SESSION['username'].'&division='.$_SESSION['division'].'');
            
        }
    }
    $func = '';
    if(isset($_POST['action']))
    {
        $action = $_POST['action'];
        if($action == 'deleteTravelOrder' )
        {   
            deleteTravelOrder();
        }else if($action == 'deleteAll')
        {
            deleteAll();
        }
    }else if(isset($_GET['action'])){
        $action2 = $_GET['action'];
        if($_GET['action']  == 'add')
        
        {
            add();
            // echo 'a';
        }
        else if($_GET['action'] == 'modify')
        {
            editTravelData();   
        }
        else if($_GET['action'] == 'modifyTravelDate')
        {
            modifyTravelDate();
        }
    }
?>
