<template>

    <div class="wrapper">
        <!-- Navbar -->
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
            <h1 class="m-0">Bitacora del estudiante</h1>
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
                <div class="card">
                  <div class="card-body">
                      <div class = "d-flex justify-content-center">
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col">
                              <div class = "d-flex justify-content-center">
                                <h4 class="m-0"><strong> UNIVERSIDAD DE EL SALVADOR </strong></h4>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class = "d-flex justify-content-center">
                                <h5 class="m-0"> <strong> {{ $props.estudiante.nombre_facultad }} </strong></h5>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col">
                              <div class = "d-flex justify-content-center">
                                <h5 class="m-0"> <strong> {{ $props.estudiante.nombre_carrera }} </strong></h5>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <br/>
                    <div class="row">
                        
                      <div class="col-sm-6 ml-4">

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Carnet</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.estudiante.carnet_estudiante }} 
                          </div>
                        </div> 
                        
                        <div class="row">
                          <div class="col-md-5">
                            <strong>Nombre Estudiante:</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.estudiante.nombre_estudiante }} {{ $props.estudiante.apellido_estudiante }}
                          </div>
                        </div> 

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Servicio social:</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.servicio.nombre_peticion }}
                          </div>
                        </div> 

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Estado del servicio:</strong>
                          </div>
                          <div class="col-md-6">
                            <h5 class="">
                                  <button v-if="$props.servicio.estado_proyecto_social == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ $props.servicio.estado_proyecto_social }}</button>
                                  <button v-else-if="$props.servicio.estado_proyecto_social == 'En curso'" class="btn btn-success" style="cursor: default;">{{ $props.servicio.estado_proyecto_social }}</button>
                                  <button v-else-if="$props.servicio.estado_proyecto_social == 'Finalizado'" class="btn btn-warning" style="cursor: default;">{{ $props.servicio.estado_proyecto_social }}</button>
                                  <button v-else-if="$props.servicio.estado_proyecto_social == 'Cancelado'" class="btn btn-danger" style="cursor: default;">{{ $props.servicio.estado_proyecto_social }}</button>
                              </h5>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-2 ml-3">Lista de Actividades</h3>
                    <div class="row">
                      <!--Boton para añadir actividades-->
                      <div class="col">
                          <div class="form-group">
                            <button v-if="this.bitacora.estado_bitacora == 'En curso'" type="button" class="btn btn-success float-right" v-on:click="limpiar();" data-toggle="modal" data-target="#añadirActividad">
                            <i class="fas fa-plus"></i> Añadir Actividad</button> 
                          </div>
                      </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div v-if="actividadesFiltradas.length != 0">
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                           
                          <!--Tabla donde apareceran todos las actividadess-->
                          <table class="table table-hover text-center" width="500" style="font-size: 20px">
                              <thead class="thead-dark">
                                  <tr> 
                                  <!-- <th scope='col'>Código</th> -->
                                  <th scope="col">Actividadd</th>
                                  <th scope="col">Fecha</th>
                                  <th scope="col">Horas</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col" width="15%" ></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr class="table-secondary" scope="row" v-for="(actividad, index) in actividadesFiltradas" :key="index">
                                      
                                      <!--Aqui devuelven los datos que se mostraran en pantalla -->
                                      <td>{{ actividad.nombre_actividad }}</td>
                                      <td>{{ actividad.fecha_actividad }}</td>
                                      <td>{{ actividad.total_horas }}</td>
                                      <td>
                                          <button v-if="actividad.verificado == 'En espera'" class="btn btn-primary" style="cursor: default;">{{ actividad.verificado }}</button>
                                          <button v-else-if="actividad.verificado == 'Aceptada'" class="btn btn-success" style="cursor: default;">{{ actividad.verificado }}</button>
                                          <button v-else-if="actividad.verificado == 'Reportada'" class="btn btn-warning" style="cursor: default;">{{ actividad.verificado }}</button>  
                                      </td>

                                      <td>
                                      <!-- Botones para edit or delete-->
                                          <div class="tools">
                                              
                                              <!-- BOTON DE VER INFORMACION -->
                                              <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(actividad)" title="Ver mas informacion de la actividad"></jet-button>
                                              

                                              <!--BOTON DE EDITAR -->
                                              <jet-button v-if="actividad.verificado != 'Aceptada'" v-on:click="mostrarMensajeUpdate(actividad)" data-toggle="modal" 
                                              data-target="#modificarActividad" title="Editar Actividad"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>

                                              <!--BOTON DE ELIMINAR -->
                                              <inertia-link v-if="actividad.verificado != 'Aceptada'" class="fas fa-trash ml-1" style='color:#dc3545' title="Dar de baja a actividad" method="delete"
                                              :href="route('actividades.destroy', actividad.id)"
                                              v-on:click="mostrarMensajeDelete(actividad)"></inertia-link>
                                                    
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                          <h5>
                            <strong>Total de horas aceptadas: 
                              <!--Llamamos la variblae total, que tiene el total de horas de las actividades realizadas-->
                              {{ this.horasTotales }} horas 
                            </strong>
                          </h5>
                        </li>
                    </ul>
                </div>
                </div>
                <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                    No se han encontrado datos
                </div>

                <div class="card-footer clearfix">

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



  <!-- Modal Insertar los datos de las actividades desde el boton añadir-->
  <div class="modal fade" id="añadirActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Añadir Actividad</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <!-- MUESTRA EN PANTALLA LOS CAMPOS A INGRESAR-->
        <form @submit.prevent="submit">
                <div class="card-body"> 
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="nombre_actividad" value="Actividad" />
                            <jet-input id="nombre_actividad" type="text" v-model="form.nombre_actividad" required autofocus autocomplete="off"/>
                        </div>
                      </div>
 
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="fecha_actividad" value="Fecha de la actividad" />
                            <jet-input id="fecha_actividad" type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" v-model="form.fecha_actividad" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="total_horas" value="Total de horas" />
                            <jet-input id="total_horas" type="text" v-model="form.total_horas" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                </div>
                
            <!--    BOTONES DE GUARDAR Y CANCELAR PARA LA MODAL DE INSERTAR-->
            <div class="d-flex justify-content-center align-items-baseline">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="mt-12">
                                <button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': form.processing }" >
                                <i class="fas"></i>Guardar
                                <!--<i class="fas fa-save"></i>  Guardar Actividad --> 
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col">
                        <div class="form-group">
                            <inertia-link :href="`/actividades/${$props.idServicio}`" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                             Cancelar</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
    
 
        </form>
        </div>
      </div>
    </div>
  </div><!--Final Modal Insertar actividades-->



<!-- Modal para actualizar los campos de las actividades con el boton de edit-->
<div class="modal fade" id="modificarActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Actividad</h5>
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
                            <jet-label for="nombre_actividad" value="Actividad" />
                            <jet-input id="nombre_actividad" type="text" v-model="formUp.nombre_actividad" required autofocus autocomplete="off" :value="this.formUp.nombre_actividad"/>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col">

                        <div class="form-group">
                                <jet-label for="fecha_actividad" value="Fecha de la Actividad" />
                                <jet-input id="fecha_actividad" type="date" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" v-model="formUp.fecha_actividad" required autofocus autocomplete="off" :value="this.formUp.fecha_actividad"/>
                         </div>
                      </div>
                      <div class="col">

                            <div class="form-group">
                                 <jet-label for="total_horas" value="Total de horas" />
                                 <jet-input id="total_horas" type="text" v-model="formUp.total_horas" required autofocus autocomplete="off" :value="this.formUp.total_horas"/>
                            </div>
                      </div>
                    </div>
                    <br>
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
                                         <!--<i class="fas fa-edit"></i>  Modificar-->   
                                     </jet-button>  
                                </div>                  
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-grup">
                                <jet-button :href="`/actividades/${$props.idServicio}`" type="button" class="btn btn-danger float-center" data-dismiss="modal">
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
<!--Final Modal Update de actividades-->

<!-- Modal de la informacion de la actividad -->
    <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
             
             <h5 class="modal-title text-primary"><strong>Informacion de la actividad</strong></h5>
              <!--<h3 class="modal-title text-primary">{{ form.nombre_actividad }} </h3>-->
              <span class="d-flex flex-row-reverse bd-highlight col">
                  
                  <button class="btn btn-dark text-light text-lg" style="cursor: default;">
                      {{ form.verificado }}                   
                  </button>    
                  <h5 class="mt-2 mr-2"><strong>Estado:</strong></h5> 
              </span>
          </div>
          <div class="modal-body">
            <table>
              <tr>
                <td><h5 class=""><strong>Actividad: </strong></h5></td>
                    <td> <h5> {{ form.nombre_actividad }}</h5></td>
              </tr>

              <tr>
                <td><h5 class=""><strong>Fecha de la actividad: </strong></h5></td>
                    <td> <h5> {{ form.fecha_actividad }}</h5></td>
              </tr>

              <tr>
                <td><h5 class=""><strong>Total de horas empleadas:  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></h5></td>
                    <td> <h5> {{ form.total_horas }}</h5></td>
              </tr>  

              <tr>
                <td><h5 class=""><strong>Observaciones:  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></h5></td>
                    <td> <h5> {{ form.observaciones_actividad }}</h5></td>
              </tr>           
            <hr class="mb-1"/>

            </table>
          </div>
          <div class="mb-4">
              <div class="d-flex justify-content-center">
                  <button class="btn btn-warning" data-dismiss="modal">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    Ocultar detalle
                  </button>
              </div>
          </div>
        </div>
      </div>
    </div> <!--MODAL DE INFORMACION DE LA ACTIVIDAD -->


</template>



<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetButton from '@/Jetstream/Button'
    import Label from '../../../Jetstream/Label.vue'
    import Button from '../../../Jetstream/Button.vue'
   

    import Base from "@/Pages/Base.vue";

    export default {
        components:{
            JetNavLink,
            JetDropdownLink,
            JetInput,
            JetLabel,
            //JetButton,
            Base
        },
        props:['actividades', 'idServicio', 'servicio', 'bitacora', 'estudiante'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },

            limpiar() {
              this.form.nombre_actividad = '';
              this.form.fecha_actividad = '';
              this.form.total_horas = '';
            },
            
            submit(){
                console.log(this.form);
                this.form.post(this.route('actividades.store'));
                Swal.fire({
                    title: 'Operación exitosa',
                    text: 'Se ha guardado la actividad con éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,  
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
                this.form.id='';
                this.form.nombre_actividad='';
                this.form.fecha_actividad='';
                this.form.total_horas='';
            },
            //Muestra mensaje cuando se actualiza los campos
            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                this.$inertia.put(route("actividades.update",form.id), this.formUp);
                Swal.fire({
                    title: 'Operación exitosa',
                    text: 'Se ha actualizado la actividad: ' + form.nombre_actividad,
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,
                    
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
                
                //window.location.reload(true);
            },
            //Muestra mmensaje cuando se borra los campos
            mostrarMensajeDelete(actividad){
                this.borrado = true;
                Swal.fire({
                    title: 'Operación exitosa',
                    text: 'Se ha borrado la actividad: ' + actividad.nombre_actividad,
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    location.reload();
                  }
                });
                //window.location.reload(true);
            },
            
            mostrarMensajeUpdate(actividad){
                console.log(actividad);
                this.formUp.id = actividad.id;
                this.formUp.nombre_actividad = actividad.nombre_actividad;
                this.formUp.fecha_actividad = actividad.fecha_actividad;
                this.formUp.total_horas = actividad.total_horas;
                console.log(this.formUp);
            },

            //carga informacion de la actividad seleccionada al formulario del modal
            mostrarinfo(actividad){
              this.form.id = actividad.id,
              this.form.nombre_actividad = actividad.nombre_actividad,
              this.form.fecha_actividad = actividad.fecha_actividad,
              this.form.total_horas = actividad.total_horas,
              this.form.verificado = actividad.verificado,
              this.form.proyecto_social_id=actividad.proyecto_social_id,
              this.form.observaciones_actividad = actividad.observaciones_actividad
            },

            calcularTotal(){
              var total = 0;
              this.actividades.forEach(element => {
                if(element.verificado == 'Aceptada'){
                  total += element.total_horas;
                }
              });
              this.horasTotales = total;
              
            }
           
        },    
        data(){
            return{
                actividad:0,
                actividadesFiltradas:[],
                successGuardado:false,
                horasTotales:0,
                
                form: this.$inertia.form({
                    
                    nombre_actividad:'',
                    fecha_actividad:'',
                    total_horas:'',
                    verificado:'En espera',
                    proyecto_social_id: this.$props.idServicio,
                    bitacora_id: this.$props.bitacora.id,
                    observaciones_actividad:null,
                    }),
                formUp: this.$inertia.form({
                    id:'',
                    nombre_actividad:'',
                    fecha_actividad:'',
                    total_horas:'',
                    verificado:'En espera',
                    proyecto_social_id: this.$props.idServicio,
                    bitacora_id: this.$props.bitacora.id,
                    }),
                }
            },        
        mounted(){
            this.actividades.forEach(element => {
                this.actividadesFiltradas.push(element);
            });
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;  
            this.calcularTotal(); 
        },
    }

</script>