@extends('layouts.tag')

@section('titulo_card', 'Validar Para Entrega de Tag!')

@section('contenido')

<form id="documents" class="user" action="{{ route('comercio.store') }}" method="post" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id_RequestTag" id="id_RequestTag" value="{{ $solicitudes[0]->id }}" />

    <div class="form-group ">
        <div class="form-group text-center">
            <h5><p class="small text-primary">Proceso de Entrega de Tag</p></h5>
        </div>  

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
            @endif
            @if ($solicitudes[0]->tipo == '2')
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="rut_representante">Rut del Representante</label>
                        <input type="text" name="rut_representante" id="rut_representante" placeholder="Rut Representante" maxlength="11" class="form-control form-control-user"
                        value="{{ $solicitudes[0]->rut_representante }}" disabled>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="nombre_representante">Nombre del Representante</label>
                        <input type="text" class="form-control form-control-user" 
                        id="nombre_representante" name="nombre_representante" placeholder="Nombre Representante" value="{{ $solicitudes[0]->nombre_representante }}" disabled>
                    </div>                                       
                </div>     
            @endif

            <div class="form-group row">
                <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="rut">Rut del Solicitante</label>
                    <input type="text" name="rut" id="rut" placeholder="Rut" maxlength="11" class="form-control form-control-user"
                    value="{{ $solicitudes[0]->rut }}" disabled>
                </div>
                <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-user" 
                    id="nombre" name="nombre" placeholder="Nombre" value="{{ $solicitudes[0]->nombre.' '.$solicitudes[0]->apellidos }}" disabled>
                </div>      
                <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="email">Email</label>
                    <input type="text" class="form-control form-control-user" 
                    id="email" name="email" placeholder="Email" value="{{ $solicitudes[0]->email }}" disabled>
                </div>                                     
            </div>

            <div class="form-group row">
                <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="rut">Telefono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Telefono" maxlength="11" class="form-control form-control-user"
                    value="{{ $solicitudes[0]->telefono }}" disabled>
                </div>
                <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="marca">Marca del Vehiculo</label>
                    <input type="text" class="form-control form-control-user" 
                    id="marca" name="marca" placeholder="Marca" value="{{ $solicitudes[0]->marca }}" disabled>
                </div>      
                <div class="col-sm-4 mb-2 mb-sm-0">
                    <label for="modelo">Modelo del Vehiculo</label>
                    <input type="text" class="form-control form-control-user" 
                    id="modelo" name="modelo" placeholder="Modelo" value="{{ $solicitudes[0]->modelo }}" disabled>
                </div>                                     
            </div>
         
            <div class="form-group row">
                <div class="input-group" id="tagentregado-form">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="tagentregado">Serie Tag</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('tagentregado') ? 'is-invalid' : '' }}" id="tagentregado" name="tagentregado">
                        <label class="custom-file-label" for="tagentregado">Imagen de la Serie del Tag.</label>
                    </div>
                </div>            
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="local_id">Local de Retiro</label>
                </div>
                <select class="custom-select {{ $errors->has('local_id') ? 'is-invalid' : '' }}" id="local_id" name="local_id">
                    <option value='' selected>Seleccione...</option>
                    @foreach ($locales as $item)
                        <option value="{{ $item['id'] }}">{{ $item['nombre'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 mb-6 mb-sm-0">
                <label for="pascomercio">Codigo de Empleado</label>
                <input type="password" class="form-control form-control-user {{ $errors->has('pascomercio') ? 'is-invalid' : '' }}" value=""
                id="pascomercio" name="pascomercio" placeholder="Ingrese la Clave del Empleado">
            </div> 

        </div>
        
        <div class="form-group">
            <input type="submit" value="Confirmar Entrega" class="btn btn-primary btn-user btn-block" />
        </div>

    </div>

</form>

@endsection