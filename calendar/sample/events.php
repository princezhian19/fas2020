<?php
session_start();
require_once 'bdd.php';
require_once 'dbaseCon.php';
require_once 'sql_statements.php';

$sql = "SELECT id, title, start, end, color, cancelflag FROM events where cancelflag = 0 and status = 1";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

$currentuser=3174;





$stmt = $bdd->query("SELECT * FROM tblemployeinfo where EMP_N = '$currentuser'");
while ($row = $stmt->fetch()) {
	$lastname = $row['LAST_M'];
	$firstname = $row['FIRST_M'];
	$middlename = $row['MIDDLE_M'];
	$isplanningofficer = $row['isPlanningOfficer'];

	/*echo $isplanningofficer;*/


	$name = $firstname . "\n" . $middlename . "\n" . $lastname;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>DILG Region IV-A LOOP</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='fullcalendar/fullcalendar.min.css' rel='stylesheet' />


	<!-- Custom CSS -->
	<style>
	
</style>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Header -->
</head>

<body>


	
	<div style="max-width: 1500px;">
		
		<div class="row">
			<div class="col-md-3 col-sm-12" style="margin-top: 3.5%; padding-left: 5%;">
				<table class="table table-bordered" style="border-width: 3px;">
					<tr>
						<td style=""><b><center>DIVISION LEGENDS</center></b></td>
					</tr>
					<tr>
						<td style="background-color: #D5D911; color:black;">ORD</td>
					</tr>
					<tr>
						<td style="background-color: #0071c5; color:white;">LGMED</td>
					</tr>
					<tr>
						<td style="background-color: #48BD0D; color:white;">LGCDD</td>
					</tr>
					<tr>
						<td style="background-color: #8F0CC7; color:white;">PDMU</td>
					</tr>
					<tr>
						<td style="background-color: #E6680E; color:white;">MBRTG</td>
					</tr>
					<tr>
						<td style="background-color: #E60785; color:white;">FAD</td>
					</tr>
					<tr>
						<td style="background-color: #000; color:white;">PROVINCE</td>
					</tr>
					
				</table>
			</div>

			<div class="col-sm-10 col-md-9 text-center">
				<div id="calendar" class="col-centered">
				</div>
			</div>


			
		</div>
		
	</div>


	<!-- jQuery Version 1.11.1 -->
	<script src="fullcalendar/lib/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='fullcalendar/lib/moment.min.js'></script>
	<script src='fullcalendar/fullcalendar.min.js'></script>
	
	<script>

		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},

			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');

			},
			eventRender: function(event, element) {  
				element.find('.fc-time').hide();
			},

			/*eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},*/
			/*eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},*/
			/*eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},*/
			events: [
			<?php foreach($events as $event): 

				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
				if (TRUE) {
					?>
					{
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['title']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $event['color']; ?>',
						url: 'viewEvent.php?eventid=<?php echo $event['id']; ?>',

					},
				<?php } endforeach; ?>
				]
			});

		/*function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}*/
		
	});
	$("#selectMonth").append('<select class="select_month form-control"><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>');
  
  $(".select_month").on("change", function(event) {
  $('#calendar').fullCalendar('changeView', 'month', this.value);
  $('#calendar').fullCalendar('gotoDate', "2020-"+this.value+"-1");
  
  });
  function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>

</body>

</html>
