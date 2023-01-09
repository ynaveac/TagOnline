@extends('layouts.admin')

@section('titulo', 'Adminitración de Usuarios')

@section('contenido')
    
    <div class="card">
        <div class="card-body">
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nuevo Usuario
                </a>   
            </div>
            <br>
            <table id="dt-products" class="table table-striped table-bordered dts">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Usuario</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Fecha Creación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                    @foreach ($user as $usuarios)
                        <tr class="text-center">
                            <td>{{ $usuarios->name }}</td>
                            <td>{{ $usuarios->username }}</td>
                            <td>{{ $usuarios->email }}</td>
                            <td>{{ $usuarios->created_at }}</td>
                            <td>
                                <a href="{{ route('user.edit', $usuarios->id) }}" class="btn btn-success">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('user.destroy', $usuarios->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" role="button"><i class="far fa-trash-alt"></i></button>
                                </form>

                            </td>
                        </tr>

                    @endforeach
                <tbody>
                </tbody>
            </table>
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