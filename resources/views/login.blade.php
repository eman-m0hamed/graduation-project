@extends('firstTemplate')

@section('title')
<title>login</title>
@endsection


@section('main')


<section class="col-12 col-md-9 col-lg-6" style="margin-top: -10px">
    <img class="col-12" src="images/Login-amico.png" alt="login" height="85%">
</section>

<article class="col-12 col-md-9 col-lg-6" id="login">
    @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
    <section class="col-lg-11 col-md-12 col-12 p-4 text-center contain">


        <h1>Welcome Back</h1>

        <form action="login" method="post" class="gap-3 row" >
            @csrf
            @if(session('error')) <span class="text-danger"> {{session('error')}} </span> @endif

            <label class="col-3">Email</label>
            <input type="text" name="email" required class="col-8 m-auto p-2 bg-light border rounded"  value="{{old('email')}}">
            @error('email')<span class="text-danger"> {{$message}} </span> @enderror

            <label class="col-3">password</label>
            <input type="password" name="password" required class="col-8 m-auto p-2 bg-light border rounded" >
            @error('password')<span class="text-danger"> {{$message}} </span> @enderror

            <a href="/forgetPassword" style="text-align: right;">Forget password</a>
            <input type="submit" value="Login" name="login" class="col-3 mx-auto mt-4 fs-3 border-1 submit">
            <a href="register">Don't have account</a>
        </form>
    </section>
@endsection
