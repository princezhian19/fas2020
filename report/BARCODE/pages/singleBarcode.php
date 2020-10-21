<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");
$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
    $PHPJasperXML = new PHPJasperXML();

if(mysqli_connect_errno()){echo mysqli_connect_error();}  

$id = $_GET['id'];
                $query = "SELECT * FROM rpci where id = '".$id."'";
            
                $name = '';
                $status = '';

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
                    $office2 = $row["office"];
                   
                    if (strpos($remarks, 'unserviceable') !== false) {
                       $status = 'unserviceable';
                       $status2 = 'correct.png';
                       $status1 = '';

                    }else{
                       $status = "serviceable";
                       $status2 = '';
                       $status1 = 'correct.png';

                    }

                     


                    $date_from = date('F d, Y',strtotime($row['date_from']));
                    $date_to = date('F d, Y',strtotime($row['date_to']));
                    $inventory_date = $date_from.' to '.$date_to.'';

                    // $art_len = strlen($art_des);
                    // if($art_len > )
       
                $PHPJasperXML->arrayParameter=array(
                                    "serv"=>$status1,
                                    "unserv"=>$status2,
                                    "sql"=>$query,
                                    "image_path"=>"logo.png",
                                    "article"=>$art_des,
                                    "property_no"=>$property_number,
                                    "office"=>$office2,
                                    "status"=>$status,
                                    "inventory_date"=>$inventory_date,
                                    "remarks"=>$remarks);
                    
                }
     

    
                                    $PHPJasperXML->load_xml_file("singlebarcode.jrxml");
                                    $PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
                                        $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
                                    

?>
