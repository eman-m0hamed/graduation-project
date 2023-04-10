@extends('doctorTemplate')

@section('title')
    <title>Search Patient</title>
@endsection

@section('style')
    <link rel="stylesheet" href="css/search_style.css">
@endsection

@section('main')
    <article id="search">
        <form action="search" class="" method="POST">
            @csrf
            <i class="fas fa-search"></i>
            <input type="search" placeholder="search by patient ID" class="search" name="national_id" required
                value="{{ old('national_id') }}">
            <button type="submit" class="btn btn-primary">Search</button>
            @error('national_id')
                <div class="alert alert-danger" role="alert"> {{ $message }} </div>
            @enderror

        </form>
        @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

        @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @if (Session::has('patient'))
            @if (Session::has('patientReject'))
                <div id="collapseExample">
                    <div class="alert alert-danger" role="alert" style="margin-top: 30px">
                        <div>
                            {{ Session::get('patientReject') }}
                        </div>
                    </div>
                </div>
            @endif
            <table class="table table-hover lms_table_active">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        @if (Session::has('conID'))
                            <th scope="col">Request ID</th>
                            @section('script')
                                <script>
                                   let RequestButton= document.getElementById("RequestButton"),
                                    ID= document.getElementById("conID").textContent;
                                RequestButton.textContent="Cancel Request";
                                RequestButton.href="requestCancel/"+ ID;
                                </script>
                            @endsection
                        @endif

                        {{-- <th scope="col">Patient ID</th> --}}
                        <th scope="col">Patient Name</th>
                        <th scope="col">National ID</th>
                        <th scope="col">Patient Email</th>
                        <th scope="col">Patient Phone</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tr>
                    <td>1</td>
                    @if (Session::has('conID'))
                        <td id="conID">{{ Session::get('conID') }}</td>
                    @endif
                    {{-- <td>{{ Session::get('patient')[0]->id }}</td> --}}

                    <td>{{ Session::get('patient')[0]->firstName . ' ' . session('patient')[0]->lastName }}</td>
                    <td>{{ Session::get('patient')[0]->national_id }}</td>
                    <td>{{ Session::get('patient')[0]->email }}</td>
                    <td>{{ Session::get('patient')[0]->phone }}</td>
                    <td><a id="RequestButton" href="sendRecquest/{{ Session::get('patient')[0]->id }}" class="btn btn-primary">Send Request</a></td>

                </tr>

            </table>
        @elseif (Session::has('patientError'))
            <div id="collapseExample">
                <div class="alert alert-danger" role="alert" style="margin-top: 30px">
                    <div>
                        {{ Session::get('patientError') }}
                    </div>
                </div>
            </div>
        @elseif (Session::has('PatientMessage'))
            <div id="collapseExample">
                <div class="alert alert-primary" role="alert" style="margin-top: 30px">
                    <div>
                        {{ Session::get('PatientMessage') }}
                    </div>
                </div>
            </div>
        @endif


    </article>
@endsection
