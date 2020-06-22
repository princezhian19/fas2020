<?php
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
function showData()
{
    include 'connection.php';
    $query = "SELECT * FROM tbltravel_claim_info2 where `NAME` = '".$_GET['username']."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
        ?>
        <tr>
        <td colspan = 9 style = "background-color:#B0BEC5;">
        <input 
                type = "text" 
                style = "width:100%;padding:5px;border:1px solid gray;"
                value = "<?php echo $row['RO_TO_OB']; ?>"
                readonly
        />
        </td>
        </tr>
        <tr>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
                <td><input type = "text" class = "form-control"/></td>
        </tr>
       
        <?php
        }
        ?>
        <tr>
            <td colspan = 9>
                <button class = "btn btn-success btn-md" style = "width:10.5%;" data-toggle="modal" data-target="#editModal" id= "editbtn" class = "btn btn-primary btn-xs"> Add Travel </button>
                <button class = "btn btn-primary btn-md" data-toggle = "modal" data-target = "#add_travel_dates" id = "travelbtn"> Add Travel Dates </button>
            </td>
        </tr>
        <?php
    }else{
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

    

?>
