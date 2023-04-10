
@extends('doctorTemplate')

@section('title')
<title>EMG result</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/upload_style.css">
@endsection

@section('main')
<article id="upload">
    <div class="wrapper">

        <header> EEG file upload</header>

        <form class="upForm" id='eegData' action="" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="uploadForm">
                    <input type="file" class="file-input" id="eegFile" name="file" required>
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p> Browse file to Upload</p>
                </div>
                <button type="submit" name="submit" id="eegBtn" class="btn submit">Submit</button>
            </form>


    </div>
</article>
<section class="prof_details">
    <div class="container" id="con2">

    </div>
</section>



@endsection
