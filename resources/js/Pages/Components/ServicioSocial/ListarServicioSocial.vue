<template>
    <div class="wrapper">
        <Base>
        <template v-slot:header></template>
        </Base>


   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="ml-3">Listado de servicios sociales</h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          <!-- Main row -->
          <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
              <!-- TO DO List -->
              <!-- Ejemplo de como podria ser una tabla pero se tendria que añadir al width del 100% -->
              <div class="card">
              <div class="card-header">
                  <h3 class="card-title mt-3 mb-3 ml-2">
                  <i class="ion ion-clipboard mr-1"></i>
                        
                        
                        <!-- <div class="row">
                            <div class="col">
                                <span>Buscar: </span>
                            </div>
                            <div class="col">
                                <input type="text" class="rounded-sm mb-2" style="width: 350px;" v-model="this.buscarNombre" v-on:keyup="buscar(this.buscarNombre)"> 
                            </div>    
                        </div> -->

                        <!-- Filtrar con checkbox -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="mx-4">
                                    <input type="checkbox" aria-label="Checkbox for following text input" v-model="this.boolFiltrar" v-on:change="siFiltrar()">
                                </div>
                            </div>
                        <!-- <input type="text" class="form-control" aria-label="Text input with checkbox"> -->

                            <div class="row" id="rowBuscar">
                                <div class="col">
                                    <span>Filtrar por: </span>
                                </div>
                                <div class="col">
                                    <select disabled id="idFiltroValores" class="col-5 ml-3" style="width: 350px;" v-model="this.campo" v-on:change="filtrarValores(this.campo)">
                                        <option value="0" selected>Todos</option>
                                        <option value="TipoServicio">Tipo de Servicio</option>
                                        <option value="Carrera">Carrera</option>
                                        <option value="Estado">Estado</option>
                                        <!-- <option value="Cancelado">Cancelado</option> -->
                                    </select>    
                                </div>

                                <div class="col" v-if="boolFiltrar">
                                    <select id="idFiltroServicios" class="" style="width: 350px;" v-model="this.valor" v-on:change="filtrarServicios(this.valor)">
                                        <option value="0" selected>Todos</option>
                                        <!-- <option value="TipoServicio">Tipo de Servicio</option>
                                        <option value="Carrera">Carrera</option>
                                        <option value="Estado">Estado</option> -->
                                        <option :value="valor" v-for="(valor, index) in valoresFiltrados" :key="index">{{ valor }}</option>
                                        <!-- <option value="Cancelado">Cancelado</option> -->
                                    </select>    
                                </div>
                            </div>   
                        </div>
                  </h3>
                    <inertia-link type="button" class="btn btn-success float-right mt-2" :href="route('finalizaractividades.index')">
                        <i class="fa fa-check-square"></i> Finalizar Actividades
                    </inertia-link>                                    
              </div>
              <!-- /.card-header -->
              <!-- <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                      <li>
                      
                        
                      </li>
                  </ul>
              </div> -->
              <!-- /.card-body -->
              <div class="card-footer clearfix" >
                  <!-- <p>{{ estudiante.nombre_estudiante }}</p> -->
                                    
                        <table v-if="serviciosFiltrados.length != 0" class="table table-hover text-center" style="font-size: 20px">
                                    <thead class="thead-dark">
                                        <tr>                                        
                                        <th scope='col'>Institución</th>
                                        <th scope="col">Tipo de servicio</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col" width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary" scope="row" v-for="(servicio, index) in serviciosFiltrados" :key="index">
                                            
                                            <td class="d-xl-block">{{ servicio.nombre_institucion }}</td>
                                            <td>{{ servicio.nombre_tipo_servicio}}</td>
                                            <td>{{ servicio.nombre_carrera }}</td>
                                            <td>
                                                <button v-if="servicio.estado_proyecto_social == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                                <button v-else-if="servicio.estado_proyecto_social == 'En curso'" class="btn btn-success" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                                <button v-else-if="servicio.estado_proyecto_social == 'Finalizado'" class="btn btn-warning" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                                <button v-else-if="servicio.estado_proyecto_social == 'Cancelado'" class="btn btn-danger" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                            </td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center tools">

                                                    
                                                    <!-- <inertia-link
                                                    method="delete"
                                                    :href="route('carreras.destroy', carrera.id)"
                                                    v-on:click="mostrarMensajeDelete(carrera)">
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </inertia-link> -->
                                                    
                                                    <!-- <button class="btn btn-warning" v-on:click="this.verDetalle(servicio)" data-toggle="modal" data-target="#detalleServicioModal">
                                                        <i class="fas fa-eye mx-12"></i>
                                                    </button>     -->
                                                    <!-- <jet-button type="button" class="fas fa-info-circle text-yellow" data-toggle="modal" data-target="#detalleServicioModal" v-on:click="verDetalle(servicio)" title="Ver informacion del servicio social"></jet-button> -->
                                                    <a type="button" class="fas fa-info-circle text-yellow" :href="`/serviciossociales/${servicio.id}`" title="Ver informacion del servicio social"></a>
                                                    <!-- <a type="button" class="mt-3 ml-2 mb-1 btn btn-warning left"  title="Ver servicio social">Información del servicio</a>  -->
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                            </table>
                    <div v-else class="alert alert-warning ml-4 mr-4 mt-3 justify-center" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                        No se han encontrado registros
                    </div>


        <!-- Modal -->
    <div class="modal fade" id="detalleServicioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">{{ verDetalleForm.nombre_estudiante }} {{ verDetalleForm.apellido_estudiante }}</h5> -->
            <h3 class="modal-title d-flex flex-row-reverse">{{ verDetalleForm.nombre_institucion }}</h3>
            <span class="d-flex flex-row-reverse bd-highlight col">
                <!-- <button class="btn btn-dark text-light text-lg" style="cursor: default;">
                    {{ verDetalleForm.correo_institucion }}                   
                </button>      -->
                <!-- <h3 class="modal-title text-primary border rounded-lg mx-4">{{ verDetalleForm.carnet_estudiante }} </h3> -->
            </span>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> -->
        </div>
        <div class="modal-body">
            
                <div>
                    <h4 class="text-primary text-center underline"><u>Institución</u></h4>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Institución: </strong>{{ verDetalleForm.nombre_institucion }}</h5>
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Rubro: </strong>{{ verDetalleForm.rubro_institucion }}</h5>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Contacto: </strong>{{ verDetalleForm.contacto_institucion }}</h5>
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Correo: </strong>{{ verDetalleForm.correo_institucion }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Telefono: </strong>{{ verDetalleForm.telefono_institucion }}</h5>
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Ubicación: </strong>{{ verDetalleForm.ubicacion_institucion }}</h5>
                        </div>
                    </div>
                    <hr/>
                    <h4 class="text-primary text-center underline"><u>Servicio Social</u></h4>
                    <br/>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Fecha de inicio: </strong>
                                <button class="btn btn-info btn-lg p-2 text-lg" style="cursor:default;">{{ verDetalleForm.fecha_peticion }}</button>
                            </h5>                           
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Fecha de finalización: </strong>
                                <button class="btn btn-info btn-lg p-2 text-lg" style="cursor:default;">{{ verDetalleForm.fecha_peticion_fin}}</button>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Descripción de petición: </strong>{{ verDetalleForm.descripcion_peticion }}</h5>
                        </div>
                        <!-- <div class="">
                            <h5 class=""></h5>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Cantidad de horas: </strong>{{ verDetalleForm.numero_horas }} h</h5>
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Cantidad de estudiantes: </strong>{{ verDetalleForm.cantidad_estudiantes }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Tipo de Servicio: </strong>{{ verDetalleForm.nombre_tipo_servicio }}</h5>
                        </div>
                        <div class="col">
                            <!-- <h5 class=""><strong>Cantidad horas en servicio: </strong>{{ verDetalleForm.cantidad_horas_ss }} h</h5> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Ubicación de las actividades: </strong>{{ verDetalleForm.ubicacion_actividades }}</h5>
                        </div>
                        <!-- <div class="col">
                            <h5 class=""><strong>Cantidad horas en servicio: </strong>{{ verDetalleForm.cantidad_horas_ss }} h</h5>
                        </div> -->
                    </div>
                    <hr/>
                    <br/>
                    <div class="">
                        <div class="">
                            <h5 class=""><strong>Facultad: </strong>{{ verDetalleForm.nombre_facultad }}</h5>
                        </div>
                        <div class="row">
                            <h5 class="col"><strong>Carrera: </strong>{{ verDetalleForm.nombre_carrera }}</h5>
                            <div>
                                <span class="d-flex flex-row-reverse bd-highlight col">
                                    <h5 class=""><strong>Estado:  </strong>
                                        <button v-if="verDetalleForm.estado_proyecto_social == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ verDetalleForm.estado_proyecto_social }}</button>
                                        <button v-else-if="verDetalleForm.estado_proyecto_social == 'En curso'" class="btn btn-success" style="cursor: default;">{{ verDetalleForm.estado_proyecto_social }}</button>
                                        <button v-else-if="verDetalleForm.estado_proyecto_social == 'Finalizado'" class="btn btn-warning" style="cursor: default;">{{ verDetalleForm.estado_proyecto_social }}</button>
                                        <button v-else-if="verDetalleForm.estado_proyecto_social == 'Cancelado'" class="btn btn-danger" style="cursor: default;">{{ verDetalleForm.estado_proyecto_social }}</button>
                                    </h5>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>  
                <hr class="mb-1"/>
                </div>
                <div class="mb-4">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button> -->
                    <div class="d-flex justify-content-center">
                        <div class="row">
                                <!--BOTON PARA IR A ACTIVIDADES -->
                                    
                                    <button class="btn btn-warning" data-dismiss="modal">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        Ocultar detalle
                                    </button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>


                    <!-- </div>     -->

                  
              </div>
              </div>
              <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">            
              <!-- /.card -->
          </section>
          <!-- right col -->
          </div>
          <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    </div>


</template>
<script>

import Base from "@/Pages/Base.vue";
import Button from '../../../Jetstream/Button.vue';

    export default {
        components:{
        //   JetAuthenticationCard,
        //   JetAuthenticationCardLogo,
        //   JetInput,
        //   JetCheckbox,
        //   JetLabel,
        //   JetValidationErrors,
          Base
        },
        methods:{
            verDetalle(servicio){
                console.log(servicio);
                console.log(this.verDetalleForm);
                // this.verDetalleForm.fecha_inicio = servicio.fecha_inicio;
                // this.verDetalleForm.fecha_fin = servicio.fecha_fin;
                this.verDetalleForm.numero_horas = servicio.numero_horas;
                this.verDetalleForm.estado_proyecto_social = servicio.estado_proyecto_social;
                this.verDetalleForm.cantidad_estudiantes = servicio.cantidad_estudiantes;
                this.verDetalleForm.descripcion_peticion = servicio.descripcion_peticion;
                this.verDetalleForm.ubicacion_actividades = servicio.ubicacion_actividades;
                this.verDetalleForm.fecha_peticion = servicio.fecha_peticion;
                this.verDetalleForm.fecha_peticion_fin = servicio.fecha_peticion_fin;
                this.verDetalleForm.correo_peticion = servicio.correo_peticion;
                this.verDetalleForm.nombre_carrera = servicio.nombre_carrera;
                this.verDetalleForm.nombre_tipo_servicio = servicio.nombre_tipo_servicio;
                this.verDetalleForm.nombre_facultad = servicio.nombre_facultad;
                this.verDetalleForm.nombre_institucion = servicio.nombre_institucion;
                this.verDetalleForm.contacto_institucion = servicio.contacto_institucion;
                this.verDetalleForm.correo_institucion = servicio.correo_institucion;
                this.verDetalleForm.telefono_institucion = servicio.telefono_institucion;
                this.verDetalleForm.ubicacion_institucion = servicio.ubicacion_institucion;
                this.verDetalleForm.rubro_institucion = servicio.rubro_institucion;
            },
            // buscar(descripcionServicio){
            //     this.estado = 0;
            //     this.filtrarServicios.splice(0, this.filtrarServicios.length);
            //     console.log(descripcionServicio);
            //     if(descripcionServicio == null || descripcionServicio == ''){
            //         this.filtrarServicios.splice(0, this.filtrarServicios.length);
            //         this.servicios.forEach(element => {
            //             this.filtrarServicios.push(element);
            //         });
            //     }else{
            //         this.servicios.forEach(element => {
            //             // console.log(element);
            //             var nombreCompleto = element.nombre_estudiante + element.apellido_estudiante;
            //             //Filtrar por nombre
            //             if(nombreCompleto.toUpperCase().includes(nombreEstudiante.toUpperCase())){
            //                 console.log(element);
            //                 this.filtrarEstudiantes.push(element);
            //             }
            //             //Filtrar por carnet
            //             if(element.carnet_estudiante.toUpperCase().includes(nombreEstudiante.toUpperCase())){
            //                 console.log(element);
            //                 this.filtrarEstudiantes.push(element);
            //             }
            //         });
            //     }
            //     console.log(this.filtrarEstudiantes);
            //     console.log(descripcionServicio);
            // },
            filtrarValores(campo){
                // this.llenarFiltroValor(valor);
                if(this.campo == 0){
                    document.getElementById("idFiltroServicios").setAttribute("disabled", true);
                    this.filtrarServicios(0);
                }else{
                    document.getElementById("idFiltroServicios").removeAttribute("disabled");
                }
                this.valor = 0;
                this.valoresFiltrados.splice(0, this.valoresFiltrados.length);
                console.log("-----> " + campo);
                if(campo == 'TipoServicio'){
                    // this.valoresFiltrados = this.tipos;
                    this.tipos.forEach(element => {
                        this.valoresFiltrados.push(element.nombre_tipo_servicio);
                    })
                }else if(campo == 'Carrera'){
                    // this.valoresFiltrados = this.carreras;
                    this.carreras.forEach(element => {
                        this.valoresFiltrados.push(element.nombre_carrera);
                    })
                }else if(campo == 'Estado'){
                    this.valoresFiltrados = this.campoEstado;
                    // this.tipos.forEach(element => {
                    //     this.valoresFiltrados.push(element.estado_proyecto_social);
                    // })
                }
                console.log(this.valoresFiltrados);

                // this.filtrarServicios.splice(0, this.filtrarServicios.length);
                // console.log(valor);
                // if(valor == 0){
                //     this.filtrarServicios.splice(0, this.filtrarServicios.length);
                //     this.servicios.forEach(element => {
                //         this.filtrarServicios.push(element);
                //     });
                // }
                // else{
                //     this.servicios.forEach(element => {
                //         if(valor == element.campo){
                //             this.filtrarServicios.push(element);
                //         }
                //     });
                // }
            },
            filtrarServicios(valor){
                this.serviciosFiltrados.splice(0, this.serviciosFiltrados.length);
                console.log(valor);
                console.log("this.valor es -> " + this.valor);
                this.servicios.forEach(element => {
                    if(this.campo == 'TipoServicio'){
                        console.log("Estamos en tipoSe");
                        if(valor == element.nombre_tipo_servicio){
                            this.serviciosFiltrados.push(element);
                        }
                    }else if(this.campo == 'Carrera'){
                        console.log("Estamos en Carrera");
                        if(valor == element.nombre_carrera){
                            this.serviciosFiltrados.push(element);
                        }
                    }else if(this.campo == 'Estado'){
                        console.log("Estamos en estado");
                        if(valor == element.estado_proyecto_social){
                            this.serviciosFiltrados.push(element);
                        }
                    }
                })
                if(this.valor == 0){
                    console.log("El valor es 0, se cargan todos los servicios");
                    this.serviciosFiltrados.splice(0, this.serviciosFiltrados.length);
                    this.servicios.forEach(element => {
                        this.serviciosFiltrados.push(element);
                    });
                }
            },

            siFiltrar(){
                console.log(this.boolFiltrar);               
                if(this.boolFiltrar){
                    document.getElementById("idFiltroValores").removeAttribute("disabled");
                }else{
                    document.getElementById("idFiltroValores").setAttribute("disabled", true);
                    this.campo = 0;
                    this.valor = 0;
                }
                this.filtrarServicios(0);
            }
        },
        props:['servicios', 'tipos', 'carreras'],
        data(){
            return{
                verDetalleForm:{
                    fecha_inicio:'',
                    fecha_fin:'',
                    numero_horas:'',
                    estado_proyecto_social:'',
                    cantidad_estudiantes:'',
                    descripcion_peticion:'',
                    ubicacion_actividades:'',
                    fecha_peticion:'',
                    estado_proyecto_social:'',
                    correo_peticion:'',
                    nombre_carrera:'',
                    nombre_tipo_servicio:'',
                    nombre_facultad:'',
                    nombre_institucion:'',
                    contacto_institucion:'',
                    correo_institucion:'',
                    telefono_institucion:'',
                    ubicacion_institucion:'',
                    rubro_institucion:'',
                },
                buscarNombre:'',
                serviciosFiltrados:[],
                valor: 0,
                campo:0,
                boolFiltrar: false,
                campoTipo: this.tipos,
                campoEstado:['No iniciado', 'En curso', 'Finalizado', 'Cancelado'],
                campoCarrera: this.carreras,
                valoresFiltrados: [],
            }
        },
        mounted(){
            this.servicios.forEach(element => {
                this.serviciosFiltrados.push(element);
            });
            console.log(this.campoTipo);
            console.log(this.campoEstado);
            console.log(this.campoCarrera);
        },
    }    
</script>
