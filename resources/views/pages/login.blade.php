@extends('layouts.app')
@section('content')

<meta name="_token" content="{{csrf_token()}}" />
<div class="container">
 <div class="jumbotron">
  <h1 class="display-4">Login to Portal</h1>
<!--
        {{Form::open(array('url' => 'pages.login'))}}
        <div class="form-group">
            {{Form::label('email', 'Email Address')}}
            {{Form::text ('email', '', array('class' => 'form-control', 'placeholder' => 'email@email.com'))}}
        </div>
        <div class="form-group">
        {{Form::label ('password', 'Password')}}
        {{Form::password ('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
        </div>
        {{Form::submit ('Login', array('class' => 'btn btn-primary float-right'))}}
-->
   <div class="form-group">
       <label for="email">Email</label>
       <input type="email" class="form-control" placeholder="yourEmail@email.com" id="email" required>
   </div>
      <div class="form-group">
       <label for="password">Password</label>
       <input type="password" class="form-control" placeholder="Password" id="password" required>
   </div>
   <button type="submit" class="btn btn-primary float-right" id="loginButton">Login</button>
</div>
</div>
<script>
    $(document).ready(function (){
        $("#loginButton").on('click', function(){
            $.ajaxSetup ({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
            })
            jQuery.ajax({
                url: "{{url('login')}}",
                method: 'POST',
                data: {
                    email: jQuery('input[id="email"]').val(),
                    password: jQuery('input[id="password"]').val()
                },
                success:function (result) {
                  window.location.href = "employees";
                },
                error: function (result) {
                alert('Wrong pass email!')
            }
            })
        })
    })
</script>
@endsection