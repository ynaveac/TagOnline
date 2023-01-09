@extends('layouts.admin')

@section('titulo', 'Adminitración de Locales')

@section('contenido')

    <div class="card">
        <div class="card-header">
        Editar Local
        </div>
        <div class="card-body">
            <form action="{{ route('empleado.update', $emp->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif
                <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="rut" id="rut" placeholder="Rut" maxlength="11" class="form-control form-control-user {{ $errors->has('rut') ? 'is-invalid' : '' }}"
                            oninput="checkRut(this)" pattern="\d{3,8}-[\d|kK]{1}" 
                            @if (is_null(old('rut')))
                                value="{{ $emp->rut }}"
                            @else
                                value="{{ old('rut') }}"      
                            @endif 
                            >
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user {{ $errors->has('pasaporte') ? 'is-invalid' : '' }}" 
                            id="pasaporte" name="pasaporte" placeholder="Pasaporte" maxlength="10"
                            @if (is_null(old('pasaporte')))
                                value="{{ $emp->pasaporte }}"
                            @else
                                value="{{ old('pasaporte') }}"      
                            @endif 
                            >
                        </div>                    
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" name="nombre" id="nombre" placeholder="Nombres" maxlength="25" class="form-control form-control-user {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                            @if (is_null(old('nombre')))
                                value="{{ $emp->nombre }}"
                            @else
                                value="{{ old('nombre') }}"      
                            @endif 
                            >
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user {{ $errors->has('apellidos') ? 'is-invalid' : '' }}" 
                            id="apellidos" name="apellidos" placeholder="Apellidos"
                            @if (is_null(old('apellidos')))
                                value="{{ $emp->apellidos }}"
                            @else
                                value="{{ old('apellidos') }}"      
                            @endif 
                            >
                        </div>                    
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            id="password" name='password' placeholder="Password">    
                        </div>  
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mb-6 mb-sm-3">
                            <input type="text" class="form-control form-control-user {{ $errors->has('direccion') ? 'is-invalid' : '' }}" 
                            id="direccion" name="direccion" placeholder="Dirección"
                            @if (is_null(old('direccion')))
                                value="{{ $emp->direccion }}"
                            @else
                                value="{{ old('direccion') }}"      
                            @endif 
                            > 
                        </div>                     
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="local_id">Asociar a Local</label>
                        </div>

                        <select class="custom-select {{ $errors->has('local_id') ? 'is-invalid' : '' }}" id="local_id" name="local_id">
                            <option selected>Seleccione...</option>
                            @foreach ($locales as $item)
                                <option value="{{ $item['id'] }}" @if ( $emp->local_id == $item['id'] ) selected @endif >{{ $item['nombre'] }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <a href="{{ url('empleado') }}" class="btn btn-primary" role="button">Volver</a> 
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