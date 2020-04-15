<div class="box">
  <div class="box-body">
    <h1 align="">Annual Procurement Plan</h1>
    <div class="box-header">
    </div>
    <li class="btn btn-success"><a href="CreateAPP.php" style="color:white;text-decoration: none;">Add Item</a></li>
    <br>
    <br>
    <table id="app_data" class="table table-striped table-bordered" style="width:;background-color: white;">
      <thead>
        <tr style="background-color: white;color:blue;">
          <th width="150">STOCK NO</th>
          <th width="150">CODE (PAP)</th>
          <th width="150">CATEGORY</th>
          <th width="150">ITEM</th>
          <th width="150">OFFICE</th>
          <th width="150">MODE OF PROCUREMENT</th>
          <th width="150">SOURCE OF FUNDS</th>
          <th width="0">ACTION</th>
          <th width="150">HISTORY</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){

  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#app_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    'lengthChange': false,
    'info'        : false,
    "order" : [],
    "ajax" : {
      url:"getApp.php",
     type:"POST"
   }
 });
 }

});
</script>
<?php include('footer.php');?>

</div>

</div>

