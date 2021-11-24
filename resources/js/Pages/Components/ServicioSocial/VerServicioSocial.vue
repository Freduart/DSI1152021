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
            <h1 class="ml-3">Servicio social</h1>
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
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="ml-2">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 ml-5">
                                <div class="row mb-2"><h5><strong>Información del servicio social</strong></h5></div>
                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Servicio: </strong></h6>
                                    </div>
                                    <div class="col">
                                    <h6 class="">{{ servicio.nombre_peticion }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Tipo: </strong></h6>
                                    </div>
                                    <div class="col">
                                    <h6 class="">{{ servicio.nombre_tipo_servicio }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Lugar del servicio: </strong></h6>
                                    </div>
                                    <div class="col">
                                    <h6 class="">{{ servicio.ubicacion_actividades }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Duración: </strong></h6>
                                    </div>
                                    <div class="col">
                                    <h6 class="">{{ servicio.fecha_peticion }} — {{ servicio.fecha_peticion_fin }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Total horas: </strong></h6>
                                    </div>
                                    <div class="col">
                                    <h6 class="">{{ servicio.cantidad_horas }} horas</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Estudiantes solicitados: </strong></h6>
                                    </div>
                                    <div class="col">
                                    <h6 class="">{{ servicio.cantidad_estudiantes }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    <h6 class=""><strong>Estado: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">
                                            <button v-if="servicio.estado_proyecto_social == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                            <button v-else-if="servicio.estado_proyecto_social == 'En curso'" class="btn btn-success" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                            <button v-else-if="servicio.estado_proyecto_social == 'Finalizado'" class="btn btn-warning" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                            <button v-else-if="servicio.estado_proyecto_social == 'Cancelado'" class="btn btn-danger" style="cursor: default;">{{ servicio.estado_proyecto_social }}</button>
                                        </h6>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 ml-5">
                                <div class="row mb-2"><h5><strong>Información de la institución</strong></h5></div>
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class=""><strong>Institución: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{ servicio.nombre_institucion }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h6 class=""><strong>Rubro: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{ servicio.rubro_institucion }}</h6>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-4">
                                        <h6 class=""><strong>Correo: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{ servicio.correo_institucion }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h6 class=""><strong>Contacto: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{ servicio.contacto_institucion }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h6 class=""><strong>Teléfono: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{ servicio.telefono_institucion }}</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h6 class=""><strong>Ubicación: </strong></h6>
                                    </div>
                                    <div class="col">
                                        <h6 class="">{{ servicio.ubicacion_institucion }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        
                      
                        <div class="row ml-3">
                              <div class="col">
                                <!-- <jet-button type="button" class="mt-3 ml-2 mb-1 btn btn-primary" data-toggle="modal" data-target="#verInstitucion" v-on:click="mostrarInstitucion(servicio)" title="Ver informacion de la institución">Información de la institución</jet-button> -->
                                <!-- <a v-if="servicio.estado == 'En curso'" type="button" class="mt-3 ml-2 mb-1 btn btn-warning left" :href="`/actividades/${servicio.idServicio}`" title="Ver informacion de la actividad">Información de las actividades</a> -->
                                <!-- <a type="button" class="mt-3 ml-2 mb-1 btn btn-warning left" :href="`/serviciossociales`" title="Ver todos los servicios">Regresar a todos los servicios</a>  -->
                                <button v-if="servicio.estado_proyecto_social == 'En curso'" type="button" class="mt-3 ml-2 mb-1 btn btn-danger" title="Finalizar servicio social" v-on:click="finalizarservicio();">
                                    <i class="fa fa-check-square"></i> Finalizar servicio social
                                </button>
                                <jet-button v-else-if="servicio.estado_proyecto_social == 'No iniciado'" type="button" class="mt-3 ml-2 mb-1 btn btn-success" title="Iniciar servicio social" v-on:click="iniciarservicio();">
                                    <i class="fa fa-check-square"></i> Iniciar servicio social
                                </jet-button> 

                                <!-- BOTON DE EDITAR cantidad de horas -->
                                <jet-button  v-if="servicio.estado_proyecto_social == 'No iniciado'" v-on:click="mostrarMensajeUpdate(servicio)" data-toggle="modal" type="button" class="mt-3 ml-2 mb-1 btn btn-warning"
                                data-target="#modificarCantidad" title="Editar Cantidad de Horas"> <i class="fas fa-edit"></i> Modificar hora de servicio social </jet-button>

                            </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
              
              <div class="card">
              <div class="card-header">
                    <h5><strong>Estudiantes inscritos</strong></h5>
                    <h3 class="card-title mt-3 mb-3 ml-1">
                        
                        <div class="row">
                            <div class="col">
                                <span>Buscar: </span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control rounded-sm mb-2" style="width: 350px;" v-model="this.buscarNombre" v-on:keyup="buscar(this.buscarNombre)"> 
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col">
                                <span>Filtrar por: </span>
                            </div>
                            <div class="col">
                                <select class="form-control col-5 ml-3" style="width: 350px;" v-model="this.estado" v-on:change="filtrarByEstado(this.estado)">
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
                    <table v-if="filtrarEstudiantes.length != 0" class="table table-hover text-center" style="font-size: 20px">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Carnet</th>
                            <th scope='col'>Nombres</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Estado Actividades</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-secondary" scope="row" v-for="(estudiante, index) in filtrarEstudiantes" :key="index">
                                <td>{{ estudiante.carnet_estudiante }}</td>
                                <td>{{ estudiante.nombre_estudiante }} {{ estudiante.apellido_estudiante }}</td>
                                <td>{{ estudiante.total_horas }}</td>
                                <td>
                                    <button v-if="estudiante.estado_bitacora == 'En curso'" class="btn btn-primary" style="cursor: default;">{{ estudiante.estado_bitacora }}</button>
                                    <button v-else-if="estudiante.estado_bitacora == 'Finalizado'" class="btn btn-success" style="cursor: default;">{{ estudiante.estado_bitacora }}</button>
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
                                        
                                        <!-- <button class="btn btn-warning" v-on:click="this.verDetalle(estudiante)" data-toggle="modal" data-target="#detalleEstudianteModal">
                                            <i class="fas fa-eye mx-12"></i>
                                            Ver detalle
                                        </button>     -->
                                        <jet-button type="button" class="fas fa-info-circle text-yellow" data-toggle="modal" data-target="#detalleEstudianteModal" v-on:click="verDetalle(estudiante)" title="Ver informacion del estudiante"></jet-button>
                                        <a type="button" class="fas fa-book text-blue ml-1" :href="`/serviciossociales/${idServicio}/estudiante/${estudiante.estudiante_id}`" title="Ver actividades"></a>
                                    
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="alert alert-warning ml-4 mr-4 mt-3 justify-center" role="alert" style="width: 100%; color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                        No se han encontrado registros
                    </div> 
                              

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
                            <h5 class=""><strong>Porcentaje de carrera: </strong>{{ verDetalleForm.porcentaje_aprobacion }} %</h5>
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

              <!-- Modal para ACTUALIZAR los campos de las cantidades de hora y estudiantes con el boton de edit-->
 <div class="modal fade" id="modificarCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modificar Cantidad de Horas al Servicio Social</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      <div class="modal-body">
        
        <!-- MUESTRA EN PANTALLA LOS CAMPOS LLENOS CON LOS DATOS INGRESADOS LISTOS PARA SER MODIFICADOS--->
          <form @submit.prevent="submitUpdate(this.formUp)">
            <div class="card-body">
                    <div class="row">
                      <div class="col">
                       <div class="form-group">
                            <jet-label for="horas" value="Cantidad de Horas para el Servicio Social" />
                            <jet-input id="horas" type="text" v-model="formUp.cantidad_horas" required autofocus autocomplete="off" :value="this.formUp.cantidad_horas"/>
                        </div>
                      </div>
                      
                    </div>
                   <!-- <div class="row">
                      <div class="col">
                            <div class="form-group">
                                 <jet-label for="cantidad" value="Cantidad de Estudiantes para el Servicio Social" />
                                 <jet-input id="cantidad" type="text" v-model="formUp.cantidad" required autofocus autocomplete="off" :value="this.formUp.cantidad"/>
                            </div>
                      </div>
                    </div>-->
                    <br>

                </div>



            <!--BOTONES DE GUARDAR Y CANCELAR EN ACTUALIZAR -->
               <div class="d-flex justify-content-center align-items-baseline">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="mt-12">
                                    <jet-button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="submitUpdate(this.formUp)">
                                    <i class="fas"></i>Guardar
                                          
                                     </jet-button>  
                                </div>                  
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-grup">
                                <jet-button :href="route('establecerha.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                                 Cancelar</jet-button>
                            </div>
                        </div>

                    </div>
               </div>
 
          </form>
        </div>
      </div>
    </div>
 </div>
 <!--Final Modal Update de Cantidades-->




</template>
<script>
import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'

import Base from "@/Pages/Base.vue";

    export default {
        components:{
        //   JetAuthenticationCard,
        //   JetAuthenticationCardLogo,
           JetInput,
        //   JetCheckbox,
           JetLabel,
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
                this.verDetalleForm.porcentaje_aprobacion = estudiante.porcentaje_aprobacion;
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

            finalizarservicio(){
                this.form.tipo = 'finalizar';
                var cont = 0;
                var estudiantes = this.estudiantes;
                for(var estudiante of estudiantes){
                    if (estudiante.estado_bitacora == "En curso"){
                        cont++;
                    }
                }
                
                if(cont == 0){
                    Swal.fire({
                        title: '¡Atención!',
                        text: "Esta a punto de finalizar el servicio social. Se dará por terminado dicho servicio social ¿Desea continuar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Finalizar servicio',
                        cancelButtonText: 'No, cancelar'  
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$inertia.put(route("serviciossociales.update",this.servicio.id), this.form);
                            Swal.fire({
                                title: 'Servicio social finalizado',
                                text: "Este servicio ha finalizado con éxito",
                                icon: 'success',
                                confirmButtonText: 'Aceptar',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showConfirmButton: true,  
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Alerta',
                        text: "Para finalizar un servicio social se deben conceder las horas a todos los estudiantes",
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: true,  
                    })
                }
            },


            iniciarservicio(){
                this.form.tipo = 'iniciar';
                var cont = 0;
                var estudiantes = this.estudiantes;
                for(var estudiante of estudiantes){
                    cont++;
                }
                
                //if (cont == this.servicio.cantidad_estudiantes) {
                if (5==5) {
                    Swal.fire({
                        title: '¡Atención!',
                        text: "Esta a punto de iniciar el servicio social.¿Desea continuar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, iniciar servicio',
                        cancelButtonText: 'No, cancelar'  
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$inertia.put(route("serviciossociales.update",this.servicio.id), this.form);
                            Swal.fire({
                                title: 'Servicio social iniciado',
                                text: "Este servicio ha iniciado con éxito",
                                icon: 'success',
                                confirmButtonText: 'Aceptar',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                showConfirmButton: true,  
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    })
                } else {
                     Swal.fire({
                        title: 'Error',
                        html: "<h5>Aun no cuenta con suficientes alumnos para iniciar el servicio social.</h5><h5>Alumnos incritos: <b>" + cont + "</b></h5><h5>Alumnos solicitados por la institucion: <b>" + this.servicio.cantidad_estudiantes + "</b></h5>",
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: true,
                        allowOutsideClick: true,
                        showConfirmButton: true,  
                    })
                }
            },
            //Muestra mensaje cuando se actualiza los campos
            submitUpdate(form){
                alert(this.formUp.cantidad_horas);
                console.log(this.formUp);
                console.log(form);
                Swal.fire({
                    title: 'Se han actualizado las cantidades ',
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                this.$inertia.put(route("serviciosocial.edit", this.formUp.idServicio), this.formUp);
            },
            mostrarMensajeUpdate(servicio){
                console.log(servicio);
                this.formUp.cantidad_horas= servicio.cantidad_horas;
                //this.formUp.horas = servicio.horas;                
                this.formUp.idServicio = servicio.idServicio;
                this.formUp.idPeticion = servicio.idPeticion;
                
                console.log(this.formUp);
            },

        },
        props:['estudiantes', 'servicio', 'idServicio'],
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
                    porcentaje_aprobacion:'',
                },
                buscarNombre:'',
                filtrarEstudiantes:[],
                estado: 0,
                form: this.$inertia.form({
                    servicio_social_id: this.servicio.id,
                    tipo: '',
                }),

                form: this.$inertia.form({
                    cantidad_horas:0,
                    idServicio:0,
                    idPeticion:0
                    }),

                formUp: this.$inertia.form({
                    //Aqui van los campos que se van a modificar
                    cantidad_horas:0,
                    idServicio:0,
                    idPeticion:0
                    }),
            }
        },
        mounted(){
            this.estudiantes.forEach(element => {
                this.filtrarEstudiantes.push(element);
            });
            
        },
    }    
</script>
