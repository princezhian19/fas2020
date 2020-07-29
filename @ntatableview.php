<?php



$getntano = $_GET['getntano'];
$getparticular = $_GET['getparticular'];
$disbursed = $_GET['disbursed'];
// echo $disbursed;


?>


<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>

  <!-- bootstrap datepicker -->
 
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

</head>
<body>

<div class="box" style="border-style: groove;">
  <div class="box-body">
            
  <div class="class"  style="overflow-x:auto;">
            <br>
            
      
            <form method = "POST" action = "@Functions/obviewexport.php">
           <!--  Getting Hidden Variables -->
            <input type="text" class="text" name="ntano" value="<?php echo $getntano?>" hidden>
            <input type="text" class="text" name="particular" value="<?php echo $getparticular?>" hidden>
           
            <!--  Getting Hidden Variables -->


            <h3 align="" >&nbspNTA No. :  <label ><?php echo $getntano?></label></h3>
            <h3 align="" >&nbspParticular :   <label name="particular" ><?php echo $getparticular?></label></h3>
            <!-- <h1 align="" >&nbspAllotment Amount :   <label ><?php
              
              $servername = "localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
              
            $conn = new mysqli($servername, $username, $password,$database);
             $getAmount = mysqli_query($conn, "SELECT * FROM  nta where  nta = '$getntano' and particular = '$getparticular' ");
             $rowAmount = mysqli_fetch_array($getAmount);
             $amount = $rowAmount['amount'];
            echo number_format($amount,2)?></label></h1>
            -->

            <h3 align="" >&nbspDisbursed Amount :   <b><?php echo  number_format($disbursed,2)?></b></h3>
            <input type="text" class="text" name="totaldisbursed" value="<h><?php echo $rowAmount['a'];?>" hidden>


        
            
        <br>
      <br>
      <table id="example1" class="table table-striped table-bordered " style="background-color: white; overflow-x:auto;" >
              <thead>
                <tr style="background-color: white;color:blue;">
                <th style="text-align:center" width="">DVs No.</th>
                  <th style="text-align:center" width="">ORS/BURS No.</th>
              
                  <th style="text-align:center" width="">ORS DATE</th>
                  <th style="text-align:center" width="">DATE DISBURSED</th>
                  <th style="text-align:center" width="">DATE RELEASED</th>
                  <th style="text-align:center" width="400">PAYEE</th>
                  <th style="text-align:center" width="400">PARTICULAR</th>
                  <th style="text-align:center" width="">GROSS AMOUNT</th>
               
                  <th style="text-align:center" width="">TOTAL DEDUCTIONS</th>
                  <th style="text-align:center" width="">NET AMOUNT</th>
                  <th style="text-align:center" width="">REMARKS</th>
                  <th style="text-align:center" width="">STATUS</th>
                  
                </tr>
              </thead>
              <?php
              $servername = "localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
            // Create connection
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT a.ID,a.dv,a.ors,a.datereceived,a.date_proccess,a.datereleased,a.payee,a.particular, a.remarks, a.status,a.flag,a.amount,a.total,a.net,b.dv,b.accno  FROM disbursement as a inner join dv_nta as b ON a.dv = b.dv   where b.accno = '$getparticular' group by ors order by a.ID desc");
              /* echo "SELECT a.ID,a.dv,a.ors,a.datereceived,a.date_proccess,a.datereleased,a.payee,a.particular, a.remarks, a.status,a.flag,b.dv,b.accno  FROM disbursement as a inner join dv_nta as b ON a.dv = b.dv   where b.accno = '$getparticular' group by ors order by a.ID desc";
              exit(); */
              
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["ID"]; 
                $dv = $row["dv"];
                $ors = $row["ors"];
                $sr = $row["sr"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"];
                $datereceived = $row["datereceived"];
                $datereceived11 = date('F d, Y', strtotime($datereceived));
                $timereceived = $row["timereceived"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                $amount = $row["amount"];
                $tax = $row["tax"];
                $gsis = $row["gsis"];
                $pagibig  = $row["pagibig"];
                $philhealth = $row["philhealth"];
                $other = $row["other"];
                $total = $row["total"];
                $net = $row["net"];
                $remarks = $row["remarks"];
                $status = $row["status"];
                $date_proccess = $row["date_proccess"];
                $date_proccess1 = date('F d, Y', strtotime($date_proccess));
                $datereleased1 = $row["datereleased"];
                $datereleased = date('F d, Y', strtotime($datereleased1));
                ?>
                <tr>
                <td><a href="" onclick="myFunction(this)" data-flag="<?php echo $flag;?>" data-ors="<?php echo $ors;?>" data-toggle="modal" data-target="#dv_data_Modal"><?php echo $dv;?></a></td>
                  <td><?php echo $ors;?></td>
                <!--   <td><?php echo $sr;?></td>
                  <td><?php echo $ppa;?></td>
                  <td><?php echo $uacs;?></td> -->
                  <?php if ($datereceived == '1970-01-01' || $datereceived =='0000-00-00'): ?>
                    <td><a href="received_dv.php?id=<?php echo $id;?>" class="btn btn-primary btn-xs">Receive</a></td>
                    <?php else: ?>
                      <td><?php echo $datereceived11;?></td>
                    <?php endif ?>
                    <!-- <?php if ($datereceived != '0000-00-00'): ?>
                      <td><a class="btn btn-success btn-xs" href='CreateDisbursement.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                      <?php else: ?>
                        <?php if ($datereleased != '0000-00-00'): ?>
                          <td><?php echo $datereleased;?></td>
                          <?php else: ?>
                            <td></td>
                          <?php endif ?>
                          <td></td>
                          <?php endif ?> -->
                          <?php if ($date_proccess != NULL): ?>
                            <td><?php echo $date_proccess1;?></td>
                            <?php else: ?>
                              <?php if ($datereceived != '0000-00-00'): ?>
                                <td><a class="btn btn-success btn-xs" href='CreateDisbursement.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                                <?php else: ?>
                                  <td></td>
                                <?php endif ?>
                              <?php endif ?> 
                              <?php if ($datereleased != '0000-00-00'): ?>
                                <td><?php echo $datereleased;?></td>
                                <?php else: ?>
                                  <?php if ($date_proccess == NULL): ?>
                                    <td></td>
                                    <?php else: ?>
                                      <td><a class="btn btn-success btn-xs" href='release_dv.php?id=<?php echo $id; ?>&stat=1' >Release</a> </td>
                                    <?php endif ?>
                                  <?php endif ?>
                                  <td><?php echo $payee;?></td>
                                  <td><?php echo $particular;?></td>
                                  <td><?php echo $amount;?></td>
                                 <!--  <td><?php echo $tax;?></td>
                                  <td><?php echo $gsis;?></td>
                                  <td><?php echo $pagibig;?></td>
                                  <td><?php echo $philhealth;?></td>
                                  <td><?php echo $other;?></td> -->
                                  <td><?php echo $total;?></td>
                                  <td><?php echo $net;?></td>
                                  <td><?php echo $remarks;?></td>
                                
                                  <td><?php echo $status;?></td>
                                       
                                   
                                    </tr>
                                  <?php } ?>    
                                </table>


</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example1').DataTable();
    } );
</script>





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


<div id="dv_data_Modal" class="modal fade" role="dialog" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">DISBURSEMENT</h4>
            </div>
            <div class="modal-body">
              <!-- <form method="POST" action="ro_cancel.php" > -->
              
        
              <div class="addmodal" >
              <h4 class="modal-title">Breakdown for BURS/ORS No.&nbsp;<input style="border:none; font-weight:bolder"  type="text" name="ors11" id="ors11" value="" class=""/></h4>
              

             

           
              <br>

            
              <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12" >
                                        <!-- Table of Uacs -->
                                        <table id="example" class="table table-responsive table-stripped table-bordered " style="background-color: white; width:100%; text-align:left; border-style: groove;" >
                                        <thead>
                                        <tr style="background-color: #A9A9A9;  text-align:left; border-style: groove; " >
                                       
                                        <th width='500'>ID</th>
                                        <th width='500'>FUND SOURCE</th>
                                        <th width='500'>PPA </th>
                                        <th width='500'>UACS </th>
                                        <th width='500'>AMOUNT </th>
                                        <th width='500'>STATUS </th>
                                        <!-- <th width='500'>ACTION</th> -->
     
                                        </thead>

                                        </table>

                                        <!-- Table of Uacs -->

                                    </div>

                                </div>

                                


                            </div>



              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
              <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

              <script type="text/javascript">
              
              </script>
              <script>

                  function myFunction(orsget) {
                    
                    //getting from data-id from link
                    var ors = orsget.getAttribute("data-ors");
                    var flag = orsget.getAttribute("data-flag");
                 
                    var ors1 = $("input[name='ors1']");
                    var ors11 = $("input[name='ors11']");
                    
                    ors1.val(flag);
                    ors11.val(ors);


                    $(document).ready(function(){

                        var ors = orsget.getAttribute("data-ors");
                        var flag = $('#ors1').val();
                        // alert(flag);



                        $('#example').DataTable().destroy();
                        dataT();

                        });

                        function dataT(){

                        // var filter_data ='0001';


                        var table = $('#example').DataTable( {
                          

                      'paging'      : true,
                      'lengthChange': false,
                      'searching'   : true,
                      'ordering'    : false,
                      'info'        : false,
                      'autoWidth'   : false,  
                        "processing": true,
                        "serverSide": false,
                        // "columnDefs": [{"render": createManageBtn, "data": null, "targets": [6]}],
                        
                        "ajax": {
                        "url": "DATATABLE/DV_data.php",
                        "type": "POST",
                        "data": {
                        "filter_data": ors,
                        "flag": flag,


                        }}

                        } );


                      $('#example tbody').on( 'click', '#editORS', function () {
                      var data = table.row( $(this).parents('tr') ).data();
                      window.location="obupdate.php?getid="+data[0];
                      });

                      $('#example tbody').on( 'click', '#delete', function () {
                      var data = table.row( $(this).parents('tr') ).data();
                      window.location="@Functions/obdeletefunction.php?getidDelete="+data[0];
                      });
                     
                      
                      function createManageBtn() {

                      
                      return '<a  class="btn btn-primary btn-xs" onclick="myFunc()" id="editORS"><i class="fa">&#xf044;</i>&nbsp;&nbsp;Edit&nbsp;&nbsp;</a> | <a  class="btn btn-danger btn-xs" onclick="myFunc()" onclick="" id="delete"><i class="fa fa-trash-o"></i>  Delete</a>';

                    

                      }
                      function myFunc() {
                      confirm("Are you sure you want to delete this obligation?")
                      console.log("Button was clicked!!!");
                      // alert(data[0]);
                      }

                        
                       


                        }
                
                    
                  }

                  </script>


              <input hidden   type="text" name="ors1" id="ors1" value="" class=""/>
              <br>
              <input hidden  type="text" name="user" id="user" value="<?php echo $username1?>" class=""/>
              <br>
              <input hidden  type="text" name="now" id="now" value=" <?php date_default_timezone_set('Asia/Manila'); echo date('F d, Y') ?>" class=""/>
              </tr>
              </table>
     
                </div>
           
                <!-- </form> -->
          </div>
        </div>

      
    
    </div>

    </div>



</body>
</html>





