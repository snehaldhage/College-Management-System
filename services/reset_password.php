<?php 
require_once '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo __site_title;?> | Recover Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/theme_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../assets/theme_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/theme_assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/theme_assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="javascript:void(0)" class="h1">Reset Password</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      <form id="reset_password" method="post">
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <input type="hidden" id="reset_token" name="reset_token" 
        value="<?php echo @$_GET['token'];?>">
        <div class="input-group mb-3">
          <input type="password" name="rpassword" id="rpassword" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="../assets/theme_assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/theme_assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/theme_assets/dist/js/adminlte.min.js"></script>
<script src="../assets/theme_assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../assets/theme_assets/plugins/sweetalert2/sweetalert2.js"></script>
<script src="../assets/theme_assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script src="../assets/js/custom.js"></script>
<script>
const site_url = "<?php echo $obj->base_url(); ?>";
$(function () {
  $.validator.setDefaults({
     submitHandler: function () {
     //alert('Inital alert'); 
     var form_data = $('#reset_password').serialize();
     $.ajax({
     type: "POST",
     url: site_url + "login.php?action=reset_password",
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
          $('#reset_password')[0].reset();
          Swal.fire({
             title: resp.message,
             showDenyButton: false,
             showCancelButton: false,
             confirmButtonText: `Go to login page`,
             denyButtonText: `Don't save`,
             }).then((result) => {
             /* Read more about isConfirmed, isDenied below */
             if (result.isConfirmed) {
             window.location.replace(resp.login_url);
            } 
          })  
         } else {
              if (resp.error_code == '1') {
                let errors = resp.errors;
                 $("div#error_msg").html('');
                 $('#reset_password').find("button[type='submit']").prop('disabled',false);
                 $('#login_loader').hide();
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
                 $('#reset_password').find("button[type='submit']").prop('disabled',false);
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

  $('#reset_password').validate({
    rules: {
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
</script>
</body>
</html>
