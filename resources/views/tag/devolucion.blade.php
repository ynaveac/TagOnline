@extends('layouts.tag')

@section('titulo_card', 'Devolución de Tag!')

@section('imagen', "background-image: url('img/devolver_tag.jpeg')")

@section('contenido')

    <form class="user" action="{{ route('devtag.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tipo" id="tipo" value="3" />
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="rut" id="rut" placeholder="Rut" maxlength="11" class="form-control form-control-user {{ $errors->has('rut') ? 'is-invalid' : '' }}"
                oninput="checkRut(this)" pattern="\d{3,8}-[\d|kK]{1}"  value="{{ old('rut') }}"/>
                <!-- deteccion de error -->
                @if ($errors->has('rut'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user {{ $errors->has('nombre') ? 'is-invalid' : '' }}" 
                id="nombre" name="nombre"  value="{{ old('nombre') }}" placeholder="Nombre">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user {{ $errors->has('apellidos') ? 'is-invalid' : '' }}" 
                    name="apellidos" id="apellidos" placeholder="Apellidos"  value="{{ old('apellidos') }}"/>
            </div>
            <div class="col-sm-6">
                <input type="text" name="telefono" id="telefono" class="form-control form-control-user {{ $errors->has('telefono') ? 'is-invalid' : '' }}" 
                placeholder="Celular : +56912341234" title="Solo puede ingresar numeros" maxlength="12"  value="{{ old('telefono') }}"/>
            </div>
        </div>

        <div class="form-group">
            <input type="email" name="email" id="email" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}" 
            placeholder="Email" maxlength="50"  value="{{ old('email') }}"/>
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="patente" id="patente" class="form-control form-control-user {{ $errors->has('patente') ? 'is-invalid' : '' }}"
                placeholder="Patente" maxlength="6"  value="{{ old('patente') }}"/>
            </div>
            <div class="col-sm-6">
                <input type="text" name="marca" id="marca" class="form-control form-control-user {{ $errors->has('marca') ? 'is-invalid' : '' }}" 
                placeholder="Marca" maxlength="100"  value="{{ old('marca') }}"/>
            </div>
        </div>

        <div class="form-group">
                <input type="text" name="modelo" id="modelo" class="form-control form-control-user {{ $errors->has('modelo') ? 'is-invalid' : '' }}"
                placeholder="Modelo de Vehiculo" maxlength="100"  value="{{ old('modelo') }}"/>
        </div>

        <div class="form-group text-center">
            <h5><p class="small ">Adjuntar Documento</p></h5>
        </div>
        <div class="form-group row">
            <div class="input-group" id="carnetfrontal-form">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="carnetfrontal">Carnet</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input {{ $errors->has('carnetfrontal') ? 'is-invalid' : '' }}" id="carnetfrontal" name="carnetfrontal">
                    <label class="custom-file-label" for="carnetfrontal">Imagen Frontal Carnet</label>
                </div>
            </div>
        </div>

        <br>
        <div class="form-group">
                <input type="submit" value="Continuar" class="btn btn-primary btn-user btn-block" />
        </div>

    </form>

@endsection