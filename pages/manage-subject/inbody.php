<style>
 .modal-lg, .modal-xl {
    max-width: 1200px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
 <div class="container-fluid">
   <div class="row mb-2">
     <div class="col-sm-6">
       <h1 class="m-0">Subject Management</h1>
     </div><!-- /.col -->
     <div class="col-sm-6">
       <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item">
           <a href="<?php echo $obj->base_url('dashboard'); ?>">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Subject Management</li>
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
           <h3 class="card-title">Subject Management</h3>
           <div class="float-sm-right"><button class="btn btn-primary add_subject">
           Add New Subject</button></div>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="user_table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>Subject Code</th>
               <th>Subject Name</th>
               <th>Subject Type</th>
               <th>Course</th>
               <th>Course Year</th>
               <th>Semister</th>
               <th>Theory Marks</th>
               <th>Practical Marks</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
             <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
             </tr>
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
<div class="modal fade" id="subject_modal">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="modal_title"></h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
            <form id="subject_form" method="post" enctype="multipart/form-data">
                 <div class="card-body">
                   <input type="hidden" name="action" id="action" value="add">
                   <input type="hidden" name="record_id" id="record_id">
                 <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                           <label>Course <span style="color:red;">*</span></label>
                           <select name="course_id" id="course_id" class="form-control">
                           <option value="">Please select</option>
                           <?php foreach($course_list as $key=>$val) {
                           //course_id~course_year~semister 
                           ?>
                          <option value="<?php echo $val['course_id'].'~'.$val['course_year'].'~'.$val['no_of_semister'];?>"><?php echo $val['course_name'];?></option>
                          <?php }?>
                         </select>
                         </div>
                         <div class="form-group">
                         <label>Subject Name <span style="color:red;">*</span></label>
                          <input type="text" class="form-control" name="subject_name" id="subject_name">
                         </div>
                         <div class="form-group">
                         <label>Theory Marks<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" name="theory_marks" id="theory_marks">
                         </div>   

                    </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="form-group">
                          <label>Select Year <span style="color:red;">*</span></label>
                          <select name="course_year" class="form-control" id="course_year">
                           <option value="">Please select course first</option>
                          </select>
                          </div>
                          <div class="form-group">
                           <label>Subject Code<span style="color:red;">*</span></label>
                           <input type="text" readonly class="form-control" name="subject_code" id="subject_code">
                          </div>
                          <div class="form-group">
                          <label>Practical Marks<span style="color:red;">*</span></label>
                          <input type="text" class="form-control" name="practical_marks" id="practical_marks">
                         </div>     
                      </div>
                        
                     <div class="col-md-4 col-sm-4 col-xs-12">
                          <div class="form-group">
                          <label>Semister <span style="color:red;">*</span></label>
                          <select name="semister" class="form-control" id="semister">
                          <option value="">Please select course first</option>
                          </select>
                          </div>
                          <div class="form-group">
                          <label>Subject Type <span style="color:red;">*</span></label>
                          <select name="course_year" class="form-control" id="subject_type">
                           <option value="">Please select</option>
                           <option value="Core">Core</option>
                           <option value="Optional">Optional</option>
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
      $('#subject_form #course_code').val(class_short_form);
      $('#subject_form #coursecode').val(class_short_form);
    }else{
      $('#subject_form #course_code').val('');
      $('#subject_form #coursecode').val(class_short_form);
    }
});

$("#course_id").change(function(e) {
 e.preventDefault();
 let course_string = $(this).val();
 if(course_string!=''){
  let course_array = course_string.split('~');
  //course_id~course_year~semister 
  let course_id = course_array[0];
  let course_year = course_array[1];
  let no_of_semister = course_array[2];
  load_course_year(course_year);
  load_course_semister(no_of_semister);
 }
 //$('#semister').val(sem).change();
}); 

//test
function load_course_year(no_of_year){
 let course_year = '<option value="">Please select</option>';
 for(let i=1;i<=no_of_year;i++){
  course_year += '<option value="'+i+'">'+i+' Year'+'</option>';
 }
 $('#course_year').html(course_year);
}
function load_course_semister(semister){
 let semister_option = '<option value="">Please select</option>';
 for(let i=1;i<=semister;i++){
  semister_option += '<option value="'+i+'">'+i+' Semister'+'</option>';
 }
 $('#semister').html(semister_option);
}

 $(".add_subject").click(function(e) {
   e.preventDefault();
   $('#modal_title').html('Add New Subject');
   $('#subject_form')[0].reset(); 
   $('#action').val('add');
   $('#record_id').val('0');
   $('#saveButton').html('Add');
   show_modal('#subject_modal');
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
   $('#semister').val(noOfSemister).change();
   $('#record_id').val(course_id);
   $('#saveButton').html('Update');
   show_modal('#subject_modal');
});
//------------------------submit action for student add/edit---------------------------------
$(function () {
  $.validator.setDefaults({
     submitHandler: function () {
     //alert('Inital alert');
     var form = $('#subject_form')[0];
     var form_data = new FormData(form);  //$('#subject_form').serialize()
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
          $('#subject_modal').modal('hide');
          location.reload();
          //$('#subject_modal').hide();
         } else {
              if (resp.error_code == '1') {
                 let errors = resp.errors;
                 $("div#error_msg").html('');
                 $('#subject_form').find("button[type='submit']").prop('disabled',false);
                 $.each(errors, function(field_id, error_message) {
                   $("#"+field_id+" + small").remove();
                   $("#"+field_id+"").after("<small class='text-danger'>" + error_message + "</small>");
                });
             } else {
                 $("#error_msg").html(resp.message);
                 $('#subject_form').find("button[type='submit']").prop('disabled',false);
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

  $('#subject_form').validate({
    rules: {
      course_name: {
        required: true
      },
      course_year: {
        required: true
      },
      semister: {
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
      semister: {
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