@extends('firstTemplate')

@section('title')
    <title>register</title>
@endsection

@section('style')
    <link rel="stylesheet" href="css/registration_style.css">
@endsection

@section('main')
    <section style="margin-top: -20px;" class="col-12 col-md-9 col-lg-6">
        <img class="col-12" src="images/undraw_Personal_info_re_ur1n.png" alt="contact" height="700px">
    </section>

    <article class="col-12 col-md-9 col-lg-6 mt-lg-5" id="registration">

        <section class="col-lg-11 col-md-12 col-12 mx-auto p-4 text-center contain">
            @if (Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

            <h1>Create an account</h1>

            <form action="register" method="post" class="d-grid gap-3 " enctype="multipart/form-data">
                @csrf
                @if (session('error'))
                    <span class="text-danger"> {{ session('error') }} </span>
                @endif

                <input required type="text" name="name" placeholder="Your name"
                    class="col-12 m-auto p-2 bg-light border rounded" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror

                <input required type="email" name="email" placeholder="Your Email"
                    class="col-12 m-auto p-2 bg-light border rounded" value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror

                <input required type="password" name="password" placeholder="Your password"
                    class="col-12 m-auto p-2 bg-light border rounded">
                @error('password')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror

                <input required type="text" name="address" placeholder="Your address"
                    class="col-12 m-auto p-2 bg-light border rounded" value="{{ old('address') }}">
                @error('address')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror

                <input required type="text" name="phone" placeholder="Your phone"
                    class="col-12 m-auto p-2 bg-light border rounded" value="{{ old('phone') }}">
                @error('phone')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror

                <div class="row">
                    <input type="file" accept=".jpg,.jpeg,.png" required class="col-6 m-auto p-2"
                        name="profession_permit">
                    <p class="floatP col-6">Upload the ministry of health licence *</p>
                </div>
                @error('profession_permit')
                    <span class="text-danger"> {{ $message }} </span>
                @enderror
                <input type="submit" value="Create" name="registerDoctor" class="col-lg-4 col-5 col-md-4mx-auto  fs-3 border-1 submit">
                <a href="login">Already have account</a>
            </form>

        </section>
    </article>
@endsection
