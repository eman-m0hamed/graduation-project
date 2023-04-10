@extends('doctorTemplate')

@section('title')
<title>Home Page</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/contact_style.css">
@endsection

@section('main')
<!-- start contact section -->
<section id="contact">
    <section class="container">
        @if (Session::has('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <div>
                <i class="fa-solid fa-triangle-exclamation"></i>
                &nbsp;
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fa-regular fa-circle-check"></i>
            &nbsp;
            <div>
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

        <h1 class="text-center">Contact US</h1>

        <p class="col-12 mx-auto mt-2 mb-4 lh-lg">Please send an email to us at <span>fighters5134@gmail.com or simply</span>
                fill out the form below.
                Normally, I will respond within 48 hours.
            </p>

        <form action="{{ route('send.email') }}" method="post" class="d-grid gap-3 " >
            @csrf
            <div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="text" placeholder="Your Name" name="name" style="margin-left: 0;" value="{{session('myProfile')->name}}" required>

                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <input type="email" placeholder="Email" name="email"  style="margin-right: 0;" value="{{session('myProfile')->email}}" required>

            </div>
            @error('phone')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="phone" placeholder="phone" name="phone" value="{{session('myProfile')->phone}}" required>

            @error('subj')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" placeholder="Subject" name="subj"  required>

            @error('msg')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <textarea rows="10" placeholder="Massege"  name="msg"  height="170px" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </section>
</section>
<!-- end contact section  -->
@endsection
