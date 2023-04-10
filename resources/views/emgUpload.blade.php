
@extends('doctorTemplate')

@section('title')
    <title>Upload EMG</title>
@endsection

@section('style')
    <link rel="stylesheet" href="css/upload_style.css">

    <link rel="stylesheet" href="css/prof_details.css">
@endsection

@section('main')
    <article id="upload">
        <div class="wrapper">

            <header> EMG file upload</header>

            <form class="upForm" id='emgData' action="" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="uploadForm">
                    <input type="file" class="file-input" id="emgFile" name="file" required>
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p> Browse file to Upload</p>
                </div>
                <button type="submit" name="submit" id="emgBtn" class="btn submit">Submit</button>
            </form>


        </div>
    </article>

    <section id="prof_details">
        <div class="container" id="con">

        </div>
    </section>
@endsection
