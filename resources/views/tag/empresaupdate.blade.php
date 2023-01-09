@extends('layouts.tag')

@section('titulo_card', 'Solicita tu Tag Online!')

@section('imagen', "background-image: url('https://www.autopista.es/uploads/s1/56/94/52/0/article-10-consejos-para-compartir-coche-y-ahorrar-101655-5418000694cd1.jpeg')")

@section('contenido')

    <form class="user" action="{{ route('request_tag.store') }}" method="post" >
        @csrf
        <input type="hidden" name="fecha_proceso" id="fecha_proceso" value="{{  date('Y-m-d\TH:i', strtotime(now()))  }}" />
        <input type="hidden" name="tipo" id="tipo" value="2" />
        <input type="hidden" name="id" id="id" value="{{ $solicitudes[0]->id }}" />
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="rut" id="rut" placeholder="Rut Empresa" maxlength="11" class="form-control form-control-user {{ $errors->has('rut') ? 'is-invalid' : '' }}"
                oninput="checkRut(this)" pattern="\d{3,8}-[\d|kK]{1}"  
                @if (is_null(old('rut')))
                    value="{{ $solicitudes[0]->rut }}"
                @else
                    value="{{ old('rut') }}"      
                @endif 
                />
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user {{ $errors->has('nombre') ? 'is-invalid' : '' }}" 
                id="nombre" name="nombre"  placeholder="Nombre Empresa"
                @if (is_null(old('nombre')))
                    value="{{ $solicitudes[0]->nombre }}"
                @else
                    value="{{ old('nombre') }}"      
                @endif
                />
            </div>
        </div>        
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="rut_representante" id="rut_representante" placeholder="Rut del Representante" maxlength="11" 
                class="form-control form-control-user {{ $errors->has('rut_representante') ? 'is-invalid' : '' }}"
                oninput="checkRut(this)" pattern="\d{3,8}-[\d|kK]{1}"  
                @if (is_null(old('rut_representante')))
                    value="{{ $solicitudes[0]->rut_representante }}"
                @else
                    value="{{ old('rut_representante') }}"      
                @endif
                />
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control form-control-user {{ $errors->has('nombre_representante') ? 'is-invalid' : '' }}" 
                id="nombre_representante" name="nombre_representante"  placeholder="Nombre del Representante"
                @if (is_null(old('nombre_representante')))
                    value="{{ $solicitudes[0]->nombre_representante }}"
                @else
                    value="{{ old('nombre_representante') }}"      
                @endif
                />
            </div>
        </div>        
        <div class="form-group row">    
                
            <input type="text" class="form-control form-control-user {{ $errors->has('direccion') ? 'is-invalid' : '' }}" 
            name="direccion" id="direccion" placeholder="Dirección Empresa"  
            @if (is_null(old('direccion')))
                value="{{ $solicitudes[0]->direccion }}"
            @else
                value="{{ old('direccion') }}"      
            @endif
            />
            
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="telefono" id="telefono" class="form-control form-control-user {{ $errors->has('telefono') ? 'is-invalid' : '' }}" 
                placeholder="Celular : +56912341234" title="Solo puede ingresar numeros" maxlength="12" 
                @if (is_null(old('telefono')))
                    value="{{ $solicitudes[0]->telefono }}"
                @else
                    value="{{ old('telefono') }}"      
                @endif
                />

            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="email" name="email" id="email" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                placeholder="Email Empresa" maxlength="50"  
                @if (is_null(old('email')))
                    value="{{ $solicitudes[0]->email }}"
                @else
                    value="{{ old('email') }}"      
                @endif
                />
            </div>            
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="patente" id="patente" class="form-control form-control-user {{ $errors->has('patente') ? 'is-invalid' : '' }}"
                placeholder="Patente" maxlength="11"  
                @if (is_null(old('patente')))
                    value="{{ $solicitudes[0]->patente }}"
                @else
                    value="{{ old('patente') }}"      
                @endif
                />
            </div>
            <div class="col-sm-6">
                <input type="text" name="marca" id="marca" class="form-control form-control-user {{ $errors->has('marca') ? 'is-invalid' : '' }}" 
                placeholder="Marca" maxlength="100"  
                @if (is_null(old('marca')))
                    value="{{ $solicitudes[0]->marca }}"
                @else
                    value="{{ old('marca') }}"      
                @endif
                />
            </div>
        </div>

        <div class="form-group">
                <input type="text" name="modelo" id="modelo" class="form-control form-control-user {{ $errors->has('modelo') ? 'is-invalid' : '' }}"
                placeholder="Modelo de Vehiculo" maxlength="100" 
                @if (is_null(old('modelo')))
                    value="{{ $solicitudes[0]->marca }}"
                @else
                    value="{{ old('modelo') }}"      
                @endif
                />
        </div>

        <div class="form-group">
            <textarea name="observaciones" id="observaciones" cols="15" rows="2" class="form-control"
            placeholder="Ingrese Un Comentario" maxlength="250">
            @if (is_null(old('observaciones')))
                {{ $solicitudes[0]->observaciones }}
            @else
                {{ old('observaciones') }}"     
            @endif
            </textarea>
        </div>  

        <hr>

        <div class="form-group">
                <input type="submit" value="Continuar" class="btn btn-primary btn-user btn-block" />
        </div>

    </form>

@endsection