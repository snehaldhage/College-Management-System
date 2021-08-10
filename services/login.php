<?php 
  require_once '../includes/config.php';
  $login_obj = new Login(); 
  if(isset($_GET['action']) && $_GET['action']=='login'){
    $post_data = $_POST; //print_r($post_data)
    $resp = $login_obj->do_login($post_data); 
    echo json_encode($resp);
  }else if(isset($_GET['action']) && $_GET['action']=='logout'){
   $resp = $login_obj->do_logout(); 
  }else if(isset($_GET['action']) && $_GET['action']=='forgot_password'){
     $post_data = $_POST;
     $resp = $login_obj->forgot_password($post_data); 
     echo json_encode($resp);
  }else if(isset($_GET['action']) && $_GET['action']=='verify_token'){
   $token = $_GET['token'];
   $is_valid_token = $login_obj->verify_token($token);
   if($is_valid_token['error_code']=='0'){
    $redirect_url = $login_obj->base_url().'reset_password.php?token='.
    $is_valid_token['token_data']['password_reset_token'];
    header("Location:".$redirect_url);
    die();
   }else{
    echo $is_valid_token['message'];
   }
 }else if(isset($_GET['action']) && $_GET['action']=='reset_password'){
     $post_data = $_POST;
     $resp = $login_obj->reset_password($post_data); 
     echo json_encode($resp);
 }
  
?>