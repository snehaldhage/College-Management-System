<?php
class Login extends Mylib
{
    public function __construct()
    {
        parent::__construct(parent::$dbdriver);
    }
    public function do_login($login_data)
    {
        $email_id = $login_data['email_id'];
        $password = $login_data['password'];
        $error_counter = 0;
        $errors = array();
        if ($email_id != '' && !filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
            $error_counter++;
            $errors['email_id'] = 'Invalid email id';
        }
        if ($email_id == '') {
            $error_counter++;
            $errors['email_id'] = 'Please enter email id';
        }
        if ($password == '') {
            $error_counter++;
            $errors['password'] = 'Please enter password';
        }
        if ($error_counter > 0) {
            //validation errors
            $resp['error_code'] = '1';
            $resp['errors'] = $errors;
        } else {
            $config['table'] = 'tbl_users_login';
            $config['joins'] = 'INNER JOIN `tbl_role_mst`
            ON tbl_users_login.role_id_fk=`tbl_role_mst`.role_id
            INNER JOIN tbl_staff_mst ON tbl_users_login.staff_id_fk=tbl_staff_mst.staff_id';
            $password = parent::encrypt_decrypt($password);
            $config['where'] = '`email_id`="' . $email_id . '" AND `password`="' . $password . '"';
            $result = parent::read_data($config);
            if (!empty($result)) {
                if ($result['is_active'] == '0') {
                    //0 active 1: inactive
                    $_SESSION['fname'] = $result['first_name'];
                    $_SESSION['mname'] = $result['middle_name'];
                    $_SESSION['lname'] = $result['last_name'];
                    $_SESSION['login_id'] = $result['login_id'];
                    $_SESSION['staff_id'] = $result['staff_id'];
                    $_SESSION['college_id'] = $result['college_id_fk'];
                    $resp['error_code'] = '0'; //success
                    $resp['message'] = 'Login successfull';
                    $resp['redirect_to'] = 'dashboard';
                } else {
                    $resp['error_code'] = '2';
                    $resp['message'] = 'Your account is inactive';
                }
            } else {
                $resp['error_code'] = '2';
                $resp['message'] = 'Invalid logins';
            }
        }
        return $resp;
    }
    public function do_logout()
    {
        session_destroy();
        header('Location: ' .__document_root.'login');
    }
    public function register_user($post_data)
    {
        $error_counter = 0;
        $errors = array();
        $first_name = $post_data['first_name'];
        $last_name = $post_data['last_name'];
        $email_id = $post_data['email_id'];
        $password = $post_data['password'];
        $rpassword = $post_data['rpassword'];
        if ($email_id != '' && !filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
            $error_counter++;
            $errors['email_id'] = 'Invalid email id';
        }
        if ($first_name == '') {
            $error_counter++;
            $errors['first_name'] = 'Please enter first name';
        }
        if ($last_name == '') {
            $error_counter++;
            $errors['last_name'] = 'Please enter last name';
        }
        if ($email_id == '') {
            $error_counter++;
            $errors['email_id'] = 'Please enter email id';
        }
        if ($password == '') {
            $error_counter++;
            $errors['password'] = 'Please enter password';
        }
        if ($rpassword == '') {
            $error_counter++;
            $errors['rpassword'] = 'Please enter password';
        }
        if ($password != $rpassword) {
            $error_counter++;
            $errors['rpassword'] = 'Password and confirm password not matched';
        }
        $is_valid_email_id = self::is_valid_email_id($email_id);
        if (!$is_valid_email_id) {
            $error_counter++;
            $errors['email_id'] = 'Email id already taken';
        }
        if ($error_counter > 0) {
            //validation errors
            $resp['error_code'] = '1'; //validations errors
            $resp['errors'] = $errors;
        } else {
            $user_data['email_id'] = $email_id;
            $user_data['first_name'] = $first_name;
            $user_data['last_name'] = $last_name;
            $user_data['password'] = $password;
            $result = parent::insert_data('tbl_login', $user_data);
            if ($result) {
                $resp['error_code'] = 0;
                $resp['message'] = 'User registration successfull';
            } else {
                $resp['error_code'] = 2;
                $resp['message'] = 'Unabel to create user';
            }
        }
        return $resp;
    }
    private function is_valid_email_id($email_id, $is_return_id = false)
    {
        $config['table'] = 'tbl_users_login';
        $config['where'] = '`email_id`="' . $email_id . '" AND `is_deleted`="0"';
        $result = parent::read_data($config);
        if (!empty($result)) {
            if ($is_return_id) {
                return $result['login_id'];
            } else {
                return false;
            }
        } else {
            if ($is_return_id) {
                return -1;
            } else {
                return true;
            }
        }
    }
    public function forgot_password(array $form_data)
    {
      $error_counter = 0;     
      $email_id = $form_data['email_id'];
         if ($email_id != '' && !filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
             $error_counter++;
             $errors['email_id'] = 'Please enter valid email id';
         }
        if ($email_id != '' && filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
            $login_id = self::is_valid_email_id($email_id, true);
            if ($login_id == -1) {
                $error_counter++;
                $errors['email_id'] = 'Entered email id is not registered with us';
            }
        }
        if ($error_counter > 0) {
            $resp['error_code'] = '1'; //validations errors
            $resp['errors'] = $errors;
        }else{
            $reset_token = generate_random_token();
            $insert_data['password_reset_token'] = $reset_token;
            $insert_data['login_id_fk'] = $login_id;
            $insert_data['date_time'] = date('Y-m-d H:i:s');
            $result = parent::insert_data('tbl_password_reset_tokens', $insert_data);
            if ($result) {
                $link_url = parent::base_url() . 'login.php?action=verify_token&token=' . $reset_token;
                //send mail function here
                $email_id = 'bharatmore10991@gmail.com';
                $message = 'Dear User,' . PHP_EOL;
                $message .= 'Please click below link to reset your password at College Management System.' . PHP_EOL . PHP_EOL;
                $message .= '<a href="' . $link_url . '" target="_blank">Reset Password</a>' . PHP_EOL;
                $message .= 'This link is valid for only 1 hour.' . PHP_EOL . PHP_EOL;

                $message .= 'Regards,' . PHP_EOL;
                $message .= 'CMS Team';
                $is_sent_mail = send_mail($email_id, 'Password reset link', $message);
                if ($is_sent_mail) {
                    $resp['error_code'] = '0';
                    $resp['message'] = 'Password reset link has been shared to your email id';
                } else {
                    $resp['error_code'] = '1';
                    $resp['message'] = 'Unable to sent pasword reset token on given email id';
                }
            } else {
                $resp['error_code'] = '1';
                $resp['message'] = 'Unable to sent pasword reset token';
            }
        }
        return $resp;
    }

    public function verify_token($token)
    {
        //verify token here 1 hr
        $where = '`password_reset_token`="' . $token . '" AND `is_used`="0"
       AND `date_time` >= DATE_SUB(NOW(), INTERVAL 1 HOUR)';
        $config['table'] = 'tbl_password_reset_tokens';
        $config['where'] = $where;
        $result = parent::read_data($config);
        if (!empty($result)) {
            //success
            $resp['error_code'] = '0';
            $resp['message'] = 'Valid token';
            $resp['token_data'] = $result;
        } else {
            $resp['error_code'] = '1';
            $resp['message'] = 'Invalid token or expired';
            $resp['token_data'] = array();
            //token invalid or expire
        }
        return $resp;
    }

    public function reset_password($form_data)
    {
        $password = $form_data['password'];
        $rpassword = $form_data['rpassword'];
        $error_counter = 0;
        if ($password == '') {
            $error_counter++;
            $errors['password'] = 'Please enter password';
        }
        if ($rpassword == '') {
            $error_counter++;
            $errors['rpassword'] = 'Please enter password';
        }
        if ($password != $rpassword) {
            $error_counter++;
            $errors['rpassword'] = 'Password and confirm password not matched';
        }
        if ($error_counter > 0) {
            //validation errors
            $resp['error_code'] = '1'; //validations errors
            $resp['errors'] = $errors;
        } else {
            $token_data = self::verify_token($form_data['reset_token']);
            $update_data['password'] = parent::encrypt_decrypt($password);
            $update_data['updated_at'] = date('Y-m-d H:i:s');
            $where = array('login_id' => $token_data['token_data']['login_id_fk']);
            $res = parent::update_data('tbl_users_login', $update_data, $where);
            if ($res) {
                $res = parent::update_data('tbl_password_reset_tokens', array('is_used' => '1'),
                    array('id' => $token_data['token_data']['id']));
                $resp['error_code'] = '0';
                $resp['message'] = 'Password reset successfully';
                $resp['login_url'] = __document_root . 'login';
            } else {
                $resp['error_code'] = '2';
                $resp['message'] = 'Password not reset';
                $resp['login_url'] = '';
            }
        }
        return $resp;
    }

}
