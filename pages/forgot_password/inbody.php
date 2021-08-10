<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo __site_title; ?> | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo __site_url; ?>assets/theme_assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo __site_url; ?>assets/theme_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo __site_url; ?>assets/theme_assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo __site_url; ?>" class="h1"><?php echo __site_title;?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      <form id="forgot_password_form" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span id="email_error" class="error invalid-feedback"></span>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="<?php echo $obj->base_url('login');?>">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
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
 const site_url = "<?php echo $obj->base_url(); ?>";
</script>
<script>
$(function () {
  $.validator.setDefaults({
  submitHandler: function () {
  var form_data = $('#forgot_password_form').serialize();
  $.ajax({
  type: "POST",
  url: site_url + "services/login.php?action=forgot_password",
  async: false,
  data: form_data,
  cache : false,
  processData: false,
  dataType:'JSON',
  beforeSend:function(){
   console.log('Processing...');
  },
  success: function(response) {
      var resp = response; //JSON.parse(response); //json to array conversion
      if (resp.error_code == '0') {
       alert(resp.message); 
      } else {
          if (resp.error_code == '1') {
             let errors = resp.errors;
              $("div#error_msg").html('');
              $('#forgot_password_form').find("button[type='submit']").prop('disabled',false);
              $('#login_loader').hide();
              if (errors.email_id) {
                  $("#email_error + small").remove();
                  $("#email_id").addClass("is-invalid");  //red
                  $('#email_error').show().html(errors.email_id);
              }
          } else {
              $("#error_msg").html(resp.message);
              $('#forgot_password_form').find("button[type='submit']").prop('disabled',false);
              $('#login_loader').hide();
          }
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
  $('#forgot_password_form').validate({
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
