@extends('layouts.admin')

@section('titulo', 'Administración de Colaboradores')

@section('contenido')
    
    <div class="card">
        <div class="card-body">
            <div>
                <a href="{{ route('empleado.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nuevo Colaborador
                </a>   
            </div>
            <br>
            <table id="dt-products" class="table table-striped table-bordered dts">
                <thead>
                    <tr>
                        <th class="text-center">Rut / Pasaporte</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Local</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                    @foreach ($emp as $emps)
                        <tr class="text-center">
                            @if (is_null($emps->rut))
                                <td>{{ $emps->pasaporte }}</td>
                            @else
                                <td>{{ $emps->rut }}</td>
                            @endif
                            <td>{{ $emps->nombre . " " . $emps->apellidos }}</td>
                            <td>
                                {{ $emps->nombre_local }}
                            </td>
                            <td>
                                <a href="{{ route('empleado.edit', $emps->id) }}" class="btn btn-success">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('empleado.destroy', $emps->id) }}" method="POST" style="display: inline-block;">
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