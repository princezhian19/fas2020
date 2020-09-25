<?php
date_default_timezone_set('Asia/Manila');
$timeNow = (new DateTime('now'))->format('m/d/Y');
//Replace now() Variable
// echo $timeNow;
/* value = "<?php echo $timeNow;?>" */
?>


<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>


</head>
<body>

<div class="box" style="border-style: groove;">
  <div class="box-body">
          <h1 align="">&nbspDisbursement</h1>
         
          <br>
          
        
            <div class="col-md-0" style="overflow-x:auto;">


                  <table class="table" > 

                <!-- Header -->
                  <tr>
                  <td class="col-md-1">
                  <li class="btn btn-success"><a href="Disbursement_Create.php" style="color:white;text-decoration: none;">Create</a></li>
                  </td>
                      
                  <td class="col-md-7" >

                  
                  </td>
                  <form method = "POST" action = "@Functions/ddateexport1.php">
                  <td class="col-md-1" style = "text-align:center;">
                  <input type="text" class="" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 220px" value = "<?php echo $timeNow;?>">
                
                 <td class="col-md-1" >
                <input type="text" class="" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 220px" value = "<?php echo $timeNow;?>">
                
                </td>
                <td class="col-md-1" >
                <button type="submit" name="submit"  class="btn btn-success pull-right ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter/Export Data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                
                </td>

                <td class="col-md-1" >
                <button type="Summary" name="Summary"  class="btn btn-success pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Export Summary&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                
                </td>
                    
                        
                </form>

            
                  </td>
                  </tr>
                  <!-- Header -->
                  <table>    

          
            <div class="col-md-0" style="overflow-x:auto;">
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;" >
              <thead>
                <tr style="background-color: white;color:blue;">
                  <th style="text-align:center" width="">DVs No.</th>
                  <th style="text-align:center" width="">ORS/BURS No.</th>
                  <!-- <th style="text-align:center" width="">SR No.</th>
                  <th style="text-align:center" width="">PPA</th>
                  <th style="text-align:center" width="">UACS</th> -->
                  <th style="text-align:center" width="">ORS/BURS DATE</th>
                  <th style="text-align:center" width="">DATE RECEIVED</th>
                  
                  <th style="text-align:center" width="">DATE DISBURSED</th>
                  <th style="text-align:center" width="">DATE RELEASED</th>
                  <th style="text-align:center" width="400">PAYEE</th>
                  <th style="text-align:center" width="400">PARTICULAR</th>
                  <th style="text-align:center" width="">GROSS AMOUNT</th>
                 <!--  <th style="text-align:center" width="">TAX</th>
                  <th style="text-align:center" width="">GSIS</th>
                  <th style="text-align:center" width="">PAGIBIG</th>
                  <th style="text-align:center" width="">PHILHEALTH</th>
                  <th style="text-align:center" width="">OTHER PAYABLES</th> -->
                  <th style="text-align:center" width="">TOTAL DEDUCTIONS</th>
                  <th style="text-align:center" width="">NET AMOUNT</th>
                  <th style="text-align:center" width="">REMARKS</th>
                  <th style="text-align:center" width="">STATUS</th>
                  <th style="text-align:center" width="50">ACTION</th>
                  <!-- <th style="text-align:center" width="150">FLAG</th> -->
                </tr>
              </thead>
              <?php
              $servername ="localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
            // Create connection
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT dv,ors,datereceived,date_proccess,datereleased,payee,particular,sum(amount) as amount, total, net, remarks, status,flag,orsdate  FROM disbursement group by ors order by ID asc");
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
                $amount1 = $row["amount"];
                $amount = number_format($amount1,2);
                $tax = $row["tax"];
                $gsis = $row["gsis"];
                $pagibig  = $row["pagibig"];
                $philhealth = $row["philhealth"];
                $other = $row["other"];
                $total1 = $row["total"];
                $total = number_format($total1,2);

                $net1 = $row["net"];
                $net = number_format($net1,2);
                $remarks = $row["remarks"];
                $status = $row["status"];


                //Getting Flag
                $flag = $row["flag"];

                $date_proccess1 = $row["date_proccess"];
                $date_proccess = date('F d, Y', strtotime($date_proccess1));
                $datereleased1 = $row["datereleased"];
                $datereleased = date('F d, Y', strtotime($datereleased1));


                $orsdate1 = $row["orsdate"];
                // echo $orsdate1;
            
                $orsdate = date('F d, Y', strtotime($orsdate1));
                ?>
                <tr>
                <td><a href="" onclick="myFunction(this)" data-flag="<?php echo $flag;?>" data-ors="<?php echo $ors;?>" data-toggle="modal" data-target="#dv_data_Modal"><?php echo $dv;?></a></td>
                <td><?php echo $ors;?></td>
                
                  <?php if ( $orsdate1 =='0000-00-00' || $orsdate1 == '1970-01-01' ): ?>
                    <td></td>
                    <?php else: ?>
                      <td><?php echo $orsdate;?></td>
                    <?php endif ?>

                  <?php if ($datereceived == '1970-01-01' || $datereceived =='0000-00-00'): ?>
                    <td><a href="received_dv.php?ors=<?php echo $ors;?>" class="btn btn-primary btn-xs">Receive</a></td>
                    <?php else: ?>
                      <td><?php echo $datereceived11;?></td>
                    <?php endif ?>
                   

                    
                          <?php if ($date_proccess1 != NULL  ): ?>
                            <td><?php echo $date_proccess;?></td>
                            <?php else: ?>
                              <?php if ($datereceived != '0000-00-00'): ?>
                                <td><a class="btn btn-success btn-xs" href='Disbursement_process.php?ors=<?php echo $ors;?>&flag=<?php echo $flag;?>&payee=<?php echo $payee;?>&particular=<?php echo $particular;?>&amount=<?php echo $amount;?>&orsdate=<?php echo $orsdate;?>'>Process</a> </td>
                                <?php else: ?>
                                  <td></td>
                                <?php endif ?>
                              <?php endif ?> 


                              <?php if ($date_proccess1 == '0000-00-00'): ?>
                                <td>
                                </td>
                               <?php else: ?>
                                <?php if ($datereleased1 != '0000-00-00'): ?>
                                  <td><?php echo $datereleased;?></td>
                                <?php else: ?>

                                <td><!-- <a class="btn btn-success btn-xs" href='release_dv.php?id=<?php echo $id; ?>' >Release</a>  --></td>
                               <?php endif ?>

                              <?php endif ?>



                                  <td><?php echo $payee;?></td>
                                  <td><?php echo $particular;?></td>
                                  <td><?php echo $amount;?></td>
                                  <td><?php echo $total;?></td>
                                  <td><?php echo $net;?></td>
                                  <td><?php echo $remarks;?></td>
                                
                                  <td><?php echo $status;?></td>
                                       
                                      <td>

                                      <a  class="btn btn-primary btn-xs" href='Disbursement_Update.php?id=<?php echo $ors?>'> <i class='fa'>&#xf044;</i>  Edit </a>
                                        <!-- <a  class = "btn btn-primary btn-xs" href='disbursementupdate.php?getid=<?php echo $id;?>' > <i class='fa'>&#xf044;</i> Edit</a> | 
                                      
                                        <a onclick="return confirm('Are you sure you want to delete this record?');" name=""  href="@Functions/ddeletefunction.php?getid=<?php echo $id;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>                                      -->
                                      </td>
                                    <!--   <td>
                                      <?php echo $flag;?>
                                      </td> -->
                                    </tr>
                                  <?php } ?>    
                                </table>
                          </div>

                          </div>
                          </div>
</body>


</html>   
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'mm/dd/yyyy' })
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
