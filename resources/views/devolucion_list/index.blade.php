@extends('layouts.admin')

@section('titulo', 'Panel de Devoluciones Tag')

@section('contenido')
    
    <div class="card">
        <div class="card-body">

            <table id="dt-products" class="table table-striped table-bordered dts" >
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Fecha Recepción</th>
                        <th class="text-center">Cod Tag</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Local Recepción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                    @foreach ($devolucion as $devoluciones)
                        <tr class="text-center">
                            <td>{{ $devoluciones->orden }}</td>
                            <td>{{ $devoluciones->created_at }}</td>
                            <td>{{ $devoluciones->cod_tag }}</td>
                            <td>{{ $devoluciones->estado }}</td>
                            <td>{{ $devoluciones->nombre_local }}</td>
                            <td>                               
                                <a href="{{ route('devoluciones.edit', $devoluciones->id) }}" class="btn btn-secondary"><i class="far fa-edit"></i></a>

                                <form action="{{ route('devoluciones.destroy', $devoluciones->id) }}" method="POST" style="display: inline-block;">
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
    <script src="{{ asset('libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" charset="UTF-8"></script>

@endpush

