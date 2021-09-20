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
            <h1 class="m-0">Establecer Cantidad de Horas y Alumnos</h1>
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
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Lista de Servicios Sociales
                    </h3>
                          <br>
                     
                            
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                           
                                <!--Tabla donde apareceran todos los servicios sociales-->
                                <table class="table table-hover text-center" width="500" style="font-size: 20px">
                                    <thead class="thead-dark">
                                        <tr> 
                                        <th scope='col'>Institucion</th>
                                        <th scope="col">Tipo de servicio</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary" scope="row" v-for="(servicio, index) in serviciosFiltrados" :key="index">
                                            
                                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                                            <td>{{ servicio.nombre_institucion }}</td>
                                            <td>{{ servicio.nombre_tipo_servicio}}</td>
                                            <td>{{ servicio.nombre_carrera }}</td>
    
                                            <td>
                                            <!-- Botones para edit or delete-->
                                                <div class="tools">

                                                     <!--BOTON DE AGREGAR -->
                                                     <jet-button :href="route('actividades.update', servicio.id)" data-toggle="modal" 
                                                    data-target="#añadirCantidad" title="Agregar cantidad de hora y alumnos"> <i class="fa fa-plus-circle" style='color:#30bd21'></i> </jet-button>
                                                   
                                                    
                                                    <!-- BOTON DE VER INFORMACION -->
                                                        <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(actividad)" title="Ver mas informacion de la actividad"></jet-button>
                                                    

                                                    <!--BOTON DE EDITAR -->
                                                    <jet-button :href="route('actividades.update', actividad.id)" v-on:click="mostrarMensajeUpdate(actividad)" data-toggle="modal" 
                                                    data-target="#modificarActividad" title="Editar Actividad"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>

                                                   
                                                          
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                        </li>
                    </ul>
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



  <!-- Modal Insertar las cantidades desde el boton añadir-->
  <div class="modal fade" id="añadirCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">Establecer Cantidad de Horas y Alumnos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <!-- MUESTRA EN PANTALLA LOS CAMPOS A INGRESAR-->
        <form @submit.prevent="submit">
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-baseline">
                            <div class="form-group">
                                 <h5 class=""><strong>Tipo de servicio </strong>{{ form.nombre_tipo_servicio }}</h5>
                            </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="total_horas" value="Numero de horas para el servicio social" />
                            <jet-input id="total_horas" type="text" v-model="form.total_horas" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="total_horas" value="Cantidad de alumnos en el servicio social" />
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
                            <inertia-link :href="route('actividades.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                             Cancelar</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
    
 
        </form>
        </div>
      </div>
    </div>
  </div><!--Final Modal Insertar cantidades-->



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
                            <jet-label for="id" value="Codigo" />
                            <jet-input id="id" type="text" v-model="formUp.id" required autofocus autocomplete="off" :value="this.formUp.id"/>
                        </div>

                      </div>
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="nombre_actividad" value="Nombre de la actividad" />
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
                                <jet-button :href="route('actividades.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
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
                      {{ form.id }}                   
                  </button>    
                  <h5 class="mt-2 mr-2"><strong>Codigo:</strong></h5> 
              </span>
          </div>
          <div class="modal-body">
              
            <div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Nombre de la actividad: </strong>{{ form.nombre_actividad }}</h5>
                </div>
                <!--<div class="col-4">
                  <h5 class=""><strong>Teléfono: </strong>{{ form.telefono_encargado_escuela }}</h5>
                </div>-->
              </div>

              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Fecha de la actividad: </strong>{{ form.fecha_actividad }}</h5>
                </div>
                <div class="col">
                  <h5 class=""></h5>
                </div>
              </div>
              
               

              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Total de horas que realizo la actividad: </strong>{{ form.total_horas }}</h5>
                </div>
              </div>

              

            </div>  
            <hr class="mb-1"/>
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
    </div> <!--MODAL DE INFORMACION PARA ESTABLECER CANTIDADES -->


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
        props:['servicios'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            /*filtrarByActividad(id){
                this.serviciosFiltrados.splice(0, this.serviciosFiltrados.length);
                console.log(id);
                this.actividades.forEach(element => {
                    if(element.bitacora_id == id){
                        console.log(element);
                        this.serviciosFiltrados.push(element);
                    }
                });
                console.log(this.serviciosFiltrados);
                if(id == '0'){
                    this.actividades.forEach(element => {
                        this.serviciosFiltrados.push(element);
                        // this.mostrarMensajeSuccess();
                    })     
                }
            },*/
            mostrarMensajeSuccess(){
                    Swal.fire({
                        title: 'Se ha guardado con éxito',
                        text: 'Actualice la página para ver los cambios',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
            },
            submit(){
                console.log(this.form);
                this.mostrarMensajeSuccess();
                this.form.post(this.route('actividades.store'));
                this.form.numero_horas='';
                this.form.cantidad_estudiantes='';
            },
            //Muestra mensaje cuando se actualiza los campos
            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                Swal.fire({
                    title: 'Se ha actualizado los datos ',
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                this.$inertia.put(route("actividades.update",form.id), this.formUp);
            },
            //Muestra mmensaje cuando se borra los campos
            /*mostrarMensajeDelete(actividad){
                this.borrado = true;
                Swal.fire({
                    title: 'Se ha borrado la actividad ' + actividad.nombre_actividad,
                    text: 'Actualice la página para ver los cambios',
                    iconColor: '#CB3234',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },*/
            
            mostrarMensajeUpdate(servicio){
                console.log(servicio);
              this.formUp.nombre_tipo_servicio = servicio.nombre_tipo_servicio,
              this.formUp.nombre_institucion = servicio.nombre_institucion,
              this.formUp.numero_horas = servicio.numero_horas,
              this.formUp.nombre_carrera = servicio.nombre_carrera,
              this.formUp.nombre_facultad = servicio.nombre_facultad,
              this.formUp.cantidad_estudiantes=servicio.cantidad_estudiantes
                console.log(this.formUp);
            },

            //carga informacion del servicio social seleccionado al formulario del modal
            mostrarinfo(servicio){
              this.form.nombre_tipo_servicio = servicio.nombre_tipo_servicio,
              this.form.nombre_institucion = servicio.nombre_institucion,
              this.form.numero_horas = servicio.numero_horas,
              this.form.nombre_carrera = servicio.nombre_carrera,
              this.form.nombre_facultad = servicio.nombre_facultad,
              this.form.cantidad_estudiantes=servicio.cantidad_estudiantes
            }
           
        },    
        data(){
            return{
                actividad:0,
                serviciosFiltrados:[],
                successGuardado:false,
                
                form: this.$inertia.form({
                    numero_horas:'',
                    estado_proyecto_social:'',
                    cantidad_estudiantes:'',
                    nombre_carrera:'',
                    nombre_tipo_servicio:'',
                    nombre_facultad:'',
                    nombre_institucion:'',
                    }),
                formUp: this.$inertia.form({
                    numero_horas:'',
                    estado_proyecto_social:'',
                    cantidad_estudiantes:'',
                    nombre_carrera:'',
                    nombre_tipo_servicio:'',
                    nombre_facultad:'',
                    nombre_institucion:'',
                    }),
                }
            },        
        mounted(){
            this.servicios.forEach(element => {
                this.serviciosFiltrados.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }


</script>