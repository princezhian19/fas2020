<html>
 <head>
  <title>AMS</title>
  <script src="links/u4.js"></script>
  <link rel="stylesheet" href="links/u2.css" />
  <script src="links/u3.js"></script>
  <script src="links/u2.js"></script>
  <link rel="stylesheet" href="links/u1.css" />
  <script src="links/u1.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  .box1 {
    background-color: black;
    width: 300px;
    border: 5px solid red;
    padding: 25px;
    margin: 25px;
}
span.b {
    display: inline-block;
    padding: 5px;
    border: 5px solid red;        
    background-color: black; 
    color:white;
    text-align: center;
    width: 300px;
    font-size: 20px;
}

  </style>
 </head>
 <body>

  <!-- container box -->
  <div class=""  style="background-color: skyblue;">
   <div class="table-responsive">
    <br>
    &nbsp&nbsp&nbsp
          <li class="btn btn-success"><a href="index.php" style="color:white;">Go Back</a></li>

    <a  class="btn btn-primary" href="tcpdf/examples/exportPdf.php?>"><b>Print</b></a>
    </div>
    <br />
    <div id="alert_message"></div>
    <table id="user_data" class="table table-bordered " style="background-color: white; ">
     <thead>
      <tr style="background-color: lightgray;">
       <th>CODE</th>    
       <th>ITEMS</th>
       <th>UNIT</th>
       <th>BALANCE AS OF</th>
       <th>&nbsp</th>
       <th>DELIVERY FOR THE MONTH</th>
       <th>AVAILABLE BALANCE</th>
       <th>ISSUED FOR THE MONTH</th>
       <th>BALANCE AS OF</th>
       <th>&nbsp</th>
       <th>CURRENT PRICE</th>
       <!-- <th>Option</th> -->
      </tr>
     </thead>
          <tbody id="result">
     
    </table>
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetchOldStock.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"updateOldStock.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="code"></td>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td contenteditable id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';
   html += '<td contenteditable id="data7"></td>';
   html += '<td contenteditable id="data8"></td>';
   html += '<td contenteditable id="data8a"></td>';
   html += '<td contenteditable id="data9"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var code = $('#code').text();
   var items = $('#data1').text();
   var unit = $('#data2').text();
   var balanceone = $('#data3').text();
   var one = $('#data4').text();
   var delivery = $('#data5').text();
   var avail_balance = $('#data6').text();
   var issue_month = $('#data7').text();
   var balancetwo = $('#data8').text();
   var two = $('#data8a').text();
   var current_price = $('#data9').text();
   if(items != '' && unit != '' && balanceone != '' && one != '' && delivery != '' && avail_balance != '' && issue_month != '' && balancetwo != '' && two != '' && current_price != '')
   {
    $.ajax({
     url:"insertOldStock.php",
     method:"POST",
     data:{code:code,items:items, unit:unit, balanceone:balanceone, one:one, delivery:delivery, avail_balance:avail_balance, issue_month:issue_month, balancetwo:balancetwo,two:two, current_price:current_price},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
 });
</script>