@extends('firstTemplate')

@section('title')
    <title>Forget Password</title>
@endsection


@section('main')
    <article class="row art">
        <section class="col-6">
            <img class="col-12" src="../images/forgot.png" alt="contact" height="80%">
        </section>

        <article class="col-6 mt-5" id="forget">

            <section class="col-9 mx-auto p-4 text-center contain">
                @if (Session::has('error'))
                    <div class="alert alert-danger d-flex align-items-center text-center" role="alert">
                        <div>
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            &nbsp;
                            {{ Session::get('error') }}
                        </div>
                    </div>
                @endif
                <h1>Reset Password</h1>
                <form action="resetPass" method="post" class="d-grid gap-3 ">
                    @csrf
                    <input name="email" type="email" placeholder="Your Email*" required
                        class="col-12 m-auto p-2 bg-light border rounded" value="{{ old('email') }}">
                    <input type="submit" value="ReSet" class="col-3 mx-auto mt-4 fs-3 border-1 submit btn btn-primary">
                </form>
            </section>
        </article>
    </article>
@endsection
