@extends('layouts.admin')

@section('titulo', 'Adminitración de Usuarios')

@section('contenido')

    <div class="card">
        <div class="card-header">
        Edición de Usuario
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">Los Campos en Rojo son Obligatorios</div>
                @endif
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                        id="name" name="name" placeholder="Nombre"
                        @if (is_null(old('name')))
                            value="{{ $user->name }}"
                        @else
                            value="{{ old('name') }}"      
                        @endif 
                        >
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user {{ $errors->has('username') ? 'is-invalid' : '' }}" 
                        id="username" name="username" placeholder="Nombre de Usuario"
                        @if (is_null(old('username')))
                            value="{{ $user->username }}"
                        @else
                            value="{{ old('username') }}"      
                        @endif 
                        >
                    </div>                    
                </div>


                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                        id="email" name="email"  placeholder="Email"
                        @if (is_null(old('email')))
                            value="{{ $user->email }}"
                        @else
                            value="{{ old('email') }}"      
                        @endif                         
                        >
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        id="password" name='password' placeholder="Password">    
                    </div>                    
                </div>

                <a href="{{ url('user') }}" class="btn btn-primary" role="button">Volver</a> 
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