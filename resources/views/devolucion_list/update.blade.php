@extends('layouts.admin')

@section('titulo', 'Panel de Devoluciones Tag')

@section('contenido')

    <div class="card">
        <div class="card-header">
        Tag Nro de Devolución : {{ $devolucion[0]->id }} - Fecha : {{ $devolucion[0]->created_at }}
        </div>
        <div class="card-body">
            <form action="{{ route('devoluciones.update', $devolucion[0]->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif

                <div class="form-group row">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value='Seleccione'>Seleccione...</option>
                            <option value='Solicitud Devolución' @if ($devolucion[0]->estado == "Solicitud Devolución") selected @endif>Solicitud Devolución</option>
                            <option value='Tag Recepcionado' @if ($devolucion[0]->estado == "Tag Recepcionado") selected @endif>Tag Recepcionado</option>
                            <option value='Tag Retirado' @if ($devolucion[0]->estado == "Tag Retirado") selected @endif>Tag Retirado</option>
                        </select>
                    </div>
                </div>

                <!-- Segmento de Documentación ----->
                <div id="accordion">

                    <div class="card">

                        <div class="card-header" id="DesplegableUno">
                            <div class="form-group text-center">

                                <div class="form-check col-sm-12 mb-6 mb-sm-0">
                                    <h5>
                                    <a href="#" class="btn btn-secundary" role="button" data-toggle="collapse" data-target="#collapseUno" aria-expanded="true" aria-controls="collapseOne">
                                        Datos de la Devolución</a> 
                                    </h5>
                                </div>  

                            </div>
                        </div>
                  
                        <div id="collapseUno" class="collapse" aria-labelledby="DesplegableUno" data-parent="#accordion">

                            <div class="card-body">


                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nombre_local">Local Recepción</label>
                                        <input type="text" name="nombre_local" id="nombre_local" placeholder="Nombre Local" maxlength="11" class="form-control form-control-user"
                                        value="{{ $devolucion[0]->nombre_local }}" disabled>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="cod_tag">Codigo Tag</label>
                                        <input type="text" class="form-control form-control-user" 
                                        id="cod_tag" name="cod_tag" placeholder="Codigo Tag" value="{{ $devolucion[0]->cod_tag }}">
                                    </div>                                       
                                </div>     

                                @if (!is_null($devolucion[0]->rutempresa))
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="rutempresa">Rut Empresa</label>
                                            <input type="text" name="rutempresa" id="rutempresa" maxlength="11" class="form-control form-control-user"
                                            value="{{ $devolucion[0]->rutempresa }}" disabled>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="nombreempresa">Nombre Empresa</label>
                                            <input type="text" class="form-control form-control-user" 
                                            id="nombreempresa" name="nombreempresa" value="{{ $devolucion[0]->nombreempresa }}"  disabled>
                                        </div>                                       
                                    </div>                                  
                                @endif
   
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="rut">Rut</label>
                                        <input type="text" name="rut" id="rut" maxlength="11" class="form-control form-control-user"
                                        value="{{ $devolucion[0]->rut }}" disabled>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nombres">Nombre y Apellido</label>
                                        <input type="text" class="form-control form-control-user" 
                                        id="nombres" name="nombres" value="{{ $devolucion[0]->nombre.' '.$devolucion[0]->apellidos }}"  disabled>
                                    </div>                                       
                                </div>  
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" name="telefono" id="telefono" maxlength="11" class="form-control form-control-user"
                                        value="{{ $devolucion[0]->telefono }}" disabled>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control form-control-user" 
                                        id="email" name="email" value="{{ $devolucion[0]->email }}" disabled>
                                    </div>                                       
                                </div>  
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label for="patente">Patente</label>
                                        <input type="text" name="patente" id="patente" maxlength="11" class="form-control form-control-user"
                                        value="{{ $devolucion[0]->patente }}" disabled>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label for="marca">Marca</label>
                                        <input type="text" class="form-control form-control-user" id="marca" name="marca" value="{{ $devolucion[0]->marca }}" disabled>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" class="form-control form-control-user" id="modelo" name="modelo"  value="{{ $devolucion[0]->modelo }}" disabled>
                                    </div>                                           
                                </div>  
                            </div>

                        </div>

                    </div>

                    <div class="card">

                        <div class="card-header" id="DesplegableDos">

                            <div class="form-group text-center">

                                <div class="form-check col-sm-12 mb-6 mb-sm-0">
                                    <h5>
                                    <a href="#" class="btn btn-secundary" role="button" data-toggle="collapse" data-target="#collapseDos" aria-expanded="true" aria-controls="collapseOne">
                                        Imagen Adjunta</a> 
                                    </h5>
                                </div>
                            </div>

                        </div>
                      
                        <div id="collapseDos" class="collapse" aria-labelledby="DesplegableUno" data-parent="#accordion">

                            <div class="card-body">
                                <div class="form-group row text-center">

                                    @if (isset($devolucion[0]->carnetfrontal))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $devolucion[0]->carnetfrontal }}">Imagen Carnet Frontal</label>
                                            <img name="{{ $devolucion[0]->carnetfrontal }}" src="{{ asset($devolucion[0]->carnetfrontal) }}" class="img-fluid img-thumbnail " alt="Imagen Tag">
                                        </div>
                                    @endif

                                    @if (isset($devolucion[0]->tag))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $devolucion[0]->tag }}">Imagen de Tag Devuelto</label>
                                            <img name="{{ $devolucion[0]->tag }}" src="{{ asset($devolucion[0]->tag) }}" class="img-fluid img-thumbnail " alt="Imagen Tag">
                                        </div>
                                    @endif
                                
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- Segmento de Documentación ----->
                <br>
                <a href="{{ url('devoluciones.list') }}" class="btn btn-primary" role="button">Volver</a> 
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