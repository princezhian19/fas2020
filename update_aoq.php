<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$rfq_id = $_GET['rfq_id'];
$abstract_id = $_GET['abstract_id'];

$select = mysqli_query($conn,"SELECT rfq.rfq_date,rfq.rfq_no,rfq.purpose,pr.pmo,rfq.pr_no,rfq.pr_received_date FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no WHERE rfq.id = '$rfq_id' ");
$row = mysqli_fetch_array($select);
$rfq_no = $row['rfq_no'];
$rfq_date = $row['rfq_date'];
$purpose = $row['purpose'];
$pmo = $row['pmo'];
$pr_no = $row['pr_no'];
$pr_date = $row['pr_received_date'];

// $selectC = mysqli_query($con,"SELECT id FROM abstract_of_quote WHERE")

$select_abs = mysqli_query($conn,"SELECT abs.abstract_no,ao.aoq_no,ao.remarks,ao.datetime_created,s.supplier_title,s.id FROM abstract_of_quote abs LEFT JOIN supplier s on s.id = abs.supplier_id LEFT JOIN aoq_data ao on ao.id = abs.abstract_no WHERE abs.id = $abstract_id");
$rowabs = mysqli_fetch_array($select_abs);
$supplier_id1 = $rowabs['id'];
$abstract_no1 = $rowabs['abstract_no'];
$supplier_title = $rowabs['supplier_title'];
$aoq_no = $rowabs['aoq_no'];
$remarks = $rowabs['remarks'];
$abs_date1 = $rowabs['datetime_created'];


$abs_date = date("Y-m-d\TH:i:s",strtotime($abs_date1));

function supplier($connect)
{ 
    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    $rfq_id = $_GET['rfq_id'];
    $SELECT_rfq = mysqli_query($conn,"SELECT * FROM rfq_items WHERE rfq_id = $rfq_id");
    $rowR = mysqli_fetch_array($SELECT_rfq);
    $rid = $rowR['id'];

    $output = '';
    $query = "SELECT sq.supplier_id,rq.rfq_id,sq.id,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on s.id = sq.supplier_id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output .= '<option text="text" value="'.$row["supplier_id"].'">'.$row["supplier_title"].'</option>';
    }
    return $output;
}
?>
<?php
if (isset($_POST['submit'])) {
    $abstract_no = $_POST['abstract_no'];
    $supplier_id = $_POST['supplier_id2'];
    $date_opened = $_POST['date_opened'];
    $remarks = $_POST['remarks'];
    $UPDATE_0 = mysqli_query($conn,"UPDATE abstract_of_quote SET abstract_no = NULL WHERE supplier_id = $supplier_id1 AND rfq_id = $rfq_id ");

    $UPDATE_1 = mysqli_query($conn,"UPDATE abstract_of_quote SET abstract_no = $abstract_no1 WHERE supplier_id = $supplier_id AND rfq_id = $rfq_id ");

    $UPDATE_2 = mysqli_query($conn,"UPDATE aoq_data SET aoq_no = '$abstract_no', datetime_created = '$date_opened',remarks = '$remarks' WHERE id = $abstract_no1 ");

      $selectAOQ = mysqli_query($conn,"SELECT id FROM aoq_data WHERE aoq_no = '$abstract_no' ");
    $rowAOQ = mysqli_fetch_array($selectAOQ);
    $aoqID =$rowAOQ['id'];

    $selectabsid = mysqli_query($conn,"SELECT id FROM abstract_of_quote WHERE abstract_no = $aoqID AND rfq_id = $rfq_id ORDER BY id DESC");
    $rowabsid = mysqli_fetch_array($selectabsid);
    $abstract_id15 = $rowabsid['id'];


    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfuly Updated!')
        window.location.href='UpdateAoq.php?rfq_id=$rfq_id&abstract_id=$abstract_id15&supplier_id=$supplier_id1';
        </SCRIPT>");



}
// S U P P L I E R S     Q U O T E      Q U E R Y


$sql = mysqli_query($conn, "SELECT rq.id FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id WHERE rq.rfq_id = '$rfq_id' ");
$row = mysqli_fetch_array($sql);
$rid = $row['id'];

$all_selected_suppliers1 = mysqli_query($conn, "SELECT s.id,rq.rfq_id,sq.id,s.id as sid,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on sq.supplier_id = s.id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid  ");

while ($allS = mysqli_fetch_assoc($all_selected_suppliers1)) {
  $Asupplier[] = $allS['sid'];
}

$implode = implode(',', $Asupplier);

$abc_for_winner = mysqli_query($conn,"SELECT supplier_id FROM abstract_of_quote WHERE supplier_id in($implode) AND rfq_id = $rfq_id AND abstract_no IS NOT NULL");
$abcrow = mysqli_fetch_array($abc_for_winner);
$win_id = $abcrow['supplier_id'];

$winneryey = mysqli_query($conn,"SELECT supplier_title FROM supplier WHERE id = $win_id");
$rowWinY = mysqli_fetch_array($winneryey);
$WinSupply = $rowWinY['supplier_title'];

$suppliers1 = mysqli_query($conn, "SELECT sq.id,s.id as sid,s.supplier_title FROM supplier s LEFT JOIN supplier_quote sq on sq.supplier_id = s.id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid  ");
$rowS1 = mysqli_fetch_assoc($suppliers1);
$supplier_title1 = $rowS1['supplier_title'];
$sid1 = $rowS1['sid'];

$suppliers2 = mysqli_query($conn, "SELECT s.id,rq.rfq_id,sq.id,s.id as sid,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on sq.supplier_id = s.id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid  AND s.supplier_title != '$supplier_title1' ");
$rowS2 = mysqli_fetch_assoc($suppliers2);
$supplier_title2 = $rowS2['supplier_title'];
$sid2 = $rowS2['sid'];


$suppliers3 = mysqli_query($conn, "SELECT s.id,rq.rfq_id,sq.id,s.id as sid,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on sq.supplier_id = s.id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid  AND s.id != $sid1 AND s.id != $sid2 ");
$rowS3 = mysqli_fetch_assoc($suppliers3);
$supplier_title3 = $rowS3['supplier_title'];
$sid3 = $rowS3['sid'];
$suppliers4 = mysqli_query($conn, "SELECT s.id,rq.rfq_id,sq.id,s.id as sid,s.supplier_title,s.supplier_address,s.contact_details,s.remarks FROM supplier s LEFT JOIN supplier_quote sq on sq.supplier_id = s.id LEFT JOIN rfq_items rq on rq.id = sq.rfq_item_id WHERE sq.rfq_item_id = $rid  AND s.id != $sid1 AND s.id != $sid2 AND s.id != $sid3");
$rowS4 = mysqli_fetch_assoc($suppliers4);
$supplier_title4 = $rowS4['supplier_title'];
$sid4 = $rowS4['sid'];

$sql_items = mysqli_query($conn, "SELECT sq.ppu,rq.id,app.procurement,rq.description,rq.qty,rq.abc,iu.item_unit_title FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id LEFT JOIN  supplier_quote sq on sq.rfq_item_id = rq.id  WHERE rq.rfq_id = '$rfq_id' AND sq.supplier_id = $sid1 ");

$sql_items1 = mysqli_query($conn, "SELECT sq.ppu,rq.id,app.procurement,rq.description,rq.qty,rq.abc,iu.item_unit_title FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id LEFT JOIN  supplier_quote sq on sq.rfq_item_id = rq.id  WHERE rq.rfq_id = '$rfq_id' AND sq.supplier_id = $sid1 ");

$sql_items2 = mysqli_query($conn, "SELECT sq.ppu,rq.id,app.procurement,rq.description,rq.qty,rq.abc,iu.item_unit_title FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id LEFT JOIN  supplier_quote sq on sq.rfq_item_id = rq.id  WHERE rq.rfq_id = '$rfq_id' AND sq.supplier_id = $sid2 ");

$sql_items3 = mysqli_query($conn, "SELECT sq.ppu,rq.id,app.procurement,rq.description,rq.qty,rq.abc,iu.item_unit_title FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id LEFT JOIN  supplier_quote sq on sq.rfq_item_id = rq.id  WHERE rq.rfq_id = '$rfq_id' AND sq.supplier_id = $sid3 ");

$sql_items4 = mysqli_query($conn, "SELECT sq.ppu,rq.id,app.procurement,rq.description,rq.qty,rq.abc,iu.item_unit_title FROM rfq_items rq LEFT JOIN app on app.id = rq.app_id LEFT JOIN item_unit iu on iu.id = rq.unit_id LEFT JOIN  supplier_quote sq on sq.rfq_item_id = rq.id  WHERE rq.rfq_id = '$rfq_id' AND sq.supplier_id = $sid4 ");

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
                <div class="col-md-11">
                    <h1>RFQ No. &nbsp <?php echo $rfq_no;?></h1>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <div class="box-body">
                  <h4>Item(s)</h4>
                  <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th width="500">Item</th>
                            <th width="500">Quantity</th>
                            <th width="500">Unit</th>
                            <th width="500">Unit Cost</th>
                            <th width="500">Total Cost</th>
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
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4>RFQ Details</h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                    <tr>
                        <th width="100">RFQ Date</th>
                        <td><?php echo $rfq_date;?></td>
                    </tr>
                    <tr>
                        <th>Purpose</th>
                        <td><?php echo $purpose;?></td>
                    </tr>
                    <tr>
                        <th>Office</th>
                        <td><?php echo $pmo;?></td>
                    </tr>

                    <tr>
                        <th>PR No.</th>
                        <td><?php echo $pr_no;?></td>
                    </tr>
                    <tr>
                        <th width="150" >PR Date Received</th>
                        <td><?php echo $pr_date;?></td>
                    </tr>
                     <!-- <tr>
                        <?php 
                    $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                      while ($row = mysqli_fetch_assoc($view_query1)) {
                        $abc1 = $row["aa"];
                                }
                        ?>
                        <th>ABC:</th>
                        <td><?php echo number_format($abc1,2);?></td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12" >
    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4>Abstract of Quotations</h4>
            <div style="padding-left: 15px;"><a href="export_abstract.php?rfq_id=<?php echo $rfq_id; ?>&abstract_no=<?php echo $abstract_no1?>" class="btn btn-success">Export</a> </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <form method="POST">
                    <div class="col-md-10" >
                       <div class="form-group" hidden>
                        <label>Select Supplier</label>
                        <select  class="form-control select2" style="width: 100%;" autocomplete="off"  >
                           <option value="<?php echo $supplier_id1;?>" selected><?php echo $supplier_title;?></option>
                           <?php echo supplier($connect); ?>
                       </select> 
                   </div>
               </div>
               <div class="col-md-6" >
                <div class="form-group">
                    <label>Abstract No.</label>
                    <input required type="text" value="<?php echo $aoq_no;?>" name="abstract_no" class="form-control">
                </div>
                <div class="form-group">
                    <label>Date Opened</label>
                    <input required type="datetime-local" value="<?php echo $abs_date;?>" name="date_opened" class="form-control">
                </div>
                <label>Remarks</label>
                <textarea class="form-control" name="remarks" style="width: 590px;"><?php echo $remarks;?></textarea>


            </div>



        </div>
    </div>
</div>
</div>

<!-- tables quotes -->
<div class="col-md-12" >
    <div class="box box-primary">
        <div class="box-header with-border" align="left">
            <h4>Suppliers Quotations</h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <form method="POST">
                    <!-- S U P P L I E R      1  [PAG DLWA LANG ANG SUPPLIER] -->
                    <?php if ($supplier_title3 == ''): ?>
                        <div class="box-body">
                          <div class="row" id="boxed">
                            <div class="col-xs-6">
                                <table id="example1" class="  table-responsive" style="width:500px;background-color: white;" align="center">
                                    <thead>
                                        <th style="float: right;" ><?php echo $supplier_title1;?></th>
                                    </thead>
                                </table>
                                <table id="example1" class="table table-striped table-bordered table-responsive" style="width:500px;background-color: white;" align="center">
                                   <thead >
                                    <th width="" >Items</th>
                                    <th width="" >PPU</th>
                                </thead>   
                                <?php 
                                $b = 1;
                                while($rowrfid1 = mysqli_fetch_assoc($sql_items) ){
                                    $ppu11 = $rowrfid1['ppu'];
                                    $procurement = $rowrfid1['procurement'];
                                    $b++;
                                    ?>
                                    <tr>
                                        <td><?php echo $procurement;?></td>
                                        

                                        <?php if ($WinSupply == $supplier_title1): ?>


                                         <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid1 ?>">&nbsp&nbsp<?php echo $ppu11;?></td>
                                         <?php else: ?>
                                             <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid1 ?>">&nbsp&nbsp<?php echo $ppu11;?></td>
                                         <?php endif ?>

                                     </tr>
                                 <?php } ?>
                             </table>
                         </div>
                         <!-- S U P P L I E R      2  -->
                         <div class="col-xs-6">
                           <table id="example1" class="  table-responsive" style="width:500px;background-color: white;" align="center">
                            <thead style="width:500px;">
                                <th width="" ><?php echo $supplier_title2;?></th>
                            </thead>
                        </table>
                        <table id="example1" class="table table-striped table-bordered table-responsive" style="width:500px;background-color: white;" align="center">
                           <thead style="width:500px;">
                            <th width="" >PPU</th>
                        </thead>   
                        <?php 
                        $b = 1;
                        while($rowrfid12 = mysqli_fetch_assoc($sql_items2) ){
                            $ppu112 = $rowrfid12['ppu'];
                            $procurement2 = $rowrfid12['procurement'];
                            $b++;
                            ?>
                            <tr>
                                <?php if ($WinSupply == $supplier_title2): ?>
                                    <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid2 ?>">&nbsp&nbsp<?php echo $ppu112;?></td>
                                 <?php else: ?>
                                     <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid2 ?>">&nbsp&nbsp<?php echo $ppu112;?></td>
                                 <?php endif ?>

                             </tr>
                         <?php } ?>
                     </table>
                 </div>
             </div>
         </div>
     <?php endif ?>
     <?php if ($supplier_title3 != '' AND $supplier_title4 == ''): ?>

        <div class="box-body">
          <div class="row" id="boxed">
                     <!-- S U P P L I E R S [PAGE TATLO ANG SUPPIER] -->
                            <div class="col-xs-3">
                                <table id="example1" class="  table-responsive" style="width:300px;background-color: white;" >
                                    <thead>
                                        <th>Item(s)</th>
                                    </thead>
                                </table>
                                <table id="example1" class="table table-striped table-bordered table-responsive" style="width:300px;background-color: white;" >
                                   <thead >
                                    <th width="" >Procurement</th>
                                </thead>   
                                <?php 
                                while($rowrfid1 = mysqli_fetch_assoc($sql_items) ){
                                    $procurement = $rowrfid1['procurement'];
                                    ?>
                                    <tr>
                                        <td><?php echo $procurement;?></td>
                                     </tr>
                                 <?php } ?>
                             </table>
                         </div>

              <!-- S U P P L I E R      1  -->
              <div class="col-xs-3">
                  <table id="example1" class="  table-responsive" style="width:300px;background-color: white;">
                    <thead>
                        <th ><?php echo $supplier_title1;?></th>
                    </thead>
                </table>
                <table id="example1" class="table table-striped table-bordered table-responsive" style="width:300px;background-color: white;">
                   <thead>
                    <th width="" >PPU</th>
                </thead>   
                <?php 
                $b = 1;
                while($rowrfid1 = mysqli_fetch_assoc($sql_items1) ){
                    $ppu11 = $rowrfid1['ppu'];
                    $b++;
                    ?>
                    <tr>
                        <?php if ($WinSupply == $supplier_title1): ?>
                            <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid1 ?>"> &nbsp&nbsp
                                <?php echo $ppu11;?></td>
                                <?php else: ?>
                                  <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid1 ?>"> &nbsp&nbsp
                                    <?php echo $ppu11;?></td>
                                <?php endif ?>
                            </tr>
                        <?php } ?>
                    </table>

                </div>
                <!-- S U P P L I E R     2  -->
                <div class="col-xs-3">
                   <table id="example1" class="  table-responsive" style="width:300px;background-color: white;">
                    <thead>
                        <th  ><?php echo $supplier_title2;?></th>
                    </thead>
                </table>
                <table id="example1" class="table table-striped table-bordered table-responsive" style="width:300px;background-color: white;">
                   <thead>
                    <th>PPU</th>
                </thead>   
                <?php 
                $b = 1;
                while($rowrfid12 = mysqli_fetch_assoc($sql_items2) ){
                    $ppu112 = $rowrfid12['ppu'];
                    $b++;
                    ?>
                    <tr >
                      <?php if ($WinSupply == $supplier_title2): ?>
                        <td ><input  type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid2 ?>">&nbsp&nbsp
                            <?php echo $ppu112;?></td>
                            <?php else: ?>
                                <td ><input  type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid2 ?>">&nbsp&nbsp
                                    <?php echo $ppu112;?></td>
                                <?php endif ?>


                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <!-- S U P P L I E R     3  -->
                <div class="col-xs-3">
                   <table id="example1" class="  table-responsive" style="width:300px;background-color: white;">
                    <thead>
                        <th width="" ><?php echo $supplier_title3;?></th>
                    </thead>
                </table>
                <table id="example1" class="table table-striped table-bordered table-responsive" style="width:300px;background-color: white;">
                   <thead>
                    <th width="" >PPU</th>
                </thead>   
                <?php 
                $b = 1;
                while($rowrfid13 = mysqli_fetch_assoc($sql_items3) ){
                    $ppu113 = $rowrfid13['ppu'];
                    $b++;
                    ?>
                    <tr>
                        <?php if ($WinSupply == $supplier_title3): ?>
                           <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid3 ?>">&nbsp&nbsp
                            <?php echo $ppu113;?></td>
                            <?php else: ?>
                               <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid3 ?>">&nbsp&nbsp
                                <?php echo $ppu113;?></td>
                            <?php endif ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
    </div>

<?php endif ?>
<?php if ($supplier_title4 !='' AND $supplier_title3 !=''): ?>
 <div class="box-body">
  <div class="row" id="boxed">
      <!-- S U P P L I E R      1 [PAG APAT ANG SUPPLIER] -->
      <div class="col-xs-3">
          <table id="example1" class="  table-responsive" style="width:200px;background-color: white;">
            <thead>
                <th width="" ><?php echo $supplier_title1;?></th>
            </thead>
        </table>
        <table id="example1" class="table table-striped table-bordered table-responsive" style="width:200px;background-color: white;">
           <thead>
            <th width="200" >Item</th>
            <th width="100" >PPU</th>
        </thead>   
        <?php 
        $b = 1;
        while($rowrfid1 = mysqli_fetch_assoc($sql_items) ){
            $ppu11 = $rowrfid1['ppu'];
            $procurement = $rowrfid1['procurement'];
            $b++;
            ?>
            <tr>
                <td><?php echo $procurement;?></td>
                <?php if ($WinSupply == $supplier_title1): ?>
                    <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid1 ?>">&nbsp&nbsp<?php echo $ppu11;?></td>
                    <?php else: ?>
                        <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid1 ?>">&nbsp&nbsp<?php echo $ppu11;?></td>
                    <?php endif ?>
                </tr>
            <?php } ?>
        </table>

    </div>
    <!-- S U P P L I E R     2  -->
    <div class="col-xs-3">
       <table id="example1" class="  table-responsive" style="width:200px;background-color: white;">
        <thead>
            <th width="" ><?php echo $supplier_title2;?></th>
        </thead>
    </table>
    <table id="example1" class="table table-striped table-bordered table-responsive" style="width:200px;background-color: white;">
       <thead>
        <th width="" >PPU</th>
    </thead>   
    <?php 
    $b = 1;
    while($rowrfid12 = mysqli_fetch_assoc($sql_items2) ){
        $ppu112 = $rowrfid12['ppu'];
        $procurement2 = $rowrfid12['procurement'];
        $b++;
        ?>
        <tr>
           <?php if ($WinSupply == $supplier_title2): ?>
            <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid2 ?>">&nbsp&nbsp<?php echo $ppu112;?></td>
            <?php else: ?>
                <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid2 ?>">&nbsp&nbsp<?php echo $ppu112;?></td>
            <?php endif ?>

        </tr>
    <?php } ?>
</table>
</div>
<!-- S U P P L I E R     3  -->
<div class="col-xs-3">
   <table id="example1" class="  table-responsive" style="width:200px;background-color: white;">
    <thead>
        <th width="" ><?php echo $supplier_title3;?></th>
    </thead>
</table>
<table id="example1" class="table table-striped table-bordered table-responsive" style="width:200px;background-color: white;">
   <thead>
    <th width="" >PPU</th>
</thead>   
<?php 
$b = 1;
while($rowrfid13 = mysqli_fetch_assoc($sql_items3) ){
    $ppu113 = $rowrfid13['ppu'];
    $procurement3 = $rowrfid13['procurement'];
    $b++;
    ?>
    <tr>
       <?php if ($WinSupply == $supplier_title3): ?>
        <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid3 ?>">&nbsp&nbsp<?php echo $ppu113;?></td>
        <?php else: ?>
            <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid3 ?>">&nbsp&nbsp<?php echo $ppu113;?></td>
        <?php endif ?>


    </tr>
<?php } ?>
</table>
</div>
<!-- S U P P L I E R     4  -->
<div class="col-xs-3">
   <table id="example1" class="  table-responsive" style="width:200px;background-color: white;">
    <thead>
        <th width="" ><?php echo $supplier_title4;?></th>
    </thead>
</table>
<table id="example1" class="table table-striped table-bordered table-responsive" style="width:200px;background-color: white;">
   <thead>
    <th width="" >PPU</th>
</thead>   
<?php 
$b = 1;
while($rowrfid14 = mysqli_fetch_assoc($sql_items4) ){
    $ppu114 = $rowrfid14['ppu'];
    $procurement4 = $rowrfid14['procurement'];
    $b++;
    ?>
    <tr>
        <?php if ($WinSupply == $supplier_title4): ?>
            <td><input type="radio" checked name="supplier_id<?php echo $b;?>" value="<?php echo $sid4 ?>">&nbsp&nbsp<?php echo $ppu114;?></td>
            <?php else: ?>
                <td><input type="radio" name="supplier_id<?php echo $b;?>" value="<?php echo $sid4 ?>">&nbsp&nbsp<?php echo $ppu114;?></td>
            <?php endif ?>
        </tr>
    <?php } ?>
</table>
</div>
</div>
</div>
<?php endif ?>
</div>
</div>
</div>
<button class="btn btn-primary" name="submit" style="width: 1260px;">Update</button>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</form>
<!-- end of div row class -->
</div>
<div class="row">
    <div class="col-md-7">
    </div>
    <div class="col-md-5">
    </div>
</div>
</body>
</html>


