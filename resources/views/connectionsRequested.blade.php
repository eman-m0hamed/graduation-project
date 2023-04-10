@extends('doctorTemplate')

@section('title')
    <title>Connections</title>
@endsection

@section('style')
    <link rel="stylesheet" href="css/connections_style.css">
@endsection

@section('main')

    <article id="connections">
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

        @if(Session::has('fail'))
        <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        <h2>Connection Requests</h2>

        @if ($dataRequest)
            <table class="table table-hover lms_table_active">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        {{-- <th scope="col">Request ID</th> --}}
                        <th scope="col">Patient Name</th>
                        <th scope="col">Patient National ID</th>
                        <th scope="col">Patient Email</th>
                        <th scope="col">Patient Phone</th>
                        <th scope="col">Date of request</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                @php
                    $i=0;
                @endphp
                @foreach ($dataRequest as $doc)

                    <tr>
                        <td>{{++$i}}</td>
                        {{-- <td>{{ $doc->id }}</td> --}}
                        <td>{{$doc->firstName . ' ' . $doc->lastName }}</td>
                        <td>{{ $doc->national_id }}</td>
                        <td>{{ $doc->email }}</td>
                        <td>{{ $doc->phone }}</td>
                        <td>{{ $doc->created_at }}</td>
                        <td>
                            <form action="requestCancel/{{$doc->id}}" method="DELETE">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                {{-- <a href="{{Route('Request.cancele', $doc->id)}}" class="btn btn-primary">Cancel</a> --}}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{-- {!!session('Request')->links()!!} --}}
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
