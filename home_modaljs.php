$(document).ready(function() {

if($('#gender').val() == 'Male')
{
  $(".period").prop('disabled', true);
  $(".period").val('');

}else if($('#gender').val() == 'Female'){
  $(".period").prop('disabled', false);
  $(".period").prop('required', true);

}else{
  $(".period").prop('disabled', true);
  $(".period").val('');
}


var action = '';
var table = $('#example').DataTable( {

  'scrollX'     : true,
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true,   aLengthMenu: [ [10, 10, 20, -1], [10, 10, 20, "All"] ],
  "bPaginate": false,
  "bLengthChange": false,
  "bFilter": true,
  "bInfo": false,
  "bAutoWidth": false,
    "processing": true,
    "serverSide": false,
    "ajax": "DATATABLE/health_monitoring.php"
    // "columnDefs": [ {
    //     "targets":10,
    //     "render": function (data, type, row, meta ) {  
    //     action = "<button class = 'btn btn-md btn-success' id = 'view'><i class = 'fa fa-eye'></i>View</button>&nbsp;<button class = 'btn btn-md btn-primary'><i class = 'fa fa-edit'></i>Edit</button>&nbsp;<button class = 'btn btn-md btn-danger'><i class = 'fa fa-trash'></i> Delete</button>";
    //     return action;
    //     }
    // }]
  

} );


$('#example tbody').on( 'click', '#view', function () {
  var data = table.row( $(this).parents('tr') ).data();
  window.location="ViewTravelClaim.php?&ro="+data[2];
} );
});


$(document).ready(function() 
{
  $.ajax({
  type: "POST",
  url: "health_monitoring_ajax.php",
  data:{
    username:'<?php echo $username;?>'
  },
  success: function(data) {
if(data == 1)
{
  $('#welcome-modal').modal('hide');
  $("#healthDec").html('Thank you for accomplishing the <br>Online Health Declaration Form.');
  $(".btndisable").prop('disabled',true);
}else{
  $('#welcome-modal').modal({
  backdrop: 'static',
  keyboard: false
  });
}
    }
});



$('#healthDec').click(function(){
  $('#welcome-modal').modal({
  backdrop: 'static',
  keyboard: false
  });
});

$("#reservation").prop('disabled', true);

$('#sched').on('change',function(e){
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    if(valueSelected == 'SWF')
    {
        $("#reservation").prop('disabled', true);

    }else{
    $("#reservation").prop('disabled', false);
    }
})
$("#txt1").prop('disabled', true);
$("#txt2").prop('disabled', true);
$("#txt3").prop('disabled', true);
$("#txt4").prop('disabled', true);
$("#txt5").prop('disabled', true);



//   checkbox
$('.checkbox1').on('change', function() { 
$('.checkbox1').not(this).prop('checked', false);  
});
$('.checkbox2').on('change', function() { 
$('.checkbox2').not(this).prop('checked', false);  
});
$('.checkbox3').on('change', function() { 
$('.checkbox3').not(this).prop('checked', false);  
});
$('.checkbox4').on('change', function() { 
$('.checkbox4').not(this).prop('checked', false);  
});
$('.checkbox5').on('change', function() { 
$('.checkbox5').not(this).prop('checked', false);  
});
        //   =================================
        $("#cb1").change(function() {
            var cb1 = "";
            if($(this).is(":checked"))
            {
              cb1 = "CHECK";
            }else{
              cb1= "UNCHECK";
            }
            switch (cb1) {
              case 'CHECK':
                    $("#txt1").prop('disabled', false);
                break;
              case 'UNCHECK':
                    $("#txt1").prop('disabled', true);
              default:
              $("#txt1").val('');

                break;
            }
        });

        $("#cb2").change(function() {
              var cb2 = "";
              if($(this).is(":checked"))
              {
                cb2 = "CHECK";
              }else{
                cb2= "UNCHECK";
              }
              switch (cb2) {
                case 'CHECK':
                      $("#txt1").val('');
                      $("#txt1").prop('disabled', true);// disable the textarea
                      $("#cb1").prop('required', false); // disable the required parameter of YES checkbox

                  break;
                case 'UNCHECK':
                      $("#cb1").prop('required', true);
                default:
                $("#txt1").prop('disabled', true);// ennable the textarea
                      $("#cb1").prop('required', true); // enable the required parameter of YES checkbox
                  break;
          }
        });
            // $('#cb1').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt1").prop('disabled', false);
            //     }else{
            //         $("#txt1").prop('disabled', true);
            //     }
            // });
            // $('#cb2').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt1").prop('disabled', true);
            //         $("#cb1").prop('required', false);
            //     }else{
            //         $("#txt1").prop('disabled', true);
            //         $("#cb1").prop('required', true);

            //     }
            // });
        // ========================================
        //   =================================
        $("#cb3").change(function() {
            var cb3 = "";
            if($(this).is(":checked"))
            {
              cb3 = "CHECK";
            }else{
              cb3= "UNCHECK";
            }
            switch (cb3) {
              case 'CHECK':
                    $("#txt2").prop('disabled', false);
                break;
              case 'UNCHECK':
                    $("#txt2").prop('disabled', true);
              default:
              $("#txt2").val('');

                break;
            }
        });

        $("#cb4").change(function() {
              var cb4 = "";
              if($(this).is(":checked"))
              {
                cb4 = "CHECK";
              }else{
                cb4= "UNCHECK";
              }
              switch (cb4) {
                case 'CHECK':
                      $("#txt2").val('');
                      $("#txt2").prop('disabled', true);// disable the textarea
                      $("#cb3").prop('required', false); // disable the required parameter of YES checkbox
                  break;
                case 'UNCHECK':
                      $("#cb3").prop('required', true);
                default:
                $("#txt2").prop('disabled', true);// ennable the textarea
                      $("#cb3").prop('required', true); // enable the required parameter of YES checkbox
                  break;
          }
        });
            // $('#cb3').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt2").prop('disabled', false);
            //     }else{
            //         $("#txt2").prop('disabled', true);
            //     }
            // });
            // $('#cb4').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt2").prop('disabled', true);
            //         $("#cb3").prop('required', false);

            //     }else{
            //         $("#txt2").prop('disabled', true);
            //         $("#cb3").prop('required', true);

            //     }
            // });
        // ========================================
        $("#cb5").change(function() {
            var cb5 = "";
            if($(this).is(":checked"))
            {
              cb5 = "CHECK";
            }else{
              cb5 = "UNCHECK";
            }
            switch (cb5) {
              case 'CHECK':
                    $("#txt3").prop('disabled', false);
                break;
              case 'UNCHECK':
                    $("#txt3").prop('disabled', true);
              default:
              $("#txt3").val('');

                break;
            }
        });

        $("#cb6").change(function() {
              var cb6 = "";
              if($(this).is(":checked"))
              {
                cb6 = "CHECK";
              }else{
                cb6 = "UNCHECK";
              }
              switch (cb6) {
                case 'CHECK':
                      $("#txt3").val('');
                      $("#txt3").prop('disabled', true);// disable the textarea
                      $("#cb5").prop('required', false); // disable the required parameter of YES checkbox
                  break;
                case 'UNCHECK':
                      $("#cb5").prop('required', true);
                default:
                  $("#txt3").prop('disabled', true);// ennable the textarea
                      $("#cb5").prop('required', true); // enable the required parameter of YES checkbox
                  break;
          }
        });
            // $('#cb5').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt3").prop('disabled', false);
            //     }else{
            //         $("#txt3").prop('disabled', true);
            //     }
            // });
            // $('#cb6').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt3").prop('disabled', true);
            //         $("#cb5").prop('required', false);

            //     }else{
            //         $("#txt3").prop('disabled', true);
            //         $("#cb5").prop('required', true);

            //     }
            // });
            // ===================================
            $("#cb7").change(function() {
              var cb7 = "";
              if($(this).is(":checked"))
              {
                cb7 = "CHECK";
              }else{
                cb7 = "UNCHECK";
              }
              switch (cb7) {
                case 'CHECK':
                      $("#txt4").prop('disabled', false);
                  break;
                case 'UNCHECK':
                      $("#txt4").prop('disabled', true);
                default:
              $("#txt4").val('');

                  break;
              }
            });

            $("#cb8").change(function() {
                  var cb8 = "";
                  if($(this).is(":checked"))
                  {
                    cb8 = "CHECK";
                  }else{
                    cb8 = "UNCHECK";
                  }
                  switch (cb8) {
                    case 'CHECK':
                          $("#txt4").val('');// disable the textarea
                          $("#txt4").prop('disabled', true);// disable the textarea
                          $("#cb7").prop('required', false); // disable the required parameter of YES checkbox
                      break;
                    case 'UNCHECK':
                          $("#cb7").prop('required', true);
                    default:
                      $("#txt4").prop('disabled', true);// ennable the textarea
                          $("#cb7").prop('required', true); // enable the required parameter of YES checkbox
                      break;
              }
            });
            // $('#cb7').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt4").prop('disabled', false);
            //     }else{
            //         $("#txt4").prop('disabled', true);
            //     }
            // });
            // $('#cb8').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt4").prop('disabled', true);
            //         $("#cb7").prop('required', false);

            //     }else{
            //         $("#txt4").prop('disabled', true);
            //         $("#cb7").prop('required', true);

            //     }
            // });
            // ===================================
            $("#cb9").change(function() {
              var cb9 = "";
              if($(this).is(":checked"))
              {
                cb9 = "CHECK";
              }else{
                cb9 = "UNCHECK";
              }
              switch (cb9) {
                case 'CHECK':
                      $("#txt5").prop('disabled', false);
                  break;
                case 'UNCHECK':
                      $("#txt5").prop('disabled', true);
                default:
              $("#txt").val('');

                  break;
              }
            });

            $("#cb10").change(function() {
                  var cb10 = "";
                  if($(this).is(":checked"))
                  {
                    cb10 = "CHECK";
                  }else{
                    cb10 = "UNCHECK";
                  }
                  switch (cb10) {
                    case 'CHECK':
                          $("#txt5").val('');// disable the textarea
                          $("#txt5").prop('disabled', true);// disable the textarea
                          $("#cb9").prop('required', false); // disable the required parameter of YES checkbox
                      break;
                    case 'UNCHECK':
                          $("#cb9").prop('required', true);
                    default:
                      $("#txt5").prop('disabled', true);// ennable the textarea
                          $("#cb9").prop('required', true); // enable the required parameter of YES checkbox
                      break;
              }
            });
            // $('#cb9').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt5").prop('disabled', false);
            //     }else{
            //         $("#txt5").prop('disabled', true);
            //     }
            // });
            // $('#cb10').click(function(){
            //     if($(this).prop("checked") == true){
            //         $("#txt5").prop('disabled', true);
            //         $("#cb9").prop('required', false);

            //     }else{
            //         $("#txt5").prop('disabled', true);
            //         $("#cb9").prop('required', true);
            //     }
            // });

});