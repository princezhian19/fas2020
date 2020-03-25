<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>

<!DOCTYPE html>
<html>
<head>
  <title>Annual Procurement Plan</title>


</head>

<body>
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <br>
            <h1 align="">&nbspAnnual Procurement Plan</h1>

            <div class="box-header with-border">
            </div>
            <br>

            &nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-success"><a href="CreateAPP.php" style="color:white;text-decoration: none;">Add Item</a></li>
            &nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-info"><a href="http://localhost/pmis/frontend/web/form/excel-consolidated-app?id=" style="color:white;text-decoration: none;">Export Consolidated App</a></li>
            <br>
            <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="0"></th>
                        <th width="150">Stock No.</th>
                        <th width="150">Code (PAP)</th>
                        <th width="150">Category</th>
                        <th width="150">Item</th>
                        <th width="150">PMO/End-User</th>
                        <th width="150">Mode of Procurement</th>
                        <th width="150">Source of Funds</th>
                        <th width="0"></th>
                        <th width="0"></th>
                        <th width="0"></th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "
                    SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
                    FROM app 
                    LEFT JOIN item_category ic on ic.id = app.category_id 
                    LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
                    LEFT JOIN pmo on pmo.id = app.pmo_id 
                    LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
                    ORDER BY app.id DESC ");

                while ($row = mysqli_fetch_assoc($view_query)) {

                    $id = $row["id"];  
                    $sn = $row["sn"];  
                    $code = $row["code"];
                    $item_category_title = $row["item_category_title"];
                    $procurement = $row["procurement"];
                    $pmo_title = $row["pmo_title"];
                    $mode = $row["mode_of_proc_title"];
                    $source_of_funds_title = $row["source_of_funds_title"];

                    // if pmo == 1 and 2 print ord and lgmed

                    ?>
                    <tr>
                        <td></td>
                        <td width="1000"><?php echo $sn;?></td>
                        <td width="1000"><?php echo $code;?></td>
                        <td width="1000"><?php echo $item_category_title;?></td>
                        <td width="2000"><?php echo $procurement;?></td>
                        <td width="150"><?php echo $pmo_title;?></td>
                        <td width="1000"><?php echo $mode;?></td>
                        <td width="1000"><?php echo $source_of_funds_title;?></td>
                        <td width="150">
                         <!--  &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=<?php echo $id; ?>' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->

                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='UpdateAPP.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>

                     </td>
                     <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $id; ?> '> 
                    <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
                <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='delete_app.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:20px' class='fa fa-trash-o' ></i> </a>

                    </td> -->
                    <td></td>
                    
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

</div>
</div>

</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();

    } );
</script>
</div>
</div>
    <!-- <div class="container">
  <h2>Inline form</h2>
  <p>Make the viewport larger than 768px wide to see that all of the form elements are inline, left aligned, and the labels are alongside.</p>
  
</div> -->

<div class="panel-footer"></div>
</div>
</div>

</body>
</html>