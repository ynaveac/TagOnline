@extends('layouts.tag')

@section('titulo_card', 'Cargando Documentos!')

@section('imagen', "background-image: url('https://www.portafolio.co/files/article_multimedia/uploads/2017/11/22/5a15bb0831832.jpeg')")

@section('contenido')
    
    <form id="documents" class="user" action="{{ route('document.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <input type="hidden" name="id_RequestTag" id="id_RequestTag" value="{{ $_REQUEST['id']; }}" />
        <div class="form-group text-center">
            <h5><p class="small ">Subir Archivos</p></h5>
        </div>
        <div class="form-group row">
            <div class="input-group" id="carnetfrontal-form">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="carnetfrontal">Carnet</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input {{ $errors->has('carnetfrontal') ? 'is-invalid' : '' }}" id="carnetfrontal" name="carnetfrontal">
                    @if ($_REQUEST['tipo']==1)
                        <label class="custom-file-label" for="carnetfrontal">Imagen Frontal Carnet</label>
                    @else
                        <label class="custom-file-label" for="carnetfrontal">Imagen Frontal Carnet Representante</label>
                    @endif 
                </div>
            </div>
        </div>

        @if ($_REQUEST['tipo']!=1)
            
            <div class="form-group row">
                <div class="input-group" id="carnetfrontalempresa-form">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="carnetfrontalempresa">Carnet</span>
                    </div>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input {{ $errors->has('carnetfrontalempresa') ? 'is-invalid' : '' }}" id="carnetfrontalempresa" name="carnetfrontalempresa">
                    <label class="custom-file-label" for="carnetfrontalempresa">Imagen Frontal Carnet Emp.</label>
                    </div>
                </div>            
            </div>

        @endif

            <div class="form-group text-center">
                <h5><p class="small text-primary">Documentos del Vehiculo:</p></h5>
            </div>  
            <div class="form-group row">
                <div class="input-group" id="primerainscripcion-form">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="primerainscripcion">Vehiculo Nuevo</span>
                    </div>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input {{ $errors->has('primerainscripcion') ? 'is-invalid' : '' }}" id="primerainscripcion" name="primerainscripcion">
                    <label class="custom-file-label" for="primerainscripcion">Primera Inscripción</label>
                    </div>
                </div>            
            </div>      

        <div class="form-group text-center">
            <h6><p class="small text-danger">Si es un Vehiculo Usado, Suba uno de los siguientes Documentos :</p></h6>
        </div>  
        <div class="form-group row">
            <div class="input-group" id="compranotarial-form">
                <div class="input-group-prepend">
                <span class="input-group-text" id="compranotarial">Vehiculo Usado</span>
                </div>
                <div class="custom-file">
                <input type="file" class="custom-file-input {{ $errors->has('compranotarial') ? 'is-invalid' : '' }}" id="compranotarial" name="compranotarial">
                <label class="custom-file-label" for="compranotarial">Compra Venta Notarial</label>
                </div>
            </div>            
        </div>   
        <div class="form-group row">
            <div class="input-group" id="padron-form">
                <div class="input-group-prepend">
                <span class="input-group-text" id="padron">Vehiculo Usado</span>
                </div>
                <div class="custom-file">
                <input type="file" class="custom-file-input {{ $errors->has('padron') ? 'is-invalid' : '' }}" id="padron" name="padron">
                <label class="custom-file-label" for="padron">Padron</label>
                </div>
            </div>            
        </div>  
        <div class="form-group row">
            <div class="input-group" id="cav-form">
                <div class="input-group-prepend">
                <span class="input-group-text" id="cav">Vehiculo Usado</span>
                </div>
                <div class="custom-file">
                <input type="file" class="custom-file-input {{ $errors->has('cav') ? 'is-invalid' : '' }}" id="cav" name="cav">
                <label class="custom-file-label" for="cav">CAV</label>
                </div>
            </div>            
        </div>  

        <div class="form-group">
            <input type="submit" value="Subir Archivos" class="btn btn-primary btn-user btn-block" />
        </div>
    </form>

@endsection