<?php
include('db.class.php'); // call db.class.php

?>
<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>
</head>
<body>
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <?php
            $saronumber="";
            $uacs="";
            if (isset($_POST['submit'])) 
            {
                
            $saronumber = $_POST['saronumber'];
            $uacs = $_POST['uacs'];
            }
            ?>
            <h1 align="">&nbspObligation Management</h1>
            <h1>&nbspExport at SARO No.:    <?php echo $saronumber ?> and UACS Object Code:    <?php echo $uacs ?> </h1>
             <div class="box-header with-border">
    </div>
    <br>
      
         <div class="class">
         <div class="col-md-2">
          &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="@obligation.php" style="color:white;text-decoration: none;">Back</a></li>
          </div>
          <div class="col-md-8">
            
          </div>
          <div class="col-md-2">
           
            <?php
            $saronumber="";
            $uacs="";
            if (isset($_POST['submit'])) 
            {
                
            $saronumber = $_POST['saronumber'];
            $uacs = $_POST['uacs'];
            }
            
            
            ?>
            <form method = "POST" action = "@Functions/obexportfilter.php">
            <input readonly type="text" class="hidden" style="height: 40px; width: 200px" id="" placeholder="Enter SARO Number" name="saronumber" value="<?php echo $saronumber ?>" >
            <input readonly type="text" class="hidden" style="height: 40px; width: 200px" id="" placeholder="Enter UACS Code" name="uacs" value="<?php echo $uacs ?>">
            &nbsp&nbsp&nbsp<button type="submit" name="submit" style="width:%; height: 40px" class="btn btn-success ">Export</button>
            </form>
            
          </div>
          
         </div>

      
      <br>
      <br>
      <br>

            <!-- table here -->

            <table id="example" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="800"></th>
                        <th width="800">DATE RECEIVED</th>
                        <th width="800">DATE PROCESSED</th>
                        <th width="800">DATE RETURNED</th>
                        <th width="800">DATE RELEASED</th>
                        <th width="800">ORS NUMBER</th>
                        <th width="800">PO NUMBER</th>
                        <th width="800">PAYEE</th>
                        <th width="800">PARTICULAR</th>
                        <th width="800">SARO NUMBER</th>
                        <th width="800">PPA</th>
                        <th width="800">UACS</th>
                        <th width="800">AMOUNT</th>
                        <th width="800">REMARKS</th>
                        <th width="800">ACTION</th>
                        
                        
                        <!-- <th width="0"></th> -->
                    </tr>
                </thead>
            
            <?php
            $servername = "localhost";

            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";

            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";

            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT * FROM saroob where saronumber = '$saronumber' and uacs ='$uacs' order by Date DESC");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];  
                  $datereceived = $row["datereceived"];
                  $datereprocessed = $row["datereprocessed"];
                  $datereturned = $row["datereturned"];
                  $datereleased = $row["datereleased"];
                  $ors = $row["ors"];
                  $ponum = $row["ponum"];
                  $payee = $row["payee"];
                  $particular = $row["particular"];
                  $saronumber = $row["saronumber"];
                  $ppa = $row["ppa"];
                  $uacs = $row["uacs"];
                  $amount = $row["amount"];
                  $date = $row["date"];
                  $remarks = $row["remarks"];
                    
                    echo "<tr align = ''>
                    <td></td>
                    <td>$datereceived</td>
                    <td>$datereprocessed</td>
                    <td>$datereturned</td>
                    <td>$datereleased</td>
                    <td>$ors</td>
                    <td>$ponum</td>
                    <td>$payee</td>
                    <td>$particular</td>
                    <td>$saronumber</td>
                    <td>$ppa</td>
                    <td>$uacs</td>
                    <td>$amount</td>
                    <td>$remarks</td>
                    <td>
                    
                    <a href='@obupdate.php?getid=$id'> <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    <a href='@Functions/obdeletefunction.php?getid=$id'> <i style='font-size:24px'<i class='fa fa-trash-o'></i> </a>
                    
                    </td>
                    
                    
                    <td></td>

                    </tr>"; 
                }
                echo "</table>";
            ?>       
                
            </table>
                
         
      </div>
    </div>
    
</div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>
</div>
</div>

   
<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



