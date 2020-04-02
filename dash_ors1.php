<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <h1>Monitoring of ORS and BURS</h1>
            <p></p>
            <br>
            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th>DATE RECEIVED</th>
                  <th>DATE OBLIGATED</th>
                  <th>DATE RELEASED</th>
                  <th>ORS NUMBER</th>
                  <th>PO NUMBER</th>
                  <th>PAYEE</th>
                  <th>PARTICULAR</th>
                  <th>AMOUNT</th>
                  <th>STATUS</th>
                </tr>
              </thead>
              <?php
              $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
              $view_query = mysqli_query($conn, "SELECT * FROM saroob where status = 'Obligated' order by id desc ");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];  

                $datereceived = $row["datereceived"];
                if ($datereceived == '0000-00-00') {
                  $datereceived11 = '';
                }else{
                  $datereceived11 = date('F d, Y', strtotime($datereceived));
                }

                $datereprocessed = $row["datereprocessed"];
                if ($datereprocessed == '0000-00-00') {
                  $datereprocessed11 = '';
                }else{
                  $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

                }
                $datereleased = $row["datereleased"];
                if ($datereleased == '0000-00-00') {
                  $datereleased11 = '';
                }else{
                  $datereleased11 = date('F d, Y', strtotime($datereleased));
                }
                $ors = $row["ors"];
                $ponum = $row["ponum"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                $saronumber = $row["saronumber"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $amount1 = $row["amount"];
                $amount = number_format( $amount1,2);
                $date = $row["date"];
                $remarks = $row["remarks"];
                $sarogroup = $row["sarogroup"];
                $status = $row["status"];
                ?>
                <tr>
                  <?php if ($datereceived !='0000-00-00' ): ?>
                    <td><?php echo $datereceived11;?></td>
                    <?php else: ?>
                      <td><a class="btn btn-primary btn-xs" href='received_burs.php?id=<?php echo $id; ?>&stat=1' >Received</a> </a></td>
                    <?php endif ?>
                    <?php if ($datereceived !='0000-00-00'): ?>
                      <?php if ($datereprocessed !='0000-00-00'): ?>
                        <td><?php echo $datereprocessed11;?></td>
                        <?php else: ?>
                          <td><a class="btn btn-success btn-xs" href='CreateObligation.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                        <?php endif ?>
                        <?php else: ?>
                          <td></td>
                        <?php endif ?>
                        <?php if ($datereprocessed !='0000-00-00'): ?>
                          <?php if ($datereleased =='0000-00-00' || $datereleased == '1970-01-01'): ?>
                           <td><a class="btn btn-success btn-xs" href='release_burs.php?id=<?php echo $id; ?>&stat=1' >Release</a> </td>
                           <?php else: ?> 
                             <td><?php echo $datereleased11;?></td>
                           <?php endif ?>
                           <?php else: ?> 
                             <td></td>
                           <?php endif ?>
                           <td><?php echo $ors;?></td>
                           <td><?php echo $ponum;?></td>
                           <td><?php echo $payee;?></td>
                           <td><?php echo $particular;?></td>
                           <td><?php echo $amount;?></td>
                           <?php if ($status =='Pending'): ?>
                            <td style='background-color:red'><b>Pending</b></td>
                            <?php else: ?>
                              <?php if ($status == 'Obligated'): ?>
                                <td style='background-color:green'><b>Obligated</b></td>
                                <?php else: ?>
                                  <td></td>
                                <?php endif ?>
                              <?php endif ?>
                            </tr> 
                          <?php } ?>
                        </table>     
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
