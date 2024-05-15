<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="display-1">404</h1>
        <p class="lead">Not Found</p>
        <p>The resource you are looking for could not be found.</p>
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-primary fw-bold">Go Home</a>
    </div>
</body>

</html>
