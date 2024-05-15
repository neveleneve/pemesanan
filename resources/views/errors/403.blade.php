<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="display-1">403</h1>
        <p class="lead">Forbidden</p>
        <p>You don't have permission to access this resource.</p>
        <a href="{{ url('/') }}" class="btn btn-sm btn-outline-primary fw-bold">Go Home</a>
    </div>
</body>

</html>
