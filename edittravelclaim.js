
$(document).ready(function()
{
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
    } else {
    $('#editbtn').attr('disabled', true);
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
  
  
   
    // checkbox validation
    $(document).ready(function(){
      // $('#datepicker4').val($('#travel_date').val());
      $( ".datepicker4" ).datepicker( "setDate", new Date());

        //   $('.wor').click(function(){
        //       if($(this).prop("checked") == true){
                
        //   $(".wor_txt").prop('disabled',true);
        //   $(".wor_txt").val('');
  
        //       }
        //       else if($(this).prop("checked") == false){
        //         $(".wor_txt").prop('disabled',false);
        //       }
        //   });
        //   $('.wa').click(function(){
        //       if($(this).prop("checked") == true){
        //   $(".wor_txt").prop('disabled',true);
                
        //       }
        //   });
        //   $('.wr').click(function(){
        //       if($(this).prop("checked") == true){
        //   $(".wor_txt").prop('disabled',false);
                
        //       }
        //   });
      });
  
  
      
      
    $("body").on('click', '.cb1', enable_cb1);
    $("body").on('click', '.wa', enable_cb2);
    $("body").on('click', '.wor', disableTxt1);
    $("body").on('click', '.wr', disableTxt2);
    $("body").on('change', '.receipt', groupCheck);

function  groupCheck() {
    const receipt = $(this).siblings('.receipt');

    receipt.not(this).prop('checked', false);  
}
      
    
    
    function enable_cb1() {
        //paikliin natin to kim 
    
    //   if (this.checked) {
    //     if($('.checkboxgroup').val() == 'breakfast')
    //     {
    //       $('.breakfast').not(this).prop('checked', true);  
    //       $('.lunch').not(this).prop('checked', true);  
    //       $('.dinner').not(this).prop('checked', true);  
    //     }
    //     $(".breakfast").removeAttr("disabled");
    //     $(".lunch").removeAttr("disabled");
    //     $(".dinner").removeAttr("disabled");
    //   } else {
  
    //     $('.breakfast').not(this).prop('checked', false);  
    //     $('.lunch').not(this).prop('checked', false);  
    //     $('.dinner').not(this).prop('checked', false);  
  
    //     $(".breakfast").attr("disabled", true);
    //     $(".lunch").attr("disabled", true);
    //     $(".dinner").attr("disabled", true);
        
    //   }
        const bf = $(this).siblings('.breakfast');
        const ln = $(this).siblings('.lunch');
        const dn = $(this).siblings('.dinner');

        bf.prop('checked', this.checked);
        ln.prop('checked', this.checked);
        dn.prop('checked', this.checked);

        bf.attr('disabled', !this.checked);
        ln.attr('disabled', !this.checked);
        dn.attr('disabled', !this.checked);
    }
    function disableTxt1() {
        const wor_txt = $(this).siblings('.wor_txt');

        wor_txt.prop('disabled', false);
        wor_txt.attr('disabled', true);
    }
    function disableTxt2() {
        const wor_txt = $(this).siblings('.wor_txt');

        wor_txt.prop('disabled', true);
        wor_txt.attr('disabled', false);   
    }
    function enable_cb2()
    {
        const wr = $(this).siblings('.wr');
        const wor = $(this).siblings('.wor');

        wr.prop('checked', this.checked);

        wor.prop('checked', this.checked);

        wr.attr('disable', !this.checked);
        wor.attr('disable', !this.checked);


    //   if (this.checked) {
    //     if($('.receipt').val() == 'With Receipt')
    //     {
    //       $('.wr').not(this).prop('checked', true);  
    //       $('.wor').not(this).prop('checked', true);  
    //     }
    //     $(".wr").removeAttr("disabled");
    //     $(".wor").removeAttr("disabled");
    //   }else{
    //     $('.wr').not(this).prop('checked', false);  
    //     $('.wor').not(this).prop('checked', false); 
        
    //     $(".wr").attr("disabled", true);
    //     $(".wor").attr("disabled", true);
    //   }
  
    }
    disabledDIV();

    function disabledDIV()
    {
     var distance =  $('.distance').val();
     distance = distance.replace('km', '');

        if(distance > 50)
     {
     
  
     }else{
  
      $(".breakfast").attr("disabled", true);
        $(".lunch").attr("disabled", true);
        $(".dinner").attr("disabled", true);
        $(".cb1").attr("disabled", true);
        $(".wa").attr("disabled", true);
        $(".wor").attr("disabled", true);
        $(".wr").attr("disabled", true);
        $('.perdiem').addClass('border-disabled');
     }
  
    }