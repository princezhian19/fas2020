<html>
<head>
  <title>Asset Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->

</head>
<script type="text/javascript">
  $(document).ready(function(){
    function load_data(query)
    {
      $.ajax({
        url:"fetch_ris.php",
        method:"POST",
        data:{query:query},
        success:function(data)
        {
          $('#result').html(data);
        }
      });
    }
    $('#search_text').keyup(function(){
      var search = $(this).val();
      if(search != '')
      {
        load_data(search);
      }
      else
      {

      }
    });
  });
  function showRow(row)
  {
    var x=row.cells;
    document.getElementById("iar_id").value = x[0].innerHTML;
    document.getElementById("rfq_id").value = x[1].innerHTML;
    document.getElementById("app_id").value = x[2].innerHTML;
    document.getElementById("division").value = x[3].innerHTML;
    document.getElementById("po_no").value = x[4].innerHTML;
    document.getElementById("purpose").value = x[5].innerHTML;
    document.getElementById("request_by").value = x[6].innerHTML;
  }
</script>
<body style="background: lightgray;">
  <div class="">
    <div class="panel panel-default">
      <br>
      
      <h1 align="">&nbspCreate Requisition and Issue Slip</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewRIS.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <div class="col-xs-6">
        <label>Search PO No. : </label>
        <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Code" class="" />
        <br>
      </div>
      <br>
      <table class="table table-striped table-hover" id="main">
        <tbody id="result">
        </tbody>
      </table>
      <div class="box-body">
        <div class="well">
          <div class="row">
            <form method="POST" id="">
              <div hidden class="col-xs-3">
                <label>IAR ID : </label>
                <input  type="text" class="form-control" style="height: 40px;" id="iar_id" placeholder="" name="iar_id">
              </div>
              <div hidden class="col-xs-3">
                <label>rfq ID : </label>
                <input  type="text" class="form-control" style="height: 40px;" id="rfq_id" placeholder="" name="rfq_id">
              </div>
              <form method="POST" id="">
                <div hidden class="col-xs-3">
                  <label>app ID : </label>
                  <input  type="text" class="form-control" style="height: 40px;" id="app_id" placeholder="" name="app_id">
                </div>
                <div class="col-xs-3">
                  <label>Division : </label>
                  <input type="text"  class="form-control" style="height: 40px;" id="division" placeholder="" name="division" >
                </div>
                <div class="col-xs-3">
                  <label>PO No. : </label>
                  <input type="text" readonly class="form-control" style="height: 40px;" id="po_no" placeholder="" name="po_no">
                </div>
                <div class="col-xs-3">
                  <label>RIS No : </label>
                  <input required type="text" class="form-control" style="height: 40px;" id="ris_no" placeholder="" name="ris_no">
                </div>
                <div  class="col-xs-3">
                  <label>Remarks : </label>
                  <textarea class="form-control" placeholder="Remarks" name="remarks" id="remarks" ></textarea> 
                </div>
                <p>&nbsp</p>
                <p>&nbsp</p>
         <!--    <div class="col-xs-3">
              <label>Requested by : </label>
              <input type="text" class="form-control" style="height: 40px;" id="" placeholder="" name="request_by">
            </div> -->

            <div class="col-xs-3">
              <label>Requested by : </label>
              <input type="text"  name="request_by" id="request_by" class="form-control" >
              <!-- <select  name="request_by" id="request_by" class="form-control">
                <option value="1">ELOISA G. ROZUL</option>
                <option value="2">JOHN M. CEREZO</option>
                <option value="3">DR. CARINA S. CRUZ</option>
              </select> -->
            </div>

            <div class="col-xs-3">
              <label>Approve by : </label>
              <input type="text" readonly class="form-control" style="height: 40px;" id="approved_by" placeholder="" name="approved_by" value="ELIAS F. FERNANDEZ JR.">
            </div>

            <div class="col-xs-3">
              <label>Issued by : </label>
              <input type="text" readonly="" class="form-control" style="height: 40px;" id="issued_by" placeholder="" name="issued_by" value="BEZALEEL O. SOLTURA">
            </div>

            <div  class="col-xs-3">
              <label>Recieved by : </label>
              <input type="text" class="form-control" id="recieved_by" placeholder="" name="recieved_by">
            </div>
            <p>&nbsp</p>
            <p>&nbsp</p>
            <div  class="col-xs-3">
              <label>Purpose : </label>
              <textarea class="form-control" placeholder="Purpose" id="purpose" style="width: 1000px;height: 100px;" name="purpose" ></textarea> 
            </div>
          </div>
        </div>
      </div>

      &nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" name="submit"  class="btn btn-success">Issue All</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <a href="javascript:void(0);" class="btn btn-primary link" data-id="<=$data['id']?>">Issue to Many</a><br><br>
    </div>
  </div>
</body>
<script>
  $(document).ready(function(){

    $('.link').click(function(){

      var f = $(this);
      var id = f.data('id');

      var app_id = $('#app_id').val();
      var rfq_id = $('#rfq_id').val();
      var iar_id = $('#iar_id').val();
      var division = $('#division').val();
      var po_no = $('#po_no').val();
      var ris_no = $('#ris_no').val();
      var remarks = $('#remarks').val();
      var request_by = $('#request_by').val();
      var approved_by = $('#approved_by').val();
      var issued_by = $('#issued_by').val();
      var recieved_by = $('#recieved_by').val();
      var purpose = $('#purpose').val();

      window.location = 
      'CreateRISmany.php?data='+id+'&app_id='+app_id+'&rfq_id='+rfq_id+'&iar_id='+iar_id+'&division='+division+'&po_no='+po_no+'&ris_no='+ris_no+'&remarks='+remarks+'&request_by='+request_by+'&approved_by='+approved_by+'&issued_by='+issued_by+'&recieved_by='+recieved_by+'&purpose='+purpose;
    });
  }) ;
</script>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "db_dilg_pmis");
if (isset($_POST['submit'])) 
{
  $app_id = $_POST['app_id'];
  $rfq_id = $_POST['rfq_id'];
  $iar_id = $_POST['iar_id'];
  $division = $_POST['division'];
  $po_no = $_POST['po_no'];
  $ris_no = $_POST['ris_no'];
  $remarks = $_POST['remarks'];
  $request_by = $_POST['request_by'];
  $approved_by = $_POST['approved_by'];
  $issued_by = $_POST['issued_by'];
  $recieved_by = $_POST['recieved_by'];
  $purpose = $_POST['purpose'];

  $query_insert_iar = mysqli_query($conn,"SELECT * FROM iar_stock WHERE rfq_id = $rfq_id");
  $iar_row=mysqli_fetch_array($query_insert_iar);
  $qty = $iar_row['qty'];

  $insert_ris_stock = mysqli_query($conn,"INSERT INTO ris_stock(rfq_id,ris_no,app_id,procurement,description,qty,unit_id,abc) 
    SELECT rfq_id,'$ris_no',app_id,procurement,description,qty,unit_id,abc FROM iar_stock WHERE rfq_id = $rfq_id");

  // $update_qty_from_iar = mysqli_query($conn,"UPDATE iar_stock SET qty = qty - qty WHERE rfq_id = $rfq_id");
  
  $sql = mysqli_query($conn,"INSERT INTO ris(
    app_id,
    rfq_id,
    iar_id,
    division,
    po_no,
    ris_no,
    remarks,
    request_by,
    approved_by,
    issued_by,
    recieved_by,
    purpose) 
    VALUES(
    '$app_id',
    '$rfq_id',
    '$iar_id',
    '$division',
    '$po_no',
    '$ris_no',
    '$remarks',
    '$request_by',
    '$approved_by',
    '$issued_by',
    '$recieved_by',
    '$purpose')");

  


  if (!empty($sql))
  {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('RIS Created!')
      window.location.href='ViewRIS.php';
      </SCRIPT>");
  } else {
   echo "Error: " ;
 }

}
?>




