@extends('layouts.admin')

@section('titulo', 'Adminitración de Locales')

@section('contenido')

    <div class="card">
        <div class="card-header">
        Crear Nuevo Local
        </div>
        <div class="card-body">
            <form action="{{ route('local.store') }}" method="POST">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="rut" id="rut" placeholder="Rut" maxlength="11" class="form-control form-control-user {{ $errors->has('rut') ? 'is-invalid' : '' }}"
                        oninput="checkRut(this)" pattern="\d{3,8}-[\d|kK]{1}"  value="{{ old('rut') }}"/>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user {{ $errors->has('nombre') ? 'is-invalid' : '' }}" 
                        id="nombre" name="nombre"  value="{{ old('nombre') }}" placeholder="Nombre">
                    </div>                    
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 mb-6 mb-sm-3">
                        <input type="text" class="form-control form-control-user {{ $errors->has('direccion') ? 'is-invalid' : '' }}" 
                        id="direccion" name="direccion"  value="{{ old('direccion') }}" placeholder="Dirección">  
                    </div>                     
                </div>

                <div class="form-group row text-center">
                    <div class="form-check col-sm-6 mb-3 mb-sm-0">
                      <input class="form-check-input" type="checkbox" id="maquina" name="maquina" value="1">
                      <label class="form-check-label" for="maquina">Despacho vía Maquina</label>
                    </div>
                    <div class="form-check col-sm-6 mb-3 mb-sm-0">
                        <input class="form-check-input" type="checkbox" id="kiosko" name="kiosko" value="1">
                        <label class="form-check-label" for="kiosko">Despacho en Local</label>
                      </div>                    
                </div>

                <a href="{{ url('local') }}" class="btn btn-primary" role="button">Volver</a> 
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