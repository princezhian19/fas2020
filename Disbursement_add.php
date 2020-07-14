<?php session_start();
date_default_timezone_set('Asia/Manila');
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
$DEPT_ID = $_SESSION['DEPT_ID'];
$OFFICE_STATION = $_SESSION['OFFICE_STATION'];
}

/* $datenow = date('Y-m-d');
echo $datenow; */
?>

<style>
/* p.dotted {border-style: dotted;}
p.dashed {border-style: dashed;}
p.solid {border-style: solid;}
p.double {border-style: double;} */
.input {border-style: groove;}

.tb {
  
  border: 1px solid black;
}
/* p.ridge {border-style: ridge;}
p.inset {border-style: inset;}
p.outset {border-style: outset;}
p.none {border-style: none;}
p.hidden {border-style: hidden;}
p.mix {border-style: dotted dashed solid double;} */
</style>



<div class="box" style="border-style: groove;">
          <div class="box-body">
      
            <h2 align="">Add Disbursement</h2>
         
        <br>
      <li class="btn btn-warning"><a href="disbursement.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <br>
        <!-- start of fields -->
        <div class="class"  >
            <form method="POST" action='' enctype="multipart/form-data" >

        <div class="col-md-6" >
         <!-- DV-->
                <div class="row" >
                <!-- Row 1 -->
                        <div class="col-md-6 ">
                            <!-- Partition 1        -->
                            
                            <table class="table"> 


                            <tr>
                            <td class="col-md-2"><b>ORS No.<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input required value=""  class="form-control input" type="text" class="" style="height: 35px;" id="ors" name="ors" placeholder="Enter ORS No." autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-2"><b>DV No.<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input required value=""  class="form-control input" type="text" class="" style="height: 35px;" id="dv" name="dv" placeholder="Enter DV No." autocomplete="off">
                            </td>
                            </tr>

                           <!--  <tr>
                            <td class="col-md-2"><b>DV Type<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <select required class="form-control select 2 input" style="width: 100%;" name="dvtype" id="dvtype" >

                            <option value="">Select Type</option>
                            <option value="Fund Transfer">Fund Transfer</option>
                            <option value="Regular DV">Regular DV</option>

                            </select>
                            </td>
                            </tr> -->

                            </table>

                        </div>


                        <div class="col-md-6">
                                <!-- Partition II -->

                                <table class="table">

                                <tr>
                                <td class="col-md-3"><b>ORS Date.<span style = "color:red;">*</span></b></td>
                                <td class="col-md-7">
                                <input required type="text" class="form-control input" style="height: 35px;" name="orsdate" id="datepicker1" value = "" placeholder="mm/dd/yyyy"  autocomplete="off">
                                </td>
                                </tr>

                                <tr>
                                <td class="col-md-3"><b>DV Date.<span style = "color:red;">*</span></b></td>
                                <td class="col-md-7">
                                <input required type="text" class="form-control input" style="height: 35px;" name="dvdate" id="datepicker2" value = "" placeholder="mm/dd/yyyy"  autocomplete="off">
                                </td>
                                </tr>

                               
                                </table>

                        </div>

                </div>

               

                <div class="row">
                <!-- Row 2 -->
                   
                        <div class="col-md-12">

                            <table class="table">

                            <tr>
                            <td class="col-md-1"><b>PAYEE<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input readonly required type="text" class="form-control input" style="height: 35px;" name="payee" id="payee" value = "" placeholder="Payee"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>PARTICULARS<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input readonly required type="text" class="form-control input" style="height: 35px;" name="particular" id="particular" value = "" placeholder="Particulars"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>AMOUNT<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input readonly required type="text" class="form-control input" style="height: 35px;" name="amount" id="amount" value = "" placeholder="Amount"  autocomplete="off">
                            </td>
                            </tr>


                            </table>

                        </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <!-- Table of Uacs -->
                                        <table id="" class="table table-bordered " style="background-color: white; width:100%; text-align:left">
                                        <thead>
                                        <tr style="background-color: #A9A9A9;  text-align:left; border-style: groove; " >
                                        <th width = ''>FUND SOURCE</th>
                                        <th width = ''>PAP  </th>
                                        <th width = ''>EXPENSE CLASS </th>
                                        <th width = ''>AMOUNT </th>

                                        </tr>
                                        </thead>

                                        <tr align = ''>


                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        </table>

                                        <!-- Table of Uacs -->

                                    </div>

                                </div>

                                


                            </div>


                            <br>



                            

                        </div>
                       
                
                

         <!-- DV-->
         

        </div>
        
        
        
        <div class="col-md-6 ">
        <!-- LD DAP -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table"> 
                        <tr>
                        <td class="col-md-1"><b>TAX<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="tax" name="tax" placeholder="Tax" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>GSIS<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="gsis" name="gsis" placeholder="GSIS" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>PAG IBIG<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="pagibig" name="pagibig" placeholder="Pag Ibig" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>PHILHEALTH<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="philhealth" name="philhealth" placeholder="Philhealth" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>OTHER PAYABLES<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="other" name="other" placeholder="Other Payables" autocomplete="off">
                        </td>
                        </tr>



                    </table>


                    <div class="col-md-4">

                        <tr>
                        <td class="col-md-1"><b>CHARGE TO<span style = "color:red;">*</span></b></td>
                        <td class="col-md-7">
                        <select class="form-control select" style="width: 100%; height: 40px;" name="charge" id="charge" required >
                        <option value = "">Select NCA/NTA</option>
                        <option value = "NCA">NCA</option>
                        <option value = "NTA">NTA</option>
                        </select>
                        </td>
                        </tr>
                 

                    </div>

                    <div class="col-md-4">

                        <tr>
                        <td class="col-md-1"><b>NCA/NTA NO.<span style = "color:red;">*</span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="text"  class="" style="height: 35px;" id="nta" name="nta" placeholder="NCA/NTA" autocomplete="off">
                        </td>
                        </tr>

                    </div>

                    <div class="col-md-4">

                        <tr>
                        <td class="col-md-1"><b>NCA/NTA BALANCE<span style = "color:red;">*</span></b></td>
                        <td class="col-md-7">
                        <input required value=""  class="form-control input" type="text"  class="" style="height: 35px;" id="ntabalance" name="ntabalance" placeholder="0" autocomplete="off">
                        </td>
                        </tr>

                    </div>

                </div>

            </div>
        
        <!-- LD DAP -->

        </div>

           

       
                
        </div>
        <!-- End of fields -->

        

        
</div>
<br>

<button type="submit" name="cancel" style="margin-left: 10px;" class="btn btn-primary pull-left">Save Info</button>
<button type="submit" name="cancel" style="margin-right: 10px;" class="btn btn-success pull-right">Disburse Voucher</button>
<br>
<br>
<br>

</form>

</div>


    




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


