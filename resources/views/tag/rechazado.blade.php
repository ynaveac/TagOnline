@extends('layouts.tag')

@section('titulo_card', 'Rechazado!!')

@section('contenido')

<div class="card text-center">
    <div class="card-header">
      Lamentablemente tu Pago ha sido Rechazado!!
    </div>
    <div class="card-body">
      <!--  
      <h5 class="card-title">Special title treatment</h5>
      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      -->
        <div>
            <i class="fa-solid fa-circle-xmark text-danger fa-10x "></i>
        </div>

    </div>
    <div class="card-footer text-muted">
        <a href="{{ url('/') }}" class="btn btn-primary">Finalizar</a>
    </div>
</div>

@endsection