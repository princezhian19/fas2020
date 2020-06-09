<?php

include_once 'Sample_Header.php';

require_once('dbaseCon.php'); 

require_once($_SERVER["DOCUMENT_ROOT"].'/_includes/setting.php');



/*



echo $_SERVER["DOCUMENT_ROOT"].'/_includes/setting.php';

print_debug($_SESSION);*/



$DBConn = dbConnect();

if (!$DBConn) {

  return false;

} 







$division = $_SESSION['datas']['division'];



/*$date = $_SESSION['datas']['date'];

$dateto =  $_SESSION['datas']['date_to'];

$byme = $_SESSION['datas']['by_me'];

*/

$date_from =  date('Y-m-d', strtotime($_SESSION['datas']['date']));

$date_array_from = explode('-', $date_from);



$date_to =  date('Y-m-d', strtotime($_SESSION['datas']['date_to']));

$date_array_to = explode('-', $date_to);







// print_debug($query_data);



$dates_to_look = array();



$start    = (new DateTime($date_from))->modify('first day of this month');

$end      = (new DateTime($date_to))->modify('first day of next month');

$interval = DateInterval::createFromDateString('1 month');

$period   = new DatePeriod($start, $interval, $end);



foreach ($period as $dt) {

    $dates_to_look[]= $dt->format("Y-m");

}









// Template processor instance creation

echo date('H:i:s'), ' Creating new TemplateProcessor instance...', EOL;



if ($_SESSION['datas']['decider']=="qme") {

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/qme_final.docx');

}



$counted = count($dates_to_look);



$objectiveoneabaverage = array();



$if_not_empty_value = array();

$monthdate = array();

$incoming_receiveda= array();

$incoming_received_routeda = array();

$outgoing_receiveda = array();

$outgoinga = array();

$total_docu_fileda = array();

$total_docu_forfilinga = array();

$objectiveone_percenta = array();

$objectiveone_percent_meta = array();

$objectivetwo_percenta = array();

$objectivethree_percenta = array();

$objectivetwo_percent_meta = array();

$objectivethree_percent_meta = array();

$objectiveone_percent_unmeta = array();

$objectivethree_percent_unmeta = array();

$objectivetwo_percent_unmeta = array();



$get_month = array();



$months_array = array("","","","","","","","","","","","");





for ($i=0; $i <$counted ; $i++) { 

  /*get received within the day*/

  $sql1 = "SELECT count(a.RECORD_N) as recordn  from tblrecords a

                left join tblrouting b on b.RECORD_N=a.RECORD_N

                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY

                where a.DATE like '%".$dates_to_look[$i]."%' and c.DIVISION_C=".$division." GROUP BY a.RECORD_N";

  /*get recieved and routed*/

  $sql2 = "SELECT count(a.RECORD_N) as daterouted  from tblrecords a

                left join tblrouting b on b.RECORD_N=a.RECORD_N

                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY

                where a.DATE like '%".$dates_to_look[$i]."%' and b.date_routed like '%".$dates_to_look[$i]."%' and c.DIVISION_C= ".$division." GROUP BY a.RECORD_N";

  /*get received and release within the same day */

  $sql3 = "SELECT *,count(a.RECORD_N) as recordn  from tblrecords a

                left join tblrouting b on b.RECORD_N=a.RECORD_N

                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N

                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY

                where b.RECEIVED_DETAILS like '%".$dates_to_look[$i]."%' and d.date_released like '%".$dates_to_look[$i]."%' and  d.RELEASED_FROM= ".$division."  GROUP BY a.RECORD_N";

  /*get all released records*/

  $sql4 = "SELECT *,count(a.RECORD_N) as recordn  from tblrecords a

                left join tblrouting b on b.RECORD_N=a.RECORD_N

                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N

                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY

                where d.DATE_RELEASED like '%".$dates_to_look[$i]."%' and d.RELEASED_FROM=".$division." GROUP by a.RECORD_N";

 /*get the filed records within 3 days*/

  $sql5 = "SELECT * from tblrecordforfiling a 

                left join tblrecords d on d.RECORD_N=a.RECORD_N

                left join tblemployeinfo b on b.EMP_N=d.ADDED_BY 

                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C

                where DATEDIFF(a.DATE_FILED,d.DATE) < 4 and  a.DATE_FILED like '%".$dates_to_look[$i]."%' and b.DIVISION_C=".$division." and a.STATUS=1";

  /*get the total for forfiling*/

  $sql6 = "SELECT * from tblrecordforfiling a 

                left join tblrecords d on d.RECORD_N=a.RECORD_N

                left join tblemployeinfo b on b.EMP_N=d.ADDED_BY 

                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C

                where d.category in(6,105,2,3,5,22,161,116,103,235) and  a.DATE_CREATED like '%".$dates_to_look[$i]."%' and b.DIVISION_C=".$division." ";



      $exploded = explode("-", $dates_to_look[$i]);

      $get_month[]= $str = ltrim($exploded[1],'0');

      $counted_received = count(getData($DBConn,$sql1));

      $counted_received_routed = count(getData($DBConn,$sql2));

      $outgoing_received_routeda[] = count(getData($DBConn,$sql3));

      $outgoing_receiveda[] = count(getData($DBConn,$sql4));

      $total_docu_fileda[]= count(getData($DBConn,$sql5));

      $total_docu_forfilinga[]= count(getData($DBConn,$sql6));

      $incoming_receiveda[]= $counted_received;

      $incoming_received_routeda[]= $counted_received_routed;

      $objectiveoneabaverage[] = round(($counted_received_routed/$counted_received) * 100);





}  

$new_array = array();



function convert_to_month($months_array,$content_array){

    $y=count($months_array);



    for ($i=0; $i < $y; $i++) { 

      

    }



    foreach ($months_array as $keyt => $valuet) {

      $content_array[$y]=$valuet;

    $y++;

    }



/*    foreach($other_array as $k => $v){

      foreach ($content_array as $keyf => $valuef) {

        if ($k==$valuef) {

          $other_array[$k]=$valuef;

        }

      }

        // $res[$k] = array_merge($other_array[$k],$content_array[$k]);

    }*/



    return $content_array; 



    }



$_array = array();



foreach ($get_month as $key => $value) {

    $new_array[$value]=$value;

}



$y=1;

foreach ($months_array as $keyt => $valuet) {

	$other_array[$y]=$valuet;

$y++;

}



foreach($other_array as $k => $v){

	foreach ($incoming_receiveda as $keyf => $valuef) {

		if ($k==$valuef) {

			$other_array[$k]=$valuef;

		}

	}

    // $res[$k] = array_merge($other_array[$k],$new_array[$k]);

}





/*
print_debug($dates_to_look);



print_debug($other_array);*/



$merged_date_with_value = [];



/*foreach ($dates_to_look as $keyr => $valuer) {

	foreach ($incoming_receiveda as $keys => $values) {

		if ($keyr==$keys) {

			$merged_date_with_value[$valuer]=$values;

		}

	}

}*/



function merge_date_with_valu($date_array,$needed_array){

foreach ($date_array as $keyr => $valuer) {

	foreach ($needed_array as $keys => $values) {

		if ($keyr==$keys) {

			$merged_date_with_value[$valuer]=$values;

		}

	}

}

return  $merged_date_with_value;



}


//merge otger array and specific array
$incoming_received_within_the_day =  array_replace_recursive($other_array, merge_date_with_valu($get_month,$incoming_receiveda));

$incoming_received_and_routed_within_the_day =  array_replace_recursive($other_array, merge_date_with_valu($get_month,$incoming_received_routeda));

$outgoing_received_within_the_day = array_replace_recursive($other_array, merge_date_with_valu($get_month,$outgoing_receiveda));

$outgoing_received_and_routed_within_the_day = array_replace_recursive($other_array, merge_date_with_valu($get_month,$outgoing_received_routeda));

$total_number_of_filed_documents = array_replace_recursive($other_array, merge_date_with_valu($get_month,$total_docu_fileda));

$total_number_of_forfiling_documents = array_replace_recursive($other_array, merge_date_with_valu($get_month,$total_docu_forfilinga));








/*


echo "Incoming Receive <br>";

print_debug($incoming_received_within_the_day);



echo "Incoming Receive Routed<br>";

print_debug($incoming_received_and_routed_within_the_day);*/







function put_to_template($array,$templatefield){
  foreach ($array as $keyu => $valueu) {
        $templateProcessor->setValue($templatefield.$keyu, $valueu);

}
}






$counted_val = count($dates_to_look);

//the first index will be assigned to $g

  # code...

/*foreach ($incoming_received_and_routed_within_the_day as $keyu => $valueu) {
        $templateProcessor->setValue('obja'.$keyu, $valueu);

}*/
$counted_dates = count($other_array);

$objctotal=[];
$objtwoctotal=[];
$objthreectotal=[];
$objfourctotal=[];

for ($h=1; $h <= $counted_dates; $h++) { 
  $objctotal[]= round(( $incoming_received_and_routed_within_the_day[$h]/$incoming_received_within_the_day[$h] ) * 100 );
  
  $objtwoctotal[]=  round(($outgoing_received_and_routed_within_the_day[$h]/$outgoing_received_within_the_day[$h]) * 100);

  $objthreectotal[]=  round(($total_number_of_filed_documents[$h]/$total_number_of_forfiling_documents[$h]) * 100);

        $templateProcessor->setValue('obja'.$h, $incoming_received_and_routed_within_the_day[$h]);
        $templateProcessor->setValue('objb'.$h, $incoming_received_within_the_day[$h]);
        $templateProcessor->setValue('objc'.$h, ( $incoming_received_and_routed_within_the_day[$h]/$incoming_received_within_the_day[$h] ) * 100 == 0 ? "" : round(( $incoming_received_and_routed_within_the_day[$h]/$incoming_received_within_the_day[$h] ) * 100 ));

        $templateProcessor->setValue('objtwoa'.$h, $outgoing_received_and_routed_within_the_day[$h]);
        $templateProcessor->setValue('objtwob'.$h, $outgoing_received_within_the_day[$h]);
        $templateProcessor->setValue('objtwoc'.$h, ($outgoing_received_and_routed_within_the_day[$h]/$outgoing_received_within_the_day[$h]) * 100 == 0 ? "" : round(($outgoing_received_and_routed_within_the_day[$h]/$outgoing_received_within_the_day[$h]) * 100));

        $templateProcessor->setValue('objthreea'.$h, $total_number_of_filed_documents[$h]);
        $templateProcessor->setValue('objthreeb'.$h, $total_number_of_forfiling_documents[$h]);
        $templateProcessor->setValue('objthreec'.$h, ($total_number_of_filed_documents[$h]/$total_number_of_forfiling_documents[$h]) * 100 == 0 ? "" : round(($total_number_of_filed_documents[$h]/$total_number_of_forfiling_documents[$h]) * 100));

        $templateProcessor->setValue('objfoura'.$h,"");
        $templateProcessor->setValue('objfourb'.$h,"");
        $templateProcessor->setValue('objfourc'.$h, "");

}

    $templateProcessor->setValue('objatotal',array_sum($incoming_received_and_routed_within_the_day));
    $templateProcessor->setValue('objbtotal',array_sum($incoming_received_within_the_day));
    $templateProcessor->setValue('objctotal',array_sum($objctotal));

    $templateProcessor->setValue('objtwoatotal',array_sum($outgoing_received_and_routed_within_the_day));
    $templateProcessor->setValue('objtwobtotal',array_sum($outgoing_received_within_the_day));
    $templateProcessor->setValue('objtwoctotal',array_sum($objtwoctotal));

    $templateProcessor->setValue('objthreeatotal',array_sum($total_number_of_filed_documents));
    $templateProcessor->setValue('objthreebtotal',array_sum($total_number_of_forfiling_documents));
    $templateProcessor->setValue('objthreectotal',array_sum($objthreectotal));

    $templateProcessor->setValue('objfouratotal',"");
    $templateProcessor->setValue('objfourbtotal',"");
    $templateProcessor->setValue('objfourctotal',"");
/*
$counted_val = count($dates_to_look);

//the first index will be assigned to $g
for ($g=$incoming_received_within_the_day[0]; $g < $counted_val; $g++) { 
      $templateProcessor->setValue('obja'.$g,"");

}


    $templateProcessor->setValue('objajan',"");

    $templateProcessor->setValue('objbjan',"");

    $templateProcessor->setValue('objajan',"");





    $templateProcessor->setValue('rowrdate#'.$g, $datearray[$h] );

    $templateProcessor->setValue('rowrtime#'.$g, date("h:i a", strtotime($get_all_the_sub_arrays_of_parent[$h]['time'])));

    $templateProcessor->setValue('rowfdate#'.$g, $get_all_the_sub_arrays_of_parent[$h]['DATE_FILED']);

    $templateProcessor->setValue('rowftime#'.$g, empty($get_all_the_sub_arrays_of_parent[$h]['TIME_FILED']) ?  "" : date("h:i a", strtotime($get_all_the_sub_arrays_of_parent[$h]['TIME_FILED'])));

    $templateProcessor->setValue('rowrseries#'.$g, $get_all_the_sub_arrays_of_parent[$h]['CATEGORY_M']);

    $templateProcessor->setValue('rowrcode#'.$g, $get_all_the_sub_arrays_of_parent[$h]['RECORD_CODE']);

    $templateProcessor->setValue('rowsubject#'.$g, $get_all_the_sub_arrays_of_parent[$h]['record_series']);

    $templateProcessor->setValue('rowlocation#'.$g,  $get_all_the_sub_arrays_of_parent[$h]['LOCATION']);

    $templateProcessor->setValue('rowfsfolder#'.$g, $get_all_the_sub_arrays_of_parent[$h]['FSFOLDER']);

    $templateProcessor->setValue('rowfsscheme#'.$g, $get_all_the_sub_arrays_of_parent[$h]['FSSCHEME']);

    $templateProcessor->setValue('rowrpactive#'.$g, $get_all_the_sub_arrays_of_parent[$h]['RPACTIVE']);

    $templateProcessor->setValue('rowrpstorage#'.$g, $get_all_the_sub_arrays_of_parent[$h]['RPSTORAGE']);

    $templateProcessor->setValue('rowrptotal#'.$g, $get_all_the_sub_arrays_of_parent[$h]['RPTOTAL']);



*/

        $sql3 = "SELECT *  FROM tblpersonneldivision where DIVISION_N =".$division." ";

        $get_division = getData($DBConn,$sql3)[0]['DIVISION_LONG_M'];
        
        



$templateProcessor->setValue('rowmonthof', $monthName.' '.$exploded[0]);

$templateProcessor->setValue('rowoffice', $get_division);











// $templateProcessor->setValue('rowdateexported', date("F j, Y", strtotime($date)) );






if ($_SESSION['datas']['decider']=="qme") {

//echo date('H:i:s'), ' Saving the result document...', EOL;

$templateProcessor->saveAs('results/QME-INCOMING-OUTGOING-COMMUNICATIONS.docx');



}

else

{

//  echo date('H:i:s'), ' Saving the result document...', EOL;

$templateProcessor->saveAs('results/OUTGOING-COMMUNICATIONS.docx');

}

//echo getEndingNotes(array('Word2007' => 'docx'), 'results/Sample_07_TemplateCloneRow.docx');

?>

<?php



if (!CLI) {

    include_once 'Sample_Footer.php';

}



?>

