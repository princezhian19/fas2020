 <table id="example1" class="table table-striped table-bordered" style="width:;background-color: white;">
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
                <?php 
                $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
                $view_query = mysqli_query($conn, "
                    SELECT DISTINCT app.id,app.sn,app.code,ic.item_category_title,app.procurement,mop.mode_of_proc_title,pmo.pmo_title,sof.source_of_funds_title 
                    FROM app 
                    LEFT JOIN item_category ic on ic.id = app.category_id 
                    LEFT JOIN source_of_funds sof on sof.id = app.source_of_funds_id 
                    LEFT JOIN pmo on pmo.id = app.pmo_id 
                    LEFT JOIN mode_of_proc mop on mop.id = app.mode_of_proc_id 
                    ORDER BY app.id DESC ");

                while ($row = mysqli_fetch_assoc($view_query)) {

                    $id = $row["id"];  
                    $sn = $row["sn"];  
                    $code = $row["code"];
                    $item_category_title = $row["item_category_title"];
                    $procurement = $row["procurement"];
                    $pmo_title = $row["pmo_title"];
                    $mode = $row["mode_of_proc_title"];
                    $source_of_funds_title = $row["source_of_funds_title"];

                    // if pmo == 1 and 2 print ord and lgmed

                    ?>
                    <tr>
                        
                        <td width="1000"><?php echo $sn;?></td>
                        <td width="1000"><?php echo $code;?></td>
                        <td width="1000"><?php echo $item_category_title;?></td>
                        <td width="2000"><?php echo $procurement;?></td>
                        <td width="150"><?php echo $pmo_title;?></td>
                        <td width="1000"><?php echo $mode;?></td>
                        <td width="1000"><?php echo $source_of_funds_title;?></td>
                        <td width="150">
                         <!--  &nbsp&nbsp&nbsp&nbsp&nbsp<a href='export_pr.php?id=<?php echo $id; ?>' > <i style='font-size:20px' class='fa'>&#xf06e;</i> </a> -->

                         &nbsp&nbsp&nbsp&nbsp&nbsp<a  href='UpdateAPP.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf044;</i> </a>

                     </td>
                      <td>&nbsp&nbsp&nbsp&nbsp&nbsp<a  href='ViewApp_History.php?id=<?php echo $id; ?>' title="View"> <i style='font-size:20px' class='fa'>&#xf06e;</i> </a></td>
                     <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a href='ViewRFQdetails.php?id=<?php echo $id; ?> '> 
                    <i style='font-size:24px' class='fa'>&#xf044;</i> </a>
                    
                </td> -->
                <!-- <td>
                    &nbsp&nbsp&nbsp&nbsp&nbsp<a  onclick="return confirm('Are you sure you want to Delete this item?');" href='delete_app.php?id=<?php echo $id; ?>  ' title="Delete"> 
                        <i style='font-size:20px' class='fa fa-trash-o' ></i> </a>

                    </td> -->
                    
                    
                </tr>
            <?php } ?>
        </table>