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



function getDivisionCode($id){
  $query = "select DIVISION_C from tblemployee where md5(EMP_N)='".md5($id)."'";
 // echo $query;
  $queryinfo = select_info_multiple_key($query);
  if($queryinfo){
    return $queryinfo[0]['DIVISION_C'];

  }

}

$division = $_SESSION['datas']['division'];

$date = $_SESSION['datas']['date'];
$byme = $_SESSION['datas']['by_me'];

$date_month =  date('Y-m-d', strtotime($_SESSION['datas']['date']));
$date_array = explode('-', $date_month);



// print_debug($query_data);

$list=array();


for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $date_array[1], $d, $date_array[0]);          
    if (date('m', $time)==$date_array[1])       
        $list[]=date('m-d', $time);
}

$count = count($list);
// Template processor instance creation
echo date('H:i:s'), ' Creating new TemplateProcessor instance...', EOL;

if ($_SESSION['datas']['decider']=="fml") {
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/fml_final.docx');
}




        $get_started = $date_month;
        $get_ended = $date_month;
        $get_started_routed = $date_month;
        $get_ended_routed = $date_month;

        // $this->printr($records);
        $baseRow = 13;
        $numItems = count($data) + 12;
        // $i = 0;

           $summary = array();

           $exploded = explode('-', $get_started);
           $explodedb = explode('-', $get_ended);
           $explodedrouted = explode('-', $get_started_routed);
           $explodedbrouted = explode('-', $get_ended_routed);

          if (strlen($get_started)) {
            
          
          $monthNum  = $exploded[1];
                    $monthNumb  = $explodedb[1];
                    $date_month = $get_started;
                    $data_end = $get_ended;
                    }
         else if(strlen($get_started) && strlen($get_started_routed)){
                  $monthNum  = $exploded[1];
                    $monthNumb  = $explodedb[1];
                    $date_month = $get_started;
                    $data_end = $get_ended;
                    }

        else if(strlen($get_started_routed)){
                     $monthNum  = $explodedrouted[1];
                    $monthNumb  = $explodedbrouted[1];
                    $date_month = $get_started_routed;
                    $data_end = $get_ended_routed;
                    }


          if (strlen($_GET['lrt'])) {
            $division = $_GET['lrt'];
            }

          else if (strlen($_GET['lrf'])) {
            $division = $_GET['lrf'];
          }

         else if (strlen($_GET['lrt']) && strlen($_GET['lrf']) || !strlen($_GET['lrt']) && !strlen($_GET['lrf'])) {
            $division = $_SESSION['datas']['division'];
          }



$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$dateObjb   = DateTime::createFromFormat('!m', $monthNumb);

$monthName = $dateObj->format('F'); // March
$monthNameb = $dateObjb->format('F'); // March
// Variables on different parts of document
/*$templateProcessor->setValue('weekday', date('l'));            // On section/content
$templateProcessor->setValue('time', date('H:i'));             // On footer
$templateProcessor->setValue('serverName', realpath(__DIR__)); // On header*/



 $sql2 = "SELECT accesstype FROM tblemployee where EMP_N='".$dataRow['ADDED_BY']."'";



// print_debug($list);


 
$if_not_empty_value = array();
$monthdate = array();
$incoming_receiveda= array();
$incominga = array();
$outgoing_receiveda = array();
$outgoinga = array();
$total_docu_fileda = array();
$objectiveone_percenta = array();
$objectiveone_percent_meta = array();
$objectivetwo_percenta = array();
$objectivethree_percenta = array();
$objectivetwo_percent_meta = array();
$objectivethree_percent_meta = array();
$objectiveone_percent_unmeta = array();
$objectivethree_percent_unmeta = array();
$objectivetwo_percent_unmeta = array();

$explain_sql5_arr= array();
$explain_sql6_arr= array();
$explain_sql7_arr= array();
$explain_sql8_arr= array();
$explain_sql9_arr= array();



$i=1;
foreach ($list as $key => $value) {

              //get the categories that match the existing file records
             /*6 = Regional Office
               105 = Regional Memorandum
               2 = DILG Department Order
               3 = DILG Memorandum Circular
               5 = Regional Memorandum Circular
               22 = Legal
               161 = Presidentail Directives
               116 = dilg joint morandum circular
               119 = dilg-office circular
               103 = dilg-circular
               235 = republic act
              */
            if ($_SESSION['inet_credentials']['division']==16) {
              # code...
            
             $explain_sql9 = "SELECT f.folder,d.date,d.time,d.record_n,d.subject as record_series,a.DATE_FILED,a.TIME_FILED,e.CATEGORY_M,a.RECORD_CODE,a.LOCATION,a.FSFOLDER,a.FSSCHEME,a.RPACTIVE,a.RPSTORAGE,a.RPTOTAL from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployee b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                left join tblrecordcategory e on e.CATEGORY_N=d.CATEGORY
                left join tblfilingschemefolder f on f.id=a.FSFOLDER
                where d.category in(6,105,2,3,5,22,161,116,103,235,237) and  a.DATE_CREATED like '%".$value."%' and b.DIVISION_C=".$division." and a.STATUS=1 ";
            $filed_records= array(6,105,2,3,5,22,161,116,103,235,237);
          
          $sql9 = "SELECT * from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployee b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                left join tblrecordcategory e on e.CATEGORY_N=d.CATEGORY
                left join tblfilingschemefolder f on f.id=a.FSFOLDER
                where d.category in(6,105,2,3,5,22,161,116,103,235,237) and  a.DATE_CREATED like '%".$value."%' and b.DIVISION_C=".$division." and a.STATUS=1 ";
          }
          else{
            
             $explain_sql9 = "SELECT  f.folder,d.date,d.time,d.record_n,d.subject as record_series,a.DATE_FILED,a.TIME_FILED,e.CATEGORY_M,a.RECORD_CODE,a.LOCATION,a.FSFOLDER,a.FSSCHEME,a.RPACTIVE,a.RPSTORAGE,a.RPTOTAL from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployee b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                left join tblrecordcategory e on e.CATEGORY_N=d.CATEGORY
                left join tblfilingschemefolder f on f.id=a.FSFOLDER
                where d.category=156 and  a.DATE_CREATED like '%".$value."%' and b.DIVISION_C=".$division." and a.STATUS=1 ";
          $sql9 = "SELECT * from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployee b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                left join tblrecordcategory e on e.CATEGORY_N=d.CATEGORY
                left join tblfilingschemefolder f on f.id=a.FSFOLDER
                where d.category=156 and  a.DATE_CREATED like '%".$value."%' and b.DIVISION_C=".$division." and a.STATUS=1 ";
          }
          
        
          
      $expsql5 =  getData($DBConn,$explain_sql9);

    


      

     if (!empty($expsql5)) {
      //rownumber-month-date

      $explain_sql5_arr[]=$expsql5;
      $monthdate[]=$value;


      }


 



 



$i++;
}





//substiture parent key by another array
$get_explain_sql5_arr= array();
$get_the_values_of_each_date= array();
$datearray = array();
foreach( $explain_sql5_arr as $origKey => $valuey ){
  $get_explain_sql5_arr[$monthdate[$origKey]] = $valuey;
}

$p=1;
foreach ($explain_sql5_arr as $keyio => $valueio) {
  // $get_the_values_of_each_date[$monthdate[$keyio]]= $valueio;
  $get_the_values_of_each_date[$monthdate[$keyio]]= count($valueio);
$p++;
}

$filteredArray = array_reduce($get_explain_sql5_arr, 'array_merge', []);
$get_all_the_sub_arrays_of_parent = call_user_func_array('array_merge', $get_explain_sql5_arr);




/*print_debug($monthdate);
print_debug($incoming_receiveda);
print_debug($objectiveone_percent_unmeta);

print_debug($explain_sql5_arr);*/

//merge all values of multidimentional array
foreach ($get_all_the_sub_arrays_of_parent as $valuer) {
  $explain_sql6_arr[]=$valuer;
}


/*get the dates iterrated by their value*/
foreach ($get_the_values_of_each_date as $keyoo => $valueoo) {
    for ($o=1; $o <= $valueoo ; $o++) { 
      $datearray[]=$keyoo;
    }
}


$dateformat = change_connector($datearray,"-");
$dateformatf = change_connector_two_tier($get_all_the_sub_arrays_of_parent,"-");



$counted_val = count($datearray);
$templateProcessor->cloneRow('rowValue', $counted_val);
$g=1;
for ($h=0; $h <= $counted_val; $h++) { 
    $date1 = new DateTime($get_all_the_sub_arrays_of_parent[$h]['date']);
    $date2 = new DateTime($get_all_the_sub_arrays_of_parent[$h]['DATE_FILED']);
    $interval = $date1->diff($date2);

    $rpactive = ucfirst(strtolower($get_all_the_sub_arrays_of_parent[$h]['RPACTIVE']));
    $rpstorage = ucfirst(strtolower($get_all_the_sub_arrays_of_parent[$h]['RPSTORAGE']));
    $rptotal = ucfirst(strtolower($get_all_the_sub_arrays_of_parent[$h]['RPTOTAL']));


    
    $templateProcessor->setValue('rowValue#'.$g, $g);
    $templateProcessor->setValue('rowrdate#'.$g, $dateformat[$h] );
    $templateProcessor->setValue('rowrtime#'.$g, date("h:i a", strtotime($get_all_the_sub_arrays_of_parent[$h]['time'])));
    $templateProcessor->setValue('rowfdate#'.$g, $dateformatf[$h]);
    $templateProcessor->setValue('rowftime#'.$g, empty($get_all_the_sub_arrays_of_parent[$h]['TIME_FILED']) ?  "" : date("h:i a", strtotime($get_all_the_sub_arrays_of_parent[$h]['TIME_FILED'])));
    $templateProcessor->setValue('rowrseries#'.$g, $get_all_the_sub_arrays_of_parent[$h]['CATEGORY_M']);
    $templateProcessor->setValue('rowrcode#'.$g, $get_all_the_sub_arrays_of_parent[$h]['RECORD_CODE']);
    $templateProcessor->setValue('rowsubject#'.$g, $get_all_the_sub_arrays_of_parent[$h]['record_series']);
    $templateProcessor->setValue('rowlocation#'.$g,  $get_all_the_sub_arrays_of_parent[$h]['LOCATION']);
    $templateProcessor->setValue('rowfsfolder#'.$g, $get_all_the_sub_arrays_of_parent[$h]['folder']);
    $templateProcessor->setValue('rowfsscheme#'.$g, $get_all_the_sub_arrays_of_parent[$h]['FSSCHEME']);
    $templateProcessor->setValue('rowrpactive#'.$g, $rpactive);
    $templateProcessor->setValue('rowrpstorage#'.$g, ucfirst($rpstorage));
    $templateProcessor->setValue('rowrptotal#'.$g, $rptotal);
    $templateProcessor->setValue('rowprocesseddays#'.$g, $date1==$date2 ? "1" : $interval->d);


  $g++; 
}

        $sql3 = "SELECT *  FROM tblpersonneldivision where DIVISION_N =".$division." ";
        $get_division = getData($DBConn,$sql3)[0]['DIVISION_LONG_M'];

$templateProcessor->setValue('rowmonthof', $monthName.' '.$exploded[0]);
$templateProcessor->setValue('rowoffice', $get_division);


/*

print_debug($monthName.' '.$exploded[0]);
print_debug(getData($DBConn,$sql3));
*/





// $templateProcessor->setValue('rowdateexported', date("F j, Y", strtotime($date)) );



if ($_SESSION['datas']['decider']=="fml") {
//echo date('H:i:s'), ' Saving the result document...', EOL;
$templateProcessor->saveAs('results/FML-INCOMING-OUTGOING-COMMUNICATIONS.docx');

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
