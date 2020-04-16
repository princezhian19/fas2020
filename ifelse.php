  <!--   <?php if ($_GET['division'] == 11 || $_GET['division'] == 12 || $_GET['division'] == 13 || $_GET['division'] == 14 || $_GET['division'] == 16):?> -->  
              
                <a  href='ViewIssuance.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> |
                <a href='UpdateIssuances.php?id=<?php echo $id;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | 

                <a onclick="return confirm('Are you sure you want to Delete?');" name="del"  href="@Functions/issuancesdelete.php?id=<?php echo $id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
              
                <!-- <?php else :?> -->
                <!-- <a  href='ViewIssuance.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> | -->
                <!-- <a href='UpdateIssuances.php?id=<?php echo $id;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> -->

                <!-- <?php endif?> -->
