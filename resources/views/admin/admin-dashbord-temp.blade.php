<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-admin.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <nav class="navbar-expand-lg navbar-dark navbar nav">
        <div>
            <a class="navbar-brand" href="#"><img src="images/logo.png" width="90px"></a>
            <!--put link of home page-->
            <h1 style="display: inline-block">Fighters</h1>
        </div>
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <div class="justify-content-center collapse navbar-collapse" id="navbarSupportedContent">
            <div class="alert-admin">
                <div class="container  ">
                    <div class="alert" role="alert" style="color: white">
                        Hello From Admin Page , You Can Get Reports About Data You Want Here.
                    </div>
                </div>
            </div>
        </div>
        <ul class="navbar-nav drop">

            <li class="nav-item dropdown">
                <a @class([
                    'nav-link',
                    'dropdown-toggle',
                    'active' => Request::is('profile'),
                ]) href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle" id="profileIcon"></i>
                    <span style="position: relative;right: 0; top: -7px; left:5px">Admin <i
                            class="fa fa-caret-down"></i></span>
                </a>
                @if (session('myProfile'))
                    <ul class="dropdown-menu">
                        <li>
                            <p class="dropdown-item" href="#">{{ session('myProfile')->name }}</p>
                        </li>
                        <li>
                            <p class="dropdown-item" href="#">{{ session('myProfile')->email }}</p>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="LogOut"class="btn btn-primary log_out">Log Out</a></li>
                    </ul>
                @endif
            </li>
            {{-- <li><a class="nav-link" href="LogOut"class="btn btn-primary log_out">Log Out</a></li> --}}

            {{-- ***=====================================** --}}



        </ul>

    </nav>

    <div class="admin-options p-3 " style="margin-top: 80px">
        <div class="container-fluid">
            <div class="row">
                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('admin'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="admin"> Admin Dashboard</a>
                    </div>
                </div>

                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('doctorData'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="doctorData"> Doctor Data</a>
                    </div>
                </div>
                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('patientsData'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="patientsData"> Patient Data</a>
                    </div>
                </div>
                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('signalsData'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="signalsData"> Signals Data</a>
                    </div>
                </div>
                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('symptomsData'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="symptomsData"> Symptoms Data</a>
                    </div>
                </div>
                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('connectionsRequested'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="connectionsRequested"> Requests Data</a>
                    </div>
                </div>
                <div class='col'>
                    <div class="opt-btn">
                        <a @class([
                            'btn-primary' => true,
                            'btn-danger' => Request::is('connection'),
                            'btn' => true,
                            'dataCard'=>true,
                        ]) href="connection"> Connections Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div>@yield('content')</div>
    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/all.min.js"></script>
</body>

</html>
