@extends('admin.admin-dashbord-temp')
@section('content')

    <article class="doc-data container-fluid p-3">
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (Session::has('fail'))
            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif
        <h2>Doctor Requests</h2>

        @if ($DocRequest)
            <table class="table table-hover lms_table_active">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor ID</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Doctor Email</th>
                        <th scope="col">Patient Phone</th>
                        <th scope="col">Doctor Address</th>
                        <th scope="col">Doctor Profession Permit</th>
                        <th scope="col">Date of request</th>
                        <th scope="col" colspan="2">Action</th>
                        {{-- <th scope="col">Action</th> --}}

                    </tr>
                </thead>
                @php
                    $i = 0;
                @endphp
                @foreach ($DocRequest as $doc)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $doc->id }}</td>
                        <td>{{ $doc->name }}</td>
                        <td>{{ $doc->email }}</td>
                        <td>{{ $doc->phone }}</td>
                        <td>{{ $doc->address }}</td>
                        {{-- <td><a href="displayCv/{{ $doc->id }}">{{ $doc->profession_permit }}</a></td> --}}
                        <td><a href="displayCv/{{ $doc->id }}">{{ $doc->profession_permit }}</a></td>
                        <td>{{ $doc->created_at }}</td>
                        <td><a href="AcceptAcount/{{ $doc->id }}" class="btn btn-primary">Approve</a></td>
                        <td><a href="CancelAccount/{{ $doc->id }}" class="btn btn-primary">Delete</a></td>
                    </tr>
                @endforeach
            </table>
        @else
            <div id="collapseExample">
                <div class="alert alert-danger d-flex align-items-center" role="alert" style="margin-top: 30px">
                    <div>
                        {{ $RequestMsg }}
                    </div>
                </div>
            </div>
        @endif

    </article>

@endsection
