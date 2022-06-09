<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
</head>
<body>
    <?php
     use App\Admin\Admin;
     $admin = Admin::where('type','Admin')->first();
         ?>
<h3> Hello! {{$name}}</h3>
<p>Your Application has been {{$status}}</p><br>
<p>For more info contact {{$admin->number}} or {{$admin->email}}</p>
<br>
Thanks,<br>
{{$name}}
</body>
</html>