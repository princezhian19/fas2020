<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Monitoring of Payments</h1>
            <p></p>
            <br>
            <table id="example1" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th style="text-align:center" width="800">DATE</th>
                  <th style="text-align:center" width="800">PAYEE</th>
                  <th style="text-align:center" width="800">PARTICULAR</th>
                  <th style="text-align:center" width="800">DV NUMBER</th>
                  <th style="text-align:center" width="800">LDDAP-ADA/CHECK</th>
                  <th style="text-align:center" width="800">ORS NUMBER</th>
                  <th style="text-align:center" width="800">NET</th>
                  <th style="text-align:center" width="800">REMARKS</th>
                  <th style="text-align:center" width="800">STATUS</th>
                </tr>
              </thead>
              <?php
              $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
              $view_query = mysqli_query($conn, "SELECT * FROM ntaob where status ='Paid' order by id desc LIMIT 3");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"]; 
                $accountno = $row["accountno"];
                $date1 = $row["date"];
                $date = date('F d, Y', strtotime($date1));
                $payee = $row["payee"];
                $particular = $row["particular"];
                $dvno = $row["dvno"];
                $lddap = $row["lddap"];
                $orsno = $row["orsno"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $gross1 = $row["gross"];
                $gross = number_format( $gross1,2);
                $totaldeduc = $row["totaldeduc"];
                $totaldeduc = number_format( $totaldeduc,2);
                $net1 = $row["net"];
                $net = number_format( $net1,2);
                $remarks = $row["remarks"];
                $status = $row["status"];
                ?>
                <tr>
                  <?php if ( $date1=="0000-00-00" ): ?>
                    <td style="text-align:center" ></td>
                    <?php else : ?>
                      <td style="text-align:center" ><?php echo $date?></td>
                    <?php endif ?>
                    <td style="text-align:center" ><?php echo $payee?></td>
                    <td style="text-align:center" ><?php echo $particular?></td>
                    <td style="text-align:center" ><?php echo $dvno?></td>
                    <td style="text-align:center" ><?php echo $lddap?></td>
                    <td style="text-align:center" ><?php echo $orsno?></td>
                    <td style="text-align:center" ><?php echo $net?></td>
                    <td style="text-align:center" ><?php echo $remarks?></td>
                    <?php if ($status =='Unpaid'): ?>
                      <td style='background-color:red'><b>Unpaid</b></td>
                      <?php else: ?>
                        <?php if ($status == 'Paid'): ?>
                          <td style='background-color:green'><b>Paid</b></td>
                          <?php else: ?>
                            <td></td>
                          <?php endif ?>
                        <?php endif ?>
                      </tr>
                    <?php }?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
