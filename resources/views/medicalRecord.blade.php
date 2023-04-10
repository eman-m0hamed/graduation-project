@extends('doctorTemplate')

@section('title')
    <title>Medical Record</title>
@endsection

@section('style')
    <link rel="stylesheet" href="css/medicalRecord_style.css">
@endsection

@section('main')

    <article id="medicalRecord">
        <section class="container">
            <h2>Patient Medical Record</h2>
            @if (session('personalData'))
                <section class="row">
                    <div class="patientD personD">
                        <h3>Personal Data</h3>
                        <p><span>Name:
                            </span>{{ session('personalData')[0]->firstName . ' ' . session('personalData')[0]->lastName }}
                        </p>
                        <p><span>Gender: </span>{{ session('personalData')[0]->gender }}</p>
                        <p style="text-transform: lowercase;"><span>Email: </span>{{ session('personalData')[0]->email }}
                        </p>
                        <p><span>Phone: </span>{{ session('personalData')[0]->phone }}</p>
                        <p><span>Address:
                            </span>{{ session('personalData')[0]->city . ', ' . session('personalData')[0]->country }}</p>
                        <p><span>National ID: </span>{{ session('personalData')[0]->national_id }}</p>
                        <p><span>Birth Day: </span> {{ date('d/m/Y', strtotime(session('personalData')[0]->birth_day)) }}
                        </p>
                        {{-- ->format('Y-m-d H:i:s') --}}
                    </div>
                </section>

            @else{
                <div class="alert alert-primary d-flex align-items-center" role="alert" style="margin-top: 30px">
                    {{ Session::get('PerMsg') }}
                </div>
                }
            @endif

            {{-- signals data --}}
            <section class="row">
                <div class="col patientD signalD ">
                    <h3>Signal Data</h3>
                    @if (session('SignalData'))
                        <table class="table table-hover lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Signal ID</th>
                                    <th scope="col">Classification</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Probability Of Seizure</th>
                                    <th scope="col">Probability Of Non Seizure</th>
                                    <th scope="col">Date of Recording Signal</th>

                                </tr>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            @foreach (session('SignalData') as $signal)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $signal->id }}</td>
                                    <td>{{ $signal->classification }}</td>
                                    <td>{{ $signal->type }}</td>
                                    <td><a href="displaysignals/{{ $signal->id }}">{{ $signal->file }}</a></td>
                                    <td>{{ $signal->prop_of_seiz . '%' }}</td>
                                    <td>{{ $signal->prop_of_non_seiz . '%' }}</td>
                                    <td>{{ $signal->created_at }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div id="collapseExample">
                            <div class="alert  alert-primary d-flex align-items-center" role="alert"
                                style="margin-top: 30px">
                                <div>
                                    {{ Session::get('SigMsg') }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </section>
            {{-- ///////////////////////// --}}
            <section class="row">
                <div class="col patientD symptomlD ">
                    <h3>Symptoms Data</h3>
                    @if (session('SymptomData'))
                        <table class="table table-hover lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">symptoms ID</th>
                                    <th scope="col">Temporary Confusion</th>
                                    <th scope="col">Staring Spell</th>
                                    <th scope="col">Stiff Muscles</th>
                                    <th scope="col">Uncontrollable Movements</th>
                                    <th scope="col">Loss of Consciousness</th>
                                    <th scope="col">Psychological Symptoms</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            @foreach (session('SymptomData') as $symptom)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $symptom->id }}</td>
                                    <td>{{ $symptom->et_1 }}</td>
                                    <td>{{ $symptom->et_2 }}</td>
                                    <td>{{ $symptom->et_3 }}</td>
                                    <td>{{ $symptom->et_4 }}</td>
                                    <td>{{ $symptom->et_5 }}</td>
                                    <td>{{ $symptom->et_6 }}</td>
                                    <td>{{ $symptom->created_at }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div id="collapseExample">
                            <div class="alert  alert-primary d-flex align-items-center" role="alert"
                                style="margin-top: 30px">
                                <div>
                                    {{ Session::get('SymMsg') }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </section>
            <section class="row">
                <div class="col patientD symptomlD ">
                    <h3>Doctors notes</h3>
                    @if (session('notes'))
                        <table class="table table-hover lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Note ID</th>
                                    <th scope="col">Doctor Name</th>
                                    <th scope="col">Doctor Email</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Date Of Adding</th>

                                </tr>
                            </thead>
                            @php
                                $i = 0;
                            @endphp
                            @foreach (session('notes') as $note)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $note->Id }}</td>
                                    <td>{{ $note->name }}</td>
                                    <td>{{ $note->email }}</td>
                                    <td>{{ $note->note }}</td>
                                    <td>{{ $note->created_at }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <div id="collapseExample">
                            <div class="alert  alert-primary d-flex align-items-center" role="alert"
                                style="margin-top: 30px">
                                <div>
                                    {{ Session::get('noteMsg') }}
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </section>

            <section id="addNote">
                <div class="container patientD">
                    @if (session('error'))
                        <span class="text-danger"> {{ session('error') }} </span>
                    @endif

                    @if (session('noteMessage'))
                        <div id="collapseExample">
                            <div class="alert  alert-primary d-flex align-items-center" role="alert"
                                style="margin-top: 30px">
                                <div>
                                    {{ Session::get('noteMessage') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <h3>Adding Note</h3>
                    <form action="note" method="POST" class="row gap-5">
                        @csrf
                        <textarea height="170px" rows="10" name="note" class="col-9"
                            placeholder="Add note to This Patient Like Advice, Specific Medicine Or Routine" required></textarea>
                        <input type="text" name="user_id" value={{ session('personalData')[0]->id }} hidden>
                        <button class="btn btn-primary col-lg-1 col-3 ">Save</button>
                    </form>
                </div>
            </section>

        </section>

    </article>

@endsection
