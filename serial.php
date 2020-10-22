    <?php

    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    $view_query = mysqli_query($conn, "SELECT id, description,serial_no FROM rpcppe");
    while ($row = mysqli_fetch_assoc($view_query)) {
        $sn = $row['serial_no'];
        $id = $row['id'];
    $view_query1 = mysqli_query($conn, "SELECT id,description,serial_no FROM rpcppe where description LIKE '%$sn%' ");
    
        while ($row1 = mysqli_fetch_assoc($view_query1))
        {
            
            $ssn = $row1['serial_no'];
            $idd = $row1['id'];
            $UPDATE =" UPDATE `rpcppe` SET 
                `serial_no`='".$sn."'
                WHERE  `id` = '".$idd."'";
            
                if (mysqli_query($conn, $UPDATE)) {
                } else {
                }
        }
    }
    ?>