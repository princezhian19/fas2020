
$(document).ready(function(){
    $('#or').prop('required',true);
    $("#editbtn").prop('disabled',true);
    if($("#or").val() != '')
    {
              $('#travelbtn').attr('disabled', false);

    }
  $( "#or" ).keyup(function() {
    $("#editbtn").prop('disabled',false);
  
    if($('#or').val() != '') {
              $('#editbtn').attr('disabled', false);
              // $('#travelbtn').attr('disabled', false);
  
          } else {
              $('#editbtn').attr('disabled', true);
              // $('#travelbtn').attr('disabled', true);
  
          }
  
  });
  
  
  
  })
   var myCounter = 1;
  
  
   $('#add_fare').click(function(){
     
      $('.myTemplate2')
     .clone()
     .removeClass("myTemplate2")
     .addClass("additionalDate")
     .show()
     .appendTo('#travelPanel');
     
    myCounter++;
       
    $(".datepicker6").on('focus', function(){
        var $this = $(this);
        if(!$this.data('datepicker')) {
         $this.removeClass("hasDatepicker");
         $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
         $this.datepicker("show");
        }
    }); 
  
    $(".datepicker5").on('focus', function(){
        var $this = $(this);
        if(!$this.data('datepicker')) {
         $this.removeClass("hasDatepicker");
         $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
         $this.datepicker("show");
        }
    }); 
  
  
  });
  $(document).on('click','#editbtn',function(e){
   
  
  var purpose = $('#or').val();
  $('#ro_txt').val(purpose);
  if(purpose == '' || purpose == null)
  {
    
    alert('Required Field:All fields with * are required!.');
  $('#editModal').modal().hide();
  
  }else{
  
  }
  });
  
  
    $('.receipt').on('change', function() { 
        $('.receipt').not(this).prop('checked', false);  
    });
    // checkbox validation
    $(document).ready(function(){
      $('#datepicker4').val($('#travel_date').val());
          $('#wor').click(function(){
              if($(this).prop("checked") == true){
                
          $("#wor_txt").prop('disabled',true);
          $("#wor_txt").val('');
  
              }
              else if($(this).prop("checked") == false){
                $("#wor_txt").prop('disabled',false);
              }
          });
          $('#wa').click(function(){
              if($(this).prop("checked") == true){
          $("#wor_txt").prop('disabled',true);
                
              }
          });
          $('#wr').click(function(){
              if($(this).prop("checked") == true){
          $("#wor_txt").prop('disabled',false);
                
              }
          });
      });
  
  
      
        enable_cb1();
        enable_cb2();
    $("#cb1").click(enable_cb1);
    $("#wa").click(enable_cb2);
    function enable_cb1() {
      if (this.checked) {
        if($('.checkboxgroup').val() == 'breakfast')
        {
          $('#breakfast').not(this).prop('checked', true);  
          $('#lunch').not(this).prop('checked', true);  
          $('#dinner').not(this).prop('checked', true);  
        }
        $("#breakfast").removeAttr("disabled");
        $("#lunch").removeAttr("disabled");
        $("#dinner").removeAttr("disabled");
      } else {
  
        $('#breakfast').not(this).prop('checked', false);  
        $('#lunch').not(this).prop('checked', false);  
        $('#dinner').not(this).prop('checked', false);  
  
        $("#breakfast").attr("disabled", true);
        $("#lunch").attr("disabled", true);
        $("#dinner").attr("disabled", true);
        
      }
    }
    function enable_cb2()
    {
      if (this.checked) {
        if($('.receipt').val() == 'With Receipt')
        {
          $('#wr').not(this).prop('checked', true);  
          $('#wor').not(this).prop('checked', true);  
        }
        $("#wr").removeAttr("disabled");
        $("#wor").removeAttr("disabled");
      }else{
        $('#wr').not(this).prop('checked', false);  
        $('#wor').not(this).prop('checked', false); 
        
        $("#wr").attr("disabled", true);
        $("#wor").attr("disabled", true);
      }
  
    }
    function disabledDIV()
    {
     var distance =  $('#distance').val();
     distance = distance.replace('km', '');
     console.log($('#distance').val());
        if(distance > 50)
     {
     
  
     }else{
  
  
      $("#breakfast").attr("disabled", true);
        $("#lunch").attr("disabled", true);
        $("#dinner").attr("disabled", true);
        $("#cb1").attr("disabled", true);
        $("#wa").attr("disabled", true);
        $('.perdiem').addClass('border-disabled');
  
     }
  
    }
    disabledDIV();