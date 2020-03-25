<?php
/* include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db() */
?>



<style>
.container {
	max-width: 940px;	
	margin: 0 auto;
  
}
</style>

<!DOCTYPE html>
<html>


<head>
  <title>Request for Quotation</title>


</head>

<body>
    <div class="">
      <div class="panel panel-default">
        <div class=""> 
          <div class="">
            <br>
            <h1 align="">&nbspRequest for Quotation</h1>
            <div class="box-header with-border">
            </div>
            <br>

            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-success"><a href="CreateRFQ.php" style="color:white;text-decoration: none;">Create</a></li>
            <br>
            <br>
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->
        <div class="" >
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="50"></th>
                        <th>RFQ No.</th>
                        <th>RFQ Date</th>
                        <th>Office</th>
                        <th>Mode of Procurement</th>
                        <th>PR Date Received</th>
                        <th width="0"></th>
                        <th width="0"></th>
                    </tr>
                </thead>
                <?php 
                $conn=mysqli_connect("localhost","root","","fascalab_2020");
                $view_query = mysqli_query($conn, "SELECT  rfq.id,rfq.rfq_no,rfq.rfq_date,rfq.pr_received_date,pmo.pmo_title,rfq_mode.rfq_mode_title FROM rfq LEFT JOIN rfq_pmo on rfq_pmo.rfq_id = rfq.id LEFT JOIN pmo on pmo.id = rfq_pmo.pmo_id LEFT JOIN rfq_mode on rfq_mode.id = rfq.rfq_mode_id GROUP BY rfq.rfq_no ORDER BY rfq.id DESC ");

                while ($row = mysqli_fetch_assoc($view_query)) {

                    $id = $row["id"];
                    $rfq_no = $row["rfq_no"];  
                    $pmo = $row["pmo_title"];
                    $mode = $row["rfq_mode_title"];
                    $rfq_date = $row["rfq_date"];
                    $pr_received_date = $row["pr_received_date"];
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $rfq_no;?></td>
                        <td><?php echo $rfq_date;?></td>
                        <td><?php echo $pmo;?></td>
                        <td><?php echo $mode;?></td>
                        <td><?php echo $pr_received_date;?></td>
                        <td>
                         <!--  &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=<?php echo $id; ?>' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->

                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='/pmis/frontend/web/rfq/view?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a>

                     </td>
                     <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $id; ?> '> 
                    <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
                <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='deleteRFQ.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:24px' class='fa fa-trash-o' ></i> </a>
                    </td>
                    
                </tr>
            <?php } ?>
        </table>
        </div>
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


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



