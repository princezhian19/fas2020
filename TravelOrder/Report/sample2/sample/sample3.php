<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once("../PHPJasperXML.inc.php");
// include_once ('setting.php');

$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->load_xml_file("sample.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');

$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
