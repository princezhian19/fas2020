  <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css" />
  <script src="calendar/fullcalendar/lib/jquery.min.js"></script>
  <script src="calendar/fullcalendar/lib/moment.min.js"></script>
  <script src="calendar/fullcalendar/fullcalendar.min.js"></script>

<div id="calendar"></div>

<div class="userSearch">
                <div class="searchBar">
                  <input type="text" id="search-criteria" onkeyup="myFunction()" placeholder="Search" /> (user)First Filter:
                  
                 </div>
                  
                <div id ="userList">
                <div> 
                <input type="radio" name="user_selector" value="all" id="all" checked/>
                  <label for="all"> All </label>
                  <input type="radio" name="user_selector" value="Jack" id="Jack" />
                  <label for="all"> Jack </label>
                  <input type="radio" name="user_selector" value="Matt" id="Matt" />
                  <label for="Matt"> Matt </label>
                </div>
                   <select style = "width:20%;" class="division_dropdown " id="selectDivision" style="width: 100%;">
                   <option text="text" value="0"  ></option>
                   <option text="text" value="all"  >All</option>
                   <option text="text" value="Jack"  >Jack</option>
                   <option text="text" value="3"  >ORD-Legal</option>
                   </select>
              
                <style>
                #calendar {
    max-width: 600px;
    margin: 40px auto;
    padding: 0 10px;
  }
                </style>
                <script>
                $(document).ready(function() {

$('#calendar').fullCalendar({
  
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,basicWeek,basicDay'
  },
  defaultDate: '2018-03-12',
  navLinks: true, // can click day/week names to navigate views
  editable: true,
  eventLimit: true, // allow "more" link when too many events

  events: [
    {
      title: 'Jack-Petco',
      start: '2018-03-01',
      user: "Jack",
      client: "Petco",
    },
    {
      title: 'Jack-Petsmart',
      start: '2018-03-07',
      end: '2018-03-10',
      user: "Jack",
      client: "Petsmart",
    },
    {
      id: 999,
      title: 'Matt-Petco',
      start: '2018-03-09T16:00:00',
      user: "Matt",
      client: "Petco",
    },
    {
      id: 999,
      title: 'Matt-Petco',
      start: '2018-03-16T16:00:00',
      user: "Matt",
      client: "Petco",
    },
    {
      title: 'Jack-petco',
      start: '2018-03-11',
      end: '2018-03-13',
      user: "Jack",
      client: "Petco",
    },
    {
      title: 'Jack-Petsmart',
      start: '2018-03-12T10:30:00',
      end: '2018-03-12T12:30:00',
      user: "Jack",
      client: "Petsmart",
    },
    {
      title: 'Jack-Petco',
      start: '2018-03-12T12:00:00',
      user: "Jack",
      client: "Petco",
    },
    {
      title: 'Jack-petco',
      start: '2018-03-12T14:30:00',
      user: "Jack",
      client: "Petco",
    },
    {
      title: 'Matt-Petsmart',
      start: '2018-03-12T17:30:00',
      user: "Matt",
      client: "Petsmart",
    },
    {
      title: 'Jack-petco',
      start: '2018-03-12T20:00:00',
      user: "Jack",
      client: "Petco"
    },
    {
      title: 'Matt-Petco',
      start: '2018-03-13T07:00:00',
      user: "Matt",
      client: "Petco",
    },
    {
      title: 'Jack-Petco',
      url: 'http://google.com/',
      start: '2018-03-28',
      user: "Jack",
      client: "Petco",
    }
  ],
    eventRender: function(event, element, view) {
            return $('input[type=radio][name=user_selector]:checked').val() === 'all' || event.user.indexOf($("input[type=radio][name=user_selector]:checked").val()) >= 0;
    },
  

});


$('input[type=radio][name=type_selector]').on('change', function() {
           console.log("Event");
           $('#calendar').fullCalendar('rerenderEvents');
       });
       
       $('input[type=radio][name=user_selector]').on('change', function() {
           console.log("Event");
           $('#calendar').fullCalendar('rerenderEvents');
       });

});
;
</script>