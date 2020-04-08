 <?php 
 $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
 if (isset($_POST['submit'])) {
    $contact_person = $_POST['contact_person'];
    $supplier_title = $_POST['supplier_title'];
    $line_of_industry_id = $_POST['line_of_industry_id'];
    $supplier_address = $_POST['supplier_address'];
    $contact_details = $_POST['contact_details'];
    $tin_number = $_POST['tin_number'];
    $registration_agency_id = $_POST['registration_agency_id'];
    $registration_valid_from = $_POST['registration_valid_from'];
    $registration_valid_until = $_POST['registration_valid_until'];
    $bp_validity_from = $_POST['bp_validity_from'];
    $bp_validity_until = $_POST['bp_validity_until'];
    $tc_validity_from = $_POST['tc_validity_from'];
    $tc_validity_until = $_POST['tc_validity_until'];
    $philgeps_reg_no = $_POST['philgeps_reg_no'];
    $prc_validity_from = $_POST['prc_validity_from'];
    $prc_validity_until = $_POST['prc_validity_until'];
    $itr_last_receipt_date = $_POST['itr_last_receipt_date'];
    $remarks = $_POST['remarks'];
    
    $insert = mysqli_query($conn,"INSERT INTO supplier(contact_person, supplier_title, line_of_industry_id, supplier_address, contact_details, tin_number, registration_agency_id, registration_valid_from, registration_valid_until, bp_validity_from, bp_validity_until, tc_validity_from, tc_validity_until, philgeps_reg_no, prc_validity_from, prc_validity_until, itr_last_receipt_date, remarks) VALUES ('$contact_person','$supplier_title','$line_of_industry_id','$supplier_address','$contact_details','$tin_number','$registration_agency_id','$registration_valid_from','$registration_valid_until','$bp_validity_from','$bp_validity_until','$tc_validity_from','$tc_validity_until','$philgeps_reg_no','$prc_validity_from','$prc_validity_until','$itr_last_receipt_date','$remarks')");
    if ($insert) {
      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Successfuly Saved!')
        window.location.href = 'ViewSuppliers.php';
        </SCRIPT>");
  }else{
      echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Error Occured!');
        </SCRIPT>");

  }
}


?>

<div class="box box-default">
    <br />
    <form method="POST">
      <div class="box-body" style="padding-bottom: 150px;">
        <div class="row">
          <div class="col-md-6">
            <legend>Supplier Information</legend>
            <div class="form-group">
                <label>Supplier Title</label>
                <input type="text" name="supplier_title" class="form-control">
            </div> 
            <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" class="form-control">
            </div> 
            <div class="form-group">
                <label>Address</label>
                <textarea name="supplier_address" class="form-control"></textarea>
            </div> 
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="contact_details" class="form-control">
            </div> 
            <div class="form-group">
                <label>TIN</label>
                <input type="text" name="tin_number" class="form-control">
            </div> 
            <div class="form-group">
                <label>Select Line of Industry</label>
                <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="line_of_industry_id" name="line_of_industry_id" >
                    <option value="" disabled selected>Select Line of Industry</option>
                    <option value="1">Supplies</option>
                    <option value="2">Hotels</option>
                    <option value="3">Catering</option>
                    <option value="4">Printing</option>
                </select> 
            </div> 
            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" rows="10" class="form-control"></textarea>
            </div> 
            <button class="btn btn-success btn-s" name="submit">Create</button>
        </div> 
        <div class="col-md-6">  
            <legend>Registration Details</legend>
            <div class="well">
                <label>Select Agency</label>
                <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="registration_agency_id" name="registration_agency_id" >
                    <option value="" disabled selected>Select Agency</option>
                    <option value="1">DTI</option>
                    <option value="2">SEC</option>
                </select> 
                <div class="row">
                    <div class="col-md-6">  
                        <label>FROM</label>
                        <input type="date" name="registration_valid_from" class="form-control">
                    </div>

                    <div class="col-md-6">  
                        <label>UNTIL</label>
                        <input type="date" name="registration_valid_until" class="form-control">
                    </div>
                </div>
            </div>
            <legend>Business Permit Validity</legend>
            <div class="well">
                <div class="row">
                    <div class="col-md-6">  
                        <label>FROM</label>
                        <input type="date" name="bp_validity_from" class="form-control">
                    </div>

                    <div class="col-md-6">  
                        <label>UNTIL</label>
                        <input type="date" name="bp_validity_until" class="form-control">
                    </div>
                </div>
            </div>
            <legend>Tax Validity</legend>
            <div class="well">
                <div class="row">
                 <div class="col-md-6">  
                    <label>FROM</label>
                    <input type="date" name="tc_validity_from" class="form-control">
                </div>
                <div class="col-md-6">  
                    <label>UNTIL</label>
                    <input type="date" name="tc_validity_until" class="form-control">
                </div>
            </div>
        </div>
        <legend>PHILGEPS Registration Certificate Validity</legend>
        <div class="well">
            <div class="form-group">
                <label>Philgeps Registration No.</label>
                <input type="text" name="philgeps_reg_no" class="form-control">
            </div> 
            <div class="row">
                <div class="col-md-6">  
                    <label>FROM</label>
                    <input type="date" name="prc_validity_from" class="form-control">
                </div>
                <div class="col-md-6">  
                    <label>UNTIL</label>
                    <input type="date" name="prc_validity_until" class="form-control">
                </div>
            </div>
            
        </div>   
        <legend>Latest Annual Income/Business Tax Return</legend>
        <div class="well">
           <label>Date of Receipt of the Annual ITR 2015 by the BIR</label>
           <input type="date" name="itr_last_receipt_date" class="form-control">
       </div> 
   </div> 

</form>
</div>
