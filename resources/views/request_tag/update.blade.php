@extends('layouts.admin')

@section('titulo', 'Panel Solicitudes Tag')

@section('contenido')

    <div class="card">
        <div class="card-header">
        Tag Nro de Solicitud : {{ $solicitudes[0]->id }} - Fecha Transacción : {{ $solicitudes[0]->updated_at }}
        </div>
        <div class="card-body">
            <form action="{{ route('request_tag.update', $solicitudes[0]->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif

                <div class="form-group row">
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <label for="estado">Estado de la Solicitud</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value='Seleccione'>Seleccione...</option>
                            <option value='Pendiente' @if ($solicitudes[0]->estado == "Pendiente") selected @endif>Pendiente</option>
                            <option value='Aprobado' @if ($solicitudes[0]->estado == "Aprobado") selected @endif>Aprobado</option>
                            <option value='Tag Retirado' @if ($solicitudes[0]->estado == "Tag Retirado") selected @endif>Tag Retirado</option>
                            <option value='Tag Habilitado' @if ($solicitudes[0]->estado == "Tag Habilitado") selected @endif>Tag Habilitado</option>
                            <option value='Falta Documentación' @if ($solicitudes[0]->estado == "Falta Documentación") selected @endif>Falta Documentación</option>
                        </select>
                    </div>
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        @if ($solicitudes[0]->estado_compra == 'Compra Aprobada')
                            <label class="text-center">Estado Compra : {{ $solicitudes[0]->estado_compra }}
                                <br>
                                <i class="text-success fa-solid fa-check-double fa-2x"></i>
                            </label>
                        @else
                            <label class="text-center">Estado Compra : {{ $solicitudes[0]->estado_compra }}
                                <br>
                                <i class="text-danger fa-regular fa-circle-xmark fa-2x"></i>
                            </label>
                        @endif
                    </div>
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <label class="text-center">Valor Tag : ${{ number_format($solicitudes[0]->total) }}
                            <br>
                            <i class="text-info fa-solid fa-sack-dollar fa-2x"></i>
                        </label>
                    </div>
                    <div class="col-sm-3 mb-2 mb-sm-0">
                        <label class="text-center">Tipo Despacho :
                            <br>
                            @if ($solicitudes[0]->local_retiro == 1)
                                    <i class="text-primary fa-solid fa-shop"></i>
                                @else
                                    <i class="text-secundary fa-solid fa-shop"></i>
                            @endif
                            @if ($solicitudes[0]->local_retiro == 2)
                                    <i class="text-danger fa-solid fa-truck"></i>
                                @else
                                    <i class="text-secundary fa-solid fa-truck"></i>
                            @endif
                            @if ($solicitudes[0]->local_retiro == 3)
                                    <i class="text-success fa-solid fa-truck-fast"></i>
                                @else
                                    <i class="text-secundary fa-solid fa-truck-fast"></i>
                            @endif
                        </label>    
                    </div>
                </div>
                <div class="form-group row">
                    @if ($solicitudes[0]->local_retiro!=1)
                        <div class="col-sm-3 mb-2 mb-sm-0">
                            <label for="cod_seguimiento">Codigo Seguimiento Despacho</label>
                            <input type="text" name="cod_seguimiento" id="cod_seguimiento" value="{{ $solicitudes[0]->cod_seguimiento }}" class="form-control form-control-user" maxlength="20">
                        </div>
                    @endif
                </div>

                <!-- Segmento de Documentación ----->
                <div id="accordion">

                    <div class="card">

                        <div class="card-header" id="DesplegableUno">
                            <div class="form-group text-center">

                                <div class="form-check col-sm-12 mb-6 mb-sm-0">
                                    <h5>
                                    <a href="#" class="btn btn-secundary" role="button" data-toggle="collapse" data-target="#collapseUno" aria-expanded="true" aria-controls="collapseOne">
                                        Datos del Solicitante</a> 
                                    </h5>
                                </div>    

                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="datos1" name="datos" value="completo" @if ($solicitudes[0]->datos == "completo") checked @endif>
                                    <label class="form-check-label text-primary" for="datos1">Item Completo</label>
                                </div>
                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="datos2" name="datos" value="incompleto" @if ($solicitudes[0]->datos == "incompleto") checked @endif>
                                    <label class="form-check-label text-primary" for="datos2">Item Incompleto</label>
                                </div>  
                                             
                            </div>
                        </div>
                  
                        <div id="collapseUno" class="collapse" aria-labelledby="DesplegableUno" data-parent="#accordion">

                            <div class="card-body">

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
                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" placeholder="Direccion" maxlength="11" class="form-control form-control-user"
                                        value="{{ $solicitudes[0]->direccion }}" disabled>
                                    </div>                                
                                </div>
                
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                        <label for="observaciones">Observaciones</label>
                                        <input type="text" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="11" class="form-control form-control-user"
                                        value="{{ $solicitudes[0]->observaciones }}" disabled>
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
                                        Documentación Adjunta</a> 
                                    </h5>
                                </div>

                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="documentos1" name="documentos" value="completo" @if ($solicitudes[0]->documentos == "completo") checked @endif>
                                    <label class="form-check-label text-primary" for="documentos1">Item Completo</label>
                                </div>
                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="documentos2" name="documentos" value="incompleto" @if ($solicitudes[0]->documentos == "incompleto") checked @endif>
                                    <label class="form-check-label text-primary" for="documentos2">Item Incompleto</label>
                                </div> 

                            </div>

                        </div>
                      
                        <div id="collapseDos" class="collapse" aria-labelledby="DesplegableUno" data-parent="#accordion">

                            <div class="card-body">
                                <div class="form-group row text-center">

                                    @if (isset($solicitudes[0]->carnetfrontal))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $solicitudes[0]->carnetfrontal }}">Carnet Frontal</label>
                                            <img name="{{ $solicitudes[0]->carnetfrontal }}" src="{{ asset($solicitudes[0]->carnetfrontal) }}" class="img-fluid img-thumbnail " alt="Carnet Frontal">
                                        </div>
                                    @endif

                                    @if (isset($solicitudes[0]->carnetfrontalempresa))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $solicitudes[0]->carnetfrontalempresa }}">Carnet Frontal Empresa</label>
                                            <img name="{{ $solicitudes[0]->carnetfrontalempresa }}" src="{{ asset($solicitudes[0]->carnetfrontalempresa) }}" class="img-fluid img-thumbnail " alt="Carnet Frontal">
                                        </div>
                                    @endif

                                    @if (isset($solicitudes[0]->primerainscripcion))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $solicitudes[0]->primerainscripcion }}">Primera Inscripción</label>
                                            <img name="{{ $solicitudes[0]->primerainscripcion }}" src="{{ asset($solicitudes[0]->primerainscripcion) }}" class="img-fluid img-thumbnail " alt="Carnet Frontal">
                                        </div>
                                    @endif

                                    @if (isset($solicitudes[0]->compranotarial))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $solicitudes[0]->compranotarial }}">Compra Notarial</label>
                                            <img name="{{ $solicitudes[0]->compranotarial }}" src="{{ asset($solicitudes[0]->compranotarial) }}" class="img-fluid img-thumbnail " alt="Carnet Frontal">
                                        </div>
                                    @endif

                                    @if (isset($solicitudes[0]->padron))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $solicitudes[0]->padron }}">Padron</label>
                                            <img name="{{ $solicitudes[0]->padron }}" src="{{ asset($solicitudes[0]->padron) }}" class="img-fluid img-thumbnail " alt="Carnet Frontal">
                                        </div>
                                    @endif

                                    @if (isset( $solicitudes[0]->cav ))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="{{ $solicitudes[0]->cav }}">CAV</label>
                                            <img name="{{ $solicitudes[0]->cav }}" src="{{ asset($solicitudes[0]->cav) }}" class="img-fluid img-thumbnail " alt="Carnet Frontal">
                                        </div>   
                                    @endif
                                 
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card">

                        <div class="card-header" id="DesplegableTres">

                            <div class="form-group text-center">

                                <div class="form-check col-sm-12 mb-6 mb-sm-0">
                                    <h5>
                                    <a href="#" class="btn btn-secundary" role="button" data-toggle="collapse" data-target="#collapseTres" aria-expanded="true" aria-controls="collapseOne">
                                        Firma Adjunta</a> 
                                    </h5>
                                </div>

                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="firma1" name="firma" value="completo" @if ($solicitudes[0]->firma == "completo") checked @endif>
                                    <label class="form-check-label text-primary" for="firma1">Item Completo</label>
                                </div>
                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="firma2" name="firma" value="incompleto" @if ($solicitudes[0]->firma == "incompleto") checked @endif>
                                    <label class="form-check-label text-primary" for="firma2">Item Incompleto</label>
                                </div>

                            </div>

                        </div>
                      
                        <div id="collapseTres" class="collapse" aria-labelledby="DesplegableTres" data-parent="#accordion">

                            <div class="card-body">
                                <div class="form-group row text-center">
                                    
                                    @if (isset($solicitudes[0]->firmadoc))
                                        <div class="col-sm-2 mb-2 mb-sm-0">
                                            <label for="firma">Firma </label>
                                            <img name="firma" src="{{ $solicitudes[0]->firmadoc }}" class="img-fluid img-thumbnail " alt="Firma">
                                        </div>
                                    @endif
                                 
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card">

                        <div class="card-header" id="DesplegableCuatro">

                            <div class="form-group text-center">

                                <div class="form-check col-sm-12 mb-6 mb-sm-0">
                                    <h5>
                                    <a href="#" class="btn btn-secundary" role="button" data-toggle="collapse" data-target="#collapseCuatro" aria-expanded="true" aria-controls="collapseOne">
                                        Respaldo de Tag Entregado</a> 
                                    </h5>
                                </div>

                            </div>

                        </div>
                    
                        <div id="collapseCuatro" class="collapse" aria-labelledby="DesplegableCuatro" data-parent="#accordion">

                            <div class="card-body">
                                <div class="form-group row text-center">

                                    @if (isset($solicitudes[0]->tagentregado))
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="tagentregado">Tag Entregado </label>
                                            <img style="width: 250px;" name="tagentregado" src="{{ asset($solicitudes[0]->tagentregado) }}" class="img-fluid img-thumbnail " alt="tagentregado">
                                        </div>
                                    @endif
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="cod_tag">Codigo Tag Entregado</label>
                                        <input type="text" name="cod_tag" id="cod_tag" value="{{ $solicitudes[0]->cod_tag }}" class="form-control form-control-user" maxlength="20">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>



                </div>
                <!-- Segmento de Documentación ----->
                <br>
                <a href="{{ url('request_tag') }}" class="btn btn-primary" role="button">Volver</a> 
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