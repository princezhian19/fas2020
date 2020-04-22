<div class="box">
  <div class="box-body">
    <div class=""  style="overflow-x:auto;"> 
      <div class=""  style="overflow-x:auto;">
        <h1 align="">SARO/SUB-ARO</h1>
        <div class=""  style="overflow-x:auto;">
        </div>
        <br>
        <br>
        <div class="class"  style="overflow-x:auto;">
         <div class="col-md-1">
          <li class="btn btn-success"><a href="sarocreate.php" style="color:white;text-decoration: none;">Create</a></li>
        </div>
        <div class="col-md-8 pull-right" style="padding-left: 55px;">
          <form method = "POST" action = "@Functions/sarodateexport.php">
            <div class="input-group date">
              <div class="input-group-addon">
                FROM   <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 200px">
              
              <div class="input-group date">
                <div class="input-group-addon">
                  TO <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 200px">
                &nbsp<button type="submit" name="submit"  class="btn btn-success ">Filter/Export Data</button> | 

                <li class="btn btn-success"><a href="@Functions/saroexportall.php" style="color:white;text-decoration: none;">Export All</a></li>
              </div>                            
            </form>
          </div>
          <br>
          <br>
        </div>
        <div class="class">
          <br>
          <br>
          <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th width="">DATE</th>
                <th width="">SOURCE</th>
                <th width="">FUND</th>
                <th width="">LEGAL BASIS</th>
                <th width="">PPA</th>
                <th width="">EXPENSE CLASS</th>
                <th width="">PARTICULARS</th>
                <th width="">UACS</th>
                <th width="">AMOUNT</th>
                <th width="">DISBURSEMENT</th>
                <th width="">BALANCE</th>
                <th width="">GROUP</th>
                <th width="">ACTION</th>
                <th width=""></th>
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
                <tr align = ''>
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
                  <td style="text-align:center" > 
                    <a class="btn btn-primary btn-xs"href='saroupdate.php?getid=<?php echo $id?>'> <i class='fa'>&#xf044;</i>Update</a>
                    <!-- <a href='@Functions/sofexport.php?getid=<?php echo $id?>'> <i style='font-size:24px' class='fa fa-fw fa-download'></i></a> --></td>
                    <td>
                    <a class="btn btn-info btn-xs" href='obtableViewMain.php?getsaroID=<?php echo $saronumber?>&getuacs=<?php echo $uacs?>'> <i class='fa'>&#xf06e;</i>View</a>
                  </td>
                </tr>
              <?php }?>
              <!-- <a href='@Functions/sarodeletefunction.php?getid=$id'> <i style='font-size:24px'<i class='fa fa-trash-o'></i> </a> -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>
           