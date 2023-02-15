<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


<!-- Scripts -->
<script src="{{url('js/p5.js')}}" type="text/javascript"></script>
<script src="{{url('js/quicksettings.js')}}" type="text/javascript"></script>
<script src="{{url('js/p5.gui.js')}}" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/bd39ac71d1.js" crossorigin="anonymous"></script>
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
