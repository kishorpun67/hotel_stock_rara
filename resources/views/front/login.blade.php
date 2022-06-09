@extends('layouts.front_layout.front_layout')
 @section('content')

<section class="banner_slider subpage-slider">
  <figure> <img src="{{asset('frontend/images/pexels-photo-9953821.jpeg')}}" alt=""> </figure>
  <!--<div class="breadCrumbNav">
    <div class="container breadcrumb-container">
      <h1 class="breadCrumb_title"> Water Adventure</h1>
      <div class="breadcumb-inner">
        <ul>
          <li><a href="index.html" class="breadCrumb_link">Home</a></li>
          <li><span>Menu Detail</span></li>
        </ul>
      </div>
    </div>
  </div>--> 
</section>

<!-- ./Main slider ends-->

<section class="login-register">
  <div class="container inner_content">
    <div class="row">
      <div class="col col-sm-6">
        <div class="login_form">
          <h3>Login</h3>
          <form action="{{route('login')}}" method="post">
                @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="email" placeholder="Username/email">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password"  placeholder="password">
            </div>
            <div class="form-group checkbox">
              <label>
                <input id="login-remember" type="checkbox" name="remember" value="1">
                Stay signed in </label>
            </div>
            <button type="submit" class="btn submit-btn btn-login">Sign in</button>
            <div class="form-group forget-text mt-3"> <span>Forgot your password? <a href="forget.html" style="text-decoration:underline;"> Click here</a> to reset your password. </span> </div>
            <div class="form-group"> </div>
          </form>
        </div>
      </div>
      <div class="col col-sm-6">
        <div class="register_form">
          <h3><span style="color:#777;">Don't have a account? </span>Register now</h3>
          <form action="{{route('register')}}" method="post">
                @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="name" placeholder="Full Name">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email address">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Create password">
            </div>
            <div class="form-group">
              <button type="submit" class="btn submit-btn btn-login">Create an Account</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--// footer section starts-->
@endsection