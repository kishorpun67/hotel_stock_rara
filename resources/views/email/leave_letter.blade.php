<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
</head>
<body>
    # Hello Admin

<p>Leave Application by {{$name}}</p>
<a href="{{route('admin.leave')}}">Vist site
</a>
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
</body>
</html>