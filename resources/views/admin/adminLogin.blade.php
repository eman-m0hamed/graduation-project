<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-admin.css">

</head>

<body>


    <main class="row main">
        <section class="col-12 col-md-9 col-lg-6">
            <img class="col-12" src="images/aa.jpg" alt="contact" height="100%">
        </section>

        <article class="col-12 col-md-9 col-lg-6 mt-5" id="login">

            <section class="col-lg-11 col-md-12 col-12 p-4 text-center contain"">

                <h1>Admin Login</h1>

                <form action="AdminLogin" method="post" class="gap-3 row">
                    @csrf
                    @if (session('error'))
                        <span class="text-danger"> {{ session('error') }} </span>
                    @endif

                    <label class="col-3">Email</label>
                    <input type="text" name="email" required class="col-8 m-auto p-2 bg-light border rounded"
                        value="{{ old('email') }}">
                    @error('email')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror

                    <label class="col-3">password</label>
                    <input type="password" name="password"  id="inputPassword6" required class="col-8 m-auto p-2 bg-light border rounded">
                    @error('password')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror

                    <a href="forgetPassword" style="text-align: right;">Forget password</a>
                    <input type="submit" value="Login" name="login" class="col-3 mx-auto mt-4 fs-3 border-1 submit">

                </form>
            </section>
        </article>
    </main>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>
