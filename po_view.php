<?php
$rfq_id = $_GET['rfq_id'];
$supplier_id = $_GET['supplier_id'];
$pr_no = $_GET['pr_no'];
$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$select1 = mysqli_query($conn,"SELECT po_id FROM selected_quote WHERE rfq_id = $rfq_id AND po_id IS NOT NULL");
$row1 = mysqli_fetch_array($select1);
$po_id = $row1['po_id'];

$selectpr = mysqli_query($conn,"SELECT * FROM pr WHERE pr_no = '$pr_no' ");
$rowpr = mysqli_fetch_array($selectpr);
$purpose = $rowpr['purpose'];
$pr_date = $rowpr['received_date'];

$select2 = mysqli_query($conn,"SELECT * FROM po WHERE id = $po_id");
$row2 = mysqli_fetch_array($select2);
$po_id = $row2['id'];
$po_no = $row2['po_no'];
$po_date = $row2['po_date'];
$noa_date = $row2['noa_date'];
$ntp_date = $row2['ntp_date'];
$remarks = $row2['remarks'];

$select3 = mysqli_query($conn,"SELECT mop.mode_of_proc_title,rfq.rfq_no,rfq.rfq_date,pr.pmo FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no LEFT JOIN mode_of_proc mop on mop.id = rfq.rfq_mode_id WHERE rfq.id = $rfq_id");
$row3 = mysqli_fetch_array($select3);
$rfqnoD = $row3['rfq_no'];
$rfq_dateD = $row3['rfq_date'];
$office = $row3['pmo'];
$mode_of_proc_title = $row3['mode_of_proc_title'];

$select4 = mysqli_query($conn,"SELECT supplier_title,supplier_address,contact_details FROM supplier WHERE id = $supplier_id");
$row4 = mysqli_fetch_array($select4);
$supplier_titleD = $row4['supplier_title'];
$supplier_addressD = $row4['supplier_address'];
$supplier_contactD = $row4['contact_details'];

$select_rfqitems = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
while ($rfqitems = mysqli_fetch_assoc($select_rfqitems)) {
  $rfq_items_id_abc[] = $rfqitems['id'];
}
$implode2 = implode(',', $rfq_items_id_abc);

$select_tots = mysqli_query($conn,"SELECT sum(ppu*qty) as ABCtots FROM supplier_quote sq LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE rfq_item_id in($implode2) AND supplier_id = $supplier_id");
while($rowppu = mysqli_fetch_array($select_tots)){
    $po_amount = number_format($rowppu['ABCtots'],2);
    $po_amount2 = $rowppu['ABCtots'];
}





?>

<html>
<head>
  <title>View PR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border" align="left">
                <h1>Purchase Order No. &nbsp <?php echo $po_no;?></h1>
                <?php if ($canceled != NULL): ?>

                    <br>
                    <font style="color:red;">Canceled by : </font>&nbsp<?php echo $username1;?>
                    <br>
                    <font style="color:red;">Reason : </font>&nbsp<?php echo $canceled;?>
                    <br>
                    <strong>Date : </strong>&nbsp<?php echo $canceled_date;?>
                    <?php else: ?>

                    <?php endif ?>
                </div>
                <div class="box-body table-responsive no-padding">
                    <div class="box-body">



                       <a href="ViewRFQ.php" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
                       <div style="float: right;padding:5px;">
                           <a href="export_po.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>" class="btn btn-success" ><i class="fa fa-fw fa-download"></i>Export</a>
                       </div>

                       <div style="float: right;padding:5px;">
                        <a href="UpdatePO.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_title=<?php echo $supplier_titleD; ?>&po_no=<?php echo $po_no; ?>&po_date=<?php echo $po_date; ?>&ntp_date=<?php echo $ntp_date; ?>&noa_date=<?php echo $noa_date; ?>&remarks=<?php echo $remarks; ?>&po_amount=<?php echo $po_amount; ?>&rfq_no=<?php echo $rfqnoD; ?>" class="btn btn-primary"><i class='fa'>&#xf044;</i>Edit</a>
                    </div>

                    <div class="modal modal-default fade" id="modal-info">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Cancel Purchase Request</h4>
                          </div>
                          <div class="modal-body">
                            <form method="POST" >
                             <label style="padding-right: 20px;">Reason 
                             </label><input  class="form-control" type="text" name="reason"><br>
                             <input type="text" name="idC" hidden  value="<?php echo $id?>">
                         </div>
                         <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="submit">Cancel</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- <?php if ($username == 'charlesodi' || $username == 'jamonteiro' || $username == 'ctronquillo' || $username == 'rlsegunial' || $username == 'mmmonteiro' || $username == 'cvferrer' || $username == 'masacluti'  ): ?> -->
        <!-- <?php else: ?> -->
        <!-- <a href="ViewPR.php" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i>Back</a> -->
        <!-- <?php endif ?> -->
        <br>
        <br>
        <h4>Item/s</h4>
        <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
            <thead>
                <tr style="background-color: white;color:blue;">
                    <th width="250">Item</th>
                    <th width="50">Quantity</th>
                    <th width="50">Unit</th>
                    <th width="100">Unit Cost</th>
                    <th width="100">Total Cost</th>
                </tr>
            </thead>
            <?php 

            $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
            while ($row = mysqli_fetch_assoc($view_query1)) {
                $abc111 = $row["aa"];
            }


            $view_query = mysqli_query($conn, "SELECT pr.id,item.item_unit_title,app.procurement,pr.unit,pr.qty,pr.abc FROM pr_items pr LEFT JOIN app on app.id = pr.items left join item_unit item on item.id = pr.unit WHERE pr_no = '$pr_no' ");

            while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];
                $items = $row["procurement"];  
                $unit = $row["item_unit_title"];
                $qty = $row["qty"];
                $abc1 = $row["abc"];
                $abc11 = number_format($abc1,2);

                $total_cost = $qty * $abc1;
                $total_cost11 = number_format($total_cost,2);

                        // $tot = number_format($abc111,2);



                echo "<tr align = ''>
                <td>$items</td>
                <td>$qty</td>
                <td>$unit</td>
                <td>$abc11</td>
                <td>$total_cost11</td>



                </tr>"; 
            }
            ?>
        </table>


        <br>

        <table id="example1" class="" style="background-color: white;">
            <thead>
                <tr style="background-color: white;color:blue;">
                    <th width="500"></th>
                    <th width="500"></th>
                    <th width="500"></th>
                    <th width="500"></th>
                    <th width="500"></th>
                </tr>
            </thead>
            <?php 


            $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
            $row = mysqli_fetch_array($view_query1);
            $abc12 = $row["aa"];
            $tot = number_format($abc12,2);


            ?>

            <tr>
                <td  width="500"></td>
                <td  width="500"></td>
                <td  width="500"></td>
                <td  width="500"></td>
                <td  width="500"><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $tot?></b></td>



            </tr>


        </table>

        <br>
        <table id="example1" class="table table-striped table-bordered" style="background-color white;">
          
            <tr>
                <th class="pull-left">NOA </th>
                <td><i class="glyphicon glyphicon-link" style="margin-right4px;"></i><a href="export_noa.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>">Notice of Award </a> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo date('F d, Y',strtotime($noa_date))?></td>
            </tr>
            <tr>
                <th class="pull-left">NTP </th>
                <td><i class="glyphicon glyphicon-link" style="margin-right4px;"></i><a href="export_ntp.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>">Notice of Proceed</a>&nbsp&nbsp&nbsp&nbsp&nbsp <?php echo date('F d, Y',strtotime($ntp_date))?></td>
            </tr>
            <tr>
                <th class="pull-left">ORS </th>
                <?php 
                $select_ors = mysqli_query($conn,"SELECT po_no,id FROM burs WHERE po_no = '$po_no'");
                $rowpo = mysqli_fetch_array($select_ors);
                $rowpo_no = $rowpo['po_no'];
                $id = $rowpo['id'];

                ?>
                <?php if ($rowpo_no != ''): ?>
                    <td><i lass="btn btn-primary btn-xs" class="" style="margin-right4px;"></i><a href="UpdateBURS.php?id=<?php echo $id;?>">View ORS</a></td>
                    <?php else: ?>
                        <td><i class="" style="margin-right4px;"></i><a class="btn btn-success btn-xs" href="CreateORSa.php?supplier_id=<?php echo $supplier_id;?>&po_no=<?php echo $po_no;?>&rfq_id=<?php echo $rfq_id;?>&supplier_titleD=<?php echo $supplier_titleD; ?>&supplier_address=<?php echo $supplier_addressD; ?>&po_amount=<?php echo $po_amount2; ?>">  Create ORS</a></td>

                    <?php endif ?>
                </tr>
                <tr>
                    <th class="pull-left">DV </th>
                    <?php 
                    $select_dv = mysqli_query($conn,"SELECT po_no,id FROM dv WHERE po_no = '$po_no'");
                    $rowpo1 = mysqli_fetch_array($select_dv);
                    $rowpo_no1 = $rowpo1['po_no'];
                    $id = $rowpo1['id'];

                    ?>
                    <?php if ($rowpo_no1 != ''): ?>
                      <td><i lass="btn btn-primary btn-xs"  class="" style="margin-right4px;"></i><a href="UpdateDV.php?id=<?php echo $id;?>">  View Dv</a></td>


                      <?php else: ?>

                        <td><i class="" style="margin-right4px;"></i><a class="btn btn-success btn-xs" href="CreateDVa.php?supplier_id=<?php echo $supplier_id;?>&po_no=<?php echo $po_no;?>&rfq_id=<?php echo $rfq_id;?>&supplier_titleD=<?php echo $supplier_titleD; ?>&supplier_address=<?php echo $supplier_addressD; ?>&po_amount=<?php echo $po_amount2; ?>">  Create DV</a></td>

                    <?php endif ?>

                </tr>
            </table>
            <br>
            <br>





        </div>


    </div>
</div>
</div>




<div class="col-md-4">


    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4>PO Details</h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <table id="example1" class="table table-striped " style="background-color: white;">
                    <tr>
                        <th class="pull-left">PO No.</th>
                        <td><?php echo $po_no;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">PO Date</th>
                        <td width="220"><?php echo date('F d, Y',strtotime($po_date));?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">PO Amount.</th>
                        <td><?php echo $po_amount;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Supplier</th>
                        <td><?php echo $supplier_titleD;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Address</th>
                        <td width="220"><?php echo $supplier_addressD;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Contact No.</th>
                        <td><?php echo $supplier_contactD;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">RFQ Date</th>
                        <td><?php echo date('F d, Y',strtotime($rfq_dateD));?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Purpose</th>
                        <td><?php echo $purpose;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Office</th>
                        <td><?php echo $office;?></td>
                    </tr>

                    <tr>
                        <th class="pull-left">PR No.</th>
                        <td><?php echo $pr_no;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">PR Date Received</th>
                        <td width="220"><?php echo date('F d, Y',strtotime($pr_date));?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">ABC</th>
                        <?php 
                        $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                        while ($row = mysqli_fetch_assoc($view_query1)) {
                            $abc1 = $row["aa"];
                        }
                        ?>
                        <td><?php echo number_format($abc1,2);?></td>
                    </tr>
                </table>




            </div>


        </div>
    </div>
</div>
<br>


</div>
<div class="box" hidden>
    <h3>Item(s)</h3>
    <table id="example1" class="table table-striped table-bordered" style="background-color white;">
        <thead>
            <tr style="background-color white;colorblue;">
                <th width="500">Item</th>
                <th width="500">Qty</th>
                <th width="500">Unit</th>
                <th width="500">ABC Per Item</th>
                <th width="500">Pricer Per Unit</th>
                <th width="500">Remarks</th>
            </tr>
        </thead>


        <?php 

        $select_rfqitems = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id");
        while ($rfqitems = mysqli_fetch_assoc($select_rfqitems)) {
          $rfq_items_id_abc[] = $rfqitems['id'];
      }
      $implode = implode(',', $rfq_items_id_abc);

      $view_query = mysqli_query($conn, "SELECT rq.total_amount as abc,iu.item_unit_title,rq.qty,app.procurement,sq.ppu,sq.remarks FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN supplier_quote sq on sq.rfq_item_id = rq.id LEFT JOIN item_unit iu on iu.id = rq.unit_id WHERE rq.id in($implode) AND sq.supplier_id = $supplier_id ");

      while ($row = mysqli_fetch_assoc($view_query)) {
        $ppu1 = $row["ppu"];  
        $remarks1 = $row["remarks"];
        $procurement1 = $row["procurement"];
        $qty1 = $row["qty"];
        $abc1 = $row["abc"];
        $item_unit_title1 = $row["item_unit_title"];
        echo "<tr align = ''>
        <td>$procurement1</td>
        <td>$qty1</td>
        <td>$item_unit_title1</td>
        <td>$abc1</td>
        <td>$ppu1</td>
        <td>$remarks1</td>
        </tr>"; 
    }
    ?>
</table>    
</div>
<div class="row">
    <div class="col-md-7">

    </div>
    <div class="col-md-5">


    </div>
</div>


</body>
</html>


