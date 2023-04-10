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
            @if ($doctors)
                <table class="table table-hover lms_table_active">
                    <thead class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Doctor ID</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Doctor Email</th>
                        <th scope="col">Doctor Address </th>
                        <th scope="col">Doctor Phone</th>
                        <th scope="col">Doctor Profession Permit</th>
                        <th scope="col">Register Date</th>
                        <th scope="col">Last Update Date</th>
                        <th scope="col">Action</th>
                    </thead>

                    @php
                        $i=0;
                    @endphp

                    <tbody>
                        @foreach ($doctors as $doc)
                            <tr>
                                <td>{{++$i}}</td>

                                <td>
                                    {{ $doc->id }}
                                </td>
                                <td>
                                    {{ $doc->name }}
                                </td>
                                <td>
                                    {{ $doc->email }}
                                </td>
                                <td>
                                    {{ $doc->address }}
                                </td>
                                <td>
                                    {{ $doc->phone }}
                                </td>
                                <td>
                                    {{ $doc->profession_permit }}
                                </td>
                                <td>
                                    {{ $doc->created_at }}
                                </td>
                                <td>
                                    {{ $doc->updated_at }}
                                </td>
                                <td><a href="CancelAccount/{{$doc->id}}" class="btn btn-primary">Delete</a></td>

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
