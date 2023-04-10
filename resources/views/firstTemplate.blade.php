<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @yield('title')
    <!-- style -->
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
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
            <h1 style="display: inline-block">Fighters</h1>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('login')]) href="login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('register')]) href="register">Register</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::is('contact')]) href="contact">Contact US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main class="row main">
        @yield('main')
    </main>


</body>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="fontawesome-free-6.1.1/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="js/script.js"></script>

</html>
