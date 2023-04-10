@extends('admin.admin-dashbord-temp')
@section('content')
    <div class="doc-data">
        <div class="container-fluid">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if ($signals)
                <table class="table table-hover lms_table_active">
                    <thead class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Signal ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">Signal Type</th>
                        <th scope="col">Signal File</th>
                        <th scope="col">classification </th>
                        <th scope="col">prop_of_seiz</th>
                        <th scope="col">prop_of_non_seiz</th>
                        <th scope="col">Record Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Action</th>
                    </thead>
                    @php
                        $i = 0;
                    @endphp
                    <tbody>
                        @foreach ($signals as $sig)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $sig->id }}
                                </td>
                                <td>
                                    {{ $sig->firstName . ' ' . $sig->lastName }}
                                </td>
                                <td>
                                    {{ $sig->user_id }}
                                </td>
                                <td>
                                    {{ $sig->type }}
                                </td>
                                <td>
                                    <a href="displaysignal/{{ $sig->id }}">{{ $sig->file }}</a>
                                </td>
                                <td>
                                    {{ $sig->classification }}
                                </td>
                                <td>
                                    {{ $sig->prop_of_seiz }}%
                                </td>
                                <td>
                                    {{ $sig->prop_of_non_seiz }}%
                                </td>
                                <td>
                                    {{ $sig->created_at }}
                                </td>
                                <td>
                                    {{ $sig->updated_at }}
                                </td>

                                <td><a href="deleteSignal/{{ $sig->id }}" class="btn btn-primary">Delete</a></td>
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
