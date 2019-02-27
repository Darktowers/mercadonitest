<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mercadoni</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="row">
            <div class="col-6 mx-auto">
                <table-container></table-container>
            </div>

        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>