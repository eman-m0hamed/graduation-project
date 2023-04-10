@extends('firstTemplate')

@section('title')
    <title>Reset Password</title>
@endsection

@section('main')
    <div class="row justify-content-center">
        <div class="card mb-3 mt-5 col-4 text-center">
            <div class="mt-2 alert alert-success d-flex align-items-center text-center" role="alert">
                <i class="fa-regular fa-circle-check"></i>
                &nbsp;
                <div>
                    {{ $success }}
                </div>
            </div>
            <div class="mt-2"><img src="images/logo.png" width="120px"></div>
            <div class="card-body">
                <article class="row art">
                    <article class="mt-1" id="forget">
                        <section class="mx-auto p-4 text-center contain">
                            <form action="finishReset" method="post" class="d-grid gap-3 ">
                                @csrf
                                <input name="conf" type="hidden" value="{{ $conf_num }}">
                                <input name="confemail" type="hidden" value="{{ $con_email }}">
                                <input name="rest" type="text" placeholder="Enter Confirm Number" required
                                    class="col-12 m-auto p-2 bg-light border rounded">
                                <input name="password" type="password" placeholder="New Password*"
                                    class="col-12 m-auto p-2 bg-light border rounded" value="{{ old('password') }}">
                                <input name="password_confirmation" type="password" placeholder="Confirm Password*"
                                    class="col-12 m-auto p-2 bg-light border rounded"
                                    value="{{ old('password_confirmation') }}">
                                <button class="btn" style="background-color: #6c63ff">Confirm</button>
                            </form>

                        </section>
                    </article>

                </article>
            </div>

        </div>
    </div>
@endsection
