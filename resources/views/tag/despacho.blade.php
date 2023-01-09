@extends('layouts.tag')

@section('titulo_card', 'Solicita tu Tag Online!')

@section('imagen', "background-image: url('img/despacho.png')")

@section('contenido')

<div class="form-group ">

    <div class="card">
        <div class="card-header">
            Tipo de Entrega
        </div>
        <div class="card-body">
            <form action="{{ route('despacho.store') }}" method="POST">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif

                <input type="text" name="id_tag" id="id_tag" value="{{ $id_tag }}" hidden>

                <!-- Segmento de Documentación ----->
                <div id="accordion">

                    <div class="card">

                        <div class="card-header" id="DesplegableDos">

                            <div class="form-group text-center">
                            </p>
                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="local" name="entrega" value="local"  data-toggle="collapse" data-target="#collapseDos" aria-expanded="true" aria-controls="collapseDos">
                                    <label class="form-check-label text-primary" for="local">Retirar en Local</label>
                                </div>
                                <div id="collapseDos" class="collapse" aria-labelledby="DesplegableDos" data-parent="#accordion">

                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="">Se le enviara por mensaje los Locales Disponibles para Retiro</label>
                                    </div>
        
                                </div>
                            </div>

                        </div>
                      
                    </div>

                    <div class="card">

                        <div class="card-header" id="DesplegableUno">
                            <div class="form-group text-center">
                            </p>
                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-left">
                                    <input class="form-check-input" type="radio" id="delivery" name="entrega" value="delivery" data-toggle="collapse" data-target="#collapseUno" aria-expanded="true" aria-controls="collapseOne">
                                    <label class="form-check-label text-primary" for="delivery">Entrega a Domicilio</label>
                                </div>
                                <div class="form-check col-sm-12 mb-6 mb-sm-0 text-right">
                                    <label class="form-check-label text-secundary" >Valor ${{ $delivery }}</label>
                                    <input type="hidden" name="valor_despacho" id="valor_despacho" value="{{ $delivery }}">
                                </div>           
                            </div>
                        </div>
                  
                        <div id="collapseUno" class="collapse" aria-labelledby="DesplegableUno" data-parent="#accordion">

                            <div class="card-body">
               
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-4 mb-sm-0">
                                        <label for="rut">Rut</label>
                                        <input type="text" name="rut" id="rut" oninput="checkRut(this)" maxlength="11" pattern="\d{3,8}-[\d|kK]{1}" class="form-control form-control-user">
                                    </div>
                                    <div class="col-sm-6 mb-4 mb-sm-0">
                                        <label for="rut">Celular</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control form-control-user" 
                                        placeholder="+56912341234" title="Solo puede ingresar numeros" maxlength="12"/>
                                    </div>
                                       
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                        <label for="nombre">Nombre y Apellido</label>
                                        <input type="text" class="form-control form-control-user" id="nombre" name="nombre">
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                        <label for="direccion">Dirección</label>
                                        <textarea name="direccion" id="direccion" cols="15" rows="2" class="form-control" maxlength="250"></textarea>
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



</div>


@endsection