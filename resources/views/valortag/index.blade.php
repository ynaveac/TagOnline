@extends('layouts.admin')

@section('titulo', 'Mantenedor Valores del Tag')

@section('contenido')
    
    <div class="card">
        <div class="card-header">
            El Valor vigente corresponde al último ingreso
            </div>
        <div class="card-body">
            <div>
                <a href="{{ route('valortag.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nuevo Valor
                </a>   
            </div>
            <br>
            <table id="dt-products" class="table table-striped table-bordered dts" >
                <thead>
                    <tr>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Valor Tag</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                    @foreach ($valortag as $tag)
                        <tr class="text-center">
                            <td>{{ $tag->created_at }}</td>
                            <td>${{ number_format($tag->valor) }}</td>
                            <td>                                
                                <form action="{{ route('valortag.destroy', $tag->id) }}" method="POST" style="display: inline-block;">
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

