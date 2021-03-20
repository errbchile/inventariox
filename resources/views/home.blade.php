@extends('layouts.app')

@section('content')


      <!-- VUEJS -->
      <div id="appVue">

        <!-- Begin Page Content -->
        <div class="container">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="configuracion-tab" data-toggle="tab" href="#configuracion" role="tab" aria-controls="configuracion" aria-selected="true">Configuracion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="compras-tab" data-toggle="tab" href="#compras" role="tab" aria-controls="compras" aria-selected="false">Compras</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="inventario-tab" data-toggle="tab" href="#inventario" role="tab" aria-controls="inventario" aria-selected="false">Inventario</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="configuracion" role="tabpanel" aria-labelledby="configuracion-tab">
            <!-- CONFIGURACION CONTENT -->
            <div class="container-fluid">
              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between m-3">
                <h1 class="h3 mb-0 text-gray-800 text-center">Configuración</h1>
              </div>

            
              
                <div class="row">
                  <form>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Nombre del Producto</label>
                      <input @keyup="findProduct" v-model="buscarNombreProducto" type="text" class="form-control" placeholder="Buscar...">
                    </div>
                  </form>
                </div>
                <!-- VISTA UNO -->
                <div class="row">
                  <!-- producto REGISTRADO -->
                  <ul v-if="productoEnRegistroDePlantillas">
                    <li v-for="(producto, index) in nombreDeProductosRegistrados" :key="index">
                      <a href="#" @click.prevent="verProductoRegistrado(producto)">
                        Ver <strong>@{{ producto.nombreProducto }}</strong>
                      </a>
                    </li>
                  </ul>
                  <!-- /producto REGISTRADO -->
                  <!-- producto NUEVO -->
                  <div v-else-if="!productoEnRegistroDePlantillas && buscarNombreProducto.length > 2">
                    <a @click.prevent="verProductoNuevo" href="#">
                      <p>Registrar <strong>@{{ buscarNombreProducto }}</strong> como nuevo nombre de producto</p>
                    </a>
                  </div>
                  <!-- /producto NUEVO -->
                </div>
                <!-- /VISTA UNO -->
                

                <!-- VISTA DOS -->
                <div class="row">
                  <div class="col-md-10 offset-md-1 text-center">
                    <!-- PRODUCTO NUEVO -->
                    <form v-if="agregarNuevoNombreDeProducto">
                      <div class="form-group text-center">
                        <label class="text-center">Nuevo Nombre del Producto</label>
                        <input v-model="newProducto.nombreProducto" type="text" class="form-control text-center" readonly>
                      </div>
                      <h5 class="text-center">Atributos</h5>
                      <div class="form-group text-center">
                        <label class="sr-only">Nombre del Atributo Nuevo</label>
                        <div class="input-group mb-2">
                          <input v-model="newAtributo.nombre" type="text" class="form-control" placeholder="Nuevo Atributo...">
                          <div class="input-group-append">
                            <button :disabled="atributoNoValidoParaSerAgregado" @click.prevent="handleNewAtributo" class="input-group-text btn btn-outline-success">
                              <i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <small v-if="atributoNoValidoParaSerAgregado" class="text-danger">El Atributo @{{ newAtributo.nombre }} no es válido...</small>
                      </div>

                      <div class="form-row">
                        <div class="form-col" v-for="(atributo, index) in newProducto.atributos" :key="index">
                          <!-- TARJETAS - producto registrado -->
                          <tarjeta-de-atributo 
                            :atributo="atributo"
                            :remove-atributo="removeAtributo"
                            @new-valor="handleNewValor"
                            @remove-valor="removeIncomingValue"
                          />
                          <!-- /TARJETAS - producto registrado -->
                        </div>
                      </div>

                      
                    </form>
                    <!-- /PRODUCTO NUEVO -->
      
                    <!-- PRODUCTO REGISTRADO -->
                    <form v-else-if="agregarNombreDeProductoExistente">
                      <div class="form-group text-center">
                        <label class="sr-only">Nombre del Atributo Nuevo</label>
                        <div class="input-group mb-2">
                          <input v-model="newProducto.nombreProducto" type="text" class="form-control text-center" readonly>
                          <div class="input-group-append">
                            <a href="#" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                            <a @click.prevent="removeProductNameRegistered(newProducto.nombreProducto)" href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle"></i></a>
                          </div>
                        </div>
                      </div>
                      <div class="form-group text-center">
                        <label class="sr-only">Nombre del Atributo Nuevo</label>
                        <div class="input-group mb-2">
                          <input v-model="newAtributo.nombre" type="text" class="form-control" placeholder="Nuevo Atributo...">
                          <div class="input-group-append">
                            <button :disabled="atributoNoValidoParaSerAgregado" @click.prevent="handleNewAtributo" class="input-group-text btn btn-outline-success">
                              <i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <small v-if="atributoNoValidoParaSerAgregado" class="text-danger">El Atributo @{{ newAtributo.nombre }} no es válido...</small>
                      </div>

                      <div class="form-row">
                        <div class="form-col" v-for="(atributo, index) in newProducto.atributos" :key="index">
                          <!-- TARJETAS - producto registrado -->
                          <tarjeta-de-atributo 
                            :atributo="atributo"
                            :remove-atributo="removeAtributo"
                            @new-valor="handleNewValor"
                            @remove-valor="removeIncomingValue"
                          />
                          <!-- /TARJETAS - producto registrado -->
                        </div>
                      </div>


                      
                    </form>
                    <!-- /PRODUCTO REGISTRADO -->
                  </div>
                </div>
                <!-- /VISTA DOS -->

            </div>
            <!-- /CONFIGURACION CONTENT -->
            </div>

            <div class="tab-pane fade" id="compras" role="tabpanel" aria-labelledby="compras-tab">
              <!-- COMPRAS-CONTENT -->
              <div class="container-fluid m-3">
                <div class="row">
                  <h3 class="text-center">Compras</h3>
                </div>

                <div class="row">
                  <div class="col">
                    <form>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Selecciona el Producto:</label>
                            <select v-model="formCompra.productoSeleccionadoParaComprar" class="form-control" required>
                              <option value="">--Seleccione--</option>
                              <option v-for="(producto, index) in registroDePlantillas" 
                                :value="producto.nombreProducto"
                              >@{{ producto.nombreProducto }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row" v-for="(atributo, index) in atributosAMostrar" :key="atributo.nombre">
  
                        <div class="col">
                          <div class="form-group">
                            <label>@{{ atributo.nombre }}</label>
                            <select v-model="formCompra.atributos[atributo.nombre]" class="form-control" required>
                              <option :value="valor" v-for="(valor, pos) in atributo.valores">@{{ valor }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label>Cantidad</label>
                            <input v-model="formCompra.cantidadItemsEnCompra" type="number" class="form-control" required>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                            <label>Monto Total Pagado</label>
                            <input v-model="formCompra.montoTotalPagado" type="number" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <label>Monto Unitario (c/u)</label>
                            <input v-model="costoUnitario" type="number" class="form-control" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <button @click.prevent="handleNuevaCompra" class="btn btn-outline-success">Registrar Compra</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>



            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary text-center">Compras Registradas</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Características</th>
                        <th>Cantidad</th>
                        <th>Costo Total</th>
                        <th>Costo Unitario</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Características</th>
                        <th>Cantidad</th>
                        <th>Costo Total</th>
                        <th>Costo Unitario</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <tr v-for="(compra, index) in comprasRegistradas">
                        <td>@{{ compra.id }}</td>
                        <td>@{{ compra.productoSeleccionadoParaComprar }}</td>
                        <td>
                          <ul v-for="(valor, atributo) in compra.atributos">
                            <li>@{{ atributo }}: @{{ valor }}</li>
                          </ul>
                        </td>
                        <td>@{{ compra.cantidadItemsEnCompra }}</td>
                        <td>@{{ compra.montoTotalPagado }}</td>
                        <td>@{{ compra.costoPorUnidad }}</td>
                        <td>@{{ compra.fecha }}</td>
                        <td>@{{ compra.status }}</td>
                        <td>
                          <a @click.prevent="handleCompraRegistrada(compra.id)" class="btn btn-outline-danger btn-sm" href="#">Eliminar</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>



              <!-- /COMPRAS-CONTENT -->
            </div>

            <div class="tab-pane fade" id="inventario" role="tabpanel" aria-labelledby="inventario-tab">-inventario content-</div>
          </div>



            



          

        </div>
        <!-- /.container-fluid -->


      </div>
      <!-- /VUEJS -->





   
@endsection



@section('custom_js')
    <script type="text/javascript">
        const {createApp} = Vue;

        const application = createApp({
        el: '#appVue',
        data() {
            return {

                registroDePlantillas: [
                    {
                    nombreProducto: 'Pestaña',
                    atributos: [
                        {
                            nombre: 'Medida',
                            valores: ['0.05', '0.07', '0.20']
                        },
                        {
                            nombre: 'Color',
                            valores: ['Rojo', 'Negro', 'Transparente']
                        }
                    ],
                    }
                ],
        
                buscarNombreProducto: "",
        
                newProducto: {
                    nombreProducto: '',
                    atributos: []
                },
        
                newAtributo: {
                    nombre: '',
                    valores: []
                },
        
                atributoEnModoEdicion: false,
        
                productoEnRegistroDePlantillas: false,
                nombreDeProductosRegistrados: [],
                agregarNuevoNombreDeProducto: false,
                agregarNombreDeProductoExistente: false,
                atributoNoValidoParaSerAgregado: false,
        
                formCompra: {
                    productoSeleccionadoParaComprar: "",
                    cantidadItemsEnCompra: null,
                    montoTotalPagado: null,
                    costoPorUnidad: null,
                    atributos: {}
                },
        
                comprasRegistradas: [],
            }

        },

        methods: {
            findProduct() {
                if (this.buscarNombreProducto.length > 2) {
                    let existe = false;
                    let nombres = [];
                    this.registroDePlantillas.map(producto => {
                    if ( ( producto.nombreProducto.toLowerCase() ).includes( (this.buscarNombreProducto).toLowerCase() ) ) {
                        existe = true;
                        nombres.push(producto);
                    }
                    })
                    this.nombreDeProductosRegistrados = nombres;
                    this.productoEnRegistroDePlantillas = existe;
                } else {
                    this.productoEnRegistroDePlantillas = false;
                    this.agregarNuevoNombreDeProducto = false;
                    this.agregarNombreDeProductoExistente = false;
                    this.newProducto = {
                    nombreProducto: '',
                    atributos: []
                    };
                }
            },

            verProductoRegistrado(producto){
                this.newProducto = producto;
                this.agregarNombreDeProductoExistente = true;
            },

            verProductoNuevo(){
                this.newProducto.nombreProducto = this.buscarNombreProducto;
                this.agregarNuevoNombreDeProducto = true;
                this.registroDePlantillas.push(this.newProducto);
            },

            handleNewAtributo(){
                if (this.newAtributo.nombre === "") {
                    return;
                }

                if ( this.atributoValido(this.newAtributo.nombre) ) {
                    this.addNewAtributoValido(this.newAtributo.nombre); 
                } else {
                    this.atributoNoValidoParaSerAgregado = true;
                    setTimeout(() => {
                    this.atributoNoValidoParaSerAgregado = false;
                    }, 3000);
                }
            },

            atributoValido(nombre){
                for (let i = 0; i < this.newProducto.atributos.length; i++) {
                    if (this.newProducto.atributos[i].nombre === nombre) {
                    return false;
                    }
                }
                return true;
            },

            addNewAtributoValido(nombre){
                this.newProducto.atributos.push({
                    nombre: nombre,
                    valores: []
                });
                this.newAtributo.nombre = "";
            },

            removeAtributo(name){
                this.newProducto.atributos = this.newProducto.atributos.filter(atributo => atributo.nombre !== name);
            },

            handleNewValor(request){
                this.newProducto.atributos.map(atributo => {
                    if (atributo.nombre === request.atributoNombre) {
                    atributo.valores.push(request.newValor);
                    }
                })
            },

            removeIncomingValue(request){
                this.newProducto.atributos.map(atributo => {
                    if (atributo.nombre === request.atributo) {
                    atributo.valores = atributo.valores.filter(valor => valor !== request.value)
                    }
                })
            },

            removeProductNameRegistered(nombre){
                this.registroDePlantillas = this.registroDePlantillas.filter(producto => producto.nombreProducto !== nombre);
                this.nombreDeProductosRegistrados = this.nombreDeProductosRegistrados.filter(producto => producto.nombreProducto !== nombre);
                this.newProducto = {
                    nombreProducto: '',
                    atributos: []
                };
                this.agregarNombreDeProductoExistente = false;
            },

            validarComprarRealizada(){
                let response = false;
                if (condition) {
                    
                }
                return response;
            },

            handleNuevaCompra(){
                let nuevaCompra = {
                    ...this.formCompra,
                    id: Date.now(),
                    fecha: new Date().toLocaleString(),
                    status: 'Pendiente'
                }
                this.comprasRegistradas.push(nuevaCompra);
                this.formCompra = {
                    productoSeleccionadoParaComprar: "",
                    cantidadItemsEnCompra: null,
                    montoTotalPagado: null,
                    costoPorUnidad: null,
                    atributos: {}
                };
            },

            handleCompraRegistrada(id){
                this.comprasRegistradas = this.comprasRegistradas.filter(compra => compra.id !== id);
            }
        }, // end methods


        watch: {
            newProducto: function(newVal) {
                this.registroDePlantillas = this.registroDePlantillas.map(producto => {
                    if (producto.nombreProducto === this.newProducto.nombreProducto) {
                    return newVal;
                    }
                    return producto;
                })
            }
        }, // end watch

        computed: {
            atributosAMostrar(){
                let response = [];
                if (this.formCompra.productoSeleccionadoParaComprar === "") {
                    return [];
                }
                let producto = this.registroDePlantillas.filter(producto => producto.nombreProducto === this.formCompra.productoSeleccionadoParaComprar);
                response = producto.map(producto => producto.atributos);
                return response[0];
            },

            costoUnitario(){
                let response = null;
                if ( this.formCompra.cantidadItemsEnCompra !== null && this.formCompra.montoTotalPagado !== null ) {
                    response = ( parseFloat(this.formCompra.montoTotalPagado) / parseFloat(this.formCompra.cantidadItemsEnCompra) ).toFixed(2);
                }
                this.formCompra.costoPorUnidad = response;
                return response;
            }
        }

        })






        application.component('TarjetaDeAtributo', {
        template:/* vue-html */`
        <div>
            <div class="card m-2" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title">
                    <div class="row" v-if="!atributoEnEdicion">
                    <div class="col">
                        <strong>@{{ atributo.nombre }}</strong>
                    </div>
                    <div class="col text-right">
                        <a @click.prevent="atributoEnEdicion = !atributoEnEdicion" href="#" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                        <a @click.prevent="removeAtributo(atributo.nombre)" href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle"></i></a>
                    </div>
                    </div>

                    <div class="row" v-else-if="atributoEnEdicion">
                    <div class="col">
                        <form>
                            <div class="form-group text-center">
                            <div class="input-group mb-2">
                                <input v-model="atributo.nombre" type="text" class="form-control">
                                <div class="input-group-append">
                                <button @click.prevent="atributoEnEdicion = !atributoEnEdicion" class="input-group-text btn btn-outline-danger"><i class="fas fa-times-circle"></i></button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                    </div>

                </h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(valor, pos) in atributo.valores" :key="pos">
                    <div class="row">
                        <div class="col">
                        @{{ valor }}
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i></a>
                            <a @click.prevent="removeValue(valor, atributo.nombre)" href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-times-circle"></i></a>
                        </div>
                    </div>
                    </li>
                    <li class="list-group-item">
                    <form>
                        <div class="form-group text-center">
                        <div class="input-group mb-2">
                            <input v-model="newValor" type="text" class="form-control" placeholder="Nuevo Valor...">
                            <div class="input-group-append">
                                <button @click.prevent="handleNewValor(atributo.nombre)" class="input-group-text btn btn-outline-success"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        </div>
                    </form>
                    </li>
                </ul>
            </div>
        </div>
        `,
        data(){
            return {
                atributoEnEdicion: false,
                newAtributo: "",
                newValor: ""
            }
        },

        props: ['atributo', 'removeAtributo'],

        methods: {
            handleNewValor(atributoNombre){
                if (this.newValor === "") {
                    return;
                }

                let obj = {
                    atributoNombre,
                    newValor: this.newValor
                }
                this.$emit('new-valor', obj);
                this.newValor = "";
            },

            removeValue(value, atributo){
                let obj = {
                    value,
                    atributo
                }
                this.$emit('remove-valor', obj);
            }
        } // end Methods
        })


        application.mount('#appVue')
    </script>
@endsection