<!DOCTYPE html>
<html lang="en">

<head>
    <title> Program SPK</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material/dist/theme/default.css">
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
        {{-- <h3 v-text=" title "></h3> --}}
        <router-view></router-view>
        <footer-component></footer-component>
    </div>
<script src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/vue"></script>
{{-- <script src="https://unpkg.com/vue-material"></script> --}}
</body>

</html>
