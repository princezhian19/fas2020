<?php
include('db.class.php'); // call db.class.php
$mydb = new db(); // create a new object, class db()
?>

<!DOCTYPE html>
<html>
<head>
  <title>Procurement</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    
    <div class="box">
  <div class="box-body">
            <h1 align="">Request For Quotation</h1>
            <div class="box-header">
            </div>
            <br>

            <!-- &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<li class="btn btn-success"><a href="CreatePR.php" style="color:white;text-decoration: none;">Create</a></li> -->

            <br>
            
   
            <!-- <h3 align="center"><b>Inspection Acceptance Report</b></h3> -->

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                        <th width="0"></th>
                        <th>PR NO</th>
                        <th>PR DATE</th>
                        <th>OFFICE</th>
                        <th width="100">TYPE</th>
                        <th width="200">PURPOSE</th>
                        <th>TARGET DATE</th>
                        <th>RFQ NO</th>
                        <th>RFQ DATE</th>
                        <th>RFQ</th>
                        <th>SUPPLIER QOUTE</th>
                        <th>ABSTRACT</th>
                        <th>PURCHASE ORDER</th>
                        <th width="0"></th>
                    </tr>
                </thead>

                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function(){
                      $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#example1 tr").filter(function() {
                          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                      });
                    });
                    </script> -->
                <?php
 
                $conn=mysqli_connect("localhost","root","","db_dilg_pmis");
                $view_query = mysqli_query($conn, "SELECT a.id,a.pr_no,a.pmo,a.purpose,a.pr_date,a.type,a.target_date,a.stat,b.rfq_no,b.rfq_date FROM pr as a left join rfq as b ON a.pr_no=b.pr_no order by a.id DESC");
                // $view_query = mysqli_query($conn, "SELECT rfq.id, rfq.pr_no, pr.date,pr.pmo, pr.purpose, pr.target_date FROM rfq LEFT join pr ON rfq.pr_no = pr.pr_no  order by id desc ");
                while ($row = mysqli_fetch_assoc($view_query)) {
                   // $getID = $row["id"]; 
                    $id = $row["id"];
                    $pr_no = $row["pr_no"];  
                    $pmo = $row["pmo"];

                    $purpose = $row["purpose"];
                    $pr_date = $row["pr_date"];
                    $pr_date1 = date('F d, Y', strtotime($pr_date));
                    $type = $row["type"];
                    $target_date = $row["target_date"];
                    $target_date1 = date('F d, Y', strtotime($target_date));
                    
                    $stat = $row["stat"];
                    $rfq_no =  $row["rfq_no"];
                    $rfq_date =  $row["rfq_date"];
                    $rfq_date1 = date('F d, Y', strtotime($rfq_date));
                    


                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $pr_no;?></td>
                        <td><?php echo $pr_date1;?></td>
                        <td><?php echo $pmo;?></td>
                    
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
                          <td><?php echo "Supplies, Materials and Devices";?></td>
                        <?php endif?>
                        <?php if ($type == "5"): ?>
                          <td><?php echo "Other Services";?></td>
                        <?php endif?>
                        <td><?php echo $purpose;?></td>
                        <td><?php echo $target_date1;?></td>
                        <td><?php echo $rfq_no;?></td>
                        
                        <?php if ($rfq_date == ""): ?>
                          <td></td>
                        <?php endif?>  
                        <?php if ($rfq_date != ""): ?>
                          <td><?php echo $rfq_date1;?></td>
                        <?php endif?>
                        
                        <td>
                        <?php if ($stat == "1"): ?>
                       <?php
                        $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                        $rowrfq = mysqli_fetch_array($view_queryrfq);
                        $rfqid = $rowrfq['id'];
                       
                        ?>
                         <!-- &nbsp&nbsp&nbsp&nbsp&nbsp<a href='/pmis/frontend/web/rfq/view?id=<?php echo $rfqid; ?>'> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->
                        
                         &nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-primary btn-xs" href='/pmis/frontend/web/rfq/view?id=<?php echo $rfqid; ?>'> View RFQ </a>
                        <?php endif?>

                        <?php if ($stat == "0"): ?>
                          <!-- <?php echo "For Encode";?> -->

                        <!-- &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='CreateRFQ.php?prID=<?php echo $id;?>' title="View"> Create RFQ </a> -->
                        &nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-success btn-xs" href='CreateRFQ.php?prID=<?php echo $id;?>' >Create RFQ</a>
                        <?php endif?>
                        
                        <!-- &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $getID; ?>' > <i style='font-size:20px' class='fa'>&#xf044;</i> </a> -->

                         <!-- &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='ViewPRv.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->

                        </td>
                        <td>

                        <?php if ($stat == "1"): ?>
                        <?php
                        $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                        $rowrfq = mysqli_fetch_array($view_queryrfq);
                        $rfqid = $rowrfq['id'];
                                                
                        $query = mysqli_query($conn,"SELECT id FROM rfq WHERE id = '$rfqid' ");
                        $row = mysqli_fetch_array($query);
                        $rfq_id = $row['id'];

                        $query_2 = mysqli_query($conn,"SELECT id FROM rfq_items WHERE rfq_id = $rfq_id ");
                        $row_2 = mysqli_fetch_array($query_2);
                        $rfq_items_id = $row_2['id'];

                        $query_3 = mysqli_query($conn,"SELECT * FROM supplier_quote WHERE rfq_item_id = '$rfq_items_id'");
                        
                        ?>
                         <?php if (mysqli_num_rows($query_3) > 0 ): ?>
                          <a class="btn btn-primary btn-xs"  href='ViewSupplierItems.php?rfq=<?php echo $rfq_items_id; ?>' title="View"> View Suppliers Quote </a>
                         
                          <?php else: ?>
                          &nbsp&nbsp&nbsp&nbsp&nbsp<a class="btn btn-success btn-xs"  href='/pmis/frontend/web/supplier-quote/encode?rfq=<?php echo $rfqid; ?>' title="View"> Encode </a> 

                          <?php endif?>
                        <?php endif?>

                        </td>
                        
                        <td>
                        

                        <?php if ($stat == "1"): ?>
                        <?php
                        
                        $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                        $rowrfq = mysqli_fetch_array($view_queryrfq);
                        $rfqid = $rowrfq['id'];
                                                
                        $query = mysqli_query($conn,"SELECT id FROM rfq WHERE id = '$rfqid' ");
                        $row = mysqli_fetch_array($query);
                        $rfq_id = $row['id'];
                          
                          $view_aoq = mysqli_query($conn,"SELECT rfq_id FROM abstract_of_quote WHERE rfq_id = $rfq_id ");
                          $rowraoq = mysqli_fetch_array($view_aoq);
                          $rfq_idaoq = $rowraoq['rfq_id'];
                        
                        ?>

                          <?php if (mysqli_num_rows($view_aoq) > 0 ): ?>
                          <a class="btn btn-primary btn-xs"  href='../frontend/web/abstract-of-quote/view?id=<?php echo $rfq_idaoq; ?>' title="View"> View Abstract of Quote </a>
                         
                          <?php else: ?>
                          <a class="btn btn-success btn-xs"  href='../frontend/web/abstract-of-quote/create' title="View"> Encode </a>

                          <?php endif?>

                          
                        <?php endif?>

                        <?php if ($stat == "0"): ?>
                        
                          <?php endif?>
                      
                        </td>
                        <td>
                        
                          
                        <?php if ($stat == "1"): ?>
                        <?php

                           
                      $view_queryrfq = mysqli_query($conn, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                      $rowrfq = mysqli_fetch_array($view_queryrfq);
                      $rfqid = $rowrfq['id'];
                                              
                      $query = mysqli_query($conn,"SELECT id FROM rfq WHERE id = '$rfqid' ");
                      $row = mysqli_fetch_array($query);
                      $rfq_id = $row['id'];
                        
                        $view_po = mysqli_query($conn,"SELECT rfq_id FROM selected_quote WHERE rfq_id = $rfq_id ");
                        $rowrpo = mysqli_fetch_array($view_po);
                        $rfq_idpo = $rowraoq['rfq_id'];
                      
                      ?>

                        <?php if (mysqli_num_rows($view_po) > 0 ): ?>
                        <a class="btn btn-primary btn-xs"  href='../frontend/web/purchase-order/view?id=<?php echo $rfq_idpo; ?>' title="View"> View Purchase Order </a>
                      
                        <?php else: ?>
                        <a class="btn btn-success btn-xs"  href='../frontend/web/purchase-order/create' title="View"> Encode </a>

                        <?php endif?>

                    
                      
                        
                        <?php endif?>

                        <?php if ($stat == "0"): ?>
                        
                          <?php endif?>
                       
                        </td>
                        <td></td>
                        <!-- <td>                     
                        
                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='deletePRfinalize.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:24px' class='fa fa-trash-o' ></i> </a>

                    </td> -->


                    
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
        $('#exmaple1').DataTable();

    } );
</script>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker,
    $('#datepicker1').datepicker({
      autoclose: true
    })

    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>


</div>
</div>


<div class="panel-footer"></div>
</div>
</div>

</body>
</html>



