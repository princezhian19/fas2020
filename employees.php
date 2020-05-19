<?php 
  date_default_timezone_set('Asia/Manila');
  $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
  $connect = new PDO("mysql:host=localhost;dbname=fascalab_2020", "fascalab_2020", "w]zYV6X9{*BN");
  $username = $_GET['username'];
  function tblpersonnel($connect)
  { 
    $output = '';
    $query = "SELECT DIVISION_N,DIVISION_M FROM `tblpersonneldivision`  ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
      $output .= '<option text="text" value="'.$row["DIVISION_N"].'">'.$row["DIVISION_M"].'</option>';
    }
    return $output;
  }



  $sel = mysqli_query($conn,"SELECT * FROM phone_directory LIMIT 1");
  $rows = mysqli_fetch_array($sel);
  $posted_date = $rows['posted_date'];
  $month = date('M',strtotime($posted_date));

  if (isset($_POST['submit'])) {
     $month_export = $_POST['month'];
     $year_export = $_POST['year'];
     $office_export = $_POST['office'];

     $full_date = $year_export.'-'.$month_export;

   echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='export_employee.php?e_date=$full_date&office=$office_export';
        </SCRIPT>");
  }
?>
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body table-responsive"> 
        <h1 align="">Directory of DILG-IV-A Employees</h1>
        <br>
         <form method="POST">
        <div class="row" id="boxed">
          <div class="col-xs-2">
            <br>
        <li class="btn btn-success"><a href="CreateEmployee.php" style="color:white;text-decoration: none;">Add</a></li>

          </div>
          <div class="">
            <div>
           <div class="col-xs-2">
            </div>
             <div class="col-xs-1">
            </div>
            </div>
            <div class="col-xs-2">
              <label>Month <font style="color:red;">*</font></label>
               <select required class="form-control select2" name="month">
                <option  selected disabled></option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </div>
            <div class="col-xs-2">
              <label>Year<font style="color:red;">*</font></label>
              <select required class="form-control select2" name="year">
                <option selected disabled></option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
              </select>
            </div>
            <div class="col-xs-2">
              <label>Office <font style="color:red;">*</font></label>
              <select required class="form-control select2" name="office">
                 <option disabled selected></option>
                 <?php echo tblpersonnel($connect)?>
              </select>
            </div>
              <div class="col-xs-1" style="padding-top: 5px;">
              <br>
              <button type="submit" name="submit" id="submit" class="btn btn-success">Export</button>
            </div>

          </div>
        </div>
        </form>
        <br>
        <br>
        <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
            <thead>
              <tr style="background-color: white;color:blue;">
                <th>FIRST NAME</th>
                <th>MIDDLE NAME</th>
                <th>LAST NAME</th>
                <th>OFFICE</th>
                <th>POSITION</th>
                <th>DESIGNATION</th>
                <th>MOBILE NO</th>
                <th>PERSONAL EMAIL ADDRESS</th>
                <th>OFFICE CONTACT NO</th>
                <th>OFFICE EMAIL ADDRESS</th>
                <th>BIRTHDAY</th>
                <th>ACTION</th>
                <th></th>
              </tr>
            </thead>
            <?php 
            $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
            $view_query = mysqli_query($conn, "SELECT tblemployee.EMP_N,tblemployee.FIRST_M,tblemployee.MIDDLE_M,tblemployee.LAST_M,tblemployee.BIRTH_D,tblemployee.EMAIL,tblemployee.MOBILEPHONE,tblpersonneldivision.DIVISION_M,tbldilgposition.POSITION_M,tbldesignation.DESIGNATION_M FROM tblemployeeinfo tblemployee LEFT JOIN tblpersonneldivision on tblpersonneldivision.DIVISION_N = tblemployee.DIVISION_C LEFT JOIN tbldilgposition on tbldilgposition.POSITION_ID = tblemployee.POSITION_C LEFT JOIN tbldesignation on tbldesignation.DESIGNATION_ID = tblemployee.DESIGNATION");

                $sele = mysqli_query($conn,"SELECT ACCESSTYPE FROM tblemployee WHERE UNAME = '$username'");
                $rowU = mysqli_fetch_array($sele);
                $ACCESSTYPE = $rowU['ACCESSTYPE'];
            while ($row = mysqli_fetch_assoc($view_query)) {
              $id = $row["EMP_N"];
              $FIRST_M = $row["FIRST_M"];  
              $MIDDLE_M = $row["MIDDLE_M"];  
              $LAST_M = $row["LAST_M"];
              $DIVISION_M = $row["DIVISION_M"];
              $POSITION_M = $row["POSITION_M"];
              $DESIGNATION_M = $row["DESIGNATION_M"];
              $MOBILEPHONE = $row["MOBILEPHONE"];
              $EMAIL = $row["EMAIL"];
              $BIRTH_D = $row["BIRTH_D"];
              $BIRTH = date('F d',strtotime($BIRTH_D));
              ?>
              <tr>
                <td width=""><?php echo $FIRST_M;?></td>
                <td width=""><?php echo $MIDDLE_M;?></td>
                <td width=""><?php echo $LAST_M;?></td>
                <td width=""><?php echo $DIVISION_M;?></td>
                <td width=""><?php echo $POSITION_M;?></td>
                <td width=""><?php echo $DESIGNATION_M;?></td>
                <td width=""><?php echo $MOBILEPHONE;?></td>
                <td width=""><?php echo $EMAIL;?></td>
                <td width=""><?php echo $MOBILEPHONE;?></td>
                <td width=""><?php echo $EMAIL;?></td>
                <td width=""><?php echo $BIRTH;?></td>

            
                <?php if ($ACCESSTYPE == 'admin'): ?>
                <td width="150">
                 <a href='UpdateEmployee.php?id=<?php echo $id; ?>&division=<?php echo $_GET['division']; ?>&username=<?php echo $_GET['username']; ?>' title="Edit" class="btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i>Edit</a>
               </td>
               <td><a onclick="return confirm('Are you sure you want to Delete this Account now?');" href='delete_account2.php?id=<?php echo $id;?>' title="delete" class = "btn btn-danger btn-xs" > <i class='fa fa-fw fa-trash'></i> Delete</a> </td>
               <?php else: ?>
                <td>
                 <a href='UpdateEmployee.php?id=<?php echo $id; ?>&view=1' title="View" class="btn btn-info btn-xs">View</a>
                </td>
                <td></td>
                <?php endif ?>


             </tr>
           <?php } ?>
       </table>
     </div>
   </div>
 </div>
</div>



