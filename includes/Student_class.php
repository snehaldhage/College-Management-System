<?php
class Student_class extends Mylib
{
    public function __construct()
    {
        parent::__construct(parent::$dbdriver);
    }
    public function manage_student($student_data)
    { 
        $student_data = $_POST;
        $error_counter = 0;
        $errors = array();
        $action = $student_data['action'];
        $record_id = $student_data['record_id'];
        $class_name = $student_data['class_name'];
        $name_prefix = $student_data['name_prefix'];
        $first_name = $student_data['first_name'];
        $middle_name = $student_data['middle_name'];
        $last_name = $student_data['last_name'];
        $gender = $student_data['gender'];
        if ($action == '') {
            $error_counter++;
            $errors['action'] = 'Action is required';
        }
        if ($action == 'edit' && $record_id == '') {
            $error_counter++;
            $errors['record_id'] = 'Record_id is required';
        }
        if ($first_name == '') {
            $error_counter++;
            $errors['first_name'] = 'Please enter first name';
        }
        if ($middle_name == '') {
            $error_counter++;
            $errors['middle_name'] = 'Please enter last name';
        }
        if ($last_name == '') {
            $error_counter++;
            $errors['last_name'] = 'Please enter last name';
        }
        if ($class_name == '') {
            $error_counter++;
            $errors['class_name'] = 'Please select class';
        }
        if ($gender == '') {
            $error_counter++;
            $errors['gender'] = 'Please enter gender';
        }
        if ($error_counter > 0) {
            //validation errors
            $resp['error_code'] = '1'; //validations errors
            $resp['errors'] = $errors;
        } else {
            $student['class_id_fk'] = $class_name;
            $student['first_name'] = $first_name;
            $student['middle_name'] = $middle_name;
            $student['last_name'] = $last_name;
            $student['name_prefix'] = $name_prefix;
            $student['gender'] = $gender;
            if(isset($_FILES['profile']) && $_FILES['profile']['name']!=''){
             $dir = '../assets/uploads/imgs/profile_pics';
             $is_upload = parent::upload_image($_FILES['profile']['name'],$dir,'profile');
             if($is_upload){
               $student['profile_pic'] = $_FILES['profile']['name'];
             }
            } 
           if($action=='add'){
           $result = parent::insert_data('tbl_student', $student);
           if ($result) {
              $resp['error_code'] = 0;
              $resp['message'] = 'Student added successfully';
           } else {
              $resp['error_code'] = 2;
              $resp['message'] = 'Unabel to update student';
           }
          }else{
           $result = parent::update_data('tbl_student', $student,array('student_id'=>$record_id));
           if ($result) {
            $resp['error_code'] = 0;
            $resp['message'] = 'Student record updated';
           } else {
              $resp['error_code'] = 2;
              $resp['message'] = 'Unabel to update student record';
           }
          }
            //submit action
        }
        return $resp;
    }

    public function remove_student($student_id){
     $where = array('student_id'=>$student_id);
     $update_data['is_deleted'] = '1';
     $result = parent::update_data('tbl_student', $update_data,$where);
     if($result){
      $resp['error_code'] = '0';
      $resp['message'] = 'Student record deleted';
     }else{
      $resp['error_code'] = '1';
      $resp['message'] = 'Student record not deleted';
     }
     return $resp;
    }

}
