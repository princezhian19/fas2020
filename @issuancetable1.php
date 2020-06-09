<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}
  //echo $username;

  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $username = $_SESSION['username'];

  //echo $username;
  $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'");
  $rowdiv = mysqli_fetch_array($select_user);
  $DIVISION_C = $rowdiv['DIVISION_C'];
 
  $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
  $rowdiv1 = mysqli_fetch_array($select_office);
  $DIVISION_M = $rowdiv1['DIVISION_M'];

  //echo $DIVISION_M;
?>
 <?php
                 
                  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                  $username = $_SESSION['username'];

                  //echo $username;
                  $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'");
                  $rowdiv = mysqli_fetch_array($select_user);
                  $DIVISION_C = $rowdiv['DIVISION_C'];

                  $select_office = mysqli_query($conn, "SELECT DIVISION_M from tblpersonneldivision where DIVISION_N = '$DIVISION_C'");
                  $rowdiv1 = mysqli_fetch_array($select_office);
                  $DIVISION_M = $rowdiv1['DIVISION_M'];
                  //echo $DIVISION_M;
                ?>


<?php
// include('db.class.php'); // call db.class.php
$edit="edit";

?>
<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>


</head>
<body>
<div class="box">
  <div class="box-body">
          
          <h1 align="">Issuances</h1>
          
          <br>
        
          <div class=""  style="overflow-x:auto;">
         
            <!-- <li class="btn btn-success"><a href="CreateIssuances.php" style="color:white;text-decoration: none;">Add</a></li> -->
        <li class="btn btn-success"><a href="issuances.php" style="color:white;text-decoration: none;">Back</a></li>
        
          
              <br>
              <br>
              
            </div>

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center">


                  <th width = '250'>CATEGORY</th>
                  <th width = '200'>ISSUANCE NO</th>
                  <th width = '200'>ISSUANCE DATE</th>
                  <th width = '500'>TITLE/SUBJECT</th>
                  <th width = '100'>ACTION</th>
                  
                </tr>
                </thead>
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT issuances.office_responsible,issuances.id,issuances.category, issuances.issuance_no, issuances.date_issued, issuances.subject, issuances_category.name from issuances left join issuances_category on issuances.category=issuances_category.id where issuances.office_responsible = '$DIVISION_M' order by date_issued desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];
                  
                  $name = $row["name"];

                  $issuance_no  = $row["issuance_no"];
                
                  $date_issued1  = $row["date_issued"];
                  $date_issued = date('F d, Y', strtotime($date_issued1));
                   // $date_issued1 = date('F d, Y', strtotime($date1));
                  $subject = $row["subject"];

                  $office = $row["office_responsible"];
                  //echo $office;
                 

               ?>

                <tr align = ''>


                
              
                
               
                <td><?php echo $name?></td>
                <td><?php echo $issuance_no?></td>
                <td><?php echo $date_issued?></td>
                <td><?php echo $subject?></td>

                <td>
                 

                          <a  href='ViewIssuances.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a>
                                          

                </td>
                
               

                </tr>

            
            <?php }?>



             
            </table>
                
                </div>
            </div>
 
    <script type="text/javascript">
    $(document).ready(function() {
        var dataTable=$('#example1').DataTable({
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true,
            "order": [[ 1, "asc" ]],
            aLengthMenu: [ [10, 20, -1], [ 10, 20, "All"] ],
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
            });
        
    } );
</script>





</body>
</html>



