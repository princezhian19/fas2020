<?php
// include('db.class.php'); // call db.class.php
?>
<!DOCTYPE html>
<html>
<head>
  <title>FAS</title>


</head>
<body>
<div class="box">
  <div class="box-body">
          
          <h1 align="">Issuances</h1>
          
          <br>
        
          <div class=""  style="overflow-x:auto;">
         
            <li class="btn btn-success"><a href="CreateIssuances.php" style="color:white;text-decoration: none;">Add</a></li>
        
          
              <br>
              <br>
              
            </div>

            <table id="example1" class="table table-striped table-bordered" style="background-color: white;">
                <thead>
                    <tr style="background-color: white;color:blue; text-align:center">
                 
                  <th width = '250'>CATEGORY</th>
                  <th width = '200'>ISSUANCE NO</th>
                  <th width = '200'>ISSUANCE DATE</th>
                  <th width = '500'>TITLE/SUBJECT</th>
                  <th width = '250'>ACTION</th>
                  
                </tr>
                </thead>
                <?php
            $servername = "localhost";
            $username = "fascalab_2020";
            $password = "w]zYV6X9{*BN";
            $database = "fascalab_2020";
            
            // Create connection
            $conn = new mysqli($servername, $username, $password,$database);
            $view_query = mysqli_query($conn, "SELECT issuances.id,issuances.category, issuances.issuance_no, issuances.date_issued, issuances.subject, issuances_category.name from issuances left join issuances_category on issuances.category=issuances_category.id order by dateposted desc");

                while ($row = mysqli_fetch_assoc($view_query)) {
                  $id = $row["id"];
                  
                  $name = $row["name"];

                  $issuance_no  = $row["issuance_no"];
                
                  $date_issued1  = $row["date_issued"];
                  $date_issued = date('F d, Y', strtotime($date_issued1));
                   // $date_issued1 = date('F d, Y', strtotime($date1));
                  $subject = $row["subject"];
                 

               ?>

                <tr align = ''>
            
                
              
                <td><?php echo $name?></td>
                <td><?php echo $issuance_no?></td>
                <td><?php echo $date_issued?></td>
                <td><?php echo $subject?></td>

                <td>
                <a  href='ViewIssuance.php?id=<?php echo $id;?>' title="View" class = "btn btn-info btn-xs"> <i class='fa'>&#xf06e;</i> View</a> |
                <a href='UpdateIssuances.php?id=<?php echo $id;?>'  class = "btn btn-primary btn-xs"> <i class='fa'>&#xf044;</i> Edit</a> | 

                <a onclick="return confirm('Are you sure you want to delete this record?');" name="del"  href="@Functions/issuancesdelete.php?id=<?php echo $id; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>

              

                </td>
                
               

                </tr>

            
            <?php }?>



             
            </table>
                
                </div>
            </div>
                

    </body>

    <script type="text/javascript">
    $(document).ready(function() {
        var dataTable=$('#example1').DataTable({
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : false,
            'info'        : false,
            'autoWidth'   : true,
            "order": [[ 1, "asc" ]],
            aLengthMenu: [ [10, 20, -1], [ 10, 20, "All"] ],
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
            });
        
    } );
</script>





</body>
</html>



