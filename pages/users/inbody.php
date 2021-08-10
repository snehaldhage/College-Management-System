<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
 <div class="container-fluid">
   <div class="row mb-2">
     <div class="col-sm-6">
       <h1 class="m-0">Students</h1>
     </div><!-- /.col -->
     <div class="col-sm-6">
       <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item">
           <a href="<?php echo $obj->base_url('dashboard'); ?>">Dashboard</a>
         </li>
         <li class="breadcrumb-item active">Students</li>
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
           <h3 class="card-title">Student List</h3>
           <div class="float-sm-right"><button class="btn btn-primary add_student">
           Add Student</button></div>
         </div>
         <!-- /.card-header -->
         <div class="card-body">
           <table id="user_table" class="table table-bordered table-hover">
             <thead>
             <tr>
               <th>Name Prefix</th>
               <th>First Name</th>
               <th>Middle Name</th>
               <th>Last Name</th>
               <th>Class Name</th>
               <th>Gender</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
             <?php if (!empty($student_list_array)) {
    foreach ($student_list_array as $k => $v) {
        $gender_class = $v['gender'] == 'Boy' ? 'btn-success' : 'btn-danger';
        ?>
             <tr>
               <td class="name_prefix"><?php echo $v['name_prefix']; ?></td>
               <td class="first_name"><?php echo $v['first_name']; ?></td>
               <td class="middle_name"><?php echo $v['middle_name']; ?></td>
               <td class="last_name"><?php echo $v['last_name']; ?></td>
               <td class="class_name" data-value="<?php echo $v['class_id']; ?>"><?php echo $v['class_name']; ?></td>
               <td class="<?php echo $gender_class; ?> gender"><?php echo $v['gender']; ?></td>
               <td><a href="javascript:void(0)" data-value="<?php echo $v['student_id']; ?>"
               data-toggle="tooltip" data-placement="right"
               title="Edit Student" class="btn bg-gradient-primary btn-xs edit_student">
               <i class="fas fa-edit"></i></a>

               <a href="javascript:void(0)" data-value="<?php echo $v['student_id']; ?>"
               data-toggle="tooltip" data-placement="right"
               title="Delete Student" class="btn bg-gradient-danger btn-xs delete_student">
               <i class="fas fa-trash"></i></a>
               </td>
             </tr>
             <?php }
} else {?>
             <tr><td colspan="6">No data to show</td></tr>
             <?php }?>
             </tbody>
             <!-- <tfoot>
             <tr>
               <th>Rendering engine</th>
               <th>Browser</th>
               <th>Platform(s)</th>
               <th>Engine version</th>
               <th>CSS grade</th>
             </tr>
             </tfoot> -->
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
<div class="modal fade" id="student_modal">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="modal_title"></h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
            <form id="student_form" method="post" enctype="multipart/form-data">
                 <div class="card-body">
                   <input type="hidden" name="action" id="action" value="add">
                   <input type="hidden" name="record_id" id="record_id">
                 <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group">
                       <label>Class <span style="color:red;">*</span></label>
                       <select class="form-control select2bs4"
                        name="class_name" id="class_name">
                        <option value="">Please select class</option>
                        <?php foreach ($class_array as $k => $v) {?>
                        <option value="<?php echo $v['class_id']; ?>">
                        <?php echo $v['class_name']; ?>
                        </option>
                        <?php }?>
                       </select>
                     </div>
                      </div>
                 </div>
                 <div class="row">
                 <div class="col-md-4 col-sm-4 col-xs-12">
                         <div class="form-group">
                         <label>Name Prefix <span style="color:red;">*</span></label>
                         <input type="text"
                         name="name_prefix" id="name_prefix" onchange="reset_error(this.id)" id="first_name" class="form-control">
                         </div>
                     </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                         <div class="form-group">
                         <label>First Name <span style="color:red;">*</span></label>
                         <input type="text" id="first_name" name="first_name" onchange="reset_error(this.id)" id="first_name" class="form-control">
                         </div>
                     </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                       <div class="form-group">
                       <label>Middle Name <span style="color:red;">*</span></label>
                       <input type="text" id="middle_name" name="middle_name" onchange="reset_error(this.id)" id="middle_name" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                       <div class="form-group">
                       <label>Last Name <span style="color:red;">*</span></label>
                       <input type="text" id="last_name" name="last_name" onchange="reset_error(this.id)" id="last_name" class="form-control">
                       </div>
                   </div>
                   <div class="col-md-4 col-sm-4 col-xs-12">
                 <div class="form-group">
                 <label>Gender <span style="color:red;">*</span></label>
                 <select name="gender" class="form-control select2bs4" onchange="reset_error(this.id)" id="gender">
                 <option value="">Please select</option>
                 <option value="Boy">Boy</option>
                 <option value="Girl">Girl</option>
                 </select>
                 </div>
                 </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                    <label>Profile Image</label>
                    <input type="file" name="profile" id="profile" onchange="reset_error(this.id)" 
                     class="form-control">
                    </div>
                  </div>       

                 </div>
                 </div>
         </div>
         <div class="modal-footer justify-content-between">
           <button type="submit" class="btn btn-primary">Save</button>
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

 $(".add_student").click(function(e) {
   e.preventDefault();
   $('#modal_title').html('Add Student'+' <small style="color:red;"> (* represents mandatory fields)</small>');
   $('#student_form')[0].reset(); 
   $('#action').val('add');
   $('#record_id').val('0');
   show_modal('#student_modal');
}); 

$(".edit_student").click(function() {
   $('#modal_title').html('Edit Student');
   $('#action').val('edit');
   var name_prefix = $(this).closest("tr").find(".name_prefix").text();
   var first_name = $(this).closest("tr").find(".first_name").text();
   var middle_name = $(this).closest("tr").find(".middle_name").text();
   var last_name = $(this).closest("tr").find(".last_name").text();
   var gender = $(this).closest("tr").find(".gender").text();
   var class_id = $(this).closest("tr").find(".class_name").data('value');
   var record_id = $(this).data('value');

   $('#name_prefix').val(name_prefix);
   $('#first_name').val(first_name);
   $('#middle_name').val(middle_name);
   $('#last_name').val(last_name);
   $('#gender').val(gender).change();
   $('#class_name').val(class_id).change();
   $('#record_id').val(record_id);

   show_modal('#student_modal');
});
//------------------------submit action for student add/edit---------------------------------
$(function () {
  $.validator.setDefaults({
     submitHandler: function () {
     //alert('Inital alert');
     var form = $('#student_form')[0];
     var form_data = new FormData(form);  //$('#student_form').serialize()
     $.ajax({
     type: "POST",
     url: site_url + "services/service.php?action=add_update_student",
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
          $('#student_modal').modal('hide');
          location.reload();
          //$('#student_modal').hide();
         } else {
              if (resp.error_code == '1') {
                 let errors = resp.errors;
                 $("div#error_msg").html('');
                 $('#student_form').find("button[type='submit']").prop('disabled',false);
                 $('#login_loader').hide();
                 $.each(errors, function(field_id, error_message) {
                   $("#"+field_id+" + small").remove();
                   $("#"+field_id+"").after("<small class='text-danger'>" + error_message + "</small>");
                });
             } else {
                 $("#error_msg").html(resp.message);
                 $('#login_form').find("button[type='submit']").prop('disabled',false);
                 $('#login_loader').hide();
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

  $('#student_form').validate({
    rules: {
     name_prefix: {
        required: true
      },
      first_name: {
        required: true
      },
      middle_name: {
        required: true
      },
      last_name: {
        required: true
      },
      gender: {
        required: true
      },
      class_name: {
        required: true
      },

    },
    messages: {
      name_prefix: {
        required: "Please enter name prefix"
      },
      first_name: {
        required: "Please enter first name"
      },
      middle_name: {
        required: "Please enter middle name"
      },
      last_name: {
        required: "Please enter last name"
      },
      class_name: {
        required: "Please select class",
      },
      gender: {
        required: "Please enter gender",
      },
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

</script>

</body>
</html>