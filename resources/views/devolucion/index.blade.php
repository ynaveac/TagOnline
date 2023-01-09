@extends('layouts.tag')

@section('titulo_card', 'Devolución de Tag!')

@section('imagen', "background-image: url('img/devolver_tag.jpeg')")

@section('contenido')

<form id="documents" class="user" action="{{ route('devoluciones.store') }}" method="post" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="id_dev" id="id_dev" value="{{ $devolucion[0]->id }}" />
    <div class="form-group ">
        <div class="form-group text-center">
            <h5><p class="small text-primary">Proceso de Devolución de Tag</p></h5>
        </div>  

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
            @endif
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="rut">Rut del Solicitante</label>
                    <input type="text" name="rut" id="rut" placeholder="Rut" maxlength="11" class="form-control form-control-user"
                    value="{{ $devolucion[0]->rut }}" disabled>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-user" 
                    id="nombre" name="nombre" placeholder="Nombre" value="{{ $devolucion[0]->nombre.' '.$devolucion[0]->apellidos }}" disabled>
                </div>                                    
            </div>

            <div class="form-group row">
                <div class="input-group" id="tag-form">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="tag">Serie Tag</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input {{ $errors->has('tag') ? 'is-invalid' : '' }}" id="tag" name="tag">
                        <label class="custom-file-label" for="tag">Imagen de la Serie del Tag.</label>
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