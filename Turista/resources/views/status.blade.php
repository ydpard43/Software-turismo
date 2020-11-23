<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
<link rel="stylesheet" type="text/css" href="{!! asset('css/pushbar.css') !!}" >
<link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}" >
<link rel="stylesheet" type="text/css" href="{!! asset('css/map.css') !!}" >
<link rel="stylesheet" type="text/css" href="{!! asset('css/nav.css') !!}" >
<link rel="stylesheet" type="text/css" href="{!! asset('css/lista.css') !!}" >

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<title>@yield('title')</title>
</head>
<body>

	@yield('content')
</body>
</html>