@extends('adminlte::page')

@section('title', 'Compras')

@section('css')
@stop

@section('content')
   <div id="appVue">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-center m-2">Compras en camino</h1>
                                    <table id="tabla_de_compras_en_camino" class="table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>ID</th>
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>Precio Total</th>
                                                <th>Fecha de Compra</th>
                                                <th>Status</th>
                                                <th class="no_exportar">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($compras_en_camino as $compra)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $compra->id }}</td>
                                                    <td>{{ $compra->cantidad }}</td>
                                                    <td>{{ $compra->ejemplar->nombre }}</td>
                                                    <td>{{ number_format($compra->precio_total, 2, ',', '.') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y') }}</td>
                                                    <td>{{ $compra->status == 1 ? "En camino" : "Recibida" }}</td>
                                                    <td>
                                                        <a href="{{ route('compras.show', ['compra_id' => $compra->id]) }}">
                                                            <button class="btn btn-outline-info btn-sm">Ver</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h1 class="text-center m-2">Compras Recibidas</h1>
                                    <table id="tabla_de_compras_recibidas" class="table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>ID</th>
                                                <th>Cantidad</th>
                                                <th>Producto</th>
                                                <th>Precio Total</th>
                                                <th>Fecha de Compra</th>
                                                <th>Status</th>
                                                <th class="no_exportar">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($compras_recibidas as $compra)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $compra->id }}</td>
                                                    <td>{{ $compra->cantidad }}</td>
                                                    <td>{{ $compra->ejemplar->nombre }}</td>
                                                    <td>{{ number_format($compra->precio_total, 2, ',', '.') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($compra->created_at)->format('d/m/Y') }}</td>
                                                    <td>{{ $compra->status == 1 ? "En camino" : "Recibida" }}</td>
                                                    <td>
                                                        <a href="{{ route('compras.show', ['compra_id' => $compra->id]) }}">
                                                            <button class="btn btn-outline-info btn-sm">Ver</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   </div>
@stop

@section('js')
   <script>
        $(document).ready(function() {

            $('#tabla_de_compras_en_camino').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: "Compras en camino - "+new Date().toLocaleString(),
                        className: "bg-info",
                        exportOptions: {
                            columns: ':not(.no_exportar)'
                        }
                    }
                ],
            });

            $('#tabla_de_compras_recibidas').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: "Compras recibidas - "+new Date().toLocaleString(),
                        className: "bg-info",
                        exportOptions: {
                            columns: ':not(.no_exportar)'
                        }
                    }
                ],
            });
        });
   </script>
@stop