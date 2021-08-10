<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
 <div class="container-fluid">
   <div class="row mb-2">
     <div class="col-sm-6">
       <h1 class="m-0">Course Management</h1>
     </div><!-- /.col -->
     <div class="col-sm-6">
       <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item">
           <a href="<?php echo $obj->base_url('dashboard'); ?>">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Course Management</li>
       </ol>
     </div><!-- /.col -->
   </div><!-- /.row -->
 </div><!-- /.container-fluid -->
 <section class="content">
 <div class="container-fluid">
 <div class="row">
 <div class="col-12">
       <div class="card">
         <div class="card-header">
           <h3 class="card-title">Course Management</h3>
           <div class="float-sm-right"><button class="btn btn-primary add_class">
           Add New Course</button></div>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="user_table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>Course Code</th>
               <th>Course Name</th>
               <th>No of Years</th>
               <th>No of Semester</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
             <?php 
             if(!empty($course_list)){
              foreach($course_list as $k=>$v){
              ?>
             <tr>
              <td class="courseCode"><?php echo $v['course_code']; ?></td>
              <td class="courseName"><?php echo $v['course_name']; ?></td>
              <td class="courseYear"><?php echo $v['course_year']; ?></td>
              <td class="noOfSemister"><?php echo $v['no_of_semister']; ?></td>
              <td>
              <a href="javascript:void(0)" data-value="<?php echo $v['course_id']; ?>"
               data-toggle="tooltip" data-placement="right"
               title="Edit Student" class="btn bg-gradient-primary btn-xs edit_course">
               <i class="fas fa-edit"></i></a>
               <a href="javascript:void(0)" data-value="<?php echo $v['course_id']; ?>"
               data-toggle="tooltip" data-placement="right"
               title="Delete Course" class="btn bg-gradient-danger btn-xs delete_course">
               <i class="fas fa-trash"></i></a> 
              </td>
             </tr>
             <?php 
             } }
             ?>
             </tbody>
             
           </table>
         </div>
         <!-- /.card-body -->
       </div>
       <!-- /.card -->
       <!-- /.card -->
     </div>
     <!-- /.col -->
   </div>
 </div>
  </div>
  </section>
 </div>
</div>
</div>
<!-- add new student modal -->
<div class="modal fade" id="course_modal">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="modal_title"></h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
            <form id="course_form" method="post" enctype="multipart/form-data">
                 <div class="card-body">
                   <input type="hidden" name="action" id="action" value="add">
                   <input type="hidden" name="record_id" id="record_id">
                 <div class="row">
                 <div class="col-md-4 col-sm-4 col-xs-12">
                       <div class="form-group">
                       <label>Course Name <span style="color:red;">*</span></label>
                       <input type="text" minlength="4" onkeypress="return isChar(event)" id="course_name" name="course_name" onchange="reset_error(this.id)" id="middle_name" class="form-control">
                       </div>
                       <div class="form-group">
                       <label>Course Code </label>
                       <input type="text" readonly id="course_code" name="course_code" onchange="reset_error(this.id)" class="form-control">
                       <input type="hidden" id="coursecode" name="coursecode">
                       </div>
                   </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                       <div class="form-group">
                         <label>No of Years <span style="color:red;">*</span></label>
                         <select name="course_year" class="form-control" id="course_year">
                         <option value="">Please select</option>
                         <option value="1">1 Years</option>
                         <option value="2">2 Years</option>
                         <option value="3">3 Years</option>
                         <option value="4">4 Years</option>
                         <option value="5">5 Years</option>
                         </select>
                         </div>
                     </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                         <div class="form-group">
                         <label>No of Semister<span style="color:red;">*</span></label>
                         <select name="no_of_semister" class="form-control" id="no_of_semister">
                         <option value="">Please select</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                         <option value="3">3</option>
                         <option value="4">4</option>
                         <option value="5">5</option>
                         <option value="6">6</option>
                         <option value="8">8</option>
                         <option value="10">10</option>
                         </select>
                         </div>
                     </div>
                 </div>
                 </div>
         </div>
         <div class="modal-footer justify-content-between">
           <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
         </form>
     </div>
     <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
 </div>
 <!-- /.modal -->
<?php include_once 'pages/template/footer.php';?>
<!-- Page specific script -->
<script>
$(function () {
$('.select2bs4').select2({ theme: 'bootstrap4'});
$('#user_table').DataTable({
 "paging": true,
 "lengthChange": true,
 "searching": true,
 "ordering": true,
 "info": true,
 "autoWidth": false,
 "responsive": true,
 // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');
});
$("#course_name").blur(function(e) {
    e.preventDefault(); 
    var course_name = $(this).val(); 
    if(course_name.trim()!='' && course_name.length>4){
    var class_short_form = get_string_short_form(course_name);
      $('#course_form #course_code').val(class_short_form);
      $('#course_form #coursecode').val(class_short_form);
    }else{
      $('#course_form #course_code').val('');
      $('#course_form #coursecode').val(class_short_form);
    }
});

$("#course_year").change(function(e) {
 e.preventDefault();
 let years = $(this).val();
 let sem = years * 2; 
 $('#no_of_semister').val(sem).change();
}); 

 $(".add_class").click(function(e) {
   e.preventDefault();
   $('#modal_title').html('Add New Course');
   $('#course_form')[0].reset(); 
   $('#action').val('add');
   $('#record_id').val('0');
   $('#saveButton').html('Add');
   show_modal('#course_modal');
});

$(".edit_course").click(function() {
   $('#modal_title').html('Edit Course');
   $('#action').val('edit');
   var course_code = $(this).closest("tr").find(".courseCode").text();
   var course_name = $(this).closest("tr").find(".courseName").text();
   var courseYear  = $(this).closest("tr").find(".courseYear").text();
   var noOfSemister = $(this).closest("tr").find(".noOfSemister").text();
   var course_id = $(this).data('value');
   $('#course_name').val(course_name);
   $('#course_code').val(course_code);
   $('#course_year').val(courseYear).change();
   $('#no_of_semister').val(noOfSemister).change();
   $('#record_id').val(course_id);
   $('#saveButton').html('Update');
   show_modal('#course_modal');
});
//------------------------submit action for student add/edit---------------------------------
$(function () {
  $.validator.setDefaults({
     submitHandler: function () {
     //alert('Inital alert');
     var form = $('#course_form')[0];
     var form_data = new FormData(form);  //$('#course_form').serialize()
     $.ajax({
     type: "POST",
     url: site_url + "services/service.php?action=add_update_course",
     processData: false,
     contentType: false,
     data:form_data,
     dataType:'JSON',
     beforeSend:function(){
      console.log('Processing...');
      //alert('before send alert');
     },
     success: function(response) {
         //alert('success alert');
         var resp = response; //JSON.parse(response); //json to array conversion
         if (resp.error_code == '0') {
         //show_message('success',resp.message);
          Swal.fire(
            'Success',
            resp.message,
            'success'
          );
          $('#course_modal').modal('hide');
          location.reload();
          //$('#course_modal').hide();
         } else {
              if (resp.error_code == '1') {
                 let errors = resp.errors;
                 $("div#error_msg").html('');
                 $('#course_form').find("button[type='submit']").prop('disabled',false);
                 $.each(errors, function(field_id, error_message) {
                   $("#"+field_id+" + small").remove();
                   $("#"+field_id+"").after("<small class='text-danger'>" + error_message + "</small>");
                });
             } else {
                 $("#error_msg").html(resp.message);
                 $('#course_form').find("button[type='submit']").prop('disabled',false);
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
         //show_message('error', 'something wrong' + response);
     }
     });
    }
  });

  $('#course_form').validate({
    rules: {
      course_name: {
        required: true
      },
      course_year: {
        required: true
      },
      no_of_semister: {
        required: true
      },
      course_code: {
        required: true
      }
    },
    messages: {
      course_name: {
        required: "Please enter course name"
      },
      course_year: {
        required: "Please select course year"
      },
      no_of_semister: {
        required: "Please select semister"
      },
      course_code: {
        required: "Course code could not be blank"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});

//remove student
$(document).on('click', '.delete_student', function() {
           var student_id = $(this).data('value');
           $el = $(this);
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                   type: "POST",
                   url: site_url + "services/service.php?action=remove_student",
                   dataType: "JSON",
                   data:{student_id:student_id},
                   success: function(resp) {
                     if(resp.error_code=='0'){
                       $el.closest("tr").remove();
                       show_swal('Deleted',resp.message,'success');
                    }else{
                       show_swal('Not Deleted',resp.message,'error');
                       //obj.show_message('error',"Error:Not Deleted");
                   }
                  }
               });
              }
           })
    });

// remove course 
$(document).on('click', '.delete_course', function() {
           var course_id = $(this).data('value');

            $el = $(this);
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                   type: "POST",
                   url: site_url + "services/service.php?action=remove_course",
                   dataType: "JSON",
                   data:{course_id:course_id},
                   success: function(resp) {
                     if(resp.error_code=='0'){
                       $el.closest("tr").remove();
                       show_swal('Deleted',resp.message,'success');
                    }else{
                       show_swal('Not Deleted',resp.message,'error');
                       //obj.show_message('error',"Error:Not Deleted");
                   }
                  }
               });
              }
           })
    });


</script>

</body>
</html>