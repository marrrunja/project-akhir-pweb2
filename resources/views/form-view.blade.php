<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VIew Form</title>
</head>
<body>
    <h1>Form</h1>
    <form method="post" action="{{ route('post-redirect') }}">
        @csrf
        <input type="text" name="nama">
        <button type="submit">Kirim</button>
    </form>
</body>
</html>
