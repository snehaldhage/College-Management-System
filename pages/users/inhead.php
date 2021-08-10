<?php 
 $obj->validate_user();
 $student_sql = 'SELECT * FROM tbl_student S 
 INNER JOIN tbl_class C ON S.class_id_fk=C.class_id WHERE `S`.`is_deleted`="0" ORDER BY student_id ASC';
 $student_query = $obj->executeQuery($student_sql);
//$student_list = mysqli_fetch_array($student_query);
$student_list_array = array();
while($row = mysqli_fetch_assoc($student_query)){
 $student_list_array[] = $row; 
}

$class_sql = 'SELECT * FROM tbl_class where is_active="Active"'; 
$class_query = $obj->executeQuery($class_sql);
$class_array = array();
while($row = mysqli_fetch_assoc($class_query)){
 $class_array[] = $row; 
}

//die; 


