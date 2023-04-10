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
            @if ($conREQ)
                <table class="table table-hover lms_table_active">
                    <thead class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Request ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Doctor ID</th>
                        <th scope="col">Request</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Action</th>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                        @foreach ($conREQ as $req)
                            <tr>
                                <td>{{++$i}}</td>

                                <td>
                                    {{ $req->id }}
                                </td>
                                <td>
                                    {{ $req->firstName . ' ' . $req->lastName }}
                                </td>
                                <td>
                                    {{ $req->user_id }}
                                </td>
                                <td>
                                    {{ $req->name }}
                                </td>
                                <td>
                                    {{ $req->doctor_id }}
                                </td>
                                <td>
                                    Not Accepted
                                </td>
                                <td>
                                    {{ $req->created_at }}
                                </td>
                                <td><a href="deleteRequest/{{$req->id}}" class="btn btn-primary">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- @endif --}}
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
