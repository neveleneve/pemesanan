<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemesanan</title>
</head>

<body>
    <form action="{{ route('pesan') }}" method="post" name="formpesan">
        @csrf
        <input type="hidden" name="meja_id" value="{{ $meja_id }}">
        <input type="hidden" name="meja_token" value="{{ $meja_token }}">
    </form>
    <script>
        window.onload = function() {
            document.forms['formpesan'].submit();
        }
    </script>
</body>

</html>
