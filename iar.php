<html>
<head>
  <title>Asset Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      function load_data(query)
      {
        $.ajax({
          url:"fetch_iar.php",
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
      document.getElementById("rfq_id").value = x[0].innerHTML;
      document.getElementById("app_id").value = x[1].innerHTML;
      document.getElementById("sup_id").value = x[2].innerHTML;
      document.getElementById("sup").value = x[3].innerHTML;
      document.getElementById("po_no").value = x[4].innerHTML;
      document.getElementById("po_date").value = x[5].innerHTML;
      document.getElementById("dept").value = x[6].innerHTML;
    }
  </script>
</head>
<body style="background: lightgray;">
  <div class="">
    <div class="panel panel-default">
      <br>
      
            <h1 align="">&nbspCreate Inspection Acceptance Report</h1>
             <div class="box-header with-border">
    </div>
    <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewIAR.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <div class="col-xs-6">
        <label>Search PO No. : </label>
        <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Code" class="" />
        <br>
      </div>
      <table class="table table-striped table-hover" id="main">
        <tbody id="result">
        </tbody>
      </table>
       <div class="box-body">
        <div class="well">
          <div class="row">
      <form method="POST">
       <div hidden>
        <input    type="text"  class="form-control" id="rfq_id" required placeholder="rfq_id" name="rfq_id">
        <input    type="text"  class="form-control" id="app_id" required placeholder="app_id" name="app_id">
        <input    type="text"  class="form-control" id="sup_id" required placeholder="" name="sup_id">
      </div>
      <div class="col-xs-3">
        <label>Supplier : </label>
        <input readonly type="text" class="form-control" style="height: 40px;" id="sup" placeholder="" name="sup">
      </div>
      <div class="col-xs-3">
        <label>PO No. : </label>
        <input readonly type="text" class="form-control" style="height: 40px;" id="po_no" placeholder="" name="po">
      </div>
      <div class="col-xs-3">
        <label>PO Date : </label>
        <input readonly type="text" class="form-control" style="height: 40px;" id="po_date" placeholder="" name="po_date">
      </div>
      <div class="col-xs-3">
        <label>Requisition Dept. : </label>
        <input readonly type="text" class="form-control" style="height: 40px;" id="dept" placeholder="" name="dept">
      </div>
      <p>&nbsp</p>
      <p>&nbsp</p>
      <div class="col-xs-3">
        <label>Code Center</label>
        <input type="text" class="form-control" style="height: 40px;" id="ccode" placeholder="" name="ccode">
      </div>
      <div class="col-xs-3">
        <label>Iar No. : </label>
        <input type="text" class="form-control" style="height: 40px;" id="iar_no" placeholder="" name="iar_no">
      </div>
      <div class="col-xs-3">
        <label>Iar Date : </label>
        <input type="date" class="form-control" style="height: 40px;" id="iar_date" placeholder="" name="iar_date">
      </div>
      <div class="col-xs-3">
        <label>Invoice No. : </label>
        <input type="text" class="form-control" style="height: 40px;" id="invoice" placeholder="" name="invoice">
      </div>
      <p>&nbsp</p>
      <p>&nbsp</p>
      <div class="col-xs-3">
        <label>Invoice Date. : </label>
        <input type="date" class="form-control" style="height: 40px;" id="invoice_date" placeholder="" name="invoice_date">
      </div>
      <div hidden class="col-xs-2">
        <label>Password:</label>
        <input type="text" class="form-control" id="sn" placeholder="Enter password" name="sn">
      </div>
      <div class="col-xs-3">
        <label>Select Officer:</label>
          <select name="officer" class="form-control">
            <option value="1">Reschiel B. Veridiano</option>
            <option value="2">Leticia A. Delgado</option>
            <option value="3">Medel A. Saturno</option>
            <option value="4">Rafael M. Saturno</option>
          </select>

      </div>
  </div>
  </div>
  </div>
  <div style="padding:20px;">
      <button type="submit" name="submit"  class="btn btn-success">Create</button>
  </div>


    </form>
  </div>
</div>
</body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "", "fascalab_2020");
if (isset($_POST['submit'])) 
{
$rfq_id = $_POST['rfq_id'];
$app_id = $_POST['app_id'];
$sup_id = $_POST['sup_id'];
$sup = $_POST['sup'];
$po = $_POST['po'];
$po_date = $_POST['po_date'];
$dept = $_POST['dept'];
$ccode = $_POST['ccode'];
$iar_no = $_POST['iar_no'];
$iar_date = $_POST['iar_date'];
$invoice = $_POST['invoice'];
$invoice_date = $_POST['invoice_date'];
$sn = $_POST['sn'];
$officer = $_POST['officer'];

$check = mysqli_query($conn,"SELECT rfq_id from iar_stock where rfq_id = '$rfq_id'");
if (mysqli_num_rows($check) == true) {

        echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Data Already Exist')
      window.location.href='iar_create.php';
      </SCRIPT>");

}else{


$sql = mysqli_query($conn,'INSERT INTO iar (rfq_id, app_id, sup_id,supplier,po_no,po_date,dept,ccode,iar_no,iar_date,invoice_no,invoice_date,stock_no,officer
) VALUES ("'.$rfq_id.'", "'.$app_id.'", "'.$sup_id.'", "'.$sup.'", "'.$po.'", "'.$po_date.'", "'.$dept.'", "'.$ccode.'", "'.$iar_no.'", "'.$iar_date.'", "'.$invoice.'", "'.$invoice_date.'", "'.$sn.'", "'.$officer.'")');

$sql2 = mysqli_query($conn,'INSERT INTO iar_stock(rfq_id,app_id,procurement,description,unit_id,qty,abc,qty_original,abc_original) SELECT rfq_id,app_id,procurement,description,rfq_items.unit_id,rfq_items.qty,abc,rfq_items.qty,abc FROM rfq_items left join app on app.id = rfq_items.app_id where rfq_id = "'.$rfq_id.'"');


$selectt = mysqli_query($conn, " SELECT rfq_id  FROM iar_stock where po_no = '' ");

if (mysqli_num_rows($selectt)>0) {
  $count = mysqli_num_rows($selectt);
  // echo $count;
  // exit();


  for($i=0; $i<$count; $i++){

  $sqlpo = mysqli_query($conn,"Update iar_stock set po_no ='$po'  WHERE rfq_id = '$rfq_id' and po_no='' ");


  }
 
  

  }

      
        echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('IAR Created!')
      window.location.href='ViewIAR.php';
      </SCRIPT>");
}
}
?>


