<?php
include('db.class.php'); // call db.class.php
?>
<!DOCTYPE html>
<html>
<head>
  <title>Financial Management System</title>


</head>
<body>
<div class="box " style="border-style: groove;">
  <div class="box-body">
          
          <h1 align="">&nbspObligation BURS</h1>
          
          <br>



                    <table class="table" > 

                <!-- Header -->
                  <tr>
                  <td class="col-md-2">
                  <li class="btn btn-warning"><a href="obligation.php" style="color:white;text-decoration: none;">Back</a></li>

                  <li class="btn btn-success   "><a href="ObligationCreate.php" style="color:white;text-decoration: none;">Create</a></li>


                  
                  </td>
                      
                  <td class="col-md-7" >

                    
                  </td>

          

                  <form method = "POST" action = "@Functions/obdateexport.php">
                  <td class="col-md-1">
                  <input type="text" class="" id="datepicker1" placeholder='From Date' name="datefrom" style="height: 35px; width: 250px" autocomplete="off">

                  </td>
                  <td class="col-md-1">
                  <input type="text" class="" id="datepicker2" placeholder='To Date' name="dateto" style="height: 35px; width: 250px" autocomplete="off">

                  </td>
                  <td class="col-md-1">
                  <button type="submit" name="submit"  class="btn btn-success pull-right">Filter/Export Data</button>

                  </td>
                  <td class="col-md-1">
                  <button type="Summary" name="Summary"  class="btn btn-success pull-right">Export Summary</button>

                  </td>
                 
           
                </form>
                  

               

                  </tr>
                  <!-- Header -->
                </table>

        
          <div class=""  style="overflow-x:auto;">
          
              <br>
              <br>
           
            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue;">
                 
                  <th>DATE RECEIVED</th>
                  <th>DATE OBLIGATED</th>
                  <th>DATE RETURNED</th>
                  <th>DATE RELEASED</th>
                  <th>BURS NUMBER</th>
                  <th>PO NUMBER</th>
                  <th>PAYEE</th>
                  <th>PARTICULAR</th>
                 <!--  <th>SARO NUMBER</th>
                  <th>PPA</th>
                  <th>UACS</th> -->
                  <th>AMOUNT</th>
                  <th>REMARKS</th>
                  <!-- <th>GROUP</th> -->
                  <th>STATUS</th>
                  <th width='130'  style="border-right: 0px; text-align: center;">ACTION</th>
                  
                  
                </tr>
              </thead>
              <?php
              $servername = "localhost";
              $username = "fascalab_2020";
              $password = "w]zYV6X9{*BN";
              $database = "fascalab_2020";
              $conn = new mysqli($servername, $username, $password,$database);
              $view_query = mysqli_query($conn, "SELECT datereceived, datereprocessed,datereturned, datereleased, burs, ponum, payee, particular, sum(amount) as amount, remarks, sarogroup, status  FROM saroobburs group by burs desc order by id desc ");
              while ($row = mysqli_fetch_assoc($view_query)) {
                $id = $row["id"];
                $datereceived = $row["datereceived"];
                if ($datereceived == '0000-00-00') {
                  $datereceived11 = '';
                }else{
                  $datereceived11 = date('F d, Y', strtotime($datereceived));
                }

                $datereprocessed = $row["datereprocessed"];
                if ($datereprocessed == '0000-00-00') {
                  $datereprocessed11 = '';
                }else{
                  $datereprocessed11 = date('F d, Y', strtotime($datereprocessed));

                }
                $datereturned = $row["datereturned"];
                if ($datereturned == '0000-00-00') {
                  $datereturned11 = '';
                }else{
                  $datereturned11 = date('F d, Y', strtotime($datereturned));
                }

                $datereleased = $row["datereleased"];
                if ($datereleased == '0000-00-00') {
                  $datereleased11 = '';
                }else{
                  $datereleased11 = date('F d, Y', strtotime($datereleased));
                }
                $burs = $row["burs"];
                $ponum = $row["ponum"];
                $payee = $row["payee"];
                $particular = $row["particular"];
                /* $saronumber = $row["saronumber"];
                $ppa = $row["ppa"];
                $uacs = $row["uacs"]; */
                $amount1 = $row["amount"];

                $amount = number_format( $amount1,2);
                $date = $row["date"];
                $remarks = $row["remarks"];
                $sarogroup = $row["sarogroup"];
                $status = $row["status"];
                ?>
                <tr>
                  <?php if ($datereceived !='0000-00-00' ): ?>
                    <td><?php echo $datereceived11;?></td>
                    <?php else: ?>
                      <td><a class="btn btn-primary btn-xs" href='received_burs.php?id=<?php echo $id; ?>&stat=1' >Received</a> </a></td>
                    <?php endif ?>
                    <?php if ($datereceived !='0000-00-00'): ?>
                      <?php if ($datereprocessed !='0000-00-00'): ?>
                        <td><?php echo $datereprocessed11;?></td>
                        <?php else: ?>
                          <td><a class="btn btn-success btn-xs" href='CreateObligation.php?id=<?php echo $id; ?>&stat=1' >Proccess</a> </td>
                        <?php endif ?>
                        <?php else: ?>
                          <td></td>
                        <?php endif ?>
                        <?php if ($datereprocessed !='0000-00-00'): ?>
                          <td><?php echo $datereturned11;?></td>
                          <?php else: ?>
                            <td> <a class="btn btn-danger btn-xs" href='ViewBURScomments.php?id=<?php echo $id; ?>&stat=2'>Return</a></td>
                          <?php endif ?>
                          <?php if ($datereprocessed !='0000-00-00'): ?>
                            <?php if ($datereleased =='0000-00-00' || $datereleased == '1970-01-01'): ?>
                               <td><a class="btn btn-success btn-xs" href='release_burs.php?id=<?php echo $id; ?>&stat=1' >Release</a> </td>
                             <?php else: ?> 
                             <td><?php echo $datereleased11;?></td>
                             <?php endif ?>
                             <?php else: ?> 
                               <td></td>
                             <?php endif ?>
                             <td><a href="" onclick="myFunction(this)" data-burs="<?php echo $burs;?>" data-toggle="modal" data-target="#ors_data_Modal"><?php echo $burs;?></a></td>
                             <td><?php echo $ponum;?></td>
                             <td><?php echo $payee;?></td>
                             <td><?php echo $particular;?></td>
                             <!-- <td><?php echo $saronumber;?></td>
                             <td><?php echo $ppa;?></td>
                             <td><?php echo $uacs;?></td> -->
                             <td><?php echo $amount;?></td>
                             <td><?php echo $remarks;?></td>
                             <!-- <td><?php echo $sarogroup;?></td> -->
                             <?php if ($status =='Pending'): ?>
                              <td style='background-color:red'><b>Pending</b></td>
                              <?php else: ?>
                                <?php if ($status == 'Obligated'): ?>
                                  <td style=' color:black'>Obligated</td>
                                  <?php else: ?>
                                    <td></td>
                                  <?php endif ?>
                                <?php endif ?>
                                <td colspan="1" style="border-right: 0px; margin-left:0px">
                                  <a  class="btn btn-primary btn-xs" href=''> <i class='fa'>&#xf044;</i> Manage Data</a>
                                  <!-- <a  class="btn btn-danger btn-xs" onclick="return confirm('Delete This Obligated Item?');" href='@Functions/obdeletefunction.php?getidDelete=<?php echo $id?>'><i class='fa fa-trash-o'> Delete</i></a> -->
                              </td>
                              </tr> 
                            <?php } ?>
                          </table>
            

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
<script>

  $(document).ready(function(){
   table = document.getElementById("item_table");

   tr = table.getElementsByTagName("th");
   var td = document.getElementById("tdvalue");

   if(td <= 0){
    $('#finalizeButton').attr('disabled','disabled');
  } else {
    $('#finalizeButton').attr('enabled','enabled');
  }

  $('.link').click(function(){

    var f = $(this);
    var id = f.data('id');

    var pr_no = $('#pr_no').val();
    var pr_date = $('#pr_date').val();
    var pmo = $('#pmo').val();
    var purpose = $('#purpose').val();

    window.location = 
    'ViewPRdetails1.php?data='+id+'&pr_no='+pr_no+'&pr_date='+pr_date+'&pmo='+pmo+'&purpose='+purpose;
  });
}) ;
</script>



</body>
</html>

<!--cancel modals -->

<div id="ors_data_Modal" class="modal fade" role="dialog" >
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">OBLIGATION</h4>
            </div>
            <div class="modal-body">
              <!-- <form method="POST" action="ro_cancel.php" > -->
              
        
              <div class="addmodal" >
              <h4 class="modal-title">Breakdown for BURS No.&nbsp;<input style="border:none; font-weight:bolder"  type="text" name="ors11" id="ors11" value="" class=""/></h4>
              

             

           
              <br>

            
              <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12" >
                                        <!-- Table of Uacs -->
                                        <table id="example" class="table table-responsive table-bordered " style="background-color: white; width:100%; text-align:left; border-style: groove;" >
                                        <thead>
                                        <tr style="background-color: #A9A9A9;  text-align:left; border-style: groove; " >
                                       
                                        <th width='500'>ID</th>
                                        <th width='500'>FUND SOURCE</th>
                                        <th width='500'>PPA </th>
                                        <th width='500'>UACS </th>
                                        <th width='500'>AMOUNT </th>
                                        <th width='500'>STATUS </th>
                                        <th width='500'>ACTION</th>
     
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
                    var burs = orsget.getAttribute("data-burs");
                 
                    var burs1 = $("input[name='ors1']");
                    var burs11 = $("input[name='ors11']");
                    
                    burs1.val(burs);
                    burs11.val(burs);


                    $(document).ready(function(){

                        var ors = orsget.getAttribute("data-burs");
                       


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
                        "columnDefs": [{"render": createManageBtn, "data": null, "targets": [6]}],
                        
                        "ajax": {
                        "url": "DATATABLE/Burs_data.php",
                        "type": "POST",
                        "data": {
                        "filter_data": burs,


                        }}

                        } );


                      $('#example tbody').on( 'click', '#editORS', function () {
                      var data = table.row( $(this).parents('tr') ).data();
                      window.location="obupdate1.php?getid="+data[0];
                      });

                      $('#example tbody').on( 'click', '#delete', function () {
                      var data = table.row( $(this).parents('tr') ).data();
                      window.location="@Functions/obdeletefunction1.php?getidDelete="+data[0];
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


              <input hidden  type="text" name="ors1" id="ors1" value="" class=""/>
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
 

          
              
 
           
        <!-- cancel modals -->

