<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('title')
    <!-- style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    @yield('style')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark nav">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand" href="#"><img src="images/logo.png" width="90px"></a>
                <!--put link of home page-->
                <h1 style="display: inline-block">Fighters</h1>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('home')]) href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('search')]) href="search">Search </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('connectionsRequest')]) href="connectionsRequest">Connections Requested</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('connections')]) href="connections">List Of Connections </a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('contactUS')]) href="contactUs">Contact Us </a>
                    </li>


                    <li class="nav-item dropdown">
                        <a @class([
                            'nav-link',
                            'dropdown-toggle',
                            'active' => Request::is('profile'),
                        ]) href="#" role="button" id="navbarDropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle" id="profileIcon"></i>
                            <span style="position: relative;right: 0; top: -7px; left:5px">My Profile <i
                                    class="fa fa-caret-down"></i></span>
                        </a>

                        @if (session('myProfile'))
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">{{ session('myProfile')->name }}</a></li>
                                <li><a class="dropdown-item" href="#">{{ session('myProfile')->email }}</a></li>
                                <li><a class="dropdown-item" href="profile">View Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logOut">Log Out</a></li>
                            </ul>
                        @endif


                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main">




        @yield('main')
        @yield('script')
    </main>

    <!-- end contact section  -->
    {{-- <footer>
        <div class="copyright">
            Copyright ©2022 All rights reserved | This website is made with <i class="far fa-heart"></i> by <a
                href="#!">Fighters Team</a>
        </div>
    </footer> --}}

</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"
    integrity="sha512-CEiA+78TpP9KAIPzqBvxUv8hy41jyI3f2uHi7DGp/Y/Ka973qgSdybNegWFciqh6GrN2UePx2KkflnQUbUhNIA=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"
    integrity="sha512-d8F1J2kyiRowBB/8/pAWsqUl0wSEOkG5KATkVV4slfblq9VRQ6MyDZVxWl2tWd+mPhuCbpTB4M7uU/x9FlgQ9Q=="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="/js/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="js/script.js"></script>

</html>
