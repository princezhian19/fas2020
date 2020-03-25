<!-- GET DATA  -->
<?php
error_reporting(0);
ini_set('display_errors', 0);
<<<<<<< HEAD
$conn = mysqli_connect("localhost","root","","fascalab_2020");
=======
$conn = mysqli_connect("localhost","fascalab_2020","7one@2019","fascalab_2020");
>>>>>>> 4e4db213f2d3f876f69b63e7348f6cddcffbe68c
$id = $_GET['id'];
$select_pr = mysqli_query($conn,"SELECT * FROM pr WHERE id = $id ");
$row = mysqli_fetch_array($select_pr);
$pr_date = $row['pr_date'];
$target_date = $row['target_date'];
$pmo = $row['pmo'];
$purpose = $row['purpose'];

$idGet='';
$getDate = date('Y');
$m = date('m');
$auto = mysqli_query($conn,"SELECT max(id)+1 as a FROM pr order by id desc limit 1");
while ($row = mysqli_fetch_assoc($auto)) {

  $idGet = $row["a"];
}

?>

<!-- SAVE DATA  -->
<?php 
if (isset($_POST['submit'])) {
  $pr_no = $_POST['pr_no'];
  $set_pr = mysqli_query($conn,"UPDATE pr SET pr_no = '$pr_no' WHERE id = $id ");
  if ($set_pr) {
    $set_items = mysqli_query($conn,"UPDATE pr_items SET pr_no = '$pr_no' WHERE pmo = '$pmo' AND date_a = '$pr_date' ");
    if ($set_items) {
      echo "<div style='background-color:lightblue;color:green;'> <p> <b>Successfuly Assign Pr No.</b> <p> <div>";
    }else{
      echo "<div style='background-color:lightblue;color:red;'> <p> <b>Error Occured!</b> <p> <div>";
    }
  }else{
    echo "<div style='background-color:lightblue;color:red;'> <p> <b>Error Occured!</b> <p> <div>";
  }

}




?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      function load_data(query)
      {
        $.ajax({
          url:"fetch_pr1.php",
          method:"POST",
          data:{query:query},
          success:function(data)
          {
            $('#result').html(data);
          }
        });
      }
      $('#app_items').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
          load_data(search);
        }
        else
        {

          load_data();
          /* document.getElementById("code").value = ""; */
          document.getElementById("stocknumber").value = "";
          document.getElementById("abc").value="";
          document.getElementById("unit").value="";
          
        }
      });
    });
    function showRow(row)
    {
      var x=row.cells;
      document.getElementById("id").value = x[0].innerHTML;
      document.getElementById("abc").value = x[1].innerHTML;
      document.getElementById("stocknumber").value = x[2].innerHTML;
      document.getElementById("abc").value = x[3].innerHTML;
      document.getElementById("app_items").value = x[4].innerHTML;
      document.getElementById("unit").value = x[5].innerHTML;
      //document.getElementById("abc").value = x[6].innerHTML;
    }
  </script>
</head>
<script>
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "ch.php",
      data:'pr_no='+$("#pr_no").val(),
      type: "POST",
      success:function(data){
        $("#user-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error:function (){}
    });
  }
</script>

<body>
  <div class="box box-default">
    <div class="box-header with-border">
      <h1 align="">&nbspCreate Purchase Request</h1>
      <div class="box-header with-border">
      </div>
      <br>
      &nbsp &nbsp &nbsp   <li class="btn btn-success"><a href="ViewPR.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <form method="POST" >
        <div class="box-body">
          <div class="well">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" >
                  <label>PR No. <label style="color: Red;" >*</label> 
                  <button class="btn btn-primary btn-xs" type="submit"  name="submit">Assign</button> 
                </label>
                <input value="<?php echo $getDate.'-'.$m.'-'.'00'.$idGet?>" autocomplete = "off"  class="form-control" name="pr_no" type="text" id="pr_no" class="demoInputBox" onBlur="checkAvailability()"><span id="user-availability-status"></span>
              </div>
              <div class="form-group">
                <label>Office <label style="color: Red;" >*</label></label>
                <input value="<?php echo $pmo?>" readonly type="text" class="form-control" style="width: 100%;" name="pmo" id="pmo"   >
              </div>
              <div class="form-group" >
                <label>Purpose <label style="color: Red;" >*</label></label>
                <input value="<?php echo $purpose?>" readonly type="text" style="height: 60px" class="form-control pull-right" name="purpose" id="purpose"  >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>PR Date <label style="color: red;" >*</label></label>
                <input value="<?php echo $pr_date?>" readonly type="text" class="form-control pull-right" name="pr_date"  >
              </div>
              <div class="form-group">
                <label>Target Date <label style="color: Red;" >*</label></label>
                <input value="<?php echo $target_date?>" readonly type="text" class="form-control pull-right" name="target_date" >
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
      </form>
    </div>  
  </div>  
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


