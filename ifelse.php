
                <?php   
                            $conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                            $username = $_SESSION['username'];

                            //echo $username;
                            $select_user = mysqli_query($conn,"SELECT DIVISION_C FROM tblemployeeinfo WHERE UNAME = '$username'");
                            $rowdiv = mysqli_fetch_array($select_user);
                            $DIVISION_C = $rowdiv['DIVISION_C'];
                            //echo $DIVISION_C;
                            
                ?>

              <?php if ($DIVISION_C == 15 || $DIVISION_C == 54):?>
                            
                <a  href='ViewIssuance.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> |
                <a href='UpdateIssuances.php?id=<?php echo $id;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | 

                <a onclick="return confirm('Are you sure you want to delete this record?');" name="del"  href="@Functions/issuancesdelete.php?id=<?php echo $id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
              <?php else :?>
                              
                <a  href='ViewIssuance.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a
                 <?php endif?>
            