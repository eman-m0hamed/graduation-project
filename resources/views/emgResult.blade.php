
@extends('doctorTemplate')

@section('title')
<title>EMG result</title>
@endsection

@section('style')
<link rel="stylesheet" href="css/upload_style.css">
@endsection

@section('main')

<section class="result">
    <div class="container">
        <h2>Signal Results</h2>

        <table>
            <tr>
                <td class="labell">Result</td>
                <td><?php echo $result['class_name'] ?></td>
            </tr>

            <tr>
                <td class="labell">Probability of No Tumor</td>
                <td><?php echo $result['prob_no_Seizure'] ?></td>
            </tr>

            <tr>
                <td class="labell">Probability of Tumor</td>
                <td><?php echo $result['prob_Seizure'] ?></td>
            </tr>
        </table>

        <div class="form-btn">
            <button class="submit-btn"><a href="emgUpload">Upload Another Radiology Image</a></button>
            <button class="submit-btn"><a href="home">Done</a></button>

        </div>
    </div>
</section>



@endsection
