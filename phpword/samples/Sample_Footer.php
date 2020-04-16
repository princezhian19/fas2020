<?php

if (CLI) {

    return;

}

?>

</div>

<script src="bootstrap/js/jquery.min.js"></script>

<script src="bootstrap/js/bootstrap.min.js"></script>



<?php 

if ($_SESSION['datas']['decider']=="incoming") {

	# code...



?>



<script type="text/javascript">

    var delay = 100; 

setTimeout(function(){ window.location = "http://www.loop.calabarzon.dilg.gov.ph/phpword/samples/results/INCOMING-COMMUNICATIONS.docx"; }, delay);

</script>

<h1>Successfully Downloaded</h1>

<a href="http://www.loop.calabarzon.dilg.gov.ph/incoming_records.php">Back</a><br>



<?php }



else if ($_SESSION['datas']['decider']=="psl") {

	# code...



?>



<script type="text/javascript">

    var delay = 100; 

setTimeout(function(){ window.location = "http://www.loop.calabarzon.dilg.gov.ph/phpword/samples/results/PSL-INCOMING-OUTGOING-COMMUNICATIONS.docx"; }, delay);

</script>

<h1>Successfully Downloaded</h1>

<a href="http://www.loop.calabarzon.dilg.gov.ph/psl_records.php">Back</a><br>



<?php }



else if ($_SESSION['datas']['decider']=="fml") {

	



?>



<script type="text/javascript">

    var delay = 100; 

setTimeout(function(){ window.location = "http://www.loop.calabarzon.dilg.gov.ph/phpword/samples/results/FML-INCOMING-OUTGOING-COMMUNICATIONS.docx"; }, delay);

</script>

<h1>Successfully Downloaded</h1>

<a href="http://www.loop.calabarzon.dilg.gov.ph/fml_records.php">Back</a><br>



<?php }

else if ($_SESSION['datas']['decider']=="qme") {

	



?>



<script type="text/javascript">

    var delay = 100; 

setTimeout(function(){ window.location = "http://www.loop.calabarzon.dilg.gov.ph/phpword/samples/results/QME-INCOMING-OUTGOING-COMMUNICATIONS.docx"; }, delay);

</script>

<h1>Successfully Downloaded</h1>

<a href="http://www.loop.calabarzon.dilg.gov.ph/qme_records.php">Back</a><br>



<?php }

 else{ ?>



<script type="text/javascript">

    var delay = 100; 

setTimeout(function(){ window.location = "http://www.loop.calabarzon.dilg.gov.ph/phpword/samples/results/OUTGOING-COMMUNICATIONS.docx"; }, delay);

</script>

<h1>Successfully Downloaded</h1>

<a href="http://www.loop.calabarzon.dilg.gov.ph/outgoing_records.php">Back</a><br>



<?php ?>





<?php } ?>

</body>

</html>



