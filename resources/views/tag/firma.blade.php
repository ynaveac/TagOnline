@extends('layouts.tag')

@section('titulo_card', 'Ultimo paso para Obtener tu Tag')

@section('imagen', "background-image: url('https://www.autopista.es/uploads/s1/56/94/52/0/article-10-consejos-para-compartir-coche-y-ahorrar-101655-5418000694cd1.jpeg')")

@section('contenido')

<form class="user" action="{{ route('firma.store') }}" method="post" enctype="multipart/form-data">

    @csrf
    <div class="card-body ">
        <div class="">

            <input type="hidden" name="id_RequestTag" id="id_RequestTag" value="{{  $_REQUEST['id']; }}" />
            <div class="form-group text-center">
                <span><h6>Realizar Firma.</h6></span>
            </div>  
            <div class="form-group text-center">
                <canvas id="canvas" class="col-sm-6 mb-4 mb-sm-0"></canvas>
                @if ($errors->first('firma'))
                    <span><h6 class="text-danger">{{ $errors->first('firma') }}</h6></span>
                @endif
                @if ($errors->first('firmaok'))
                    <span><h6 class="text-danger">{{ $errors->first('firmaok') }}</h6></span>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">    
                    <a id="limpiar" href="#" class="btn btn-primary btn-user btn-block">
                        Borrar Firma
                    </a>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0"> 
                    <span class="input-group-text">
                        <input type="checkbox" id="firmaok" name="firmaok" value="1">
                        <label class="form-check-label" for="firmaok" onclick="btnSave()"> - Fidedigna a C.I. </label>
                    </span>
                </div>   
            </div> 
            <div class="form-group row">      
                <div class="col-md-12">
                    <img id = "imgCapture" name="imgCapture" alt = "" style = "display:none;border:1px solid #ccc" />
                    <input type="hidden" id="firma" name="firma">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Realizar Pago" class="btn btn-primary btn-user btn-block" />
            </div>
            
        </div>

    </div>
</form>
<script src="{{ asset('js/firma.js') }}"></script>
@endsection