<!DOCTYPE html>
<html lang="en">
<head>
    <title> Program SPK</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <style>
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <div id="app">

                <header-component></header-component>
                <h3 v-text = " title "></h3>
                <router-view></router-view>
                {{-- <example-component></example-component> --}}
                <footer-component></footer-component>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
