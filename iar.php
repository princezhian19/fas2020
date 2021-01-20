  <?php 
  $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
  $idGet='';
  $getDate = date('Y');
  $m = date('m');
  // $auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM iar order by id desc limit 1");
  $auto = mysqli_query($conn,"SELECT COUNT(*) as a FROM iar WHERE iar_no LIKE '%2021%' and tim3 > '2021-01-20'");
  while ($row = mysqli_fetch_assoc($auto)) {

    $idGet = $row["a"]+1;
  }

  // $latest_pr_no = $getDate.'-'.$m.'-'.'0'.$idGet;
  // $latest_pr_no = $getDate.'-'.'0'.$idGet;
  $latest_pr_no = $getDate.'-00'.$idGet;

  function get_pr($connect)
  { 
    $output = '';
    $query = "SELECT pr_no FROM pr WHERE type = 6 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["pr_no"].'">'.$row["pr_no"].'</option>';
    }
    return $output;
  }
  ?>

  <?php
  $conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");
  if (isset($_POST['submit'])) 
  {
    $rfq_id = $_POST['rfq_id'];
    $app_id = $_POST['app_id'];
    $sup_id = $_POST['sup_id'];
    $sup = $_POST['sup1'];
    $po = $_POST['po1'];
    $po_date = $_POST['po_date1'];
    $dept = $_POST['dept'];
    $ccode = $_POST['ccode'];
    $iar_no = $_POST['iar_no'];
    $iar_date = $_POST['iar_date'];
    $invoice = $_POST['invoice'];
    $invoice_date = $_POST['invoice_date'];
    $sn = $_POST['sn'];
    $officer = $_POST['officer'];
    $pr_no = $_POST['pr_no'];

      $sql = mysqli_query($conn,'INSERT INTO iar(rfq_id, app_id, sup_id,supplier,po_no,po_date,dept,ccode,iar_no,iar_date,invoice_no,invoice_date,stock_no,officer,pr_no
    ) VALUES ("'.$rfq_id.'", "'.$app_id.'", "'.$sup_id.'", "'.$sup.'", "'.$po.'", "'.$po_date.'", "'.$dept.'", "'.$ccode.'", "'.$iar_no.'", "'.$iar_date.'", "'.$invoice.'", "'.$invoice_date.'", "'.$sn.'", "'.$officer.'", "'.$pr_no.'")');
           if ($sql) {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('IAR Created!')
        window.location.href='ViewIAR.php';
        </SCRIPT>");
      }else{
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Error Occured!')
        </SCRIPT>");
      }


      // $sql2 = mysqli_query($conn,'INSERT INTO iar_stock(rfq_id,app_id,procurement,description,unit_id,qty,abc,qty_original,abc_original) SELECT rfq_id,app_id,procurement,description,rfq_items.unit_id,rfq_items.qty,abc,rfq_items.qty,abc FROM rfq_items left join app on app.id = rfq_items.app_id where rfq_id = "'.$rfq_id.'"');
      // $selectt = mysqli_query($conn, " SELECT rfq_id  FROM iar_stock where po_no = '' ");
      // if (mysqli_num_rows($selectt)>0) {
      //   $count = mysqli_num_rows($selectt);
      //   for($i=0; $i<$count; $i++){
      //     $sqlpo = mysqli_query($conn,"Update iar_stock set po_no ='$po'  WHERE rfq_id = '$rfq_id' and po_no='' ");
      //   }
      // }
 

  }
  ?>


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
  <div class="">
    <div class="panel panel-default">
      <br>
      
      <h1 align="">&nbspCreate Inspection Acceptance Report</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-warning"><a href="ViewIAR.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
          <form method="POST">
      &nbsp &nbsp &nbsp   <input type="checkbox"  name="pety" id="pety" onclick='javascript:yesnoCheck();'> <strong>Petty Cash ?</strong>
      <div class="box-body">
        <div class="well">
          <div class="row">
            <div class="col-xs-3 H1">
              <label>Search PO No. : </label>
              <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search Code" class="" />
              <div style="background-color:black;">
               <b><table class="table table-striped table-hover" style="border:solid 1px;" id="main" >
                <tbody id="result" style="color:black;">
                </tbody>
              </table></b>
            </div>
          </div>
          <div class="col-xs-3 H2" hidden>
            <label>PR NO. </label>
            <select class="form-control select2" name="pr_no" id="pr_no" style="width: 100%;">
              <option selected disabled></option>
              <?php echo get_pr($connect); ?>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="box-body">
      <div class="well">
        <div class="row">
           <div hidden>
            <input    type="text"  class="form-control" id="rfq_id"  placeholder="rfq_id" name="rfq_id">
            <input    type="text"  class="form-control" id="app_id"  placeholder="app_id" name="app_id">
            <input    type="text"  class="form-control" id="sup_id"  placeholder="" name="sup_id">
          </div>
          <div class="col-xs-3 H1">
            <label>Supplier : </label>
            <input readonly type="text" class="form-control" id="sup" placeholder="" name="sup1">
          </div>
          <div class="col-xs-3 H2" hidden>
            <label>Supplier : </label>
            <input  type="text" class="form-control" id="sup" placeholder="" name="sup">
          </div>
          <div class="col-xs-3 H1">
            <label>PO No. : </label>
            <input readonly type="text" class="form-control" id="po_no" placeholder="" name="po1">
          </div>
          <div class="col-xs-3 H2" hidden>
            <label>PO No. : </label>
            <input  type="text" class="form-control" id="po_no" placeholder="" name="po">
          </div>
          <div class="col-xs-3 H1">
            <label>PO Date : </label>
            <input readonly type="text" class="form-control" id="po_date" placeholder="" name="po_date1">
          </div>
          <div class="col-xs-3 H2" hidden>
            <label>PO Date : </label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input autocomplete="new-password"  type="text" name="po_date" class="form-control" id="datepicker3" placeholder="">
            </div>
          </div>
          <div class="col-xs-3 H1">
            <label>Requisition Dept. : </label>
            <input readonly type="text" class="form-control"  id="dept" placeholder="" name="dept">
          </div>
          <div class="col-xs-3 H2" hidden>
            <label>Requisition Dept. : </label>
            <input  type="text" class="form-control"  id="dept" placeholder="" name="dept">
          </div>
          <p>&nbsp</p>
          <p>&nbsp</p>
          <div class="col-xs-3">
            <label>Code Center</label>
            <input type="text" class="form-control" id="ccode" placeholder="" name="ccode">
          </div>
          <div class="col-xs-3">
            <label>IAR NO. : </label>
            <input type="text" class="form-control"  id="iar_no" value="<?php echo $latest_pr_no?>" name="iar_no">
          </div>
          <div class="col-xs-3">
            <label>IAR DATE : </label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input autocomplete="new-password" required type="text" name="iar_date" class="form-control" id="datepicker" placeholder="">
            </div>
            <!-- <input type="date" class="form-control" style="height: 40px;" id="iar_date" placeholder="" name="iar_date"> -->
          </div>
          <div class="col-xs-3">
            <label>Invoice No. : </label>
            <input type="text" class="form-control" id="invoice" placeholder="" name="invoice">
          </div>
          <p>&nbsp</p>
          <p>&nbsp</p>
          <div class="col-xs-3">
            <label>Invoice Date. : </label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input autocomplete="new-password" required type="text" name="invoice_date" class="form-control" id="datepicker2" placeholder="">
            </div>
            <!-- <input type="date" class="form-control"  id="invoice_date" placeholder="" name="invoice_date"> -->
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
              <option value="5">Camille T. Ronquillo</option>
              <option value="6">Art Brian G. Rubio</option>
              <option value="7">Hannah Grace P. Solis</option>
              <option value="8">Eunice A. Sales</option>
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
<script>
  function yesnoCheck() {
    $(".H1").hide();
    $(".H2").show();
    if ($('#pety').is(':checked')) {
    }else{
    $(".H1").show();
    $(".H2").hide();
    }
  }

</script>


