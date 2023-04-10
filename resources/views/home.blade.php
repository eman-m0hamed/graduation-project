@extends('doctorTemplate')

@section('title')
<title>Home Page</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/home_style.css">
@endsection

@section('main')


<article class="row" id="services">
    <article class="container ">
       <div class="row justify-content-center">
        <span class="col-12">Our Services</span>
        <h3 class="col-12">You can choose the type of signals that you want  to record.</h3>
       </div>
        <section class="cards">
            <section class="container row container gap-3 row justify-content-evenly">
                <div class="one-card col-12 col-lg-5">
                    <i class="fas fa-brain"></i>
                    <h1>
                        EEG Signals
                    </h1>
                    <p>from there you can upload EEG</p>
                    <a class="btns" href="eegUpload">Upload EEG</a>
                </div>
                <!-- ******************* -->
                <div class="one-card col-12 col-lg-5 ">
                    <i class="far fa-sticky-note"></i>
                    <h1>
                        EMG Signals
                    </h1>
                    <p>from there you can upload EMG</p>
                    <a class="btns" href="emgUpload">Upload EMG</a>
                </div>
                <!-- ******************* -->

            </section>
        </section>
        <!-- end cards section  -->
    </article>
</article>
@endsection
