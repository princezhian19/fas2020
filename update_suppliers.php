 <?php 
 $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
 $id = $_GET['id'];
 $get_data = mysqli_query($conn,"SELECT * FROM supplier WHERE id = $id ");
 $getrow = mysqli_fetch_array($get_data);
 $contact_person1 = $getrow['contact_person'];
 $supplier_title1 = $getrow['supplier_title'];
 $line_of_industry_id1 = $getrow['line_of_industry_id'];
 $supplier_address1 = $getrow['supplier_address'];
 $contact_details1 = $getrow['contact_details'];
 $tin_number1 = $getrow['tin_number'];
 $registration_agency_id1 = $getrow['registration_agency_id'];
 $registration_valid_from1 = $getrow['registration_valid_from'];
 $registration_valid_until1 = $getrow['registration_valid_until'];
 $bp_validity_from1 = $getrow['bp_validity_from'];
 $bp_validity_until1 = $getrow['bp_validity_until'];
 $tc_validity_from1 = $getrow['tc_validity_from'];
 $tc_validity_until1 = $getrow['tc_validity_until'];
 $philgeps_reg_no1 = $getrow['philgeps_reg_no'];
 $prc_validity_from1 = $getrow['prc_validity_from'];
 $prc_validity_until1 = $getrow['prc_validity_until'];
 $itr_last_receipt_date1 = $getrow['itr_last_receipt_date'];
 $remarks1 = $getrow['remarks'];

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
    
    $insert = mysqli_query($conn,"UPDATE supplier SET contact_person='$contact_person',supplier_title='$supplier_title',line_of_industry_id='$line_of_industry_id',supplier_address='$supplier_address',contact_details='$contact_details',tin_number='$tin_number',registration_agency_id='$registration_agency_id',registration_valid_from='$registration_valid_from',registration_valid_until='$registration_valid_until',bp_validity_from='$bp_validity_from',bp_validity_until='$bp_validity_until',tc_validity_from='$tc_validity_from',tc_validity_until='$tc_validity_until',philgeps_reg_no='$philgeps_reg_no',prc_validity_from='$prc_validity_from',prc_validity_until='$prc_validity_until',itr_last_receipt_date='$itr_last_receipt_date',remarks='$remarks' WHERE id = $id");
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
                <input type="text" name="supplier_title" class="form-control" value="<?php echo $supplier_title1?>">
            </div> 
            <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" class="form-control" value="<?php echo $contact_person1?>">
            </div> 
            <div class="form-group">
                <label>Address</label>
                <textarea name="supplier_address" class="form-control"><?php echo $supplier_address1?></textarea>
            </div> 
            <div class="form-group">
                <label>Contact Details</label>
                <input type="text" name="contact_details" class="form-control" value="<?php echo $contact_details1?>">
            </div> 
            <div class="form-group">
                <label>TIN</label>
                <input type="text" name="tin_number" class="form-control" value="<?php echo $tin_number1?>">
            </div> 
            <div class="form-group">
                <label>Select Line of Industry</label>
                <?php if ($line_of_industry_id1 == 1): ?>
                     <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="line_of_industry_id" name="line_of_industry_id" >
                    <option value="1">Supplies</option>
                    <option value="2">Hotels</option>
                    <option value="3">Catering</option>
                    <option value="4">Printing</option>
                </select> 
                <?php endif ?>
                 <?php if ($line_of_industry_id1 == 2): ?>
                     <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="line_of_industry_id" name="line_of_industry_id" >
                    <option value="2">Hotels</option>
                    <option value="1">Supplies</option>
                    <option value="3">Catering</option>
                    <option value="4">Printing</option>
                </select> 
                <?php endif ?>
                 <?php if ($line_of_industry_id1 == 3): ?>
                     <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="line_of_industry_id" name="line_of_industry_id" >
                    <option value="3">Catering</option>
                    <option value="1">Supplies</option>
                    <option value="2">Hotels</option>
                    <option value="4">Printing</option>
                </select> 
                <?php endif ?>
                 <?php if ($line_of_industry_id1 == 4): ?>
                     <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="line_of_industry_id" name="line_of_industry_id" >
                    <option value="4">Printing</option>
                    <option value="1">Supplies</option>
                    <option value="2">Hotels</option>
                    <option value="3">Catering</option>
                </select> 
                <?php endif ?>
            </div> 
            <div class="form-group">
                <label>Remarks</label>
                <textarea name="remarks" rows="10" class="form-control"><?php echo $remarks1?></textarea>
            </div> 
            <button class="btn btn-primary btn-s" name="submit">Update</button>
        </div> 
        <div class="col-md-6">  
            <legend>Registration Details</legend>
            <div class="well">
                <label>Select Agency</label>
                <?php if ($registration_agency_id1 == 1): ?>
                     <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="registration_agency_id" name="registration_agency_id" >
                    <option value="1">DTI</option>
                    <option value="2">SEC</option>
                </select> 
                <?php endif ?>
                <?php if ($registration_agency_id1 == 2): ?>
                     <select required class="form-control select2" style="width: 100%;" autocomplete="off" id="registration_agency_id" name="registration_agency_id" >
                    <option value="2">SEC</option>
                    <option value="1">DTI</option>
                </select> 
                <?php endif ?>
                <div class="row">
                    <div class="col-md-6">  
                        <label>FROM</label>
                        <input type="date" name="registration_valid_from" class="form-control" value="<?php echo $registration_valid_from1?>">
                    </div>

                    <div class="col-md-6">  
                        <label>UNTIL</label>
                        <input type="date" name="registration_valid_until" class="form-control" value="<?php echo $registration_valid_until1?>">
                    </div>
                </div>
            </div>
            <legend>Business Permit Validity</legend>
            <div class="well">
                <div class="row">
                    <div class="col-md-6">  
                        <label>FROM</label>
                        <input type="date" name="bp_validity_from" class="form-control" value="<?php echo $bp_validity_from1?>">
                    </div>

                    <div class="col-md-6">  
                        <label>UNTIL</label>
                        <input type="date" name="bp_validity_until" class="form-control" value="<?php echo $bp_validity_until1?>">
                    </div>
                </div>
            </div>
            <legend>Tax Validity</legend>
            <div class="well">
                <div class="row">
                   <div class="col-md-6">  
                    <label>FROM</label>
                    <input type="date" name="tc_validity_from" class="form-control" value="<?php echo $tc_validity_from1?>">
                </div>
                <div class="col-md-6">  
                    <label>UNTIL</label>
                    <input type="date" name="tc_validity_until" class="form-control" value="<?php echo $tc_validity_until1?>">
                </div>
            </div>
        </div>
        <legend>PHILGEPS Registration Certificate Validity</legend>
        <div class="well">
            <div class="form-group">
                <label>Philgeps Registration No.</label>
                <input type="text" name="philgeps_reg_no" class="form-control" value="<?php echo $philgeps_reg_no1?>">
            </div> 
            <div class="row">
                <div class="col-md-6">  
                    <label>FROM</label>
                    <input type="date" name="prc_validity_from" class="form-control" value="<?php echo $prc_validity_from1?>">
                </div>
                <div class="col-md-6">  
                    <label>UNTIL</label>
                    <input type="date" name="prc_validity_until" class="form-control" value="<?php echo $prc_validity_until1?>">
                </div>
            </div>
            
        </div>   
        <legend>Latest Annual Income/Business Tax Return</legend>
        <div class="well">
         <label>Date of Receipt of the Annual ITR 2015 by the BIR</label>
         <input type="date" name="itr_last_receipt_date" class="form-control" value="<?php echo $itr_last_receipt_date1?>">
     </div> 
 </div> 

</form>
</div>
