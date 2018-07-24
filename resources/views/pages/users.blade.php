@extends('layouts.app')
@section('content')
   <meta name="_token" content="{{csrf_token()}}" />
    <main class="py-4">
        <div class="container">
          <button class="btn btn-primary float-right" id="addUsers" data-target="#addUserModal" data-toggle="modal">
                   Add Users
               </button>
           <h1 class="display-4">List of Users</h1>
                @include('pages.usersTable')
        </div>
    </main>
    
    <!----------- Add User Modal --------------->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUsersLbl" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007bff">
        <h5 class="modal-title" id="exampleModalLabel">Add Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger dangerAdd" style="display:none">
                  <ul class="edit-alert">
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
      <form>
       <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="addName">
            </div>
            <div class="form-group">
              <label for="nickname">Nickname:</label>
              <input type="text" class="form-control" id="addNickname">
            </div><div class="form-group">
              <label for="emial">Email:</label>
              <input type="email" class="form-control" id="addEmail">
            </div>
            <div class="form-group">
               <label for="password">Password:</label>
               <input type="password" class="form-control" id="addPassword">
             </div>    
             <div class="form-group">
               <label for="confirmPassword">Confirm password:</label>
               <input type="password" class="form-control" id="addConfirmPassword">
             </div>   
             
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="addUserSubmit">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      
          </div>
    </div>
  </div>
</div>

<!----------- Edit User Modal --------------->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUsersLbl" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #e0a800">
        <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>    
      <div class="modal-body">
             <input type="hidden" id="userIdEdit" value="">
              <div class="alert alert-danger dangerEdit" style="display:none">
                  <ul class="edit-alert">
                      @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
       <form>
       <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="editName">
            </div>
            <div class="form-group">
              <label for="nickname">Nickname:</label>
              <input type="text" class="form-control" id="editNickname">
            </div><div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="editEmail">
            </div>
            <div class="form-group">
               <label for="password">Current Password:</label>
               <input type="password" class="form-control" id="currentPassword">
             </div>    
             <div class="form-group">
               <label for="confirmPassword">New password:</label>
               <input type="password" class="form-control" id="newPassword">
             </div>   
             
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="editUserSubmit">Submit</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </div>
    </div>
  </div>
</div>

<script>
    //================ Add user ============== /
    $(document).ready(function(){
        $(document).on('click', '#addUserSubmit', function (e) {
            $('.dangerAdd').text('')
            $('.dangerAdd').hide('')
            if ($("#addPassword").val() != $("#addConfirmPassword").val() ) {
                alert('not match')
                console.log('wrong')
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            })
            $.ajax({
                url: "{{ url('/users/store')}}",
                method: 'POST',
                data: {
                    name: $('input[id="addName"]').val(),
                    nickname: $('input[id="addNickname"]').val(),
                    email: $('input[id="addEmail"]').val(),
                    password: $('input[id="addPassword"]').val(),          
                },
                success:function (result) {
                    console.log('Saved')
                    $('#usersTable').load('{{url('users/table')}}', function (){$('#usersTable').fadeIn()})
                    $('#addUserModal').modal('toggle');
                },
                error:function (request, status, error){
                            $('.dangerAdd').text('')
                            json =$.parseJSON(request.responseText);
                            $.each(json.errors, function(key, value){
                                $('.dangerAdd').show()
                                $('.dangerAdd').append('<p>' + value + '</p>')
                            })
                            $('.dangerAdd').delay(3000).fadeOut(800)
                            }  
            })
        })
   })
// ============= Clear alert modals when closed ==============//
    $('#addUserModal').on('hide.bs.modal', function(e) {
        $('.dangerAdd').text('')
        $('.dangerAdd').hide('')
    })
    $('#editUserModal').on('hide.bs.modal', function(e) {
        $('.dangerEdit').text('')
        $('.dangerEdit').hide('')
    })
//================== Edit User ================//
    $(document).ready(function (){
        $(document).on('click', '.editUser', function (e){
            $("#editName").val($(this).attr('name'))
            $("#editNickname").val($(this).attr('nickname'))
            $("#editEmail").val($(this).attr('email'))
            $("#userIdEdit").val($(this).attr('userid'))
        })
    })
    
   $(document).ready(function (){
        $(document).on('click', '#editUserSubmit', function (e){
             $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                    })
                    $.ajax({
                        url: "{{ url('/users/update')}}",
                        method: 'POST',
                        data: {
                            id: $('#userIdEdit').val(),
                            name: $('input[id="editName"]').val(),
                            nickname: $('input[id="editNickname"]').val(),
                            email: $('input[id="editEmail"]').val(),
                            currentPassword: $('input[id="currentPassword"]').val(),   
                            newPassword: $('input[id="newPassword"]').val(), 
                        },
                        success:function (result) {
                        $('#usersTable').load('{{url('users/table')}}', function (){$('#usersTable').fadeIn()})
                            $('#editUserModal').modal('toggle');
                        },
                        error:function (request, status, error){
                            $('.dangerEdit').text('')
                            json =$.parseJSON(request.responseText);
                            $.each(json.errors, function(key, value){
                                $('.dangerEdit').show()
                                $('.dangerEdit').append('<p>' + value + '</p>')
                                
                            })
                            $('.dangerEdit').delay(3000).fadeOut(800)
                            }       
        })
        })
    })
    
//================= Delete User ==============//
    $(document).ready(function(){
        $(document).on('click', '.deleteUser', function (e){
            var toDelete = confirm('Do you want to delete this record?')
            if (toDelete) {
                var userid = $(this).attr('userid');
                console.log(userid)
                $.ajaxSetup({
                    headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                $.ajax({
                url: "{{url('/users/destroy')}}",
                method: "delete",
                data: {
                    user_id: userid
                },
                success:function (result){
                    console.log('deleted', result);
                    $('#usersTable').fadeOut()
                    $('#usersTable').load('{{url('users/table')}}', function (){ $('#usersTable').fadeIn()})
            }})
            }
        })
    })
    
</script>
@endsection