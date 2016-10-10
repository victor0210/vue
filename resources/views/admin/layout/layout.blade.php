<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8"/>
    <title>Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel="stylesheet" href="{{ elixir("css/styles.css") }}"/>
</head>
<body>
@yield('content')
<script src="{{ elixir("assets/js/admin.js") }}" type="text/javascript"></script>
</body>
</html>