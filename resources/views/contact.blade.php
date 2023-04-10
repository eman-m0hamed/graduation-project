@extends('firstTemplate')

@section('title')
<title>contact us</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/contact_style.css">
@endsection

@section('main')

<section class="col-lg-6 col-12">
    <img class="col-12" src="images/contact.png" alt="contact" height="90%">
</section>

<article class="col-lg-6 col-12 mt-2 mt-lg-5" id="contact">

    <section class="col-11 mx-auto p-4 contain">
        @if (Session::has('error'))
        <div class="alert alert-danger d-flex align-items-center text-center" role="alert">
            <div>
                <i class="fa-solid fa-triangle-exclamation"></i>
                &nbsp;
                {{ Session::get('error') }}
            </div>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success d-flex align-items-center text-center" role="alert">
            <i class="fa-regular fa-circle-check"></i>
            &nbsp;
            <div>
                {{ Session::get('success') }}
            </div>
        </div>
    @endif

        <h1 class="text-center">Contact US</h1>

        <p class="col-12 mx-auto mt-2 mb-4 lh-lg text-center">Please send an email to us at <span>fighters5134@gmail.com or simply</span>
                fill out the form below.
                Normally, I will respond within 48 hours.
            </p>

        <form action="{{ route('send.email') }}" method="post" class="d-grid gap-3 " >
            @csrf
            @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <input type="text" placeholder="Your name*" name="name"  class="col-12 m-auto p-2 bg-light border rounded" required>

            @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <input type="email" placeholder="Your Email*" name="email"  class="col-12 m-auto p-2 bg-light border rounded"required>

            @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <input type="tel" placeholder="Your phone*" name="phone" class="col-12 m-auto p-2 bg-light border rounded"required>

            @error('subj')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <input type="text" placeholder="Your Subject*" name="subj" class="col-12 m-auto p-2 bg-light border rounded"required>

            @error('msg')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            <textarea placeholder="Your message*" name="msg"  rows="4" class="col-12 m-auto p-2 bg-light border rounded"required></textarea>

            <input type="submit" value="Send" class="col-md-3 col-5 mx-auto mt-4 fs-3 border-1 submit">
        </form>
    </section>
</article>
@endsection
