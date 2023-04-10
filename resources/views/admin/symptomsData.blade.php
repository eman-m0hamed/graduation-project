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

            @if ($symptoms)
                <table class="table table-hover lms_table_active">
                    <thead class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">symptom ID</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient ID</th>
                        <th scope="col">ET_1</th>
                        <th scope="col">ET_2</th>
                        <th scope="col">ET_3</th>
                        <th scope="col">ET_4</th>
                        <th scope="col">ET_5</th>
                        <th scope="col">ET_6</th>
                        <th scope="col">Enter Date</th>
                        <th scope="col">Update Date</th>
                        <th scope="col">Action</th>
                    </thead>
                    @php
                        $i=0;
                    @endphp
                    <tbody>
                        {{-- @foreach (session('symptoms') as $sym) --}}
                        @foreach ($symptoms as $sym)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>
                                    {{ $sym->id }}
                                </td>
                                <td>
                                    {{ $sym->firstName . ' ' . $sym->lastName }}
                                </td>
                                <td>
                                    {{ $sym->user_id }}
                                </td>
                                <td>
                                    {{ $sym->et_1 }}
                                </td>
                                <td>
                                    {{ $sym->et_2 }}
                                </td>
                                <td>
                                    {{ $sym->et_3 }}
                                </td>
                                <td>
                                    {{ $sym->et_4 }}
                                </td>
                                <td>
                                    {{ $sym->et_5 }}
                                </td>
                                <td>
                                    {{ $sym->et_6 }}
                                </td>
                                <td>
                                    {{ $sym->created_at }}
                                </td>
                                <td>
                                    {{ $sym->updated_at }}
                                </td>

                                <td><a href="deleteSymptom/{{$sym->id}}" class="btn btn-primary">Delete</a></td>

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
