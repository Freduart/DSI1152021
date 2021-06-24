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
            <h1 class="ml-3">Listado de estudiantes</h1>
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
                        
                        
                        <div class="row">
                            <div class="col">
                                <span>Buscar: </span>
                            </div>
                            <div class="col">
                                <input type="text" class="rounded-sm mb-2" style="width: 350px;" v-model="this.buscarNombre" v-on:keyup="buscar(this.buscarNombre)"> 
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col">
                                <span>Filtrar por: </span>
                            </div>
                            <div class="col">
                                <select class="col-5 ml-3" style="width: 350px;" v-model="this.estado" v-on:change="filtrarByEstado(this.estado)">
                                    <option value="0" selected>Todos</option>
                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Activo">Activo</option>
                                    <option value="En espera">En espera</option>
                                    <option value="Realizando servicio">Realizando servicio</option>
                                    <option value="Servicio finalizado">Servicio finalizado</option>
                                </select> 
                            </div>      
                        </div>                       
                  </h3>                  
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
                <div class="row">
                      <!-- <div class="col-sm-4" v-for="(estudiante, index) in this.filtrarEstudiantes" :key="index"> -->
                        <!-- <div class="card">
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <h4 class=""><strong>Nombre: </strong>{{ estudiante.nombre_estudiante }} {{ estudiante.apellido_estudiante }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h4><strong>Carnet: </strong>{{ estudiante.carnet_estudiante }}</h4>
                                    </div>
                                    <div class="">
                                        <span class="d-flex flex-row-reverse bd-highlight col">
                                                <button v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-primary" disabled>{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Inactivo'" class="btn btn-danger" disabled>{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Servicio finalizado'" class="btn btn-success" disabled>{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Realizando servicio'" class="btn btn-info" disabled>En servicio</button>
                                        </span>
                                    </div> 
                                </div>                            
                            </div>
                            <hr class=""/>

                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-warning" v-on:click="this.verDetalle(estudiante)" data-toggle="modal" data-target="#detalleEstudianteModal">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            Ver detalle
                                    </button>
                                </div>
                                                                                                             
                        </div>
                        </div> -->
                        <table class="table table-striped table-dark text-center" style="font-size: 20px">
                                    <thead>
                                        <tr>
                                        
                                        <th scope='col'>Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Carnet</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr scope="row" v-for="(estudiante, index) in filtrarEstudiantes" :key="index">
                                            
                                            <td>{{ estudiante.nombre_estudiante }}</td>
                                            <td>{{ estudiante.apellido_estudiante }}</td>
                                            <td>{{ estudiante.carnet_estudiante }}</td>
                                            <td>
                                                <button v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-primary" style="cursor: default;">{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Inactivo'" class="btn btn-danger" style="cursor: default;">{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Activo'" class="btn btn-light" style="cursor: default;">{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Servicio finalizado'" class="btn btn-success" style="cursor: default;">{{ estudiante.estado_estudiante }}</button>
                                                <button v-else-if="estudiante.estado_estudiante == 'Realizando servicio'" class="btn btn-info" style="cursor: default;">En servicio</button>
                                            </td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center">

                                                    
                                                    <!-- <inertia-link
                                                    method="delete"
                                                    :href="route('carreras.destroy', carrera.id)"
                                                    v-on:click="mostrarMensajeDelete(carrera)">
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </inertia-link> -->
                                                    
                                                    <button class="btn btn-warning" v-on:click="this.verDetalle(estudiante)" data-toggle="modal" data-target="#detalleEstudianteModal">
                                                        <i class="fas fa-eye mx-12"></i>
                                                        Ver detalle
                                                    </button>    
                                                
                                                
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

        <!-- Modal -->
    <div class="modal fade" id="detalleEstudianteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">{{ verDetalleForm.nombre_estudiante }} {{ verDetalleForm.apellido_estudiante }}</h5> -->
            <h3 class="modal-title text-primary">{{ verDetalleForm.nombre_estudiante }} {{ verDetalleForm.apellido_estudiante }}</h3>
            <span class="d-flex flex-row-reverse bd-highlight col">
                <button class="btn btn-dark text-light text-lg" style="cursor: default;">
                    {{ verDetalleForm.carnet_estudiante }}                   
                </button>     
                <!-- <h3 class="modal-title text-primary border rounded-lg mx-4">{{ verDetalleForm.carnet_estudiante }} </h3> -->
            </span>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button> -->
        </div>
        <div class="modal-body">
            
                <div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Correo: </strong>{{ verDetalleForm.correo_estudiante }}</h5>
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Teléfono: </strong>{{ verDetalleForm.telefono_estudiante }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Sexo: </strong>{{ verDetalleForm.sexo_estudiante }}</h5>
                        </div>
                        <div class="col">
                            <h5 class=""></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col" v-if="verDetalleForm.dui_estudiante != null">
                            <h5 class=""><strong>DUI: </strong>{{ verDetalleForm.dui_estudiante}}</h5>
                        </div>
                        <div class="col" v-else>
                            <h5 class=""><strong>DUI: </strong><span class="text-danger">No se ha ingresado este dato.</span></h5>
                        </div>
                        <div class="col" v-if="verDetalleForm.nit_estudiante != null">
                            <h5 class=""><strong>NIT:</strong>{{ verDetalleForm.nit_estudiante }}</h5>
                        </div>
                        <div class="col" v-else>
                            <h5 class=""><strong>NIT: </strong><span class="text-danger">No se ha ingresado este dato.</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 class=""><strong>Porcentaje de carrera: </strong>{{ verDetalleForm.materias_cursadas }} %</h5>
                        </div>
                        <div class="col">
                            <h5 class=""><strong>Cantidad horas en servicio: </strong>{{ verDetalleForm.cantidad_horas_ss }} h</h5>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <h5 class=""><strong>Facultad: </strong>{{ verDetalleForm.nombre_facultad }}</h5>
                        </div>
                        <div class="row">
                            <h5 class="col"><strong>Carrera: </strong>{{ verDetalleForm.nombre_carrera }}</h5>
                            <div>
                                <span class="d-flex flex-row-reverse bd-highlight col">
                                    <h5 class=""><strong>Estado:  </strong>
                                        <button v-if="verDetalleForm.estado_estudiante == 'En espera'" class="btn btn-primary" disabled>{{ verDetalleForm.estado_estudiante }}</button>
                                        <button v-else-if="verDetalleForm.estado_estudiante == 'Inactivo'" class="btn btn-danger" disabled>{{ verDetalleForm.estado_estudiante }}</button>
                                        <button v-else-if="verDetalleForm.estado_estudiante == 'Activo'" class="btn btn-secondary" style="cursor: default;">{{ verDetalleForm.estado_estudiante }}</button>
                                        <button v-else-if="verDetalleForm.estado_estudiante == 'Servicio finalizado'" class="btn btn-success" disabled>{{ verDetalleForm.estado_estudiante }}</button>
                                        <button v-else-if="verDetalleForm.estado_estudiante == 'Realizando servicio'" class="btn btn-info" disabled>En servicio</button>
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
                        <button class="btn btn-warning" v-on:click="this.verDetalle(estudiante)" data-dismiss="modal">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                Ocultar detalle
                        </button>
                    </div>
                </div>
                </div>
            </div>
            </div>


                    <!-- </div>     -->

                </div>  
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
            verDetalle(estudiante){
                // console.log(estudiante);
                this.verDetalleForm.nombre_estudiante = estudiante.nombre_estudiante;
                this.verDetalleForm.apellido_estudiante = estudiante.apellido_estudiante;
                this.verDetalleForm.carnet_estudiante = estudiante.carnet_estudiante;
                this.verDetalleForm.nombre_carrera = estudiante.nombre_carrera;
                this.verDetalleForm.nombre_facultad = estudiante.nombre_facultad;
                this.verDetalleForm.estado_estudiante = estudiante.estado_estudiante;
                this.verDetalleForm.correo_estudiante = estudiante.correo_estudiante;
                this.verDetalleForm.telefono_estudiante = estudiante.telefono_estudiante;
                this.verDetalleForm.sexo_estudiante = estudiante.sexo_estudiante;
                this.verDetalleForm.dui_estudiante = estudiante.dui_estudiante;
                this.verDetalleForm.nit_estudiante = estudiante.nit_estudiante;
                this.verDetalleForm.materias_cursadas = estudiante.materias_cursadas;
                this.verDetalleForm.cantidad_horas_ss = estudiante.cantidad_horas_ss;
            },
            buscar(nombreEstudiante){
                this.estado = 0;
                this.filtrarEstudiantes.splice(0, this.filtrarEstudiantes.length);
                console.log(nombreEstudiante);
                if(nombreEstudiante == null || nombreEstudiante == ''){
                    this.filtrarEstudiantes.splice(0, this.filtrarEstudiantes.length);
                    this.estudiantes.forEach(element => {
                        this.filtrarEstudiantes.push(element);
                    });
                }else{
                    this.estudiantes.forEach(element => {
                        // console.log(element);
                        var nombreCompleto = element.nombre_estudiante + element.apellido_estudiante;
                        //Filtrar por nombre
                        if(nombreCompleto.toUpperCase().includes(nombreEstudiante.toUpperCase())){
                            console.log(element);
                            this.filtrarEstudiantes.push(element);
                        }
                        //Filtrar por carnet
                        if(element.carnet_estudiante.toUpperCase().includes(nombreEstudiante.toUpperCase())){
                            console.log(element);
                            this.filtrarEstudiantes.push(element);
                        }
                    });
                }
                console.log(this.filtrarEstudiantes);
            },
            filtrarByEstado(estado){
                this.buscarNombre = '';
                this.filtrarEstudiantes.splice(0, this.filtrarEstudiantes.length);
                console.log(estado);
                if(estado == 0){
                    this.filtrarEstudiantes.splice(0, this.filtrarEstudiantes.length);
                    this.estudiantes.forEach(element => {
                        this.filtrarEstudiantes.push(element);
                    });
                }
                else{
                    this.estudiantes.forEach(element => {
                        if(estado == element.estado_estudiante){
                            this.filtrarEstudiantes.push(element);
                        }
                    });
                }
            },
        },
        props:['estudiantes'],
        data(){
            return{
                verDetalleForm:{
                    nombre_estudiante:'',
                    apellido_estudiante:'',
                    correo_estudiante:'',
                    telefono_estudiante:'',
                    sexo_estudiante:'',
                    dui_estudiante:'',
                    nit_estudiante:'',
                    materias_cursadas:'',
                    cantidad_horas_ss:'',
                    nombre_facultad:'',
                    nombre_carrera:'',
                    estado_estudiante:'',
                    carnet_estudiante:'',
                },
                buscarNombre:'',
                filtrarEstudiantes:[],
                estado: 0,
            }
        },
        mounted(){
            this.estudiantes.forEach(element => {
                this.filtrarEstudiantes.push(element);
            });
        },
    }    
</script>
