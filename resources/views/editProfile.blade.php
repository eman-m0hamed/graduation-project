@extends('doctorTemplate')

@section('title')
<title>Update Profile</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/registration_style.css">
@endsection

@section('main')
<section class="row">

<section style="margin-top: -20px;" class="col-6">
    <img class="col-12 image" src="/images/profile.png" alt="contact" >
</section>

<article class="col-6" id="profileEdit">

    <section class="col-9 mx-auto p-4 text-center contain">
        @if(Session::has('failedProfile'))
            <div class="alert alert-success">{{Session::get('failedProfile')}}</div>
        @endif
        <h1>Edit Profile Data</h1>

        <form action="updateProfile" method="post" class="d-grid gap-3 " >
            @csrf
            @if(session('error')) <span class="text-danger"> {{session('error')}} </span> @endif

            <input required type="text" name="name" placeholder="Your name"  class="col-12 m-auto p-2 bg-light border rounded" value="{{session('myProfile')->name}}">
            @error('name')<span class="text-danger"> {{$message}} </span> @enderror

            <input required type="email" name="email" placeholder="Your Email"  class="col-12 m-auto p-2 bg-light border rounded" value="{{session('myProfile')->email}}">
            @error('email')<span class="text-danger"> {{$message}} </span> @enderror

            <input required type="text" name="address" placeholder="Your address" class="col-12 m-auto p-2 bg-light border rounded" value="{{session('myProfile')->address}}">
            @error('address')<span class="text-danger"> {{$message}} </span> @enderror

            <input required type="text" name="phone" placeholder="Your phone" class="col-12 m-auto p-2 bg-light border rounded" value="{{session('myProfile')->phone}}">
            @error('phone')<span class="text-danger"> {{$message}} </span> @enderror

            <input type="submit" value="Update"  class="col-3 mx-auto  fs-3 border-1 submit">

        </form>
    </section>
</article>
</section>
@endsection
