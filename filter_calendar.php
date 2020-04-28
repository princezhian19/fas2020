<?php session_start();
if(!isset($_SESSION['username'])){
header('location:index.php');
}else{
  error_reporting(0);
ini_set('display_errors', 0);
$username = $_SESSION['username'];
}

require_once 'calendar/sample/bdd.php';
require_once 'calendar/sample/dbaseCon.php';
require_once 'calendar/sample/sql_statements.php';

$sql = "SELECT id, title, start, end, tblpersonneldivision.DIVISION_COLOR as 'color', cancelflag, office FROM events inner join tblpersonneldivision on events.office = tblpersonneldivision.DIVISION_N where cancelflag = 0 and status = 1 ";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();
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
  
  .response {
      height: 60px;
  }
  
  .success {
      background: #cdf3cd;
      padding: 10px 60px;
      border: #c3e6c3 1px solid;
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
<?php include 'test1.php';?>
<?php include 'connection.php';?>

  <div class="content-wrapper">
    <section class="content-header">
    <br>
      <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Calendar of Events</li>
      </ol><br>
 
  <div id="openviewWeather">
      <a class="weatherwidget-io" href="https://forecast7.com/en/51d51n0d13/london/" data-label_1="Manila" data-label_2="Weather" data-font="Roboto" data-icons="Climacons Animated" data-theme="original" data-accent="rgba(1, 1, 1, 0.0)"></a>
  </div>
  
  <script>
  !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
  </script>
  
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  
  <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css' rel='stylesheet' media='print' />
  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  
  <div id="contextMenu" class="dropdown clearfix">
  
  </div>
 
  <div class="panel panel-default hidden-print">
    
    <div class="panel-body">
      
      <div class="col-lg-4">
    
    <label for="calendar_view">Filter Eventy Type</label>
    <div class="input-group">
        <select class="filter" id="type_filter" multiple="multiple">
          <option value="Appointment">Appointment</option>
          <option value="Check-in">Check-in</option>
          <option value="Checkout">Checkout</option>
          <option value="Inventory">Inventory</option>
          <option value="Valuation">Valuation</option>
          <option value="Viewing">Viewing</option>
        </select>
      </div>
  </div>
      
      
    </div>
  </div>
  
          <div id="wrapper">
              <div id="loading"></div>
              <div class="print-visible" id="calendar"></div>
          </div>
      
       
  <script>
      var newEvent;
var editEvent;

$(document).ready(function() {
    
   var calendar = $('#calendar').fullCalendar({
       
       eventRender: function(event, element, view) {
         
  
         
       
   
           var show_username, show_type = true, show_calendar = true;

           var types = $('#type_filter').val();
           var calendars = $('#calendar_filter').val();


           if (types && types.length > 0) {
               if (types[0] == "all") {
                   show_type = true;
               } else {
                   show_type = types.indexOf(event.type) >= 0;
               }
           }

        
           return show_type ;
          
       },
    
       header: {
           left: 'today, prevYear, nextYear, printButton',
           center: 'prev, title, next',
           right: 'month,agendaWeek,agendaDay,listWeek'
       },
  
  
       eventAfterAllRender: function(view) {
           if(view.name == "month"){
              $(".fc-content").css('height','auto');
            }
       },
     
  
        eventClick: function(event, jsEvent, view) {
          
          editEvent(event);
          
        },
       locale: 'en-GB',
       timezone: "local",
       nextDayThreshold: "09:00:00",
       allDaySlot: true,
       displayEventTime: true,
       displayEventEnd: true,
       firstDay: 1,
       weekNumbers: false,
       selectable: true,
       weekNumberCalculation: "ISO",
       eventLimit: true,
       eventLimitClick: 'week', //popover
       navLinks: true,
       defaultDate: moment('2018-03-07'),
       timeFormat: 'HH:mm',
       defaultTimedEventDuration: '01:00:00',
       editable: true,
       minTime: '07:00:00',
       maxTime: '18:00:00',
       slotLabelFormat: 'HH:mm', 
       weekends: true,
       nowIndicator: true,
       dayPopoverFormat: 'dddd DD/MM', 
       longPressDelay : 0,
       eventLongPressDelay : 0,
       selectLongPressDelay : 0,
       
       events:
        [
                    {
                    _id: 1,
                    title: 'Michigan University',
                    avatar: 'https://republika.mk/wp-content/uploads/2017/07/man-852762_960_720.jpg',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-07T09:30',
                    end: '2018-03-07T10:00',
                    type: 'Appointment',
                    calendar: 'Sales',
                    className: 'colorAppointment',
                    username: 'Caio Vitorelli',
                    backgroundColor: "#f4516c",
                    textColor: "#ffffff",
                    allDay: false
                }, {
                    _id: 2,
                    title: 'California Polytechnic',
                    avatar: 'http://kidscoaching.com.br/wp-content/uploads/2016/08/opulent-profile-square-02.jpg',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-01T12:30',
                    end: '2018-03-01T15:30',
                    type: 'Appointment',
                    calendar: 'Sales',
                    className: 'colorAppointment',
                    username: 'Adam Rackham',
                    backgroundColor: "#9816f4",
                    textColor: "#ffffff",
                    allDay: false
                }, {
                    _id: 3,
                    title: 'Vermont University 2',
                    avatar: 'http://kidscoaching.com.br/wp-content/uploads/2016/08/opulent-profile-square-02.jpg',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-02',
                    end: '2018-03-02',
                    type: 'Check-in',
                    calendar: 'Sales',
                    className: 'colorCheck-in',
                    username: 'Adam Rackham',
                    backgroundColor: "#9816f4",
                    textColor: "#ffffff",
                    allDay: true
                }, {
                    _id: 4,
                    title: 'Vermont University',
                    avatar: '',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-06',
                    end: '2018-03-06',
                    type: 'Checkout',
                    calendar: 'Sales',
                    className: 'colorCheckout',
                    username: 'Peter Grant',
                    backgroundColor: "#1756ff",
                    textColor: "#ffffff",
                    allDay: true
                }, {
                    _id: 5,
                    title: 'Michigan High School',
                    avatar: '',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-08',
                    end: '2018-03-08',
                    type: 'Inventory',
                    calendar: 'Lettings',
                    className: 'colorInventory',
                    username: 'Peter Grant',
                    backgroundColor: "#1756ff",
                    textColor: "#ffffff",
                    allDay: true
                }, {
                    _id: 6,
                    title: 'Vermont High School',
                    avatar: '',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-09',
                    end: '2018-03-09',
                    type: 'Valuation',
                    calendar: 'Lettings',
                    className: 'colorValuation',
                    username: 'Peter Grant',
                    backgroundColor: "#1756ff",
                    textColor: "#ffffff",
                    allDay: true
                }, {
                    _id: 7,
                    title: 'California High School',
                    avatar: 'https://republika.mk/wp-content/uploads/2017/07/man-852762_960_720.jpg',
                    description: 'Lorem ipsum dolor sit incid idunt ut Lorem ipsum sit.',
                    start: '2018-03-07',
                    end: '2018-03-08',
                    type: 'Viewing',
                    calendar: 'Lettings',
                    className: 'colorViewing',
                    username: 'Caio Vitorelli',
                    backgroundColor: "#f4516c",
                    textColor: "#ffffff",
                    allDay: true
                     }
    ]

   });
  
   $('.filter').on('change', function() {
       $('#calendar').fullCalendar('rerenderEvents');
   });

   $("#type_filter").select2({
       placeholder: "Filter ddTypes",
       allowClear: true
   });

   $("#calendar_filter").select2({
       placeholder: "Filter Calendars",
       allowClear: true
   });
  
  $("#starts-at, #ends-at").datetimepicker({
    format: 'ddd DD MMM YYYY HH:mm'
  });
  
  //var minDate = moment().subtract(0, 'days').millisecond(0).second(0).minute(0).hour(0);
  
  $(" #editStartDate, #editEndDate").datetimepicker({
    format: 'ddd DD MMM YYYY HH:mm'
    //minDate: minDate
  });
  
  //CREATE NEW EVENT CALENDAR

  newEvent = function(start, end, eventType) {
      
      var colorEventyType;
      
      if (eventType == "Appointment"){
        colorEventyType = "colorAppointment";
      }
      else if (eventType == "Check-in"){
        colorEventyType = "colorCheck-in";
      }
      else if (eventType == "Checkout"){
        colorEventyType = "colorCheckout";
      }
      else if (eventType == "Inventory"){
        colorEventyType = "colorInventory";
      }
      else if (eventType == "Valuation"){
        colorEventyType = "colorValuation";
      }
      else if (eventType == "Viewing"){
        colorEventyType = "colorViewing";
      }

      $("#contextMenu").hide();
      $('.eventType').text(eventType);
      $('input#title').val("");
      $('#starts-at').val(start);
      $('#ends-at').val(end);
      $('#newEventModal').modal('show');
      
      var statusAllDay;
      var endDay;
    
      $('.allDayNewEvent').on('change',function () {
      
        if ($(this).is(':checked')) {
          statusAllDay = true;
          var endDay = $('#ends-at').prop('disabled', true);
        } else {
          statusAllDay = false;
          var endDay = $('#ends-at').prop('disabled', false);
        }   
      });
      
      //GENERATE RAMDON ID - JUST FOR TEST - DELETE IT
      var eventId = 1 + Math.floor(Math.random() * 1000);
      //GENERATE RAMDON ID - JUST FOR TEST - DELETE IT
    
      $('#save-event').unbind();
      $('#save-event').on('click', function() {
      var title = $('input#title').val();
      var startDay = $('#starts-at').val();
      if(!$(".allDayNewEvent").is(':checked')){
        var endDay = $('#ends-at').val();
      }
      var calendar = $('#calendar-type').val();
      var description = $('#add-event-desc').val();
      var type = eventType;
      if (title) {
        var eventData = {
            _id: eventId,
            title: title,
            avatar: 'https://republika.mk/wp-content/uploads/2017/07/man-852762_960_720.jpg',
            start: startDay,
            end: endDay,
            description: description,
            type: type,
            calendar: calendar,
            className: colorEventyType,
            username: 'Caio Vitorelli',
            backgroundColor: '#1756ff',
            textColor: '#ffffff',
            allDay: statusAllDay
        };
        $("#calendar").fullCalendar('renderEvent', eventData, true);
        $('#newEventModal').find('input, textarea').val('');
        $('#newEventModal').find('input:checkbox').prop('checked',false);
        $('#ends-at').prop('disabled', false);
        $('#newEventModal').modal('hide');
        }
      else {
        alert("Title can't be blank. Please try again.")
      }
      });
    }
    
  //EDIT EVENT CALENDAR
  
    editEvent = function(event, element, view) {

        $('.popover.fade.top').remove();
        $(element).popover("hide");
      
        //$(".dropdown").hide().css("visibility", "hidden");
      
        if(event.allDay == true){
          $('#editEventModal').find('#editEndDate').attr("disabled", true);
          $('#editEventModal').find('#editEndDate').val("");
          $(".allDayEdit").prop('checked', true);
        }else{
          $('#editEventModal').find('#editEndDate').attr("disabled", false);
          $('#editEventModal').find('#editEndDate').val(event.end.format('ddd DD MMM YYYY HH:mm'));
          $(".allDayEdit").prop('checked', false);
        }
      
        $('.allDayEdit').on('change',function () {
      
          if ($(this).is(':checked')) {
              $('#editEventModal').find('#editEndDate').attr("disabled", true);
              $('#editEventModal').find('#editEndDate').val("");
              $(".allDayEdit").prop('checked', true);
            } else {
              $('#editEventModal').find('#editEndDate').attr("disabled", false);
              $(".allDayEdit").prop('checked', false);
            }   
        });
        
        $('#editTitle').val(event.title);
        $('#editStartDate').val(event.start.format('ddd DD MMM YYYY HH:mm'));
        $('#edit-calendar-type').val(event.calendar);
        $('#edit-event-desc').val(event.description);
        $('.eventName').text(event.title);
        $('#editEventModal').modal('show');
        $('#updateEvent').unbind();
        $('#updateEvent').on('click', function() {
          var statusAllDay;
          if ($(".allDayEdit").is(':checked')) {
            statusAllDay = true;
          }else{
            statusAllDay = false;
          }
          var title = $('input#editTitle').val();
          var startDate = $('input#editStartDate').val();
          var endDate = $('input#editEndDate').val();
          var calendar = $('#edit-calendar-type').val();
          var description = $('#edit-event-desc').val();
          $('#editEventModal').modal('hide');
          var eventData;
          if (title) {
            event.title = title
            event.start = startDate
            event.end = endDate
            event.calendar = calendar
            event.description = description
            event.allDay = statusAllDay
            $("#calendar").fullCalendar('updateEvent', event);
          } else {
          alert("Title can't be blank. Please try again.")
          }
        });
      
        $('#deleteEvent').on('click', function() {
          $('#deleteEvent').unbind();
          if (event._id.includes("_fc")){
            $("#calendar").fullCalendar('removeEvents', [event._id]);
          } else {
            $("#calendar").fullCalendar('removeEvents', [event._id]);
          }
          $('#editEventModal').modal('hide');
        });
      }
    

  //SET DEFAULT VIEW CALENDAR
    
  var defaultCalendarView = $("#calendar_view").val();
  
  if(defaultCalendarView == 'month'){                             
      $('#calendar').fullCalendar( 'changeView', 'month');
  }else if(defaultCalendarView == 'agendaWeek'){
      $('#calendar').fullCalendar( 'changeView', 'agendaWeek');
  }else if(defaultCalendarView == 'agendaDay'){
      $('#calendar').fullCalendar( 'changeView', 'agendaDay');
  }else if(defaultCalendarView == 'listWeek'){
      $('#calendar').fullCalendar( 'changeView', 'listWeek');
  }
  
  $('#calendar_view').on('change',function () {
    
    var defaultCalendarView = $("#calendar_view").val();
    $('#calendar').fullCalendar('changeView', defaultCalendarView);
    
  });
  
  //SET MIN TIME AGENDA
    
  $('#calendar_start_time').on('change',function () {
    
    var minTimeAgendaView = $(this).val();
    $('#calendar').fullCalendar('option', {minTime: minTimeAgendaView});
    
  });
  
  //SET MAX TIME AGENDA
    
  $('#calendar_end_time').on('change',function () {
    
    var maxTimeAgendaView = $(this).val();
    $('#calendar').fullCalendar('option', {maxTime: maxTimeAgendaView});
    
  });
  
  //SHOW - HIDE WEEKENDS
  
  var activeInactiveWeekends = false;
  checkCalendarWeekends();

  $('.showHideWeekend').on('change',function () {
    checkCalendarWeekends();
  });
  
  function checkCalendarWeekends(){
    
    if ($('.showHideWeekend').is(':checked')) {
      activeInactiveWeekends = true;
      $('#calendar').fullCalendar('option', {
        weekends: activeInactiveWeekends
      });
    } else {
      activeInactiveWeekends = false;
      $('#calendar').fullCalendar('option', {
        weekends: activeInactiveWeekends
      });
    }   
    
  }
  
  //CREATE NEW CALENDAR AND APPEND
  
  $('#addCustomCalendar').on('click', function() {
    
    var newCalendarName = $("#inputCustomCalendar").val();
    $('#calendar_filter, #calendar-type, #edit-calendar-type').append($('<option>', {
        value: newCalendarName,
        text: newCalendarName
    }));
    $("#inputCustomCalendar").val("");
    
  });
  
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
        
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCit4RJVPT9UiLQCJJPYEBkNTJCslqO4ps&libraries=places"></script>







































                </div>
    </section>
  </div>


  <footer class="main-footer">
  <br>

    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>DILG IV-A Regional Information and Communication Technology Unit (RICTU) © 2019 All Right Reserved .</strong>
  </footer>
  <br>



  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>

</script>

</body>
</html>
