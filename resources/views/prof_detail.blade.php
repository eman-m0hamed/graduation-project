@extends('doctorTemplate')

@section('title')
<title>Profile Page</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/prof_detail_style.css">
@endsection

@section('main')
<section id="prof_details">
    <section class="container">
        @if(Session::has('updatedProfile'))
            <div class="alert alert-success">{{Session::get('updatedProfile')}}</div>
        @endif
        <i class="fas fa-user-circle prof_icon"></i>
        <h2>My Profile</h2>
                @if (Session::get('myProfile'))
                    <section class="row">
                        <div class="personD">
                            <p><span>Name:
                                </span>{{ session('myProfile')->name}}
                            </p>
                            <p style="text-transform: lowercase;"><span>Email: </span>{{ session('myProfile')->email }}</p>
                            <p>
                                <span>Password: </span>
                                <input type="password" value="{{ session('myProfile')->password }}" readonly>
                            </p>
                            <p><span>Phone: </span>{{ session('myProfile')->phone }}</p>
                            <p><span>Address: </span>{{ session('myProfile')->address }}</p>
                            <p><span>Date Of Creating Account: </span>{{ session('myProfile')->created_at }}</p>
                            <p><span>Last Update Date: </span> {{ session('myProfile')->updated_at  }}
                            </p>
                            {{-- {{ date("Y-m-d",strtotime(session('myProfile')->created_at)); }} --}}
                        </div>
                    </section>
                @endif

        <a class="btn btn-primary prof_btn" href="editProfile">Edit</a>
    </section>
</section>
@endsection
