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
  $query = "select DIVISION_C from tblemployeeinfo where md5(EMP_N)='".md5($id)."'";
 // echo $query;
  $queryinfo = select_info_multiple_key($query);
  if($queryinfo){
    return $queryinfo[0]['DIVISION_C'];

  }

}

$division = $_SESSION['datas']['division'];
$date = $_SESSION['datas']['date'];
$byme = $_SESSION['datas']['by_me'];

if ($division!=16) {

if (!empty($byme)) {

/*$sql="SELECT b.REMARKS,a.TYPE,a.DATE,a.SUBJECT AS SUBJECT,g.SOURCE_M as external,f.SOURCE_M as SOURCE_M,d.DIVISION_M as internal,a.RECEIVE_MODE as RECEIVE_MODE,a.date_received AS date_received,a.TIME as TIME,b.DATE_RELEASED as DATE_RELEASED,b.TIME_RELEASED as TIME_RELEASED,b.RELEASED_TO ,a.record_n as arecord from tblrecords a
left join  tblrecordrelease b on b.RECORD_N=a.RECORD_N
left join  tblemployeeinfo c on c.EMP_N=b.SENDER_M
left join  tblrecordsources f on f.SOURCE_N=a.SOURCE
left join tblrecordsources g on g.SOURCE_N=b.RELEASED_TO
left join  tblpersonneldivision d on d.DIVISION_N=b.RELEASED_TO
WHERE b.DATE_RELEASED = '".$date."' and b.RELEASED_FROM = ".$division." and b.SENDER_M=".$byme."";*/

$sql="SELECT b.REMARKS,a.TYPE,a.DATE,a.SUBJECT AS SUBJECT,g.SOURCE_M as external,f.SOURCE_M as SOURCE_M,d.DIVISION_M as internal,a.RECEIVE_MODE as RECEIVE_MODE,a.date_received AS date_received,a.TIME as TIME,b.DATE_RELEASED as DATE_RELEASED,b.TIME_RELEASED as TIME_RELEASED,b.RELEASED_TO ,a.record_n as arecord from tblrecords a
left join  tblrecordrelease b on b.RECORD_N=a.RECORD_N
left join  tblemployeeinfo c on c.EMP_N=b.SENDER_M
left join tblrouting h on h.record_n=a.RECORD_N
left join  tblrecordsources f on f.SOURCE_N=a.SOURCE
left join tblrecordsources g on g.SOURCE_N=b.RELEASED_TO
left join  tblpersonneldivision d on d.DIVISION_N=b.RELEASED_TO
WHERE ( b.DATE_RELEASED = '".$date."' and b.RELEASED_FROM = ".$division." and b.SENDER_M=".$byme." ) or ( h.DATE_ROUTED='".$date."' and h.routed_from=".$division."  and h.ROUTED_TO >= 1 and h.ROUTED_TO <= 18 or h.DATE_ROUTED='".$date."' and h.routed_from=".$date." and h.ROUTED_TO >= 25 and h.ROUTED_TO <= 27  )";
}
else{


/*$sql = "SELECT b.REMARKS,a.TYPE,a.DATE,a.SUBJECT AS SUBJECT,g.SOURCE_M as external,f.SOURCE_M as SOURCE_M,d.DIVISION_M as internal,a.RECEIVE_MODE as RECEIVE_MODE,a.date_received AS date_received,a.TIME as TIME,b.DATE_RELEASED as DATE_RELEASED,b.TIME_RELEASED as TIME_RELEASED,b.RELEASED_TO ,a.record_n as arecord from tblrecords a
left join  tblrecordrelease b on b.RECORD_N=a.RECORD_N
left join  tblemployeeinfo c on c.EMP_N=b.SENDER_M
left join  tblrecordsources f on f.SOURCE_N=a.SOURCE 
left join tblrecordsources g on g.SOURCE_N=b.RELEASED_TO
left join  tblpersonneldivision d on d.DIVISION_N=b.RELEASED_TO
WHERE b.DATE_RELEASED = '".$date."' and b.RELEASED_FROM = ".$division."";*/
$sql="SELECT b.REMARKS,a.TYPE,a.DATE,a.SUBJECT AS SUBJECT,g.SOURCE_M as external,f.SOURCE_M as SOURCE_M,d.DIVISION_M as internal,a.RECEIVE_MODE as RECEIVE_MODE,a.date_received AS date_received,a.TIME as TIME,b.DATE_RELEASED as DATE_RELEASED,b.TIME_RELEASED as TIME_RELEASED,b.RELEASED_TO ,a.record_n as arecord from tblrecords a
left join  tblrecordrelease b on b.RECORD_N=a.RECORD_N
left join  tblemployeeinfo c on c.EMP_N=b.SENDER_M
left join tblrouting h on h.record_n=a.RECORD_N
left join  tblrecordsources f on f.SOURCE_N=a.SOURCE
left join tblrecordsources g on g.SOURCE_N=b.RELEASED_TO
left join  tblpersonneldivision d on d.DIVISION_N=b.RELEASED_TO
WHERE ( b.DATE_RELEASED = '".$date."' and b.RELEASED_FROM = ".$division."  ) or ( h.DATE_ROUTED='".$date."' and h.routed_from=".$division."  and h.ROUTED_TO >= 1 and h.ROUTED_TO <= 18 or h.DATE_ROUTED='".$date."' and h.routed_from=".$division." and h.ROUTED_TO >= 25 and h.ROUTED_TO <= 27  )";
}


}

else{

if (!empty($byme)) {

$sql="SELECT b.REMARKS,a.TYPE,a.DATE,a.SUBJECT AS SUBJECT,g.SOURCE_M as external,f.SOURCE_M as SOURCE_M,d.DIVISION_M as internal,a.RECEIVE_MODE as RECEIVE_MODE,a.date_received AS date_received,a.TIME as TIME,b.DATE_RELEASED as DATE_RELEASED,b.TIME_RELEASED as TIME_RELEASED,b.RELEASED_TO ,a.record_n as arecord from tblrecords a
left join  tblrecordrelease b on b.RECORD_N=a.RECORD_N
left join  tblemployeeinfo c on c.EMP_N=b.SENDER_M
left join  tblrecordsources f on f.SOURCE_N=a.SOURCE
left join tblrecordsources g on g.SOURCE_N=b.RELEASED_TO
left join  tblpersonneldivision d on d.DIVISION_N=b.RELEASED_TO
WHERE b.DATE_RELEASED = '".$date."' and b.RELEASED_FROM = ".$division." and b.SENDER_M=".$byme."";
}
else{


$sql = "SELECT b.REMARKS,a.TYPE,a.DATE,a.SUBJECT AS SUBJECT,g.SOURCE_M as external,f.SOURCE_M as SOURCE_M,d.DIVISION_M as internal,a.RECEIVE_MODE as RECEIVE_MODE,a.date_received AS date_received,a.TIME as TIME,b.DATE_RELEASED as DATE_RELEASED,b.TIME_RELEASED as TIME_RELEASED,b.RELEASED_TO ,a.record_n as arecord from tblrecords a
left join  tblrecordrelease b on b.RECORD_N=a.RECORD_N
left join  tblemployeeinfo c on c.EMP_N=b.SENDER_M
left join  tblrecordsources f on f.SOURCE_N=a.SOURCE
left join tblrecordsources g on g.SOURCE_N=b.RELEASED_TO
left join  tblpersonneldivision d on d.DIVISION_N=b.RELEASED_TO
WHERE b.DATE_RELEASED = '".$date."' and b.RELEASED_FROM = ".$division."";
}

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

 $sql2 = "SELECT accesstype FROM tblemployeeinfo where EMP_N='".$dataRow['ADDED_BY']."'";
    


$i=1;
foreach ($query_data as $key) {
            $sql2 = "SELECT accesstype FROM tblemployeeinfo where EMP_N='".$key['ADDED_BY']."'";

            $sql4 = "SELECT UNAME from tblemployeeinfo where EMP_N=".$key['RECEIVED']."";
        
          $get_receiver = getData($DBConn,$sql4)[0]['UNAME'];
          $remove_year = array_shift($compared);
      

          $compare = getData($DBConn,$sql2)[0]['accesstype']=='admin' ? $key['date_received'] : $key['DATE'];


      $compared = explode('-', $key['DATE']);
          $remove_year = array_shift($compared);
     $compared_final = implode('/', $compared);
       $data_routed = explode('-',$key['DATE_RELEASED']);
     $routed_year_removed = array_shift($data_routed);

          $date_routed_final=implode('/', $data_routed);


    $templateProcessor->setValue('rowNumber#'.$i, $i);
    $templateProcessor->setValue('rowrecord#'.$i, $key['arecord']);
    $templateProcessor->setValue('rowValue#'.$i, $key['SUBJECT']);
    $templateProcessor->setValue('rowsource#'.$i, $key['SOURCE_M']);
    $templateProcessor->setValue('rowmode#'.$i, $key['RECEIVE_MODE']);
    $templateProcessor->setValue('rowdater#'.$i, $compared_final);
    $templateProcessor->setValue('rowtimer#'.$i, date("h:i a", strtotime($key['TIME'])));
    $templateProcessor->setValue('rowdatero#'.$i, $date_routed_final);
    $templateProcessor->setValue('rowtimero#'.$i, empty($key['TIME_RELEASED']) ? '' : date("h:i a", strtotime($key['TIME_RELEASED'])) );
    $templateProcessor->setValue('rowtoro#'.$i, ($key['TYPE']=="External") ? $key['external'] : $key['internal'] );
    $templateProcessor->setValue('rowreceiveby#'.$i, '');
    $templateProcessor->setValue('rowpday#'.$i, $compare == $key['DATE_RELEASED'] ? '1' : $interval->d );
    // $templateProcessor->setValue('rowmonthof#'.$i, $monthName.' '.$exploded[0]);
    $templateProcessor->setValue('rowremark#'.$i, $key['SUMMARY']);







$i++;
}

        $sql3 = "SELECT DIVISION_LONG_M FROM tblpersonneldivision where DIVISION_N =".$division." ";
          $get_division = getData($DBConn,$sql3)[0]['DIVISION_LONG_M'];

$templateProcessor->setValue('rowmonthof', $monthName.' '.$exploded[0]);
$templateProcessor->setValue('rowoffice', $get_division);
$templateProcessor->setValue('rowdateexported', date("F j, Y", strtotime($date)) );



// Table with a spanned cell
/*$templateProcessor->cloneRow('userId', 3);

$templateProcessor->setValue('userId#1', '1');
$templateProcessor->setValue('userFirstName#1', 'James');
$templateProcessor->setValue('userName#1', 'Taylor');
$templateProcessor->setValue('userPhone#1', '+1 428 889 773');

$templateProcessor->setValue('userId#2', '2');
$templateProcessor->setValue('userFirstName#2', 'Robert');
$templateProcessor->setValue('userName#2', 'Bell');
$templateProcessor->setValue('userPhone#2', '+1 428 889 774');

$templateProcessor->setValue('userId#3', '3');
$templateProcessor->setValue('userFirstName#3', 'Michael');
$templateProcessor->setValue('userName#3', 'Ray');
$templateProcessor->setValue('userPhone#3', '+1 428 889 775');*/
if ($_SESSION['datas']['decider']=="incoming") {
// echo date('H:i:s'), ' Saving the result document...', EOL;
$templateProcessor->saveAs('results/INCOMING-COMMUNICATIONS.docx');

}
else
{
	// echo date('H:i:s'), ' Saving the result document...', EOL;
$templateProcessor->saveAs('results/OUTGOING-COMMUNICATIONS.docx');
}
// echo getEndingNotes(array('Word2007' => 'docx'), 'results/Sample_07_TemplateCloneRow.docx');
if (!CLI) {
    include_once 'Sample_Footer.php';
}
