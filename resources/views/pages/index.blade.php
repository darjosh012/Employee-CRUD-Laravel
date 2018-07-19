@extends('layouts.app')
@section('content')
<main class="py-4">
   <meta name="_token" content="{{csrf_token()}}" />
   
   <div class="container">
     <!------------- Toast -------------->
      <div class="alert alert-info float-center">
          <p><h4>Welcome, {{$currentUser}}!</h4></p>
      </div>
      
       <h1 class="display-4">List of Employees</h1>
       <button type="button" data-toggle="modal" data-target="#addEmployeeModal" class="btn btn-primary float-right">Add Employee</button>
       <div class="table-container">
       @include('pages.employeesTable')
       </div>
    </div>
    
    <!----------- Add Employee Modal --------------->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007bff">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
       <div class="form-group">
              <label for="name">Employee Name:</label>
              <input type="text" class="form-control" id="addName">
            </div>
            <div class="form-group">
              <label for="type">Department:</label>
              <input type="text" class="form-control" id="addDepartment">
            </div>
            <div class="form-group">
               <label for="price">Position:</label>
               <input type="text" class="form-control" id="addPosition">
             </div>   
          <div class="modal-footer">
            <button class="btn btn-primary" id="addEmployeeSubmit">Submit</button>

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      
          </div>
    </div>
  </div>
</div>
</div>
   
    <!---------------- Edit Employee Modal ----------------->
<input id="editEmpID" type ="hidden" value="">
<div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e0a800;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
              <label for="name">Employee Name:</label>
              <input type="text" class="form-control" id="editName">
            </div>
            <div class="form-group">
              <label for="type">Department:</label>
              <input type="text" class="form-control" id="editDepartment">
            </div>
            <div class="form-group">
               <label for="price">Position:</label>
               <input type="text" class="form-control" id="editPosition">
             </div>
          <div class="modal-footer">
           <button class="btn btn-primary" id="editSubmit">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
</div>
</main>
<script>
    //=========== Variables ==========//
    var empName;
    var department;
    var position;
    
    //=========== Animation toast ==========//
    $(".alert").delay(4000).slideUp(500, function() {
    $(this).alert('close');
});
    //======= Getting data from button to Edit Modal ========//
    $('#editEmployeeModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      empName = button.data('name') 
      department = button.data('department')
      position = button.data('position')
      $('input[id="editName"]').val(empName)
      $('input[id="editDepartment"]').val(department)
      $('input[id="editPosition"]').val(position)
    }); 
    
    //========== For Addding Employee ============//
    jQuery(document).ready(function(){
        jQuery('#addEmployeeSubmit').click(function(e){
            e.preventDefault();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            });
            jQuery.ajax({
                url: "{{ url('/employees/store') }}",
                method: 'POST',
                data: {
                    name: jQuery('input[id="addName"]').val(),
                    department: jQuery('input[id="addDepartment"]').val(),
                    position: jQuery('input[id="addPosition"]').val()           
                },
                success:function (result) {   
                    console.log("true");
                    $('div.table-container').fadeOut();
                    $('div.table-container').load('{{url('employees/table')}}', function() {$('div.table-container').fadeIn();});
                    $('#addEmployeeModal').modal('toggle')
                },
            error:function (result){
                    alert('Please enter the fields below');
                }});
        });
    });
    
    //========== For Editing Employee ============//
        $(document).on('click', '.editToModal', function(e){
            var empID = $(this).val();
           $('#editEmpID').val(empID);
            console.log(empID)
        });
    //========== Main function of Edit ==========//
    jQuery(document).ready(function(){
        jQuery('#editSubmit').click(function(e){
            e.preventDefault();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            });
            jQuery.ajax({
                url: "{{ url('/employees/edit') }}",
                method: 'POST',
                data: {
                    id: jQuery('input[id="editEmpID"]').val(),
                    name: jQuery('input[id="editName"]').val(),
                    department: jQuery('input[id="editDepartment"]').val(),
                    position: jQuery('input[id="editPosition"]').val()           
                },
                success:function (result) {   
                    $('div.table-container').fadeOut();
                    $('div.table-container').load('{{url('employees/table')}}', function() {$('div.table-container').fadeIn();});
                    $('#editEmployeeModal').modal('hide')
                },
                error:function (result){
                    alert('Please enter the fields below');
               }
            });
        });
    });
    //=========== For Deleting Employeee ============//
    $(document).on('click', '.deleteEmployee', function(event){
        var toDelete = confirm('Do you want to delete this record?');
        if (toDelete) {
            var button = $(event.relatedTarget) 
            var idDelete = $(this).val();
            console.log(idDelete);
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            });
            jQuery.ajax({
                url: "{{url('/employees/destroy')}}",
                method: "delete",
                data: {
                    employee_id: idDelete
                },
                success:function (result){
                   $('div.table-container').fadeOut();
                    $('div.table-container').load('{{url('employees/table')}}', function() {$('div.table-container').fadeIn();});
            }})
        }
    })
</script>
@endsection