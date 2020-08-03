<?php
date_default_timezone_set('Asia/Manila');
$timeNow = (new DateTime('now'))->format('m/d/Y');
//Replace now() Variable
// echo $timeNow;
/* value = "<?php echo $timeNow;?>" */
?>

<!DOCTYPE html>
<html>
<head>
<title>FAS</title>

</head>

<body>

<div class="box " style="border-style: groove;">
  <div class="box-body">
  
        <h1 align="">SARO/SUB-ARO</h1>
       
        <br>
        <br>




        <div class=""  style="overflow-x:auto;">
    
                <table class="table" > 

              <!-- Header -->
                <tr>
                <td class="col-md-1">
                <li class="btn btn-success"><a href="sarocreate.php" style="color:white;text-decoration: none;">Create</a></li>

              </td>

              <td class="col-md-7">
               
              </td>
                
                <form method = "POST" action = "@Functions/sarodateexport.php">
               
                <td class="col-md-1">
                <input autocomplete="off" type="text" class="" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 200px" value = "<?php echo $timeNow;?>">

               </td>
               <td class="col-md-1">
               <input autocomplete="off" type="text" class="" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 200px" value = "<?php echo $timeNow;?>">

               </td>
               <td class="col-md-1">
               <button style="color:white;text-decoration: none; height: 35px; " type="submit" name="submit"  class="btn btn-success pull-right">Filter/Export Data</button>

               </td>
               <td class="col-md-1">
               <li class="btn btn-success pull-right "><a href="@Functions/saroexportall.php" style="color:white;text-decoration: none; height: 35px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Export All&nbsp;&nbsp;&nbsp;</a></li>

               </td>

                </form>
              
                </tr>
                <!-- Header -->
        </table>
   </div>


        <div class=""  style="overflow-x:auto;">

          <br>
          <br>
          <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
            <thead style="text-align: center;">
              <tr style="background-color: white;color:blue; text-align: center;">
              <th width="">DATE</th>
                <th width="">SOURCE</th>
                <th width="">FUND</th>
                <th width="">LEGAL BASIS</th>
                <th width="">PPA</th>
                <th width="">EXPENSE CLASS</th>
                <th width="">PARTICULARS</th>
                <th width="">UACS</th>
                <th width="">ALLOTMENT</th>
                <th width="">OBLIGATED</th>
                <th width="">BALANCE</th>
                <th width="">GROUP</th>
                <th colspan="" width='200' style="border-right: 0px; text-align: center;" >ACTION</th>
                
                
              </tr>
              </thead>
              <?php
              $servername = "localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT * FROM saro order by sarodate desc");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];  
                $date = $row["sarodate"];
                $date11 = date('F d, Y', strtotime($date));
                $saronumber = $row["saronumber"];
                $fund = $row["fund"];
                $legalbasis = $row["legalbasis"];
                $ppa = $row["ppa"];
                $expenseclass = $row["expenseclass"];
                $particulars = $row["particulars"];
                $uacs = $row["uacs"];
                $amount1 = $row["amount"];
                $amount = number_format( $amount1,2);
                $obligated1 = $row["obligated"];
                $obligated = number_format( $obligated1,2);
                $balance1 = $row["balance"];
                $balance = number_format( $balance1,2);
                $sarogroup = $row["sarogroup"];
                ?>
                <tr>
                  <td><?php echo $date11?></td>
                  <td><?php echo $saronumber?></td>
                  <td><?php echo $fund?></td>
                  <td><?php echo $legalbasis?></td>
                  <td><?php echo $ppa?></td>
                  <td><?php echo $expenseclass?></td>
                  <td><?php echo $particulars?></td>
                  <td><?php echo $uacs?></td>
                  <td><?php echo $amount?></td>
                  <td><?php echo $obligated?></td>
                  <td><?php echo $balance?></td>
                  <td><?php echo $sarogroup?></td>
                  <td style="border-right: 0px; margin-left:0px" colspan="" style="text-align: center;"> 
                  <a class="btn btn-primary btn-xs"href='saroupdate.php?getid=<?php echo $id?>'> <i class='fa'>&#xf044;</i> Edit</a> | 
                  <a onclick="return confirm('Are you sure you want to delete this record?');" name=""  href="dis.php?id=<?php echo $id;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a> | 
                  <a class="btn btn-info btn-xs" href='obtableViewMain.php?getsaroID=<?php echo $saronumber?>&getuacs=<?php echo $uacs?>'> <i class='fa'>&#xf06e;</i> View</a>
                  </td>

                </tr>
              <?php }?>
            
            </table>
          </div>
          </div>
          </div>
                
  </body>
  </html>

  
  <script type="text/javascript">
    $(document).ready(function() {
        var dataTable=$('#example1').DataTable({
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : false,
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
  
    