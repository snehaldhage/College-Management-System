<?php 
require_once '../includes/config.php';
$course_obj = new Course_class();
if(isset($_GET['action']) && $_GET['action']=='add_update_course'){
   $resp['error_code'] = '1';
   $resp['message'] = 'Invalid request method';
   if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
    $resp = $course_obj->manage_course($_POST);
   }
   echo json_encode($resp);
}else if(isset($_GET['action']) && $_GET['action']=='remove_course'){
    $resp['error_code'] = '1';
    $resp['message'] = 'Invalid request method'; 
    $course_id = $_POST['course_id']; 
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
     if($course_id!=''){
      $resp = $course_obj->remove_course($course_id);
     }else{
      $resp['error_code'] = '1';
      $resp['message'] = 'Unable to delete student : Student id missing'; 
     }
    }
    echo json_encode($resp);
 } 




