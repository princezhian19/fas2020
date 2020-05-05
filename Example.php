<?php session_start();
date_default_timezone_set('Asia/Manila');

if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}


?>
        

  
  <!DOCTYPE html>
<html>
  <head>
  <link rel="shortcut icon" type="image/png" href="dilg.png">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FAS | Calendar</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
    <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
    <script src="calendar/fullcalendar/lib/moment.min.js"></script>
    <script src="calendar/fullcalendar/fullcalendar.min.js"></script>
   
    <style>
  
  #calendar {
      width: 100%;
      padding:10px;
      margin: 0 auto;
      background-color:#fff;
  }
  body{
  font-family: Roboto;
  padding: 30px;
}
.dropNewEvent{
  font-family: Roboto;
  font-size: 13px;
}
.popoverTitleCalendar{
  width: 100%;
  height: 100%;
  padding: 15px 15px;
  font-family: Roboto;
  font-size: 13px;
  border-radius: 5px 5px 0 0;
}
.popoverInfoCalendar i{
  font-size: 14px;
    margin-right: 10px;
    line-height: inherit;
    color: #d3d4da;
}
.popoverInfoCalendar p{
  margin-bottom: 1px;
}
.popoverDescCalendar{
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px solid #E3E3E3;
  overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
.popover-title {
    background: transparent;
    font-weight: 600;
    padding: 0 !important;
    border: none;
}
.popover-content {
    padding: 15px 15px;
    font-family: Roboto;
    font-size: 13px;
}
.inputModal{
  width: 65%;
  margin-bottom: 10px;
}
#contextMenu {
  position: absolute;
  display:none;
  z-index: 2;
}
#contextMenu .dropdown-menu{
  border: none;
}
.opacityWeekend{
  background-color: #f4f4fb !important;
}
.fc-avatar-image{
    top: 4px;
    left: 20px;
    height: 28px;
    width: 28px;
    border-radius: 50%;
    position: absolute;
    z-index: 2;
}
.fc-avatar-image img{
  height: 28px;
  width: 28px;
  border-radius: 50%;
}
.fc-avatar-image:before{
    content: none !important;
}
.fc-day-header{
  text-transform: uppercase;
  font-size: 13px;
  font-family: Roboto;
  font-weight: 500;
  color: #505363;
  background-color: #FAFAFA;
  padding: 11px 0px !important;
  text-decoration: none;
}
.fc-day-header a{
  text-decoration: none !important;
  color: #505363;
}
.fc-center h2{
   text-transform: uppercase;
  font-size: 18px;
  font-family: Roboto;
  font-weight: 500;
  color: #505363;
  line-height: 32px;
}
.fc-toolbar.fc-header-toolbar {
    margin-bottom: 22px;
    padding-top: 22px;
}
.fc-agenda-view .fc-day-grid .fc-row .fc-content-skeleton {
    padding-bottom: 1em;
    padding-top: 1em;
}
.fc-day{
  transition: all 0.2s linear;
}
.fc-day:hover{
  background:#EEF7FF;
  cursor: pointer;
  transition: all 0.2s linear;
}
.fc-highlight {
    background: #EEF7FF;
    opacity: 0.7;
}
.fc-time-grid-event.fc-short .fc-time:before {
    content: attr(data-start);
    display: none;
}
.fc-time-grid-event.fc-short .fc-time span {
    display: inline-block;
}
.fc-time-grid-event.fc-short .fc-avatar-image {
    display: none;
    transition: all 0.3s linear;
}
.fc-time-grid .fc-bgevent, .fc-time-grid .fc-event {
    border: 1px solid #fff !important;
}
.fc-time-grid-event.fc-short .fc-content {
    padding: 4px 20px 10px 22px !important;
}
.fc-time-grid-event .fc-avatar-image{
    top: 9px;
}
.fc-event-vert {
  min-height: 22px;
}
.fc .fc-axis {
    vertical-align: middle;
    padding: 0 4px;
    white-space: nowrap;
    font-size: 10px;
    color: #505362;
    text-transform: uppercase;
    text-align: center !important;
    background-color: #fafafa;
}
.fc-unthemed .fc-event .fc-content, .fc-unthemed .fc-event-dot .fc-content {
    padding: 10px 20px 10px 22px;
    font-family: 'Roboto', sans-serif;
    margin-left: -1px;
    height: 100%;
}
.fc-event{
    border: none !important;
}
.fc-day-grid-event .fc-time {
    font-weight: 700;
      text-transform: uppercase;
}
.fc-unthemed .fc-day-grid td:not(.fc-axis).fc-event-container {
    padding: 0.2rem 0.5rem;
}
.fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
    border-color: #DADFEA;
}
.fc-ltr .fc-h-event .fc-end-resizer, .fc-ltr .fc-h-event .fc-end-resizer:before, .fc-ltr .fc-h-event .fc-end-resizer:after, .fc-rtl .fc-h-event .fc-start-resizer, .fc-rtl .fc-h-event .fc-start-resizer:before, .fc-rtl .fc-h-event .fc-start-resizer:after {
    left: auto;
    cursor: e-resize;
    background: none;
}
.colorAppointment :before {
    background-color: #9F4AFF;
    border-right: 1px solid rgba(255, 255, 255, 0.6);
    display: block;
    content: " ";
    position: absolute;
    height: 100%;
    width: 8px;
    border-radius: 3px 0 0 3px;
    top: 0;
    left: -1px;
}
.colorCheck-in :before {
    background-color: #ff4747;
    border-right: 1px solid rgba(255, 255, 255, 0.6);
    display: block;
    content: " ";
    position: absolute;
    height: 100%;
    width: 8px;
    border-radius: 3px 0 0 3px;
    top: 0;
    left: -1px;
}
.colorCheckout :before {
    background-color: #FFC400;
    border-right: 1px solid rgba(255, 255, 255, 0.6);
    display: block;
    content: " ";
    position: absolute;
    height: 100%;
    width: 8px;
    border-radius: 3px 0 0 3px;
    top: 0;
    left: -1px;
}
.colorInventory :before {
    background-color: #FE56F2;
    border-right: 1px solid rgba(255, 255, 255, 0.6);
    display: block;
    content: " ";
    position: absolute;
    height: 100%;
    width: 8px;
    border-radius: 3px 0 0 3px;
    top: 0;
    left: -1px;
}
.colorValuation :before {
    background-color: #0DE882;
    border-right: 1px solid rgba(255, 255, 255, 0.6);
    display: block;
    content: " ";
    position: absolute;
    height: 100%;
    width: 8px;
    border-radius: 3px 0 0 3px;
    top: 0;
    left: -1px;
}
.colorViewing :before {
    background-color: #26CBFF;
    border-right: 1px solid rgba(255, 255, 255, 0.6);
    display: block;
    content: " ";
    position: absolute;
    height: 100%;
    width: 8px;
    border-radius: 3px 0 0 3px;
    top: 0;
    left: -1px;
}
select.filter{
  width: 500px !important;
}

.popover  {
	background: #fff !important;
	color: #2E2F34;
  border: none;
  margin-bottom: 10px;
}

/*popover header*/
.popover-title{
    background: #F7F7FC;
    font-weight: 600;
    padding: 15px 15px 11px ;
    border: none;
}

/*popover arrows*/
.popover.top .arrow:after {
  border-top-color: #fff;
}

.popover.right .arrow:after {
  border-right-color: #fff;
}

.popover.bottom .arrow:after {
  border-bottom-color: #fff;
}

.popover.left .arrow:after {
  border-left-color: #fff;
}

.popover.bottom .arrow:after {
  border-bottom-color: #fff;
}
.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;

  /* Support for all WebKit browsers. */
  -webkit-font-smoothing: antialiased;
  /* Support for Safari and Chrome. */
  text-rendering: optimizeLegibility;

  /* Support for Firefox. */
  -moz-osx-font-smoothing: grayscale;

  /* Support for IE. */
  font-feature-settings: 'liga';
}
.fc-icon-print::before{
  font-family: 'Material Icons';
  content: "\e8ad";
  font-size: 24px;
}
.fc-printButton-button{
  padding: 0 3px !important;
}

@media print {
.print-visible  { display: inherit !important; }
.hidden-print   { display: none !important; }
}
  
</style>

  
  
  <div id="openviewWeather">
      <a class="weatherwidget-io" href="https://forecast7.com/en/12d88121d77/philippines/" data-label_1="Philippines" data-label_2="Weather" data-font="Roboto" data-icons="Climacons Animated" data-theme="original" data-accent="rgba(1, 1, 1, 0.0)"></a>
  </div>
  
  <script>
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
  </script>
  
  
        
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCit4RJVPT9UiLQCJJPYEBkNTJCslqO4ps&libraries=places"></script>


<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
var newEvent;
var editEvent;

$(document).ready(function() {
    

  
  //WEATHER GRAMATICALLY
  
  function retira_acentos(str) {
    var com_acento = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝRÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿr";
    var sem_acento = "AAAAAAACEEEEIIIIDNOOOOOOUUUUYRsBaaaaaaaceeeeiiiionoooooouuuuybyr";
    var novastr="";
    for(i=0; i<str.length; i++) {
      troca=false;
      for (a=0; a<com_acento.length; a++) {
        if (str.substr(i,1)==com_acento.substr(a,1)) {
          novastr+=sem_acento.substr(a,1);
          troca=true;
          break;
        }
      }
      if (troca==false) {
        novastr+=str.substr(i,1);
      }
    }
    return novastr.toLowerCase().replace( /\s/g, '-' );
  }
  
  //WEATHER THEMES
  
  document.getElementById('switchWeatherTheme').addEventListener('change', function(){
    
    var valueTheme = $(this).val();
    var widget = document.querySelector('.weatherwidget-io');
    widget.setAttribute('data-theme', valueTheme);
    __weatherwidget_init();
    
  });
  
  //WEATHER LOCATION
  var input = document.getElementById('searchTextField');
  var autocomplete = new google.maps.places.Autocomplete(input);
  
  google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    var newPlace = retira_acentos(place.name);
    
    var urlDataWeather = 'https://forecast7.com/en/'+ latitude.toFixed(2).replace(/\./g,'d').replace(/\-/g,'n') + longitude.toFixed(2).replace(/\./g,'d').replace(/\-/g,'n') + '/'+ newPlace +'/';
    
    alert(urlDataWeather);
    
    var weatherWidget = document.querySelector('.weatherwidget-io');
    weatherWidget.href = urlDataWeather;
    weatherWidget.dataset.label_1 = place.name;
    __weatherwidget_init();
    
    //document.getElementById('city2').value = place.name;
    //document.getElementById('cityLat').value = place.geometry.location.lat();
    //document.getElementById('cityLng').value = place.geometry.location.lng();
    //alert("This function is working!");
    //alert(place.name);
    // alert(place.address_components[0].long_name);

  });
  
});
</script>

</body>
</html>
