<?php 
$is_valid_user = $obj->validate_user(true);
if($is_valid_user!=-1){
  header('Location: '.$obj->base_url('dashboard'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo __site_title; ?> | Login</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo __site_url; ?>assets/theme_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo __site_url; ?>assets/theme_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo __site_url; ?>assets/theme_assets/dist/css/adminlte.min.css">
</head>
<script>
 const site_url = "<?php echo $obj->base_url(); ?>";
</script>
<body class="hold-transition login-page" style="background-image:url(assets/imgs/login-register.jpg);background-size: cover; background-position: center;
  background-repeat: no-repeat;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="javascript:void(0)" class="h1">Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <p id="error_msg" style="text-align:center;color:#f51313; font-size:20px;"></p>
      <form id="login_form" name="login_form" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email_id"
           onchange="reset_error(this.id,'email_error')" id="email_id" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span id="email_error" class="error invalid-feedback"></span>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" onchange="reset_error(this.id,'password_error')"
           id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span id="password_error" class="error invalid-feedback"></span>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="<?php echo $obj->base_url('forgot_password'); ?>">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="<?php echo $obj->base_url('register'); ?>" class="text-center">Register here</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="<?php echo __site_url; ?>assets/theme_assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo __site_url; ?>assets/theme_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo __site_url; ?>assets/theme_assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo __site_url; ?>assets/theme_assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo __site_url; ?>assets/js/custom.js?v=<?php echo time(); ?>"></script>
<script>
$(function () {
  $.validator.setDefaults({
  submitHandler: function () {
  var form_data = $('#login_form').serialize();
  $.ajax({
  type: "POST",
  url: site_url + "services/login.php?action=login",
  async: false,
  data: form_data,
  cache : false,
  processData: false,
  dataType:'JSON',
  beforeSend:function(){
   console.log('Processing...');
  },
  success: function(response) {
      var login_resp = response; //JSON.parse(response); //json to array conversion
      if (login_resp.error_code == '0') {
       //console.log('login succesful');
       var url = site_url + login_resp.redirect_to;
       window.location.replace(url);
      } else {
          if (login_resp.error_code == '1') {
             let errors = login_resp.errors;
              $("div#error_msg").html('');
              $('#login_form').find("button[type='submit']").prop('disabled',false);
              $('#login_loader').hide();
              if (errors.email_id) {
                  $("#email_error + small").remove();
                  $("#email_id").addClass("is-invalid");  //red
                  $('#email_error').html(errors.email_id);
              }
              if (errors.password) {
                  $("#password + small").remove();
                  $("#password").addClass("is-invalid");
                  $('#password_error').html(errors.password);
              }
          } else {
              $("#error_msg").html(login_resp.message);
              $('#login_form').find("button[type='submit']").prop('disabled',false);
              $('#login_loader').hide();
          }
          console.log('Unable to parse given response');
      }
  },
  complete:function(response){
   console.log('action completed...');
  },
  error: function(response) {
   console.log(response);
      //obj.show_message('error', 'something wrong' + response);
  }
});

    }
  });
  $('#login_form').validate({
    rules: {
      email_id: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6
      },
    },
    messages: {
     email_id: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      }
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

















$(document).on('submit','#login_form',function(e){
  e.preventDefault();
  //$(this).find("button[type='submit']").prop('disabled',true);
  //$('#login_loader').show();

  //var form_data = new FormData(this);

return false;
});


</script>
</body>
</html>