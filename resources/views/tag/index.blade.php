@extends('layouts.tag')

@section('titulo_card', 'Solicita tu Tag Online!')

@section('imagen', "background-image: url('img/solicitud.jpeg')")

@section('contenido')

<div class="form-group ">
    <div class="form-group text-center">
        <h5><p class="small text-primary">Seleccione el Tipo de Solicitud a Realizar :</p></h5>
    </div>  

    <a href="{{ route('natural') }}" class="btn btn-primary btn-user btn-block">
        <i class="fa-solid fa-person"></i>   Persona Natural
    </a>
    <a href="{{ route('empresa') }}" class="btn btn-facebook btn-user btn-block">
        <i class="fa-solid fa-industry"></i>   Empresa
    </a>
</div>

<div class="form-group ">
    <br>
    <div class="form-group text-center">
        <h5><p class="small text-primary">Para Devoluciones de TAG :</p></h5>
    </div>  

    <a href="{{ route('tagdevolucion') }}" class="btn btn-success btn-user btn-block">
        <i class="fa-solid fa-arrow-rotate-left"></i>   Realiza tu Devolución
    </a>

</div>


@endsection