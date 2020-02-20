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


if (!empty($byme)) {
  $sql = "SELECT *,a.record_N as arecord FROM `tblrecords` a 
left join tblrouting b  on a.RECORD_N=b.RECORD_N 
  left join tblrecordsources as e on e.SOURCE_N = a.SOURCE 
left JOIN tblemployee c on a.added_by=c.EMP_N
left join tblpersonneldivision d on b.ROUTED_TO=d.DIVISION_N
where a.category!=53 and DATE = '".$date."' and a.ADDED_BY = ".$byme." and c.DIVISION_C = ".$division." ";
}
else{
$sql = "SELECT *,a.record_N as arecord  FROM `tblrecords` a 
left join tblrouting b  on a.RECORD_N=b.RECORD_N 
left JOIN tblemployee c on a.added_by=c.EMP_N
left join tblpersonneldivision d on b.ROUTED_TO=d.DIVISION_N
  left join tblrecordsources as e on e.SOURCE_N = a.SOURCE 
where a.category!=53 and DATE = '".$date."' and c.DIVISION_C = ".$division." ";
}

$sql.= " GROUP BY arecord";

$query="SELECT * FROM tblrecords LIMIT 50";
$query_data  = getDAta($DBConn,$sql);
// print_debug($query_data);

$count = count($query_data);
// Template processor instance creation
// echo date('H:i:s'), ' Creating new TemplateProcessor instance...', EOL;
if ($_SESSION['datas']['decider']=="incoming") {
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/incoming_iso_template.docx');
}
else{
$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/Sample_07_TemplateCloneRow.docx');
}

        $get_started = $date;
        $get_ended = $date;
        $get_started_routed = $date;
        $get_ended_routed = $date;

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
                    $date = $get_started;
                    $data_end = $get_ended;
                    }
         else if(strlen($get_started) && strlen($get_started_routed)){
                  $monthNum  = $exploded[1];
                    $monthNumb  = $explodedb[1];
                    $date = $get_started;
                    $data_end = $get_ended;
                    }

        else if(strlen($get_started_routed)){
                     $monthNum  = $explodedrouted[1];
                    $monthNumb  = $explodedbrouted[1];
                    $date = $get_started_routed;
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

$templateProcessor->cloneRow('rowValue', $count);

 $sql2 = "SELECT accesstype FROM tblemployee where EMP_N='".$dataRow['ADDED_BY']."'";
    

$i=1;
foreach ($query_data as $key) {
            $sql2 = "SELECT accesstype FROM tblemployee where EMP_N='".$key['ADDED_BY']."'";

            $sql4 = "SELECT UNAME from tblemployee where EMP_N=".$key['RECEIVED']."";
        
          $get_receiver = getData($DBConn,$sql4)[0]['UNAME'];
          $remove_year = array_shift($compared);
      

          $compare = getData($DBConn,$sql2)[0]['accesstype']=='admin' ? $key['date_received'] : $key['DATE'];


      $compared = explode('-', $key['DATE']);
          $remove_year = array_shift($compared);
     $compared_final = implode('/', $compared);
       $data_routed = explode('-',$key['DATE_ROUTED']);
     $routed_year_removed = array_shift($data_routed);

          $date_routed_final=implode('/', $data_routed);
          $date1 = new DateTime($key['DATE']);
         $date2 = new DateTime($dataRow['DATE_ROUTED']);
         $interval = $date1->diff($date2);

$time1= $key['TIME'];
$time2=$key['TIME_ROUTED'];
$hourdiff = round((strtotime($time1) - strtotime($time2))/3600, 1);

    $templateProcessor->setValue('rowNumber#'.$i, $i);
    $templateProcessor->setValue('rowrecord#'.$i, $key['arecord']);
    $templateProcessor->setValue('rowValue#'.$i, $key['SUBJECT']);
    $templateProcessor->setValue('rowsource#'.$i, $key['SOURCE_M']);
    $templateProcessor->setValue('rowmode#'.$i, $key['RECEIVE_MODE']);
    $templateProcessor->setValue('rowdater#'.$i, $compared_final);
    $templateProcessor->setValue('rowtimer#'.$i, date("h:i a", strtotime($key['TIME'])));
    $templateProcessor->setValue('rowdatero#'.$i, $date_routed_final);
    $templateProcessor->setValue('rowtimero#'.$i, empty($key['TIME_ROUTED']) ? '' : date("h:i a", strtotime($key['TIME_ROUTED'])) );
    $templateProcessor->setValue('rowtoro#'.$i, $key['DIVISION_M']);
    $templateProcessor->setValue('rowreceiveby#'.$i, $get_receiver);
    $templateProcessor->setValue('rowpday#'.$i, $compare == $key['DATE_ROUTED'] || $hourdiff < 25 ? '1' : $interval->d );
    // $templateProcessor->setValue('rowmonthof#'.$i, $monthName.' '.$exploded[0]);
    $templateProcessor->setValue('rowremark#'.$i, $key['SUMMARY']);




// print_debug($interval);


$i++;
}
        $sql3 = "SELECT DIVISION_LONG_M FROM tblpersonneldivision where DIVISION_N =".$division." ";
        $get_division = getData($DBConn,$sql3)[0]['DIVISION_LONG_M'];

$templateProcessor->setValue('rowmonthof', $monthName.' '.$exploded[0]);
$templateProcessor->setValue('rowoffice', $get_division);
$templateProcessor->setValue('rowdateexported', date("F j, Y", strtotime($date)) );



if ($_SESSION['datas']['decider']=="incoming") {
//echo date('H:i:s'), ' Saving the result document...', EOL;
$templateProcessor->saveAs('results/INCOMING-COMMUNICATIONS.docx');

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
