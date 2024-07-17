@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Bienvenido</h1>
        <p class="lead">Simplifica tu vida, simplifica tu hogar </p>
        <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
        @endauth

        @guest
        <h1>Bienvenido a Vivienda Smart</h1>
        <p class="lead">Por favor, inicie sesion para acceder al mejor catalogo.</p>
        @endguest
    </div>
@endsection
