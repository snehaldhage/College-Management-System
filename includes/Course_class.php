<?php
class Course_class extends Mylib
{
    public function __construct()
    {
        parent::__construct(parent::$dbdriver);
    }
    public function manage_course($form_data)
    {
        $error_counter = 0;
        $errors = array();
        $action = $form_data['action'];
        $record_id = $form_data['record_id'];
        $course_name = $form_data['course_name'];
        $course_code = $form_data['course_code'];
        $course_year = $form_data['course_year'];
        $no_of_semister = $form_data['no_of_semister'];
        $college_id = $_SESSION['college_id'];
        if ($action == '') {
            $error_counter++;
            $errors['action'] = 'Action is required';
        }
        if ($action == 'edit' && $record_id == '') {
            $error_counter++;
            $errors['record_id'] = 'Record_id is required';
        }
        if ($course_name == '') {
            $error_counter++;
            $errors['course_name'] = 'Please enter course name';
        }
        if ($course_code == '') {
            $error_counter++;
            $errors['course_code'] = 'Course code could not be blank';
        }
        if ($course_year == '') {
            $error_counter++;
            $errors['course_year'] = 'Please select course year';
        }
        if ($no_of_semister == '') {
            $error_counter++;
            $errors['no_of_semister'] = 'Please select no of semister';
        }
        if($action =='add'){
          $check_duplicate = array('course_name'=>$course_name,'college_id_fk'=>$college_id);
          $is_not_added = self::_is_duplicate_entry('tbl_course',$check_duplicate);
          if(!$is_not_added){
           $error_counter++;
           $errors['course_name'] = 'Course name already taken';
          }
        }
        if ($error_counter > 0) {
            //validation errors
            $resp['error_code'] = '1'; //validations errors
            $resp['errors'] = $errors;
        } else {
            $course['course_name'] = $course_name;
            $course['course_code'] = $course_code;
            $course['course_year'] = $course_year;
            $course['no_of_semister'] = $no_of_semister;
            if ($action == 'add') {
                $course['created_at'] = date('Y-m-d H:i:s');
                $course['created_by'] = $_SESSION['staff_id'];
                $course['college_id_fk'] = $_SESSION['college_id'];
                $result = parent::insert_data('tbl_course', $course);
                if ($result) {
                    $resp['error_code'] = 0;
                    $resp['message'] = 'Course added successfully';
                } else {
                    $resp['error_code'] = 2;
                    $resp['message'] = 'Unabel to update course';
                }
            } else {
                $course['updated_at'] = date('Y-m-d H:i:s');
                $course['updated_by'] = $_SESSION['staff_id'];
                $result = parent::update_data('tbl_course', $course, array('course_id' => $record_id));
                if ($result) {
                    $resp['error_code'] = 0;
                    $resp['message'] = 'Course record updated';
                } else {
                    $resp['error_code'] = 2;
                    $resp['message'] = 'Unabel to update course record';
                }
            }
            //submit action
        }
        return $resp;
    }

    public function get_course_list(){
       $course_sql = 'SELECT * FROM tbl_course  WHERE `is_deleted`="0" AND 
      `college_id_fk`="'.$_SESSION['college_id'].'" ORDER BY course_id ASC';
      $course_query = parent::executeQuery($course_sql);
      $course_list_array = array();
      while($row = mysqli_fetch_assoc($course_query)){
        $course_list_array[] = $row; 
       }
       return $course_list_array; 
    }
    //remove course 
    public function remove_course($course_id){
        $where = array('course_id'=>$course_id);
        $update_data['is_deleted'] = '1';
        $update_data['deleted_by'] = $_SESSION['staff_id'];
        $update_data['deleted_at'] = date('Y-m-d H:i:s'); //24 hours date stamp ,h:i:s = 12 hours
        $result = parent::update_data('tbl_course', $update_data,$where);
        if($result){
         $resp['error_code'] = '0';
         $resp['message'] = 'Course record deleted';
        }else{
         $resp['error_code'] = '1';
         $resp['message'] = 'Course record not deleted';
        }
        return $resp;
    }


}
