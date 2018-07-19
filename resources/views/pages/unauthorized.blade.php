@extends('layouts.app')
@section('content')
   <div class="container">
       <img src="http://www.shoutech.in/wp-content/uploads/2017/12/404-Error.png" class="img-fluid" alt="404">
        <p>404: Not Found | You cannot access this page or doesn't exist! Please <a href= "{{url('login')}}">login.</p>
    </div>
@endsection