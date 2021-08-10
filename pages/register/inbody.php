<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo __site_title;?> | User Registration</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo __site_url;?>assets/theme_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo __site_url;?>assets/theme_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo __site_url;?>assets/theme_assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="javascript:void(0)" class="h1">User Registration</a>
    </div>
    <form name="regi_form" id="regi_form" method="post">
    <div class="card-body">
      <p class="login-box-msg">New user registration</p>
      
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="first_name"
           name="first_name" placeholder="First name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" id="last_name" 
          name="last_name" placeholder="Last name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span id="email_error" class="error invalid-feedback"></span>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="rpassword" id="rpassword" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="input-group icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="javascript:void(0)">terms</a>
              </label>
            </div> 
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="<?php echo $obj->base_url('login'); ?>" class="text-center">I already registered</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<!-- jQuery -->
<script src="<?php echo __site_url;?>assets/theme_assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo __site_url;?>assets/theme_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo __site_url;?>assets/theme_assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo __site_url; ?>assets/theme_assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo __site_url; ?>assets/js/custom.js?v=<?php echo time(); ?>"></script>
<script>
const site_url = "<?php echo $obj->base_url(); ?>";
$(function () {
  $.validator.setDefaults({
     submitHandler: function () {
     //alert('Inital alert'); 
     var form_data = $('#regi_form').serialize();
     $.ajax({
     type: "POST",
     url: site_url + "services/register_user.php",
     async: false,
     data: form_data,
     cache : false,
     processData: false,
     dataType:'JSON',
     beforeSend:function(){
      console.log('Processing...');
      //alert('before send alert');
     },
     success: function(response) {
         //alert('success alert'); 
         var resp = response; //JSON.parse(response); //json to array conversion
         if (resp.error_code == '0') {
           alert(resp.message); 
         } else {
              if (resp.error_code == '1') {
                let errors = resp.errors;
                 $("div#error_msg").html('');
                 $('#regi_form').find("button[type='submit']").prop('disabled',false);
                 $('#login_loader').hide();
                 if (errors.first_name) {
                     $("#first_name_error + small").remove();
                     $("#first_name").addClass("is-invalid");  //red
                     $('#first_name_error').html(errors.first_name);
                 }
                 if (errors.last_name) {
                     $("#last_name_error + small").remove();
                     $("#last_name").addClass("is-invalid");  //red
                     $('#last_name_error').html(errors.last_name);
                 }
                 if (errors.email_id) {
                     $("#email_error + small").remove();
                     $("#email_id").addClass("is-invalid");  //red
                     $('#email_error').show().html(errors.email_id);
                 }
                 if (errors.password) {
                     $("#password + small").remove();
                     $("#password").addClass("is-invalid");
                     $('#password_error').html(errors.password);
                 }
                 if (errors.rpassword) {
                     $("#rpassword + small").remove();
                     $("#rpassword").addClass("is-invalid");
                     $('#rpassword_error').html(errors.rpassword);
                 }
             } else {
                 $("#error_msg").html(resp.message);
                 $('#login_form').find("button[type='submit']").prop('disabled',false);
                 $('#login_loader').hide();
             } 
         }
     },
     complete:function(response){
      //alert('complete alert');
      console.log('action completed...');
     },
     error: function(response) {
      //alert('error alert');
      console.log(response);
         //obj.show_message('error', 'something wrong' + response);
     }
     });
    }
  });

  $('#regi_form').validate({
    rules: {
      first_name: {
        required: true
      },
      last_name: {
        required: true
      },
       terms: {
        required: true
      },
      email_id: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 12
      },
      rpassword: {
        required: true,
        minlength: 6,
        maxlength: 12,
        equalTo : "#password"
      },
    },
    messages: {
     first_name: {
        required: "Please enter first name"
      },
      last_name: {
        required: "Please enter last name"
      },
     email_id: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long",
        maxlength: "Your password should not exceeds 12 characters"
      },
      rpassword: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long",
        maxlength: "Your password should not exceeds 12 characters",
        equalTo: "Password and confirm password not matched."
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.input-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
