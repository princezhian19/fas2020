<?php

?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border" align="left">
                <h1>PO No. <? echo $po_no?></h1>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <a href="" class="btn btn-primary"> Update </a> | 
                                        <a href="" class="btn btn-success"> Export </a>
                                    </p> 
                                    <div class="table table-responsive table-bordered"></div>
                                    <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                                        <tr>
                                            <th>PO No.:</th>
                                            <td><?php echo $po_no;?></td>
                                        </tr>
                                        <tr>
                                            <th>PO Date :</th>
                                            <td><?php echo $po_date;?></td>
                                        </tr>
                                        <tr>
                                            <th>PO Amount:</th>
                                            <td><?php echo $po_amount;?></td>
                                        </tr>

                                        <tr>
                                            <th>Remarks :</th>
                                            <td><?php echo $remarks;?></td>
                                        </tr>
                                        <tr>
                                            <th>NOA :</th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right:4px;"></i><a href="">Notice of Award</a></td>
                                        </tr>
                                        <tr>
                                            <th>NTP :</th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right:4px;"></i><a href="">Notice of Proceed</a></td>
                                        </tr>
                                        <tr>
                                            <th>ORS :</th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right:4px;"></i><a href="">Obligation Request Status</a></td>
                                        </tr>
                                        <tr>
                                            <th>DV :</th>
                                            <td><i class="glyphicon glyphicon-link" style="margin-right:4px;"></i><a href="">Disbursement Voucher</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="box box-success">
                                <div class="box-header with-border" align="left">
                                    <h4>RFQ No. </h4>
                                </div>
                                <div class="box-body table-responsive no-padding">
                                    <div class="box-body">
                                        <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                                            <tr>
                                                <th>Mode of Procurement:</th>
                                                <td><?php echo $pmo;?></td>
                                            </tr>
                                            <tr>
                                                <th>RFQ Date:</th>
                                                <td><?php echo $pr_no;?></td>
                                            </tr>
                                            <tr>
                                                <th>Office:</th>
                                                <td><?php echo $pr_date;?></td>
                                            </tr>

                                            <tr>
                                                <th>Address:</th>
                                                <td><?php echo $target_date;?></td>
                                            </tr>
                                            <tr>
                                                <th>Contact No.:</th>
                                                <td><?php echo $purpose;?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <h3>Item(s)</h3>
                    <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                        <thead>
                            <tr style="background-color: white;color:blue;">
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

                    $view_query = mysqli_query($conn, "SELECT sq.ppu,sq.remarks,app.procurement,rq.qty,ui.item_unit_title,sum(sq.ppu*rq.qty) as abc FROM rfq_items rq LEFT JOIN item_unit ui on ui.id = rq.unit_id LEFT JOIN supplier_quote sq on sq.rfq_item_id = rq.id LEFT JOIN app on app.id = rq.app_id WHERE sq.supplier_id = $supplier_id AND sq.rfq_item_id in($implode) ");
                    while ($row = mysqli_fetch_assoc($view_query)) {
                        $ppu1 = $row["ppu"];  
                        $remarks1 = $row["remarks"];
                        $procurement1 = $row["procurement"];
                        $qty1 = $row["qty"];
                        $item_unit_title1 = $row["item_unit_title"];
                        $abc1 = $row["abc"];
                        $total_cost111 = number_format($total_cost,2);
                        echo "<tr align = ''>
                        <td>$procurement1</td>
                        <td>$qty1</td>
                        <td>$item_unit_title1</td>
                        <td>$abc1</td>
                        <td>$ppu1</td>
                        </tr>"; 
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
