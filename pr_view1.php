<?php 
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];
$username = $_SESSION['username'];
$select = mysqli_query($conn,"SELECT * FROM pr WHERE id = '$id' ");
$row = mysqli_fetch_array($select);
$pr_no = $row['pr_no'];
$pmo = $row['pmo'];
$purpose = $row['purpose'];
$pr_date = $row['pr_date'];
$target_date = $row['target_date'];
$type = $row['type'];
$submitted_date = $row['submitted_date'];
$canceled = $row['canceled'];
$canceled_date = $row['canceled_date'];
$username1 = $row['username'];

if (isset($_POST['submit'])) {
  $reason = $_POST['reason'];
  $idC = $_POST['idC'];

  $update = mysqli_query($conn,"UPDATE pr SET canceled = '$reason', canceled_date = now(),username='$username' WHERE id = $idC ");
  if ($update) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('PR Successfuly Canceled!');
      window.location.href = 'ViewPRv.php?id=$id';
      </SCRIPT>");
}

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
                <h1>Purchase Request No. &nbsp <?php echo $pr_no;?></h1>
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



                 <a href="ViewPR1.php" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
                 <div style="float: right;padding:5px;">
                     <a href="export_pr1.php?id=<?php echo $id; ?>" class="btn btn-success pull-right"><i class="fa fa-fw fa-download"></i>Export</a>
                     <?php if ($canceled != NULL): ?>
                        <?php else: ?>
                          | 
                          <a data-toggle="modal"  data-target="#modal-info"   class = "btn btn-warning"><i class="fa fa-fw fa-close"></i>Cancel</a>  
                      <?php endif ?>
                  </div>
                  <?php if($submitted_date!=NULL):?>
                    <?php else:?>
                     <div style="float: right;padding:5px;">
                        <a href="ViewRFQdetails1.php?id=<?php echo $id; ?>" class="btn btn-primary"><i class='fa'>&#xf044;</i>Update</a>
                    </div>
                <?php endif?>
                <br>
                <br>
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
    <h4>Item(s)</h4>
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
            <td  width="500"><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $tot?></b></td>



        </tr>


    </table>
</div>
</div>
</div>
</div>




<div class="col-md-4">


    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4>PR Details</h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                    <tr>
                        <tr>
                            <th>Office:</th>
                            <td><?php echo $pmo;?></td>
                        </tr>
                        <tr>
                            <th>PR No:</th>
                            <td><?php echo $pr_no;?></td>
                        </tr>
                        <tr>
                            <th>PR Date:</th>
                            <td><?php echo date('F d, Y',strtotime($pr_date));?></td>
                        </tr>

                        <tr>
                            <th>Target Date:</th>
                            <td><?php echo date('F d, Y',strtotime($target_date));?></td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <?php if ($type == "1"): ?>
                              <td><?php echo "Catering Services";?></td>
                          <?php endif?>
                          <?php if ($type == "2"): ?>
                              <td><?php echo "Meals, Venue and Accommodation";?></td>
                          <?php endif?>
                          <?php if ($type == "3"): ?>
                              <td><?php echo "Repair and Maintenance";?></td>
                          <?php endif?>
                          <?php if ($type == "4"): ?>
                              <td><?php echo "Supplies and Materials";?></td>
                          <?php endif?>
                          <?php if ($type == "5"): ?>
                              <td><?php echo "Other Services";?></td>
                          <?php endif?>
                      </tr>
                      <tr>
                        <th>Purpose:</th>
                        <td><?php echo $purpose;?></td>
                    </tr>
                    <?php 
                    $view_query1 = mysqli_query($conn, "SELECT  sum(abc*qty) as aa from pr_items WHERE pr_no = '$pr_no' ");
                    while ($row = mysqli_fetch_assoc($view_query1)) {
                        $abc1 = $row["aa"];
                    }
                    ?>
                    <th>ABC:</th>
                    <td><?php echo number_format($abc1,2);?></td>
                </tr>
            </table>


        </div>
    </div>
</div>
</div>
</div>
</body>
</html>


