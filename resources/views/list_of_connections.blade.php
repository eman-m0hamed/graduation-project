@extends('doctorTemplate')

@section('title')
    <title>Connections</title>
@endsection

@section('style')
    <link rel="stylesheet" href="css/connections_style.css">
@endsection

@section('main')

    <article id="connections">
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif


        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif

        <h2>List Of Connections</h2>

        @if ($connectionsData)
            <table class="table table-hover lms_table_active">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        {{-- <th scope="col">Connection ID</th> --}}
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient National ID</th>
                        <th scope="col">Patient Email</th>
                        <th scope="col">Patient Phone</th>
                        <th scope="col">Date of Request</th>
                        <th scope="col">Date of Connection</th>
                        <th scope="col">Action</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                @php
                    $i = 0;
                @endphp
                @foreach ($connectionsData as $doc)
                    <tr>
                        <td>{{ ++$i }}</td>
                        {{-- <td>{{ $doc->id }}</td> --}}
                        {{-- <td>{{ $doc->User_id }}</td> --}}
                        <td>{{ $doc->firstName . ' ' . $doc->lastName }}</td>
                        <td>{{ $doc->national_id }}</td>
                        <td>{{ $doc->email }}</td>
                        <td>{{ $doc->phone }}</td>

                        <td>{{ $doc->created_at }}</td>
                        <td>{{ $doc->updated_at }}</td>
                        <td><a href="View/{{ $doc->user_id }}" class="btn btn-primary">View</a></td>
                        <td><a href="connectionDelete/{{ $doc->id }}" class="btn btn-primary">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <div id="collapseExample">
                <div class="alert alert-danger d-flex align-items-center" role="alert" style="margin-top: 30px">
                    <div>
                        {{ $CONmsg }}

                    </div>
                </div>
            </div>
        @endif

    </article>

@endsection
