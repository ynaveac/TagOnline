@extends('layouts.admin')

@section('titulo', 'Adminitración de Locales')

@section('contenido')
    
    <div class="card">
        <div class="card-body">
            <div>
                <a href="{{ route('local.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nuevo Local
                </a>   
            </div>
            <br>
            <table id="dt-products" class="table table-striped table-bordered dts">
                <thead>
                    <tr>
                        <th class="text-center">Rut</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Tipo Despacho</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                    @foreach ($local as $locals)
                        <tr class="text-center">
                            <td>{{ $locals->rut }}</td>
                            <td>{{ $locals->nombre }}</td>
                            <td>
                                @if ($locals->kiosko == "1")
                                    Retiro en Local - <br>
                                @endif
                                @if ($locals->maquina == "1")
                                    Maquina Habilitada
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('local.edit', $locals->id) }}" class="btn btn-success">
                                    <i class="far fa-edit"></i>
                                </a>
                                <form action="{{ route('local.destroy', $locals->id) }}" method="POST" style="display: inline-block;">
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