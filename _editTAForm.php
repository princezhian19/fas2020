<?php
ini_set('display_errors', 0);
error_reporting(0);
require_once('functions.php'); 
session_start();  
$UNAME = $_SESSION['username'];

function fillInputs()
{
  echo '<div class="col-md-6">';
  $link = mysqli_connect("localhost","root","", "db_dilg_pmis");
  if(mysqli_connect_errno()){echo mysqli_connect_error();}  

  $query = "SELECT * FROM `tbltechnical_assistance` where `CONTROL_NO` ='".$_GET['id']."' ";
  $result = mysqli_query($link, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
    {
      ?>
                        <div class="form-group">
                          <label>Requested By:</label>
                            <input placeholder = "Requested By" autocomplete = "false"  class="form-control" name="requested_by" type="text" value = "<?php echo $row['REQ_BY'];?>" >
                              </div>

                        <div class="form-group">
                          <label>Office :<small style="color:red;">*</small></label>
                            <input placeholder = "Office" required autocomplete = "false"  class="form-control" name="office" type="text" id="supplier" value = "<?php echo $row['OFFICE'];?>" >
                              </div>
                              
                        <div class="form-group">
                          <label>Position/Designation:<small style="color:red;">*</small></label>
                            <input placeholder = "Position/Designation" required autocomplete = "false"  class="form-control" name="position" type="text" id="supplier" value = "<?php echo $row['POSITION'];?>">
                              </div>
                        
                        <div class="form-group">
                          <label>Contact No :<small style="color:red;">*</small></label>
                            <input placeholder = "Contact No" required autocomplete = "false"  class="form-control" name="contact_no" type="text" id="supplier" value = "<?php echo $row['CONTACT_NO'];?>">
                              </div>
                        
                       <div class="form-group">
                          <label>Email Address:<small style="color:red;">*</small></label>
                            <input placeholder = "Email Address" required autocomplete = "false"  class="form-control" name="email_address" type="text" id="supplier" value = "<?php echo $row['EMAIL_ADD'];?>">
                              </div>
                        
                      <div class="form-group">
                        <label>Issue/Concern : <small style="color:red;">*</small></label>
                          <textarea class="form-control" rows="5" name="issue_concern" >
                          <?php echo $row['ISSUE_PROBLEM'];?>
                          </textarea>
                          </div>

                      <div class="form-group">
                          <label>Assist By:<small style="color:red;">*</small></label>
                          <select class="form-control " style="width: 100%;" name="assist_by" >
                          <option value = "Charles Adrian T. Odi">Charles Adrian T. Odi</option>
                          <option value = "Mark Kim A. Sacluti">Mark Kim A. Sacluti</option>
                          <option value = "Christian Paul Ferrer">ChrisTian Paul Ferrer </option>
                          </select>
                              </div>
                   
      <?php
    }
    echo ' </div>';
}

function fillInputs2()
{
  echo '<div class="col-md-6">';
  $link = mysqli_connect("localhost","root","", "db_dilg_pmis");
  if(mysqli_connect_errno()){echo mysqli_connect_error();}  

  $query = "SELECT * FROM `tbltechnical_assistance` where `CONTROL_NO` ='".$_GET['id']."' ";
  $result = mysqli_query($link, $query);
  $val = array();
  while($row = mysqli_fetch_array($result))
    {
      ?>
                      <div class="form-group">
                        <label>Control No :</label>
                          <input placeholder = "Control No." readonly autocomplete = "false"  class="form-control" name = "control_no" type="text" id="control_no" value = "<?php echo $row['CONTROL_NO'];?>" >
                            </div>

                      <div class="form-group">
                        <label>Equipment Type : <small style="color:red;">*</small></label>
                          <input placeholder = "Equipment Type" required autocomplete = "false"  class="form-control" name="equipment_type" type="text" id="purpose" value = "<?php echo $row['EQUIPMENT_TYPE'];?>" >
                            </div>
                      
                      <div class="form-group">
                        <label>Brand/Model : <small style="color:red;">*</small></label>
                          <input placeholder = "Brand Model" required autocomplete = "false"  class="form-control" name="model" type="text" id="purpose" value = "<?php echo $row['BRAND_MODEL'];?>" >
                            </div>
                      
                      <div class="form-group">
                        <label>Property No : <small style="color:red;">*</small></label>
                          <input placeholder = "Property No"required autocomplete = "false"  class="form-control" name="property_no" type="text" id="purpose" value = "<?php echo $row['PROPERTY_NO'];?>" >
                            </div>
                      
                      <div class="form-group">
                        <label>Serial No : <small style="color:red;">*</small></label>
                          <input placeholder = "Serial No." required autocomplete = "false"  class="form-control" name="serial_no" type="text" id="purpose" value = "<?php echo $row['SERIAL_NO'];?>" >
                            </div>
                      
                      <div class="form-group">
                        <label>IP Address : <small style="color:red;">*</small></label>
                          <input placeholder = "IP Address" required autocomplete = "false"  class="form-control" name="ip_address" type="text" id="purpose" value = "<?php echo $row['IP_ADDRESS'];?>" >
                            </div>
                      
                      <div class="form-group">
                        <label>MAC Address : <small style="color:red;">*</small></label>
                          <input placeholder = "MAC Address" required autocomplete = "false"  class="form-control" name="mac_address" type="text" id="purpose" value = "<?php echo $row['MAC_ADDRESS'];?>" >
                            </div>

      <?php
    }
  echo '</div>';
}

?>

<!DOCTYPE html>
<html>
<body>
 <div class="box box-default">
  <div class="box-header with-border">
    <h1 align="">&nbspModify Technical Request</h1>
  
    <br>
    <li class="btn btn-success btn-s"><a href="_techassistance.php" style="color:white;text-decoration: none;">Back</a></li>

    <br>
    <form method="POST" autocomplete="off" id = "submit" >
        <div class="box-body">
            <div class="well">
                <div class="row">
                <?php echo fillInputs(); ?>
                <?php echo fillInputs2(); ?>
                </div>
            </div>
          </div>

          <button class="btn btn-primary btn-s  sweet-14" style="float: right;" onclick="_gaq.push(['_trackEvent', 'example, 'try', 'Danger']); "id="finalizeButton" type="button" onclick="return confirm('Are you sure you want to save now?');">Save Changes</button>
          <br>
    </form>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  
<br>
</body>

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
<!-- Sweet Alert -->
<script src="_includes/sweetalert.min.js"></script>
<link rel="stylesheet" href="_includes/sweetalert.css">

<script>
var c_n = $('#control_no').val();
   document.querySelector('.sweet-14').onclick = function(){
        swal({
          title: "Are you sure you want to save?",
          text: "Control No:"+c_n,
          type: "info",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
  closeOnConfirm: false,
  showLoaderOnConfirm: true
        }, function () {
          var queryString = $('#submit').serialize();
          $.ajax({
            url:"_editTAForm_save.php",
            method:"POST",
            data:$("#submit").serialize(),
            
            success:function(data)
            {
              setTimeout(function () {
              swal("Record saved successfully!");
              }, 3000);
              window.location = "_techassistance.php";
            }
          });
      });
   }
</script>