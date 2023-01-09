@extends('layouts.tag')

@section('titulo_card', 'Login del Sistema')

@section('imagen', "background-image: url('https://www.autopista.es/uploads/s1/56/94/52/0/article-10-consejos-para-compartir-coche-y-ahorrar-101655-5418000694cd1.jpeg')")

@section('contenido')

    <form class="user" action="valida" method="POST" >
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="email" name ="email" aria-describedby="emailHelp"
                placeholder="Enter Email Address...">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-primary btn-user btn-block">Ingresar al Sistema</button>
        <hr>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="#">Recuperar Password?</a>
    </div>

@endsection