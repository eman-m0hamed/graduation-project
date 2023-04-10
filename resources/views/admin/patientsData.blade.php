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
            @if ($patient_data)
                <table class="table table-hover lms_table_active">
                    <thead class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient Email</th>
                        <th scope="col">Patient Phone</th>
                        <th scope="col">Patient Address </th>
                        <th scope="col">National Id</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Action</th>

                    </thead>

                    @php
                        $i=0;
                    @endphp

                    <tbody>
                        @foreach ($patient_data as $pat)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>
                                    {{ $pat->id }}
                                </td>
                                <td>
                                    {{ $pat->firstName . ' ' . $pat->lastName }}
                                </td>
                                <td>
                                    {{ $pat->email }}
                                </td>
                                <td>
                                    {{ $pat->phone }}
                                </td>
                                <td>
                                    {{ $pat->city . ' - ' . $pat->country }}
                                </td>
                                <td>
                                    {{ $pat->national_id }}
                                </td>
                                <td>
                                    {{ $pat->gender }}
                                </td>
                                <td>
                                    {{ $pat->created_at }}
                                </td>
                                <td>
                                    {{ $pat->updated_at }}
                                </td>
                                <td><a href="deletePatient/{{$pat->id}}" class="btn btn-primary">Delete</a></td>
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
