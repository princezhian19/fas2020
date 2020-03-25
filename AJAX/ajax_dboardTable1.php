<?php
$link = mysqli_connect("localhost","root","", "fascalab_2020");
if(mysqli_connect_errno()){echo mysqli_connect_error();}  

$win_supplier = '';
$po = '';
$query1 = "SELECT * FROM end_users 
           INNER JOIN pr on end_users.username = pr.pmo
           INNER JOIN rfq on pr.pr_no = rfq.pr_no
           INNER JOIN abstract_of_quote on rfq.id = abstract_of_quote.rfq_id
           INNER JOIN supplier ON abstract_of_quote.supplier_id=supplier.id
           INNER JOIN selected_quote ON rfq.id = selected_quote.rfq_id
           INNER JOIN po on selected_quote.po_id = po.id
           WHERE 
           end_users.username = 'FAD' and
           pmo = 'FAD'
          order by pr.id";

$result = mysqli_query($link, $query1);
              if($row = mysqli_fetch_array($result)){
                $view_query = mysqli_query($link,"SELECT * FROM pr  where pmo = 'FAD'  order by id desc");
                while ($row = mysqli_fetch_assoc($view_query))
                {
                    $id = $row["id"];
                    $pr_no = $row["pr_no"];
                    $pr_date = $row["pr_date"];
                    $pr_date11 = date('F d, Y', strtotime($pr_date));
                    $pmo = $row["pmo"];
                    $purpose = $row["purpose"];
                    $target_date = $row["target_date"];
                    $target_date11 = date('F d, Y', strtotime($target_date));

                    $RFQ = mysqli_query($link, "SELECT * FROM rfq where pr_no = '$pr_no' ");
                    $rowID = mysqli_fetch_array($RFQ);
                    $rfq_id = $rowID['id'];
                    $rfq_no = $rowID['rfq_no'];
                    $rfq_date = $rowID['rfq_date'];
                    $rfq_date11 = date('F d, Y', strtotime($rfq_date));
                    if (mysqli_num_rows($RFQ)>0) { echo "<p style='color:green'><b>$rfq_no</b></p>"; }else{ echo " "; }
                    if (mysqli_num_rows($RFQ) > 0) { echo "<p style='color:green'><b>$rfq_date11</b></p>"; }else{ echo " "; }
                    $selectABS = mysqli_query($link,"SELECT * FROM abstract_of_quote WHERE rfq_id = '$rfq_id'");
                            if (mysqli_num_rows($selectABS) > 0 ) {
                            $rowABS = mysqli_fetch_array($selectABS);
                            $supplier_id = $rowABS['supplier_id'];
                            $select_sup = mysqli_query($link,"SELECT supplier_title from supplier WHERE id = '$supplier_id'");
                            $rowSup = mysqli_fetch_array($select_sup);
                            $win_supplier = $rowSup['supplier_title'];
                              echo "<p style='color:green'><b>$win_supplier</b></p>";
                            }else{
                            echo "";
                            }

                            $selectPO = mysqli_query($link,"SELECT po.po_no FROM selected_quote sq LEFT JOIN po on po.id = sq.po_id WHERE sq.rfq_id = '$rfq_id'");
                            if (mysqli_num_rows($selectPO) > 0 ) {
                            $rowPO = mysqli_fetch_array($selectPO);
                            $po = $rowPO['po_no'];
                              echo "<p style='color:green'><b>$po</b></p>";
    
                            }else{
                            echo "";
                             }

                             $selectPO_date = mysqli_query($link,"SELECT po.po_no,po.po_date FROM selected_quote sq LEFT JOIN po on po.id = sq.po_id WHERE sq.rfq_id = '$rfq_id'");
                             $rowPO_date = mysqli_fetch_array($selectPO_date);
                             $po_date = $rowPO_date['po_date'];
                             $po_date11 = date('F d, Y', strtotime($po_date));
                             
                             if($po_date==""){
                               echo "<p style='color:green'><b></b></p>";
     
                             }
                             else{
                               echo "<p style='color:green'><b>$po_date11</b></p>";
     
                             }
                             $viewpr = '<a href = "ViewPRv1.php?id='.$id.'">'.$pr_no.'</a>';
                             $viewrfq = '<p style="color:green"><b>'.$rfq_no.'</b></p>';
                             $viewrfqdate11 ='<p style="color:green"><b>'.$rfq_date11.'</b></p>';
                             $viewwin_supplier = '<p style="color:green"><b>'.$win_supplier.'</b></p>';
                             $viewpo = '<p style="color:green"><b>'.$po.'</b></p>';
                            $view_podate11='<p style="color:green"><b>'.$po_date11.'</b></p>';
                            
                             $return_arr[] = array(
                               "PR_NO"=>$pr_no,
                               "PR_DATE" => $pr_date11,
                               "OFFICE"=> $pmo,
                               "PURPOSE"=>$purpose,
                               "TARGET_DATE"=>$target_date,

                               "RFQ_NO"=>$pr_no,
                               "RFQ_DATE"=>$rfq_no,
                               "WINNING_SUPPLIER"=>$win_supplier,
                               "PO_NO"=>$po,
                               "PO_DATE"=>$view_podate11
                              );
                }
        
            }
echo json_encode($return_arr);

              

?>