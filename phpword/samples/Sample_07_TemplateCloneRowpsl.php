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
  $query = "select DIVISION_C from tblemployeinfo where md5(EMP_N)='".md5($id)."'";
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
        $list[]=date('Y-m-d', $time);
}

$count = count($list);
// Template processor instance creation
echo date('H:i:s'), ' Creating new TemplateProcessor instance...', EOL;

if ($_SESSION['datas']['decider']=="psl") {
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/pslrrm_final.docx');
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



 $sql2 = "SELECT accesstype FROM tblemployeinfo where EMP_N='".$dataRow['ADDED_BY']."'";



// print_debug($list);


 
$if_not_empty_value = array();
$monthdate = array();
$incoming_receiveda= array();
$incominga = array();
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

$explain_sql5_arr= array();
$explain_sql6_arr= array();
$explain_sql7_arr= array();
$explain_sql8_arr= array();
$explain_sql9_arr= array();

function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
} 

$i=1;
foreach ($list as $key => $value) {
            $sql2 = "SELECT accsstype FROM tblemployeinfo where EMP_N='".$key['ADDED_BY']."'";

            $sql4 = "SELECT UNAME from tblemployeinfo where EMP_N=".$key['RECEIVED']."";
            $explain_sql5 = "SELECT a.record_n,a.subject from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where a.category!=53 and a.DATE like '%".$value."%' and TIMESTAMPDIFF(HOUR, a.TIME, b.TIME_ROUTED) < 25 and c.DIVISION_C=".$division." GROUP BY a.RECORD_N ";

            //get incoming and routed within the day
         /*   $sql5 = "SELECT count(a.RECORD_N) as daterouted  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where a.category!=53 and a.DATE like '%".$value."%' and b.date_routed like '%".$value."%' and c.DIVISION_C= ".$division." GROUP BY a.RECORD_N ";*/
            $sql5 = "SELECT count(a.RECORD_N) as daterouted  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where a.category!=53 and a.DATE like '%".$value."%' and TIMESTAMPDIFF(HOUR, a.TIME, b.TIME_ROUTED) < 25 and c.DIVISION_C=".$division." GROUP BY a.RECORD_N ";
            //get incoming for the day
            $explain_sql6 = "SELECT a.record_n,a.subject,count(a.RECORD_N) as recordn  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where a.category!=53 and  a.DATE like '%".$value."%' and c.DIVISION_C= ".$division." GROUP BY a.RECORD_N";
            $sql6 = "SELECT count(a.RECORD_N) as recordn  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where a.category!=53 and a.DATE like '%".$value."%' and c.DIVISION_C= ".$division." GROUP BY a.RECORD_N";
          $explain_sql7 = "SELECT a.RECORD_N,a.subject,count(a.RECORD_N) as recordn  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where b.RECEIVED_DETAILS like '%".$value."%' and d.date_released like '%".$value."%' and  d.RELEASED_FROM= ".$division."  GROUP BY a.RECORD_N";    
            //get outgoing received and released within the day
         /*   $sql7 = "SELECT *,count(a.RECORD_N) as recordn  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where b.RECEIVED_DETAILS like '%".$value."%' and d.date_released like '%".$value."%' and  d.RELEASED_FROM= ".$division."  GROUP BY a.RECORD_N";*/
            $sql7 = "SELECT *,count(a.RECORD_N) as recordn  from tblrecords a
                left join (select * from tblrouting where date_routed like '%".$value."%' ) b on b.RECORD_N=a.RECORD_N
                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N
               /*left join tblemployeinfo c on c.EMP_N=a.ADDED_BY */
                where /* b.RECEIVED_DETAILS like '%11-12%' and */ d.date_released like '%".$value."%' and  d.RELEASED_FROM=".$division."  GROUP BY a.RECORD_N";
            $explain_sql8 = "SELECT a.RECORD_N,a.subject,count(a.RECORD_N) as recordn  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where d.DATE_RELEASED like '%".$value."%' and d.RELEASED_FROM=".$division." GROUP by a.RECORD_N";
               //get outgoing released within the day
            $sql8 = "SELECT *,count(a.RECORD_N) as recordn  from tblrecords a
                left join tblrouting b on b.RECORD_N=a.RECORD_N
                left join tblrecordrelease d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo c on c.EMP_N=a.ADDED_BY
                where d.DATE_RELEASED like '%".$value."%' and d.RELEASED_FROM=".$division." GROUP by a.RECORD_N";
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
          /*get the filed records within 3 days*/
       /*      $explain_sql9 = "SELECT a.time,a.record_n,a.subject from tblrecords a 
          left join tblemployeinfo b on b.EMP_N=a.ADDED_BY 
          left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
          where category in(6,105,2,3,5,22,161,116,103,235) and DATE like '%".$value."%' and b.DIVISION_C=".$division." ";*/
            $filed_records= array(6,105,2,3,5,22,161,116,103,235,237);
/*            $sql9 = "SELECT * from tblrecords a 
          left join tblemployeinfo b on b.EMP_N=a.ADDED_BY 
          left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
          where category in(6,105,2,3,5,22,161,116,103,235) and DATE like '%".$value."%' and b.DIVISION_C=".$division." ";*/

            $explain_sql9 = "SELECT d.time,d.record_n,d.subject from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                where DATEDIFF(a.DATE_FILED,d.DATE) < 4 and  a.DATE_FILED like '%".$value."%' and b.DIVISION_C=".$division." and a.STATUS=1";
  /*field within 3 days*/
  $sql9 = "SELECT * from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                where DATEDIFF(a.DATE_FILED,d.DATE) < 4 and d.category in(6,105,2,3,5,22,161,116,103,235,237) and a.DATE_CREATED like '%".$value."%' and b.DIVISION_C=".$division." and a.STATUS=1";
  /*get the total for forfiling*/ 
  $sql10 = "SELECT * from tblrecordforfiling a 
                left join tblrecords d on d.RECORD_N=a.RECORD_N
                left join tblemployeinfo b on b.EMP_N=d.ADDED_BY 
                left join tblpersonneldivision c on c.DIVISION_N=b.DIVISION_C
                where d.category in(6,105,2,3,5,22,161,116,103,235,237) and  a.DATE_CREATED like '%".$value."%' and b.DIVISION_C=".$division." ";
        
          
          $expsql5 =  getData($DBConn,$explain_sql9);

          $get_receiver = getData($DBConn,$sql4)[0]['UNAME'];
          $remove_year = array_shift($compared);

          $incoming_received =  count(getData($DBConn,$sql5));
          $incoming =  count(getData($DBConn,$sql6));
          $total_docu_filed = count(getData($DBConn,$sql9));
          $total_docu_forfiling = count(getData($DBConn,$sql10));

          $outgoing = count(getData($DBConn,$sql7));
          $outgoing_received = count(getData($DBConn,$sql8));

          $total_docu_forfiling_converted = $total_docu_forfiling==0 ? '-' : ""; 
          $total_docu_filed_converted = $total_docu_filed==0 ? '-' : "";

          $objectiveone_percent_computation = ($incoming_received/$incoming) * 100;
          $objectiveone_percent = $objectiveone_percent_computation == 0 ? "-" : $objectiveone_percent_computation;
          $objectiveone_percent_met = round($objectiveone_percent) >= 80 && $incoming==$incoming_received ?  "1" : "";
          $objectiveone_percent_unmet = round($objectiveone_percent) < 81  && $incoming!==$incoming_received ? "1" : "" ;

          $objectivetwo_percent_computation = ($outgoing/$outgoing_received) * 100;
          $objectivetwo_percent = $objectivetwo_percent_computation == 0 ? "-" : $objectivetwo_percent_computation;
          $objectivetwo_percent_met = $objectivetwo_percent >= 80 && $outgoing==$outgoing_received ? "1" : "";
          $objectivetwo_percent_unmet = $objectivetwo_percent < 81 && $outgoing!==$outgoing_received ?  "1" : "" ;

          $objectivethree_percent_computation = ($total_docu_filed/$total_docu_forfiling) * 100;
          $objectivethree_percent = $objectivethree_percent_computation == 0 && $total_docu_forfiling==0 ? "-" : $objectivethree_percent_computation;
          $objectivethree_percent_met = $objectivethree_percent >= 80 && $total_docu_forfiling==$total_docu_filed? "1" : $total_docu_filed_converted; 
          $objectivethree_percent_unmet = $objectivethree_percent < 81 && $total_docu_forfiling !== $total_docu_filed ? "1" : "";

         /* $objectiveone_percent_computation = ($incoming_received/$incoming) * 100;
          $objectiveone_percent = $objectiveone_percent_computation == 0 ? "-" : $objectiveone_percent_computation;
          $objectiveone_percent_met = $objectiveone_percent >= 80 ? "1" : "";
          $objectiveone_percent_unmet = round($objectiveone_percent) < 80 ? "1" : "" ;

          $objectivetwo_percent_computation = ($outgoing/$outgoing_received) * 100;
          $objectivetwo_percent = $objectivetwo_percent_computation == 0 ? "-" : $objectivetwo_percent_computation;
          $objectivetwo_percent_met = $objectivetwo_percent >= 80 ? "1" : "-";
          $objectivetwo_percent_unmet = $objectivetwo_percent < 80 ?  "1" : "" ;

          $objectivethree_percent_computation = ($total_docu_filed/$total_docu_forfiling) * 100;
          $objectivethree_percent = $objectivethree_percent_computation == 0 && $total_docu_forfiling==0 ? "-" : $objectivethree_percent_computation;
          $objectivethree_percent_met = $objectivethree_percent >= 80 && $objectivethree_percent !=0 ? "1" : $total_docu_filed_converted; 
          $objectivethree_percent_unmet = $objectivethree_percent < 81 && $objectivethree_percent != 0 ? "1" : $total_docu_forfiling_converted;
*/


      

     if (!empty($incoming_received) || !empty($incoming) || !empty($outgoing) || !empty($outgoing_received)) {
      //rownumber-month-date

      $explain_sql5_arr[]=$expsql5;


      $incominga[]=$incoming;
      $incoming_receiveda[]=$incoming_received;
      $outgoing_receiveda[]=$outgoing_received;
      $outgoinga[]=$outgoing;
      $total_docu_fileda[]=$total_docu_filed;
      $total_docu_forfilinga[]=$total_docu_forfiling;
      $objectiveone_percenta[]=$objectiveone_percent;

      $objectivetwo_percenta[]=$objectivetwo_percent;
      $objectivethree_percenta[]=$objectivethree_percent;
      $objectiveone_percent_meta[]=$objectiveone_percent_met;
      $objectivetwo_percent_meta[]=$objectivetwo_percent_met;
      $objectivethree_percent_meta[]=$objectivethree_percent_met;

      $objectiveone_percent_unmeta[]=$objectiveone_percent_unmet;
      $objectivetwo_percent_unmeta[]=$objectivetwo_percent_unmet;
      $objectivethree_percent_unmeta[]=$objectivethree_percent_unmet;

      $if_not_empty_value[]=$i;
      $monthdate[]=$value;


      }
 



 

 

$i++;
}



$date_reformat = change_connector($monthdate,"-");


 function giveChildToParentLevel($array)
    {

       $countOfArray = count($array);

       foreach($array as $key=>$value)
       {

           if(is_array($value))
           {

               $childitems = giveChildToParentLevel($value);

               if(count($childitems) > 0 )
               {
                   unset($array[$key]);
                   $o = 0;
                   foreach($childitems as $child)
                   {
                /*       if($i == 0)*/
                             $array[$key.$o] = $child;
           /*            else
                            $array[$key.$i] = $child;*/

                       $o++;
                   }
               }


           }


       }

        return $array;
    }


//substiture parent key by another array
$newArray= array();

foreach( $explain_sql5_arr as $origKey => $valuey ){
  $newArray[$monthdate[$origKey]] = $valuey;
}
$filteredArray = array_reduce($newArray, 'array_merge', []);
$oneDimensionalArray = call_user_func_array('array_merge', $explain_sql5_arr);

$array = $newArray;
    foreach($array as $key=>$value)
    {
        $array[$key] = giveChildToParentLevel($value);
    }

/*print_debug(count(array_filter($objectivetwo_percenta)));
    print_debug($objectivetwo_percent_unmeta);*/
/*    print_debug($array);


print_debug($filteredArray);*/

// print_debug($newArray);
/*print_debug($if_not_empty_value);
print_debug($monthdate);
print_debug($incoming_receiveda);
print_debug($objectiveone_percent_unmeta);

print_debug($explain_sql5_arr);*/

//merge all values of multidimentional array
foreach ($oneDimensionalArray as $valuer) {  
  $explain_sql6_arr[]=$valuer;
}

$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($explain_sql5_arr));
foreach($it as $v) {
  $explain_sql7_arr[]=$v;
}

function trim_array($Array)
{
    foreach ($Array as $value) {
        if(trim($value) === '-') {
            $index = array_search($value, $Array);
            unset($Array[$index]);
        }
    }
    return $Array;
}

// print_debug(trim_array($objectivetwo_percenta));

// print_debug(array_merge($explain_sql7_arr));

$percenttwo_ave_arr = array_filter($objectivetwo_percenta);

$sub_key    = array_keys($percenttwo_ave_arr);
$sub_values = array_values($percenttwo_ave_arr);

/*echo "incoming received routed within one day";
print_debug($incoming_receiveda);

print_debug($list);


echo "incoming files recieved";
print_debug($incominga);*/

/*print_debug($total_docu_fileda);
echo "Objective 2 Percent";
print_debug($objectivethree_percenta);

echo "Objective 2 met";
print_debug($objectivethree_percent_meta);

echo "Objective 2 unmet";
print_debug($objectivethree_percent_unmeta);

echo "total for filing";
print_debug(count(trim_array($total_docu_forfilinga)));*/



$metone = count($incoming_receiveda);
$mettwo = count($outgoinga);
$metthree = count($total_docu_fileda);

$percentone_ave = array_sum(trim_array($objectiveone_percenta))/count(trim_array($objectiveone_percenta));
$percenttwo_ave = array_sum(trim_array($objectivetwo_percenta))/count(trim_array($objectivetwo_percenta));
$percentthree_ave = array_sum(trim_array($objectivethree_percenta))/count(trim_array($objectivethree_percenta));

$counted_val = count($monthdate);
$templateProcessor->cloneRow('rowValue', $counted_val);
$g=1;
for ($h=0; $h <= $counted_val; $h++) { 
    $templateProcessor->setValue('rowValue#'.$g, $date_reformat[$h]);
    $templateProcessor->setValue('rowinreceived#'.$g, $incoming_receiveda[$h] == 0 && $incominga[$h] == 0 ? '-' : $incoming_receiveda[$h] ); 
    $templateProcessor->setValue('rowincoming#'.$g, $incominga[$h] == 0 ? '-' : $incominga[$h]);
    $templateProcessor->setValue('rowoutgoing#'.$g, $outgoinga[$h]== 0 && $outgoing_receiveda[$h]==0  ? '-' : $outgoinga[$h]);
    $templateProcessor->setValue('rowoutreceived#'.$g, $outgoing_receiveda[$h]==0 ? '-' : $outgoing_receiveda[$h]);
    $templateProcessor->setValue('rowdocufile#'.$g, $total_docu_fileda[$h] == 0 && $total_docu_forfilinga[$h]==0 ? '-' : $total_docu_fileda[$h]);
    $templateProcessor->setValue('rowdocureceived#'.$g, $total_docu_forfilinga[$h]== 0 ? '-' : $total_docu_forfilinga[$h]);
    $templateProcessor->setValue('rowtransaction#'.$g, "NO TRANSACTION");
    $templateProcessor->setValue('rowpercent#'.$g, $objectiveone_percenta[$h]==0 ? '-' : round($objectiveone_percenta[$h]));
    $templateProcessor->setValue('rowmet#'.$g, $objectiveone_percent_meta[$h]);
    $templateProcessor->setValue('rowunmet#'.$g, $objectiveone_percent_unmeta[$h] == 0 ? '' : 1);
    $templateProcessor->setValue('rowremarks#'.$g, "");
    $templateProcessor->setValue('rowpercenttwo#'.$g, round($objectivetwo_percenta[$h]) == 0 ? '-' : round($objectivetwo_percenta[$h]));
    $templateProcessor->setValue('rowmettwo#'.$g, $objectivetwo_percent_meta[$h]);
    $templateProcessor->setValue('rowunmettwo#'.$g,$objectivetwo_percent_unmeta[$h]);
    $templateProcessor->setValue('rowpercentthree#'.$g, $objectivethree_percenta[$h] != 0 ? round($objectivethree_percenta[$h]) : $objectivethree_percenta[$h] );
    $templateProcessor->setValue('rowmetthree#'.$g, $objectivethree_percent_meta[$h]);
    $templateProcessor->setValue('rowunmetthree#'.$g,$objectivethree_percent_unmeta[$h]);
    $templateProcessor->setValue('rowtrans#'.$g, "NO TRANSACTION");

  $g++; 
}

        $sql3 = "SELECT DIVISION_LONG_M FROM tblpersonneldivision where DIVISION_N =".$division." ";
        $get_division = getData($DBConn,$sql3)[0]['DIVISION_LONG_M'];

$templateProcessor->setValue('rowmonthof', $monthName.' '.$exploded[0]);
$templateProcessor->setValue('rowoffice', $get_division);

$templateProcessor->setValue('rowinreceivedsum', array_sum($incoming_receiveda));
$templateProcessor->setValue('rowincomingsum', array_sum($incominga));
$templateProcessor->setValue('rowoutgoingsum', array_sum($outgoinga));
$templateProcessor->setValue('rowoutreceivedsum', array_sum($outgoing_receiveda));
$templateProcessor->setValue('rowdocufilesum', array_sum($total_docu_fileda));
$templateProcessor->setValue('rowdocureceivedsum', array_sum($total_docu_forfilinga));
$templateProcessor->setValue('rowtransactionsum', "NO TRANSACTION");

$templateProcessor->setValue('rowpercentsum', round($percentone_ave));
$templateProcessor->setValue('rowmetsum', array_sum($objectiveone_percent_meta));
$templateProcessor->setValue('rowunmetsum', array_sum($objectiveone_percent_unmeta) == 0 ? "" : array_sum($objectiveone_percent_unmeta) );
$templateProcessor->setValue('rowpercenttwosum', round($percenttwo_ave));
$templateProcessor->setValue('rowmettwosum',  array_sum($objectivetwo_percent_meta));
$templateProcessor->setValue('rowunmettwosum', array_sum($objectivetwo_percent_unmeta) == 0 ? "" : array_sum($objectivetwo_percent_unmeta));
$templateProcessor->setValue('rowpercentthreesum', round($percentthree_ave));
$templateProcessor->setValue('rowmetthreesum', array_sum($objectivethree_percent_meta));
$templateProcessor->setValue('rowunmetthreesum', array_sum($objectivethree_percent_unmeta) == 0 ? "" : array_sum($objectivethree_percent_unmeta) );
$templateProcessor->setValue('rowtransum', "NO TRANSACTION");
 











// $templateProcessor->setValue('rowdateexported', date("F j, Y", strtotime($date)) );



if ($_SESSION['datas']['decider']=="psl") {
//echo date('H:i:s'), ' Saving the result document...', EOL;
$templateProcessor->saveAs('results/PSL-INCOMING-OUTGOING-COMMUNICATIONS.docx');

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
