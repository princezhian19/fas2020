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



function getNta()
    {
        include 'connection.php';
        $query = "SELECT particular from nta  order by id desc" ;
        $result = mysqli_query($conn, $query);
        echo '<option VALUE = "">NTA/NCA No.</option>';
        while($row = mysqli_fetch_array($result))
        {
            echo '<option>'.$row['particular'].'</option>';
            
        }
    }
?>

<?php

$idget = $_GET['id'];
// echo $idget;

$servername ="localhost";
$username = "fascalab_2020";
$password = "w]zYV6X9{*BN";
$database = "fascalab_2020";
// Create connection
$conn = new mysqli($servername, $username, $password,$database);



$view_query = mysqli_query($conn, "SELECT ID,dv,ors,datereceived,date_proccess,datereleased,payee,particular,sum(amount) as amount,tax,gsis,pagibig,philhealth,other, sum(total) as total, sum(net) as net, remarks, status,flag  FROM disbursement   where ors = '$idget' group by ors");
/* echo "SELECT ID,dv,ors,datereceived,date_proccess,datereleased,payee,particular,sum(amount) as amount, sum(total) as total, sum(net) as net, remarks, status,flag  FROM disbursement   where ors = '$idget' group by ors";
exit();
 */
while ($row = mysqli_fetch_assoc($view_query)) {
$id = $row["ID"]; 
$dv = $row["dv"];
// $ors = $row["ors"];

$datereceived1 = $row["datereceived"];
$datereceived = date('m/d/Y', strtotime($datereceived1));

$payee = $row["payee"];
$particular = $row["particular"];

$amount1 = $row["amount"];
$amount = number_format($amount1,2);
$total1 = $row["total"];
$total = number_format($total1,2);

$net1 = $row["net"];
$net = number_format($net1,2);
$remarks = $row["remarks"];
$status = $row["status"];


$tax = $row["tax"];
$gsis = $row["gsis"];
$pagibig  = $row["pagibig"];
$philhealth = $row["philhealth"];
$other = $row["other"];

//Getting Flag
$flag = $row["flag"];
/* echo $flag;
exit(); */

$date_proccess = $row["date_proccess"];
$date_proccess1 = date('m/d/Y', strtotime($date_proccess));

$datereleased1 = $row["datereleased"];
$datereleased = date('m/d/Y', strtotime($datereleased1));
}

/* $no = ""; */

if($flag=='BURS'){
$view_burs = mysqli_query($conn, "SELECT burs from saroobburs where burs = '$idget'");
$row1 = mysqli_fetch_array($view_burs);
$bursget = $row1["burs"]; 
/* echo $bursget; */

}
else if ($flag=='ORS'){
$view_ors = mysqli_query($conn, "SELECT ors from saroob where ors = '$idget'");
$row2 = mysqli_fetch_assoc($view_ors);
$orsget = $row2["ors"]; 
/* echo $orsget; */


}
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

<!-- <script src="bower_components/select2/dist/js/select2.full.min.js"></script> -->
<div class="box" style="border-style: groove;">
          <div class="box-body">
      
            <h2 align="">Update Disbursement</h2>
         
        <br>
      <li class="btn btn-warning"><a href="disbursement.php" style="color:white;text-decoration: none;">Back</a></li>
      <br>
      <br>
      <br>
        <!-- start of fields -->
        <div class="class"  >
            <form method="POST" action='' enctype="multipart/form-data" >

        <div class="col-md-6 well" >
         <!-- DV-->
                <div class="row" >
                <?php 
                
                
                ?>
                <input hidden readonly required value="<?php echo $flag?>"  class=" input" type="text" class="" style="height: 35px;" id="mode" name="mode" placeholder="" autocomplete="off">
                
                <!-- Row 1 -->
                        <div class="col-md-6 ">
                            <!-- Partition 1 -->
                           
                            
                            <table class="table"> 
                           
                            <tr>
                            <td class="col-md-2">
                            <b>TYPE<span style = "color:red;">*</span></b>

                            </td>
                            <td class="col-md-7">
                            <!-- <select onchange="myFunctionORS()" class=" form-control select input" style="width: 100%; height: 40px;" name="mode" id="mode" required style="border-style: groove;"> -->
                            <input readonly required value="<?php echo $flag?>"  class="form-control input" type="text" class="" style="height: 35px;" id="mode" name="mode" placeholder="" autocomplete="off">
                            <!-- <option value = "">SELECT BURS/ORS</option>
                            <option value = "BURS">BURS</option>
                            <option value = "ORS">ORS</option>
                            </select> -->
                            </td>
                            </tr>
                            

                            <tr>
                            <td class="col-md-2"><b>BURS No.<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input required value="<?php if($flag=='BURS'){echo $bursget;}else{}?>"  class="form-control input" type="text" class="" style="height: 35px;" id="ors" name="ors" placeholder="Enter BURS No." autocomplete="off">
                           
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
                                <table class="table table-striped table-hover" id="main" >
                                <tbody id="result" style="font-weight:bold" >
                                </tbody>
                                </table>


                                <script>

                               
                                $(document).ready(function(){
                                //Set ors disabled
                             
                                // $('#ors').prop('disabled', true);
                                // $('#ors1').prop('disabled', true);
                                $("#result").click(function(){
                                $("#main").hide();
                                // alert(filter_data);
                               
                                // alert(filter_data);

                                filter_data1 = $('#ors').val();
                               
                               
                                var ors = $("input[name='ors1']"); 
                                ors.val('');

                                $('#ors1').prop('disabled', true);

                                $('#example').DataTable().destroy();
                                dataT();
                                // alert(filter_data1);

                             

                                });
                                });
                                </script>
                               
                                <script type="text/javascript">
                                //declare variable for filtering
                                

                                $(document).ready(function(){
                                
                               
                                function load_data(query)
                                {

                               
                                $.ajax({
                                
                                url:"@disbursementvalue1.php",
                                method:"POST",
                                data:{query:query,
                                },


                                success:function(data)
                                {
                                $('#result').html(data);
                                }
                                });
                                }
                                $('#ors').keyup(function(){
                                var search = $(this).val();
                                if(search != '')
                                {
                                load_data(search);

                               
                                
                                }
                                else
                                {
                                
                                $("#main").show();
                                load_data();

                                filter_data = '';
                                $('#example').DataTable().destroy();
                                dataE();

                                document.getElementById('payee').value = "";
                                document.getElementById('particular').value = "";
                                document.getElementById("amount").value = "";
                                document.getElementById("orsdate").value = "";

                                }
                                });
                                });
                                function showRow1(row)
                                {
                                var x=row.cells;
                                document.getElementById("ors").value = x[0].innerHTML;
                                document.getElementById("orsdate").value = x[3].innerHTML;
                                document.getElementById("payee").value = x[4].innerHTML;
                                document.getElementById("particular").value = x[5].innerHTML;
                                document.getElementById("amount").value = x[6].innerHTML;
                                document.getElementById("deductions").value = "0";
                                document.getElementById("net").value = "0";
                                }

                                //function of table
                                function dataT(){
                                
                                // var filter_data ='0001';
                                

                                var table = $('#example').DataTable( {
                                'scrollX'     : true,
                                'paging'      : true,
                                'lengthChange': true,
                                'searching'   : false,
                                'ordering'    : true,
                                'info'        : true,
                                'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
                                "bPaginate": false,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": false,
                                "bAutoWidth": false,  
                                "processing": true,
                                "serverSide": false,
                                "ajax": {
                                "url": "DATATABLE/Disbursement_data1.php",
                                "type": "POST",
                                "data": {
                                "filter_data1": filter_data1,
                               
                                }}
                                
                                } );
                                }
                                /* Delete function */
                                function dataE(){
                                
                                var filter_data ='';
                                
                                var table = $('#example').DataTable( {
                                'scrollX'     : true,
                                'paging'      : true,
                                'lengthChange': true,
                                'searching'   : false,
                                'ordering'    : true,
                                'info'        : true,
                                'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
                                "bPaginate": false,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": false,
                                "bAutoWidth": false,  
                                "processing": true,
                                "serverSide": false,
                                "ajax": {
                                "url": "DATATABLE/Disbursement_data_del1.php",
                                "type": "POST",
                                "data": {
                                "filter_data": filter_data
                                
                                }}
                                

                                } );
                                }
                                
      
                                </script>
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-2"><b>ORS No.<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input required value="<?php if($flag=='ORS'){echo $orsget;}else{}?>"  class="form-control input" type="text" class="" style="height: 35px;" id="ors1" name="ors1" placeholder="Enter ORS No." autocomplete="off">
                           
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                                <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
                                <table class="table table-striped table-hover" id="main1" >
                                <tbody id="result1" style="font-weight:bold">
                                </tbody>
                                </table>



                                <script>

                              
                                $(document).ready(function(){
                                //Set ors disabled



                             /*    $('#ors').prop('disabled', true);
                                $('#ors1').prop('disabled', true);
 */

                                

                                $("#result1").click(function(){
                                $("#main1").hide();
                                // alert(filter_data);
                               
                                // alert(filter_data);

                                filter_data = $('#ors1').val();
                              
                                $('#example').DataTable().destroy();
                                dataTE();

                                //  alert(mode);
                                
                                });
                                });
                                </script>
                               
                                <script type="text/javascript">
                                //declare variable for filtering
                                

                                $(document).ready(function(){
                                
                              
                                function load_data(query)
                                {
                               
                                $.ajax({
                                
                                url:"@disbursementvalue.php",
                                method:"POST",
                                data:{query:query,
                                },


                                success:function(data)
                                {
                                $('#result1').html(data);
                                }
                                });
                                }
                                $('#ors1').keyup(function(){
                                var search = $(this).val();
                                if(search != '')
                                {
                                load_data(search);

                               
                                
                                }
                                else
                                {
                                
                                $("#main1").show();
                                load_data();

                                filter_data = '';
                                $('#example').DataTable().destroy();
                                dataEE();

                                document.getElementById('payee').value = "";
                                document.getElementById('particular').value = "";
                                document.getElementById("amount").value = "";
                                document.getElementById("orsdate").value = "";

                                }
                                });
                                });
                                function showRow(row)
                                {
                                var x=row.cells;
                                document.getElementById("ors1").value = x[0].innerHTML;
                                document.getElementById("orsdate").value = x[3].innerHTML;
                                document.getElementById("payee").value = x[4].innerHTML;
                                document.getElementById("particular").value = x[5].innerHTML;
                                document.getElementById("amount").value = x[6].innerHTML;
                                document.getElementById("deductions").value = "0";
                                document.getElementById("net").value = "0";
                                }

                                //function of table
                                function dataTE(){
                                
                                // var filter_data ='0001';
                                

                                var table = $('#example').DataTable( {
                                'scrollX'     : true,
                                'paging'      : true,
                                'lengthChange': true,
                                'searching'   : false,
                                'ordering'    : true,
                                'info'        : true,
                                'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
                                "bPaginate": false,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": false,
                                "bAutoWidth": false,  
                                "processing": true,
                                "serverSide": false,
                                "ajax": {
                                "url": "DATATABLE/Disbursement_data.php",
                                "type": "POST",
                                "data": {
                                "filter_data": filter_data,
                               
                                
                                }}
                                
                                } );
                                }
                                /* Delete function */
                                function dataEE(){
                                
                                var filter_data ='';
                                
                                var table = $('#example').DataTable( {
                                'scrollX'     : true,
                                'paging'      : true,
                                'lengthChange': true,
                                'searching'   : false,
                                'ordering'    : true,
                                'info'        : true,
                                'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
                                "bPaginate": false,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": false,
                                "bAutoWidth": false,  
                                "processing": true,
                                "serverSide": false,
                                "ajax": {
                                "url": "DATATABLE/Disbursement_data_del.php",
                                "type": "POST",
                                "data": {
                                "filter_data": filter_data
                                
                                }}
                                


                                } );
                                }
                              
                                
                                </script>
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-2"><b>DV No.<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input required value="<?php echo $dv?>"  class="form-control input" type="text" class="" style="height: 35px;" id="dv" name="dv" placeholder="Enter DV No." autocomplete="off">
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
                                <input value="<?php echo $datereceived?>" readonly required type="text" class="form-control input" style="height: 35px;" name="orsdate" id="orsdate" value = "" placeholder="mm/dd/yyyy"  autocomplete="off">
                                </td>
                                </tr>

                                

                                <tr>
                                <td class="col-md-3"><b>DV Date.<span style = "color:red;">*</span></b></td>
                                <td class="col-md-7">
                                <input value="<?php echo $datereleased?>" required type="text" class="form-control input" style="height: 35px;" name="dvdate" id="datepicker2" value = "" placeholder="mm/dd/yyyy"  autocomplete="off">
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
                            <input value="<?php echo $payee?>" readonly required type="text" class="form-control input" style="height: 35px;" name="payee" id="payee" value = "" placeholder="Payee"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>PARTICULARS<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input value="<?php echo $particular?>"  required type="text" class="form-control input" style="height: 70px;" name="particular" id="particular" value = "" placeholder="Particulars"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>OBLIGATED AMOUNT<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input value="<?php echo $amount?>" readonly required type="text" class="form-control input" style="height: 35px;" name="amount" id="amount" value = "" placeholder="Obligated Amount"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>TOTAL DEDUCTIONS<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input value="<?php echo $total?>" readonly required type="text" class="form-control input" style="height: 35px;" name="deductions" id="deductions" value = "0" placeholder="Total Deductions"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>NET AMOUNT<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <input value="<?php echo $net?>" readonly required type="text" class="form-control input" style="height: 35px;" name="net" id="net" value = "0" placeholder="Net Amount"  autocomplete="off">
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>Remarks<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <textarea class="form-control input" placeholder="Remarks" id="remarks" name="remarks" style="width: 100%; height: 40px;" ><?php echo $remarks?></textarea>
                            </td>
                            </tr>

                            <tr>
                            <td class="col-md-1"><b>Status<span style = "color:red;">*</span></b></td>
                            <td class="col-md-7">
                            <select class="form-control select input" style="width: 100%; height: 40px;" name="status" id="status" required >
                            
                            <option value = "Disbursed">Paid</option>
                            <option value = "Pending">Pending</option>
                            </td>
                            </tr>

                            </table>

                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <!-- Table of Uacs -->
                                        <table id="example" class="table table-bordered " style="background-color: white; width:100%; text-align:left">
                                        <thead>
                                        <tr style="background-color: #A9A9A9;  text-align:left; border-style: groove; " >
                                        <th width='500'>FUND SOURCE</th>
                                        <th width='500'>PPA </th>
                                        <th width='500'>UACS </th>
                                        <th width='500'>AMOUNT </th>

                                        </thead>

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
                        
                <div class="well ">
                <div class="class-bordered">
                <b><font style="font-size:25px; color:firebrick">DEDUCTIONS</font></b>  
                </div>
                
             
               
                            
                <table class="table"> 
                        <tr>
                        <td class="col-md-1"><b>TAX<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input value="<?php echo $tax?>" required value="0" onkeyup="myFunctiontax()"  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="tax" name="tax" placeholder="Tax" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>GSIS<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input value="<?php echo $gsis?>" required value="0" onkeyup="myFunctiongsis()"  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="gsis" name="gsis" placeholder="GSIS" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>PAG IBIG<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input value="<?php echo $pagibig?>" required value="0" onkeyup="myFunctionpagibig()" class="form-control input" type="number" step="any" class="" style="height: 35px;" id="pagibig" name="pagibig" placeholder="Pag Ibig" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>PHILHEALTH<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input value="<?php echo $philhealth?>" required value="0" onkeyup="myFunctionphilhealth()"  class="form-control input" type="number" step="any" class="" style="height: 35px;" id="philhealth" name="philhealth" placeholder="Philhealth" autocomplete="off">
                        </td>
                        </tr>

                        <tr>
                        <td class="col-md-1"><b>OTHER PAYABLES<span style = "color:red;"></span></b></td>
                        <td class="col-md-7">
                        <input value="<?php echo $other?>" required value="0" onkeyup="myFunctionother()" class="form-control input" type="number" step="any" class="" style="height: 35px;" id="other" name="other" placeholder="Other Payables" autocomplete="off">
                        </td>
                        </tr>

                    </table>

 
                </div>
                <button class="add_form_field pull-right btn btn-info btn-xs">Add NTA/NCA &nbsp; 
                <span style="font-size:16px; font-weight:bold;">+ </span>
              </button>
              <br>
              <br>
                 <div class="container1">

                    
                    <div class="col-md-3">


                        
                        <tr>
                        <td class="col-md-1"><b>CHARGE TO<span style = "color:red;">*</span></b></td>
                        <td class="col-md-7">
                        <select class="form-control select" style="width: 100%; height: 40px;" name="charge[]" id="charge" required >
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

                        <!-- <label>Employee Name</label>
                        <select class="form-control select2" style= "color:blue;text-align:center;"  id = "ntano">

                        
                        </select>  -->
                        <!-- <input required value=""  class="form-control input" type="text"  class="" style="height: 35px;" id="ntano" name="ntano[]" placeholder="NCA/NTA NO." autocomplete="off"> -->

                        <select class="form-control select2" style= "color:black;text-align:center;"  id = "ntano" name = "ntano[]"> <?php getNta();?> </select>
                        
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                            <table class="table table-striped table-hover" id="main2" >
                                <tbody id="result2" style="font-weight:bold" >
                                </tbody>
                                </table>

                           

                                <script>

                               
                                $(document).ready(function(){
                                //Set ors disabled


                                $("#result2").click(function(){
                                $("#main2").hide();
                                
                                });
                                });
                                </script>
                               
                                <script type="text/javascript">
                                //declare variable for filtering
                                

                                $(document).ready(function(){
                                
                               
                                function load_data(query)
                                {

                               
                                $.ajax({
                                
                                url:"@ntavalue.php",
                                method:"POST",
                                data:{query:query,
                                },


                                success:function(data)
                                {
                                $('#result2').html(data);
                                }
                                });
                                }

                                $('#ntano').keyup(function(){
                                var search = $(this).val();
                                if(search != '')
                                {
                                load_data(search);

                                
                                }
                                else
                                {
                                
                                $("#main2").show();
                                load_data();
                                
                                document.getElementById('ntano').value = "";
                                document.getElementById('ntabalance').value = "";
                              

                                }
                                });
                                });
                                function showRow2(row)
                                {
                                var x=row.cells;
                                document.getElementById("ntano").value = x[0].innerHTML;
                                document.getElementById("ntabalance").value = x[1].innerHTML;
                               
                                }

                             
      
                                </script>
                        </td>
                        </tr>

                    </div>
                  <div class="col-md-2">

                  <tr>
                  <td class="col-md-1"><b>AMOUNT<span style = "color:red;">*</span></b></td>
                  <td class="col-md-7">
                  <input required value=""  class="form-control input" type="number" step="any"  class="" style="height: 35px;" id="amount" name="amount[]" placeholder="0" autocomplete="off">
                  </td>
                  </tr>

                  </div>

                    <div class="col-md-3">

                        <tr>
                        <td class="col-md-1"><b>NCA/NTA BALANCE<span style = "color:red;">*</span></b></td>
                        <td class="col-md-7">
                        <input readonly required value=""  class="form-control input" type="text"  class="" style="height: 35px;" id="ntabalance" name="ntabalance[]" placeholder="0" autocomplete="off">
                        </td>
                        </tr>

                    </div>

                </div>

                </div>

            </div>
        
        <!-- LD DAP -->

        </div>

           

       
                
        </div>
        <!-- End of fields -->

        

        
</div>
<br>

<!-- <button type="" onclick="SaveData()" name="savediv" style="margin-left: 10px;" class="btn btn-primary pull-left">Save</button> -->

<!-- <a  id="savediv" style="margin-right: 10px;" class="btn btn-primary pull-right">&nbsp;&nbsp;Save&nbsp;&nbsp;</a> -->
<!-- <button type="submit" name="cancel" style="margin-right: 10px;" class="btn btn-success pull-right">Disburse Voucher</button> -->
<input type="submit" name="submit" class="btn btn-primary pull-right" value="Save" id="butsave" style="margin-right:10px">
<br>
<br>
<br>

</form>

</div>


    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
  $(document).ready(function() {
    var mode = $("input[name='mode']").val();
    // alert(mode);
    var Fill = $("#mode").val();
    // var Fill = $("input[name='mode']").val();
    // alert(Fill);
    

    if(Fill=='BURS'){
            var bursno = '<?php echo $bursget?>';
            // alert(bursno);
            function dataTT(){

            var table = $('#example').DataTable( {
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : false,  
            "processing": true,
            "serverSide": false,
            "ajax": {
            "url": "DATATABLE/Disbursement_data1.php",
            "type": "POST",
            "data": {
            "filter_data1": bursno,

            }}

            } );
            }

            $('#example').DataTable().destroy();
            dataTT();
            

    }
    else if(Fill=='ORS'){

            var orsno = '<?php echo $orsget?>';
            // alert(orsno);
        function dataTTE(){
          
        var table = $('#example').DataTable( {
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : false,  
        "processing": true,
        "serverSide": false,
        "ajax": {
        "url": "DATATABLE/Disbursement_data.php",
        "type": "POST",
        "data": {
        "filter_data": orsno,


        }}

        } );
        }

        
        $('#example').DataTable().destroy();
        dataTTE();

    }
    else{


    }
    
    //APPEND
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
      e.preventDefault();
      if (x < max_fields) {
        x++;
        var list = "Hello";
            $(wrapper).append('<div ><br><br><br><br><a href="#" style="margin-right:50px" class="delete btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o"></i></a><br><br><div class="col-md-3"><tr><td class="col-md-1"><b>CHARGE TO<span style = "color:red;">*</span></b></td><td class="col-md-7"><select class="form-control select" style="width: 100%; height: 40px;" name="charge[]" id="charge" required > <option value = "">Select NCA/NTA</option> <option value = "NCA">NCA</option> <option value = "NTA">NTA</option> </select> </td> </tr> </div> <div class="col-md-4"> <tr> <td class="col-md-1"><b>NCA/NTA NO.<span style = "color:red;">*</span></b></td> <td class="col-md-7">  <select class="form-control select2" style= "color:black;text-align:center;"  id = "ntano" name="ntano[]"> <?php getNta();?> </select>  </td> </tr> </div><div class="col-md-2"> <tr> <td class="col-md-1"><b>AMOUNT<span style = "color:red;">*</span></b></td> <td class="col-md-7"> <input required value=""  class="form-control input" type="number" step="any"  class="" style="height: 35px;" id="amount" name="amount[]" placeholder="0" autocomplete="off"> </td> </tr> </div>  <div class="col-md-3"> <tr> <td class="col-md-1"><b>NCA/NTA BALANCE<span style = "color:red;">*</span></b></td> <td class="col-md-7"> <input required value=""  class="form-control input" type="text"  class="" style="height: 35px;" id="ntabalance" name="ntabalance" placeholder="0" autocomplete="off"> </td> </tr> </div></div>'); //add input box
          } else {
            alert('You Reached the limits')
          }
        });

       
                   

    $(wrapper).on("click", ".delete", function(e) {
        if(confirm("Are you sure you want to delete this NCA/NTA?")){
            
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        }
        else{


        }
        

        
    })

    //setting data



  });



function myFunctionORS()
{
var mode = document.getElementById("mode").value;

if(mode==""){
$('#ors').prop('disabled', true);
var ors = $("input[name='ors']"); 
ors.val('');

$('#ors1').prop('disabled', true);
var ors = $("input[name='ors1']"); 
ors.val('');


var payee = $("input[name='payee']"); 
payee.val('');
var particular = $("input[name='particular']"); 
particular.val('');
var amount = $("input[name='amount']"); 
amount.val('');
var orsdate = $("input[name='orsdate']"); 
orsdate.val('');


var deductions = $("input[name='deductions']"); 
deductions.val('');

var net = $("input[name='net']"); 
net.val('');

var tax = $("input[name='tax']"); 
tax.val('0');

var gsis = $("input[name='gsis']"); 
gsis.val('0');


var pagibig = $("input[name='pagibig']"); 
pagibig.val('0');

var philhealth = $("input[name='philhealth']"); 
philhealth.val('0');

var other = $("input[name='other']"); 
other.val('0');






}
else if(mode=="BURS"){

$('#ors1').prop('disabled', true);
var ors = $("input[name='ors1']");
ors.val('');

$('#ors').prop('disabled', false);
var ors = $("input[name='ors']"); 
ors.val('');

var payee = $("input[name='payee']"); 
payee.val('');
var particular = $("input[name='particular']"); 
particular.val('');
var amount = $("input[name='amount']"); 
amount.val('');
var orsdate = $("input[name='orsdate']"); 
orsdate.val('');



var deductions = $("input[name='deductions']"); 
deductions.val('');

var net = $("input[name='net']"); 
net.val('');

var tax = $("input[name='tax']"); 
tax.val('0');

var gsis = $("input[name='gsis']"); 
gsis.val('0');


var pagibig = $("input[name='pagibig']"); 
pagibig.val('0');

var philhealth = $("input[name='philhealth']"); 
philhealth.val('0');

var other = $("input[name='other']"); 
other.val('0');

}
else{
$('#ors').prop('disabled', true);
var ors = $("input[name='ors']"); 
ors.val('');

$('#ors1').prop('disabled', false);
var ors = $("input[name='ors1']"); 
ors.val('');

var payee = $("input[name='payee']"); 
payee.val('');
var particular = $("input[name='particular']"); 
particular.val('');
var amount = $("input[name='amount']"); 
amount.val('');
var orsdate = $("input[name='orsdate']"); 
orsdate.val('');

var deductions = $("input[name='deductions']"); 
deductions.val('');

var net = $("input[name='net']"); 
net.val('');

var tax = $("input[name='tax']"); 
tax.val('0');

var gsis = $("input[name='gsis']"); 
gsis.val('0');


var pagibig = $("input[name='pagibig']"); 
pagibig.val('0');

var philhealth = $("input[name='philhealth']"); 
philhealth.val('0');

var other = $("input[name='other']"); 
other.val('0');
//dataEE();

}

}

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>

/* Functions for deductions */
function myFunctiontax() {
  var tax = document.getElementById("tax").value;
  var gsis = document.getElementById("gsis").value;
  var pagibig = document.getElementById("pagibig").value;
  var philhealth = document.getElementById("philhealth").value;
  var other = document.getElementById("other").value;


  var deductions1 = $("input[name='deductions']");
  var net1 = $("input[name='net']");
  var tax1 = $("input[name='tax']");

  if(tax==''){
  net1.val('0');
  deductions1.val('0');
  //tax1.val('0');

  }
  else{
  var allsum = parseFloat(tax) + parseFloat(gsis) + parseFloat(pagibig) + parseFloat(philhealth) + parseFloat(other);

  var deductions1 = $("input[name='deductions']");
  deductions1.val(allsum);

  var amount = document.getElementById('amount').value;
  var deductions = document.getElementById('deductions').value;
  var result = parseFloat(amount).toFixed(2) - parseFloat(deductions).toFixed(2);
  if (!isNaN(result)) {

  document.getElementById('net').value = result.toFixed(2);

  }
  
  }
        

}





function myFunctiongsis() {
  var tax = document.getElementById("tax").value;
  var gsis = document.getElementById("gsis").value;
  var pagibig = document.getElementById("pagibig").value;
  var philhealth = document.getElementById("philhealth").value;
  var other = document.getElementById("other").value;


  var deductions1 = $("input[name='deductions']");
  var net1 = $("input[name='net']");
  var gsis1 = $("input[name='gsis']");

  if(gsis==''){
  net1.val('0');
  deductions1.val('0');
  //gsis1.val('0');

  }
  else{
  var allsum = parseFloat(tax) + parseFloat(gsis) + parseFloat(pagibig) + parseFloat(philhealth) + parseFloat(other);

  var deductions1 = $("input[name='deductions']");
  deductions1.val(allsum);

  var amount = document.getElementById('amount').value;
  var deductions = document.getElementById('deductions').value;
  var result = parseFloat(amount).toFixed(2) - parseFloat(deductions).toFixed(2);
  if (!isNaN(result)) {

  document.getElementById('net').value = result.toFixed(2);

  }
  
  }
        

}


function myFunctionpagibig() {
  var tax = document.getElementById("tax").value;
  var gsis = document.getElementById("gsis").value;
  var pagibig = document.getElementById("pagibig").value;
  var philhealth = document.getElementById("philhealth").value;
  var other = document.getElementById("other").value;


  var deductions1 = $("input[name='deductions']");
  var net1 = $("input[name='net']");
  var pagibig1 = $("input[name='pagibig']");

  if(pagibig==''){
  net1.val('0');
  deductions1.val('0');
  //pagibig1.val('0');

  }
  else{
  var allsum = parseFloat(tax) + parseFloat(gsis) + parseFloat(pagibig) + parseFloat(philhealth) + parseFloat(other);

  var deductions1 = $("input[name='deductions']");
  deductions1.val(allsum);

  var amount = document.getElementById('amount').value;
  var deductions = document.getElementById('deductions').value;
  var result = parseFloat(amount).toFixed(2) - parseFloat(deductions).toFixed(2);
  if (!isNaN(result)) {

  document.getElementById('net').value = result.toFixed(2);

  }
  
  }
        

}

function myFunctionphilhealth() {
  var tax = document.getElementById("tax").value;
  var gsis = document.getElementById("gsis").value;
  var pagibig = document.getElementById("pagibig").value;
  var philhealth = document.getElementById("philhealth").value;
  var other = document.getElementById("other").value;


  var deductions1 = $("input[name='deductions']");
  var net1 = $("input[name='net']");
  var philhealth1 = $("input[name='philhealth']");

  if(philhealth==''){
  net1.val('0');
  deductions1.val('0');
  //philhealth1.val('0');

  }
  else{
  var allsum = parseFloat(tax) + parseFloat(gsis) + parseFloat(pagibig) + parseFloat(philhealth) + parseFloat(other);

  var deductions1 = $("input[name='deductions']");
  deductions1.val(allsum);

  var amount = document.getElementById('amount').value;
  var deductions = document.getElementById('deductions').value;
  var result = parseFloat(amount).toFixed(2) - parseFloat(deductions).toFixed(2);
  if (!isNaN(result)) {

  document.getElementById('net').value = result.toFixed(2);

  }
  
  }
        

}

function myFunctionother() {
  var tax = document.getElementById("tax").value;
  var gsis = document.getElementById("gsis").value;
  var pagibig = document.getElementById("pagibig").value;
  var philhealth = document.getElementById("philhealth").value;
  var other = document.getElementById("other").value;


  var deductions1 = $("input[name='deductions']");
  var net1 = $("input[name='net']");
  var other1 = $("input[name='other']");

  if(other==''){
  net1.val('0');
  deductions1.val('0');
  //other1.val('0');

  }
  else{
  var allsum = parseFloat(tax) + parseFloat(gsis) + parseFloat(pagibig) + parseFloat(philhealth) + parseFloat(other);

  var deductions1 = $("input[name='deductions']");
  deductions1.val(allsum);

  var amount = document.getElementById('amount').value;
  var deductions = document.getElementById('deductions').value;
  var result = parseFloat(amount).toFixed(2) - parseFloat(deductions).toFixed(2);
  if (!isNaN(result)) {
  
  document.getElementById('net').value = result.toFixed(2);

  }
  
  }
        

}

</script>

<script>
  $( "#savediv" ).click(function() {
    
    var mode = $('#mode').val();
    var ors = $('#ors').val();
    var ors1 = $('#ors1').val();
    var orsdate = $('#orsdate').val();
    var dv = $('#dv').val();
    var dvdate = $('#datepicker2').val();
    var payee = $('#payee').val();
    var particular = $('#particular').val();
    var net = $('#net').val();
    var amount = $('#amount').val();
    var deductions = $('#deductions').val();

    var tax = $('#tax').val();
    var gsis = $('#gsis').val();
    var pagibig = $('#pagibig').val();
    var philhealth = $('#philhealth').val();
    var other = $('#other').val(); 
    var remarks = $('#remarks').val(); 
    var status = $('#status').val(); 

    var users = $('input[name="charge[]"]').map(function(){ 
    return this.value; 
    }).get();
    var users = $('input[name="ntano[]"]').map(function(){ 
    return this.value; 
    }).get();
    var users = $('input[name="amount[]"]').map(function(){ 
    return this.value; 
    }).get();




    $.ajax({
    url: "Disbursement_create_function.php",
    type: "post",
    data: {mode : mode,
    'charge[]' : charge,
    'ntano[]' : ntano, 
    'amount[]' : amount, 
    ors : ors, 
    ors1 : ors1, 
    orsdate : orsdate, 
    dv : dv, 
    dvdate : dvdate, 
    payee : payee, 
    particular : particular, 
    net : net, 
    amount : amount, 
    deductions : deductions,
    tax : tax, 
    gsis : gsis, 
    pagibig : pagibig, 
    philhealth : philhealth,
    other : other,
    remarks : remarks,
    status : status,
    charge : charge,
    ntano : ntano,
    amount : amount},
    success : function(data){
    alert(data); /* alerts the response from php.*/
    window.location.href='disbursement.php';
    }
    });

    // alert(mode);

});
</script>





