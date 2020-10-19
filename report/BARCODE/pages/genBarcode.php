<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");
$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
if(mysqli_connect_errno()){echo mysqli_connect_error();}  

// $office = $_POST['office'];
                $query = "SELECT * FROM rpci ORDER BY office ASC ";
                $name = '';
                $result = mysqli_query($conn, $query);
                $val = array();
                $status = '';
                while($row = mysqli_fetch_array($result))
                {
                    $id = $row["id"];
                    $article = $row["article"];  
                    $description = $row["description"];
                    $art_des = $article.",".$description;
                    $stock_number = $row["stock_number"];
                    $property_number = $row["inventory_item_no"];
                    $unit = $row["unit"];
                    $amount = $row["amount"];
                    $bpc = $row["bpc"];
                    $opc = $row["opc"];
                    $shortage_Q = $row["shortage_Q"];
                    $shortage_V = $row["shortage_V"];
                    $remarks = $row["remarks"];
                    $office = $row["office"];
                   
                    if (strpos($remarks, 'unserviceable') !== false) {
                       $status = 'unserviceable';
                    }else{
                      $status = "serviceable";
                    }

                     


                    $date_from = date('F d, Y',strtotime($row['date_from']));
                    $date_to = date('F d, Y',strtotime($row['date_to']));
                    $inventory_date = $date_from.' to '.$date_to.'';

                    $PHPJasperXML = new PHPJasperXML();

       
                $PHPJasperXML->arrayParameter=array(
                                    "article"=>$art_des,
                                    "property_no"=>$property_number,
                                    "serial_no"=>'',
                                    "location"=>$office,
                                    "status"=>$status,
                                    "inventory_date"=>$inventory_date,
                                    "remarks"=>$remarks);
                    
                }
     

    
                                    $PHPJasperXML->load_xml_file("barcode.jrxml");
                                    $PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
                                        $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
                                    

?>
