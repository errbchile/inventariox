@extends('adminlte::page')

@section('title', 'Compras')

@section('css')
@stop

@section('content')
   <div id="appVue">

        {{-- nueva-compra --}}
        <div class="container-fluid">
            <div class="row text-center">
                <div class="col">
                    <h3>Registra una Nueva Compra:</h3>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Selecciona el Producto:</label>
                            <select @change="traerLaEntidadDeBaseDeDatos()" v-model="entidadSeleccionada" class="form-control" required>
                                <option value="">--Seleccione--</option>
                                @foreach ($entidades as $entidad)
                                    <option value="{{ $entidad->id }}">{{ $entidad->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="row" v-for="atributo in atributos" :key="atributo.nombre">

                        <div class="col">
                            <div class="form-group">
                                <label>@{{ atributo.nombre }}</label>
                                <select class="form-control" required>
                                    <option v-for="valor in atributo.valores" :key="valor" :value="valor">@{{ valor }}</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Cantidad de Unidades</label>
                            <input v-model="cantidad_de_unidades" type="number" class="form-control" min="1" step="1" required>
                        </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label>Monto Total Pagado</label>
                            <input v-model="monto_total_pagado" type="number" class="form-control" min="0" step="50" required>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Monto Unitario (c/u)</label>
                            <input v-model="monto_unitario" type="number" class="form-control" readonly>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Precio Sugerido (c/u)</label>
                            <input v-model="precio_sugerido" type="number" class="form-control" required>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label>Ingrese el enlace completo al sitio donde se realizó la compra:</label>
                            <input v-model="enlace_url" type="text" class="form-control" placeholder="Ejemplo: https://www.proveedor.com" required>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <button class="btn btn-outline-success">Registrar Compra</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- /nueva-compra --}}

   </div>
@stop

@section('js')
    <!-- VUEJS -->
    <script src="https://unpkg.com/vue@next"></script>

    {{-- AXIOS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>

    <!-- lodash -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.20/lodash.min.js"></script>

    {{-- MOMENT-JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>

    <script>
        const {
            createApp
        } = Vue;

        let ejemplo_de_entidad = {
            nombreEntidad: 'Pestaña',
            atributos: [{
                    nombre: 'Medida',
                    valores: ['0.05', '0.07', '0.20']
                },
                {
                    nombre: 'Color',
                    valores: ['Rojo', 'Negro', 'Transparente']
                }
            ],
        };

        const application = createApp({
            el: '#appVue',
            data() {
                return {
                    entidadSeleccionada: null,
                    atributos: [],
                    
                    cantidad_de_unidades: null,
                    monto_total_pagado: null,
                    precio_sugerido: null,
                    enlace_url: null,
                }

            },

            methods: {
                traerLaEntidadDeBaseDeDatos(){
                    if ( !this.entidadSeleccionada ) {
                        this.atributos = [];
                        return;
                    }
                    let obj = {
                        entidad: this.entidadSeleccionada
                    };
                    axios.post("{{ route('get_entidad') }}", obj)
                        .then(res => this.atributos = JSON.parse(res.data.atributos))
                },
                registrarNuevaCompraEnBaseDeDatos(nueva_compra){
                    let nueva_compra = {
                        nombreDeEntidadSeleccionadaParaComprar: this.entidadSeleccionada,
                        cantidadItemsEnCompra: this.cantidad_de_unidades,
                        montoTotalPagado: this.monto_total_pagado,
                        costoPorUnidad: this.monto_unitario,
                        precioSugerido: this.precio_sugerido,
                        enlaceURLDeLaCompra: this.enlace_url,
                        atributos: {}
                    };
                    axios.post( "{{route('registrarNuevaCompra')}}", nueva_compra)
                        .then(res => console.log(res.data))
                },
            },
            computed: {
                monto_unitario(){
                    if ( this.cantidad_de_unidades && this.monto_total_pagado ) {
                        let monto_unitario = this.monto_total_pagado/this.cantidad_de_unidades;
                        return monto_unitario; // Recuerda formatear el numero
                    }
                }
            }

        })


        application.mount('#appVue')
    </script>
@stop
