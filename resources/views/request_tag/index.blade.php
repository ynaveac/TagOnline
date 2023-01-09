@extends('layouts.admin')

@section('titulo', 'Panel Solicitudes Tag')

@section('contenido')
    
    <div class="card">
        <div class="card-body">

            <table id="dt-products" class="table table-striped table-bordered dts" >
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Fecha Solicitud</th>
                        <th class="text-center">Nombre / Apellido</th>
                        <th class="text-center">Patente</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Tipo Entrega</th>
                        <th class="text-center">Compra</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                    @foreach ($solicitudes as $solicitud)
                        <tr class="text-center">
                            <td>{{ $solicitud->orden }}</td>
                            <td>{{ $solicitud->created_at }}</td>
                            <td>{{ $solicitud->nombre.' '.$solicitud->apellidos }}</td>
                            <td>{{ $solicitud->patente }}</td>
                            <td>
                                @if ($solicitud->tipo == "1")
                                    Persona Natural
                                @else
                                    Empresa
                                @endif
                            </td>
                            <td>{{ $solicitud->estado }}</td>
                            <td>
                                @if ($solicitud->local_retiro == 1)
                                        <i class="text-primary fa-solid fa-shop"></i>
                                    @else
                                        <i class="text-secundary fa-solid fa-shop"></i>
                                @endif
                                @if ($solicitud->local_retiro == 2)
                                        <i class="text-danger fa-solid fa-truck"></i>
                                    @else
                                        <i class="text-secundary fa-solid fa-truck"></i>
                                @endif
                                @if ($solicitud->local_retiro == 3)
                                        <i class="text-success fa-solid fa-truck-fast"></i>
                                    @else
                                        <i class="text-secundary fa-solid fa-truck-fast"></i>
                                @endif
                            </td>

                            <td>
                                @if ($solicitud->estado_compra == 'Compra Aprobada')
                                    <label class="text-center"><i class="text-success fa-solid fa-check-double fa-lg"></i></label>
                                @else
                                    <a href="#" class="text-center" onclick="pendientepago({{ $solicitud->id }})">
                                        <i class="text-danger fa-regular fa-circle-xmark fa-lg"></i>
                                        @if ($solicitud->tag_pago_pendiente>0)
                                            <i class="fa-solid fa-paper-plane fa-xs"> {{ $solicitud->tag_pago_pendiente }}</i>
                                        @endif
                                    </a>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('request_tag.pdf', $solicitud->id) }}" class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i></a>
                                
                                <a href="{{ route('request_tag.edit', $solicitud->id) }}" class="btn btn-secondary"><i class="far fa-edit"></i></a>

                                @if ($solicitud->estado == 'Falta Documentación')
                                    <a href="#" class="btn btn-info" onclick="mensaje({{ $solicitud->id }})">
                                        <i class="fa-solid fa-book"></i>
                                        @if ($solicitud->tag_falta_documentacion>0)
                                            <i class="fa-solid fa-paper-plane fa-xs"> {{ $solicitud->tag_falta_documentacion }}</i>
                                        @endif
                                    </a>                                 
                                @endif

                                @if ($solicitud->estado_compra != 'Compra Aprobada')
                                    <form action="{{ route('request_tag.destroy', $solicitud->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" role="button"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                @endif

                                @if ($solicitud->estado == 'Aprobado')
                                    <a href="#" class="btn btn-success" onclick="estadoaprobado({{ $solicitud->id }})">
                                        <i class="fa-solid fa-thumbs-up"></i>
                                        @if ($solicitud->tag_aprobado>0)
                                            <i class="fa-solid fa-paper-plane fa-xs"> {{ $solicitud->tag_aprobado }}</i>
                                        @endif
                                    </a>  
                                @endif

                                @if ($solicitud->estado == 'Tag Habilitado')
                                    <a href="#" class="btn btn-success" onclick="taghabilitado({{ $solicitud->id }})">
                                        <i class="fa-solid fa-car-side"></i>
                                        @if ($solicitud->tag_habilitado>0)
                                            <i class="fa-solid fa-paper-plane fa-xs"> {{ $solicitud->tag_habilitado }}</i>
                                        @endif
                                    </a>  
                                @endif

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

    <script>


        function mensaje(id) {

        Swal.fire({
                icon: 'info',
                title: "¿Documentos Pendientes?",
                text: "Se le enviara un mensaje por wsp al Cliente solicitando el llenado de lo pendiente, lo desea realizar?",
                showCancelButton: true,
                cancelButtonText: 'No Enviar Mensaje',
                confirmButtonText: 'Enviar Mensaje!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({ title: "Mensaje Enviado.!!", icon: "success" });
                    location.href = '/mensaje_pendiente/'+id;
                } 
            });
            
        }

        function pendientepago(id) {

        Swal.fire({
                icon: 'info',
                title: "¿Pago Pendiente?",
                text: "Se le enviara un mensaje por wsp al Cliente solicitando el pago pendiente.",
                showCancelButton: true,
                cancelButtonText: 'No Enviar Mensaje',
                confirmButtonText: 'Enviar Mensaje!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({ title: "Mensaje Enviado.!!", icon: "success" });
                    location.href = '/pago_pendiente/'+id;
                } 
            });
            
        }

        function estadoaprobado(id) {

        Swal.fire({
                icon: 'info',
                title: "Tag Aprobado.!!",
                text: "Se le enviara un mensaje por wsp al Cliente indicando que su TAG\n se encuentra aprobado y disponible para su retiro.",
                showCancelButton: true,
                cancelButtonText: 'No Enviar Mensaje',
                confirmButtonText: 'Enviar Mensaje!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({ title: "Mensaje Enviado.!!", icon: "success" });
                    location.href = '/mensaje_estado_aprobado/'+id;
                } 
            });
            
        }

        function taghabilitado(id) {

        Swal.fire({
                icon: 'info',
                title: "Tag Habilitado.!!",
                text: "Se le enviara un mensaje por wsp al Cliente indicando que su TAG\n se encuentra habilitado para su uso.",
                showCancelButton: true,
                cancelButtonText: 'No Enviar Mensaje',
                confirmButtonText: 'Enviar Mensaje!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire({ title: "Mensaje Enviado.!!", icon: "success" });
                    location.href = '/mensaje_estado_habilitado/'+id;
                } 
            });
            
        }
    </script>
@endpush

