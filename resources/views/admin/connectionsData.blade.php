@extends('admin.admin-dashbord-temp')
@section('content')
    <div class="doc-data">
        <div class="container-fluid">
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif

            @if(Session::has('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
            @endif
            @if ($conns)
                <table class="table table-hover lms_table_active">
                    <thead class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Connection ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Doctor ID</th>
                        <th scope="col">Request</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">connection Date</th>
                        <th scope="col">Action</th>

                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                        @foreach ($conns as $conn)
                            <tr>
                                <td>{{++$i}}</td>

                                <td>
                                    {{ $conn->id }}
                                </td>
                                <td>
                                    {{ $conn->firstName . ' ' . $conn->lastName }}
                                </td>
                                <td>
                                    <a href="patient/{{$conn->user_id}}">{{ $conn->user_id }}</a>
                                </td>
                                <td>
                                    {{ $conn->name }}
                                </td>
                                <td>
                                    {{ $conn->doctor_id }}
                                </td>
                                <td>
                                    @if ($conn->axcept)
                                        Accepted
                                    @endif
                                </td>
                                <td>
                                    {{ $conn->created_at }}
                                </td>
                                <td>
                                    {{ $conn->updated_at }}
                                </td>

                                <td><a href="deleteConnection/{{$conn->id}}" class="btn btn-primary">Delete</a></td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-danger d-flex align-items-center justify-content-center" role="alert">
                    <div>
                        {{ $message }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
