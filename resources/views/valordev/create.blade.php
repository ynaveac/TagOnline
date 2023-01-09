@extends('layouts.admin')

@section('titulo', 'Mantenedor Valores de Devolución')

@section('contenido')

    <div class="card">
        <div class="card-header">
        Crear Nuevo Valor a Cobrar
        </div>
        <div class="card-body">
            <form action="{{ route('valordev.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="number" class="form-control form-control-user {{ $errors->has('valor') ? 'is-invalid' : '' }}" 
                        id="valor" name="valor"  value="{{ old('valor') }}" placeholder="Ingrese Valor $">
                    </div>                  
                </div>

                <a href="{{ url('valordev') }}" class="btn btn-primary" role="button">Volver</a> 
                <button type="submit" class="btn btn-success" role="button">Guardar</button>
              </form>        
           
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush