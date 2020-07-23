<?PHP
session_start();

    include 'connection.php';
    $query1 = "SELECT * FROM tbltravel_claim_info2  WHERE `NAME` = '".$_SESSION['username']."'  ORDER BY ID DESC LIMIT 1";
    $result1 = mysqli_query($conn, $query1);
    
        if($row1 = mysqli_fetch_array($result1))
        {
                $query2 = "SELECT sum(`TOTAL_AMOUNT`)AS 'total' FROM tbltravel_claim_info inner join tbltravel_claim_info2 on  tbltravel_claim_info.TC_ID = tbltravel_claim_info2.ID  
                WHERE `RO_TO_OB` = '".$_POST['ro']."'";
                $result2 = mysqli_query($conn, $query2);
                if(mysqli_num_rows($result2) > 0)
                {
                    if($row2 = mysqli_fetch_array($result2))
                    {
            ECHO '₱ &nbsp;'.sprintf("%.2f",$row2['total']);
                    }
                }
            }
        

?>