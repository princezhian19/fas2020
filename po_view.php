<?php
$rfq_id = $_GET['rfq_id'];
$supplier_id = $_GET['supplier_id'];
$conn = mysqli_connect("localhost","root","","db_dilg_pmis");
$select1 = mysqli_query($conn,"SELECT po_id FROM selected_quote WHERE rfq_id = $rfq_id");
$row1 = mysqli_fetch_array($select1);
$po_id = $row1['po_id'];

$select2 = mysqli_query($conn,"SELECT * FROM po WHERE id = $po_id");
$row2 = mysqli_fetch_array($select2);
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
}


?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border" align="left">
                <h1>PO No. <?php echo $po_no?></h1>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <!-- <a href="" class="btn btn-primary"> Update </a> |  -->
                                        <a href="export_po.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>" class="btn btn-success"> Export </a>
                                    </p> 
                                    <div class="table table-responsive table-bordered"></div>
                                    <table id="example1" class="table table-striped table-bordered" style="background-color white;">
                                        <tr>
                                            <th width="200">PO No.</th>
                                            <td><?php echo $po_no;?></td>
                                        </tr>
                                        <tr>
                                            <th>PO Date </th>
                                            <td><?php echo $po_date;?></td>
                                        </tr>
                                        <tr>
                                            <th>PO Amount</th>
                                            <td><?php echo $po_amount;?></td>
                                        </tr>

                                        <tr>
                                            <th>Remarks </th>
                                            <td><?php echo $remarks;?></td>
                                        </tr>
                                        <tr>
                                            <th>NOA </th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right4px;"></i><a href="export_noa.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>">Notice of Award</a></td>
                                        </tr>
                                        <tr>
                                            <th>NTP </th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right4px;"></i><a href="export_ntp.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>">Notice of Proceed</a></td>
                                        </tr>
                                        <tr>
                                            <th>ORS </th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right4px;"></i><a href="export_obligation_po.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>">Obligation Request Status</a></td>
                                        </tr>
                                        <tr>
                                            <th>DV </th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right4px;"></i><a href="export_dv_po.php?po_id=<?php echo $po_id;?>&rfq_id=<?php echo $rfq_id;?>&supplier_id=<?php echo $supplier_id; ?>">Disbursement Voucher</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="box box-success">
                                <div class="box-header with-border" align="left">
                                    <h4>RFQ No. <?php echo $rfqnoD;?></h4>
                                </div>
                                <div class="box-body table-responsive no-padding">
                                    <div class="box-body">
                                        <table id="example1" class="table table-striped table-bordered" style="background-color white;">
                                            <tr>
                                                <th>Mode of Procurement</th>
                                                <td><?php echo $mode_of_proc_title;?></td>
                                            </tr>
                                            <tr>
                                                <th>RFQ Date</th>
                                                <td><?php echo $rfq_dateD;?></td>
                                            </tr>
                                            <tr>
                                                <th>Office</th>
                                                <td><?php echo $office;?></td>
                                            </tr>

                                            <tr>
                                                <th>Supplier</th>
                                                <td><?php echo $supplier_titleD;?></td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td><?php echo $supplier_addressD;?></td>
                                            </tr>
                                            <tr>
                                                <th>Contact No.</th>
                                                <td><?php echo $supplier_contactD;?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
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
        </div>
    </div>
</div>
</div>
