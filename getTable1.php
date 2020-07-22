<?php 

include 'travelclaim_functions.php';
?>
<thead>
                <tr>
                    <td class = "label-text">
                      <label>Entity Name: 
                        </td>
                          <td colspan = 10  >
                        <input type = "text" class = "form-control" value = "DILG Region IV-A" readonly/>
                      </td>
                  </tr>
          
              
                <tr>
                  <td class = "label-text">
                    <label>Fund Cluster:</label>
                      </td>
                        <td colspan = "4">
                      <input type = "text" class = "form-control" readonly/>
                    </td>
                  <td class = "label-text" colspan = 2>
                    <label>No:</label>
                      </td>
                        <td colspan = 4>
                      <input type = "text" class = "form-control" readonly/>
                    </td>
                </tr>
                <tr>
                  <td class = "label-text">
                    <label>Name: 
                      </td>
                  <td colspan = 4><input type = "text" class = "form-control" style = "font-weight:bold;"value = "<?php echo viewCompleteName($_POST['username']);?>" readonly/></td>
                  <td colspan = 2 class = "label-text"><label>Date of Travel: <label style="color: Red;" >*</label> </label></td>
                  <td colspan = 4><input type = "text" class = "form-control datepicker1" id = "datepicker1" value = "<?php echo date('F d, Y');?>" readonly/></td>
                </tr>
                <tr>
                  <td class = "label-text">  <label>Position:</label></td>
                    <td colspan = 4 ><input type = "text" class = "form-control" value = "<?php echo viewPosition($_POST['username']);?>" readonly/></td>
                      <td colspan = 5 rowspan = 2>
                        <label>Purpose:</label> <label style="color: Red;" >*</label><textarea name = "ro" rows = 4 col=10 style = "width:100%;resize:none;" id = "or" disabled><?php echo $_POST['purpose'];?></textarea></td>
                </tr>
                <tr>
                  <td class = "label-text">  <label>Official Station: </label></td>
                  <td colspan = 4> <?php echo viewOffice($_POST['username']); ?> </td>
                </tr>
              </thead>
