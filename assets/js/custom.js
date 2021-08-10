function reset_error(field_id,error_id=''){
   if(error_id!=''){
    $("#"+error_id).html('');
   } 
   $("#"+field_id).removeClass("is-invalid");
   $("#error_msg").html('');
}
function show_modal(modal_id){
  $(modal_id).modal({
   backdrop: 'static',
   keyboard: false,
   show: true
  });
}

function isChar(evt) { 
   var regex = new RegExp("^[a-z A-Z]+$");
   var str = String.fromCharCode(!evt.charCode ? evt.which : evt.charCode);
   if (regex.test(str)) {
       return true;
   } else {
       return false;
   }
}

function get_string_short_form(input_string){
    var special_keywords = ['IN','OF','IS'];
    var short_form_string = '';
    if(input_string.trim()!='' && input_string.length>4){
      var string_array = input_string.split(" ");
      var final_string_array = [];
      string_array.forEach(function(string) {
      var is_string_exists = special_keywords.includes(string.toUpperCase());
      if(!is_string_exists){
       var first_char = string.charAt(0).toUpperCase();
       final_string_array.push(first_char);
      }
      });
      short_form_string =  final_string_array.join('').toString();
   }
   return short_form_string;
} 



/*show toastr message */
function show_message(type, content) {
 toastr.options = {
     "closeButton": true,
     "debug": false,
     "newestOnTop": false,
     "progressBar": true,
     "positionClass": "toast-top-right",
     "preventDuplicates": true,
     "onclick": null,
     "showDuration": "300",
     "hideDuration": "1000",
     "timeOut": "5000",
     "extendedTimeOut": "1000",
     "showEasing": "swing",
     "hideEasing": "linear",
     "showMethod": "fadeIn",
     "hideMethod": "fadeOut"
 }
 toastr[type](content);
}

function show_swal(action,message,type){
 Swal.fire(
 action,
 message,
 type
 )
}