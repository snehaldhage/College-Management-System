<?php
require_once '../includes/config.php';
$reg_obj = new Login();
$resp['error_code'] = '0';
$resp['message'] = 'Invalid request method';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
 $resp = $reg_obj->register_user($_POST);
}
echo json_encode($resp);
