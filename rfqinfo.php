<?php
$connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
$id = $_GET['id'];

function supplier($connect)
{ 
  $output = '';
  $query = "SELECT * FROM supplier ORDER BY supplier_title ASC ";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  foreach($result as $row)
  {
    $output .= '<option text="text" value="'.$row["id"].'">'.$row["supplier_title"].'</option>';
}
return $output;
}
$select = mysqli_query($conn,"SELECT rfq.rfq_date,rfq.rfq_no,rfq.purpose,pr.id,pr.pmo,rfq.pr_no,rfq.pr_received_date FROM rfq LEFT JOIN pr on pr.pr_no = rfq.pr_no WHERE rfq.id = '$id' ");
$row = mysqli_fetch_array($select);
$rfq_no = $row['rfq_no'];
$rfq_date = $row['rfq_date'];
$purpose = $row['purpose'];
$pmo = $row['pmo'];
$pr_no = $row['pr_no'];
$pr_id = $row['id'];
$pr_date = $row['pr_received_date'];
?>
<?php
if (isset($_POST['submit'])) {

    $supplier_id = $_POST['supplier_id'];
    $sql_items1 = mysqli_query($conn, "SELECT sum(pr.qty*pr.abc) as totalABC,pr.id,item.item_unit_title,app.procurement,pr.unit,pr.qty,pr.abc FROM pr_items pr LEFT JOIN app on app.id = pr.items left join item_unit item on item.id = pr.unit WHERE pr_no = '$pr_no' ");
    $rowA = mysqli_fetch_array($sql_items1);
    $totalABC = $rowA["totalABC"];

    $select_supp = mysqli_query($conn,"SELECT * FROM supplier WHERE id = $supplier_id");
    $rowSup = mysqli_fetch_array($select_supp);
    $supName = $rowSup['supplier_title'];
    $supContact = $rowSup['contact_person'];
    $supAddress = $rowSup['supplier_address'];

    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href = 'export_pos.php?supName=$supName&supContact=$supContact&supAddress=$supAddress&rfq_no=$rfq_no&purpose=$purpose&totalABC=$totalABC&pmo=$pmo';
        </SCRIPT>");

}



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header with-border" align="left">
                <h1>RFQ No. &nbsp <?php echo $rfq_no;?></h1>
            </div>
            <div class="box-bodyno-padding">
                <div class="box-body">


                 <!-- <a href="ViewRFQdetails.php?id=<?php echo $pr_id; ?>" class="btn btn-primary">Update</a> |  -->
                 <a href="ViewRFQ.php" class="btn btn-warning"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
                 <a href="UpdateRFQ.php?id=<?php echo $id?>" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i>Edit</a>
                 <a href="export_rfq.php?id=<?php echo $id; ?>" class="btn btn-success pull-right"><i class="fa fa-fw fa-download"></i>Export</a> 
                 <br>
                 <br>
                 <h4>Item(s)</h4>
                 <table id="" class="table table-striped table-bordered" style="background-color: white;">
                    <thead>
                        <tr style="background-color: white;color:blue;">
                            <th width="">Item</th>
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

                <table id="" class="" style="background-color: white;">
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
                    $tot = number_format($abc111,2);


                    ?>
                    <tr>
                        <td  width="500"></td>
                        <td  width="500"></td>
                        <td  width="500"></td>
                        <td  width="500"></td>
                        <td  width="500"><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $tot?></b></td>



                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="box box-success">
        <div class="box-header with-border" align="left">
            <h4><strong>RFQ Details</strong></h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <table id="example1" class="table table-striped " style="background-color: white;">
                    <tr>
                        <th class="pull-left" >RFQ Date</th>
                        <td width="200"><?php echo date('F d, Y',strtotime($rfq_date));?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Purpose</th>
                        <td><?php echo $purpose;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left">Office</th>
                        <td><?php echo $pmo;?></td>
                    </tr>

                    <tr>
                        <th class="pull-left">PR No.</th>
                        <td><?php echo $pr_no;?></td>
                    </tr>
                    <tr>
                        <th class="pull-left" >PR Date Received</th>
                        <td><?php echo date('F d, Y',strtotime($pr_date));?></td>
                    </tr>
                    <tr>
                        <th class="pull-left"  >ABC</th>
                        <td><?php echo number_format($abc111,2);?></td>
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
<div class="col-md-4" style="float: right;">
    <div class="box box-primary">
        <div class="box-header with-border" align="left">
            <h4><strong>Proof of Sending</strong></h4>
        </div>
        <div class="box-body table-responsive no-padding">
            <div class="box-body">
                <form method="POST">
                   <div class="form-group">
                    <label>Select Supplier</label>
                    <select class="form-control select2" style="width: 100%;" autocomplete="off" id="supplier_id" name="supplier_id" >
                       <option value="" disabled selected>Select your Supplier</option>
                       <?php echo supplier($connect); ?>
                   </select> 
               </div>
               <div hidden>
                <input type="text" id="rfq_no" value="<?php echo $rfq_no?>">
                <input type="text" id="pmo" value="<?php echo $pmo?>">
                <input type="text" id="purpose" value="<?php echo $purpose?>">
                <input type="text" id="pr_no" value="<?php echo $pr_no?>">
            </div>
            <a style="float:right;" href="javascript:void(0);" class="btn btn-primary link" data-id="<=$data['id']?>">Generate</a>
        </form>
    </div>
</div>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-7">
    </div>
    <div class="col-md-5">
    </div>
</div>
</body>
<script>
  $(document).ready(function(){

    $('.link').click(function(){

      var f = $(this);
      var id = f.data('id');

      var supplier_id = $('#supplier_id').val();
      var rfq_no = $('#rfq_no').val();
      var pmo = $('#pmo').val();
      var purpose = $('#purpose').val();
      var pr_no = $('#pr_no').val();

      window.location = 
      'export_pos.php?data='+id+'&supplier_id='+supplier_id+'&rfq_no='+rfq_no+'&pmo='+pmo+'&purpose='+purpose+'&pr_no='+pr_no;
  });
}) ;
</script>
</html>


