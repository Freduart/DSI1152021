<template>
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

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
            <h1 class="ml-3">Servicios sociales del estudiante</h1>
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
              <div v-if="servicio.length != 0">
                <div class="card" v-for="(servicioA, index) in servicio" :key="index">
                  <div class="card-header">
                      <h5 class="mt-2 mb-2 ml-2">Servicio social activo</h5>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="ml-2">

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Servicio: </strong></h6>
                        </div>
                        <div class="col">
                          <h6 class="">{{ servicioA.servicio }}</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Tipo: </strong></h6>
                        </div>
                        <div class="col">
                          <h6 class="">{{ servicioA.tipo }}</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Descripción: </strong></h6>
                        </div>
                        <div class="col">
                          <h6 class="">{{ servicioA.descripcion }}</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Lugar del servicio: </strong></h6>
                        </div>
                        <div class="col">
                          <h6 class="">{{ servicioA.ubicacion_actividades }}</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Duración: </strong></h6>
                        </div>
                        <div class="col">
                          <h6 class="">{{ servicioA.fechaInicio }} — {{ servicioA.fechaFin }}</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Total horas: </strong></h6>
                        </div>
                        <div class="col">
                          <h6 class="">{{ servicioA.numHoras }} horas</h6>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-2">
                          <h6 class=""><strong>Estado: </strong></h6>
                        </div>
                        <div class="col">
                              <h6 class="">
                                  <button v-if="servicioA.estado == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ servicioA.estado }}</button>
                                  <button v-else-if="servicioA.estado == 'En curso'" class="btn btn-success" style="cursor: default;">{{ servicioA.estado }}</button>
                              </h6>
                          
                        </div>
                      </div>
                      
                        <div class="row">
                              <div class="col">
                                <jet-button type="button" class="mt-3 ml-2 mb-1 btn btn-primary" data-toggle="modal" data-target="#verInstitucion" v-on:click="mostrarInstitucion(servicioA)" title="Ver informacion de la institución">Información de la institución</jet-button>
                                <a v-if="servicioA.estado == 'En curso'" type="button" class="mt-3 ml-2 mb-1 btn btn-warning left" :href="`/actividades/${servicioA.idServicio}`" title="Ver informacion de la actividad">Información de las actividades</a>                             
                              </div>
                        </div>
                      
                    </div>
                  </div>
                </div>

              </div>
              <div class="card" v-else>
                <div class="card-header">
                  <h5 class="mt-2 mb-2 ml-2">Servicio social activo</h5>
                </div>
                <!-- /.card-header -->
                
                  <div  class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                    No hay un servicio social activo actualmente
                  </div>
                
              </div>
              


              <div class="card">
                <!-- /.card-header -->
                <div class="card-header">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h5 class="mt-2 mb-2 ml-2">Servicios sociales realizados</h5>
                    </div>
                  </div>
                </div>
                
                <!-- /.card-body -->
                <div class="card-body" v-if="servicios.length != 0">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h5 class="mt-2 mb-2 ml-2">Constancia de cumplimiento de servicio social</h5>
                    </div>
                    <div class="col-sm-6">
                    <a :href="route('constancia.pdf', $props.idEstudiante)">
                      <button class="ml-16 btn btn-info float-right" >Generar PDF</button>
                     </a>
                    </div>
                  </div>
                  <!-- todo text -->
                  <!-- tabla de las solicitudes del estudiante -->
                  <table class="table table-hover text-center "  width="500" style="font-size: 17px">
                      <thead class="thead-dark">
                          <tr>
                          <th scope='col' width="40%">Proyecto</th>
                          <th scope='col'>Institución</th>
                          <th scope="col">Horas</th>
                          <th scope="col">Finalizado el</th>
                          <th scope="col">Estado</th>
                          <th scope="col" width="7%"></th>
                          </tr>
                      </thead>
                      <tbody>
                          <!-- cargando datos en la tabla -->
                          <tr class="table-secondary" scope="row" v-for="(serv, index) in servicios" :key="index">
                              
                              <td> <strong></strong>{{ serv.nombre_peticion }} - Tipo: {{ serv.nombre_tipo_servicio }}</td>
                              <td> {{ serv.nombre_institucion }}</td>
                              <td> {{ serv.cantidad_horas }} h</td>
                              <td> {{ serv.fecha_peticion_fin }} </td>
                              <td> 
                                <button v-if="serv.estado_proyecto_social == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ serv.estado_proyecto_social }}</button>
                                <button v-else-if="serv.estado_proyecto_social == 'En curso'" class="btn btn-success" style="cursor: default;">{{ serv.estado_proyecto_social }}</button>
                                <button v-else-if="serv.estado_proyecto_social == 'Finalizado'" class="btn btn-info" style="cursor: default;">{{ serv.estado_proyecto_social }}</button>
                                <button v-else-if="serv.estado_proyecto_social == 'Cancelado'" class="btn btn-danger" style="cursor: default;">{{ serv.estado_proyecto_social }}</button>
                              </td>
                              <td >
                              <!-- General tools such as edit or delete-->
                                  <div class="tools">
                                    <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(serv)" title="Ver informacion del servicio"></jet-button>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
                      
                </div>
              <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                  No se han encontrado datos de servicios realizados
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

    <!-- Modal de la informacion de la institucion -->
    <div class="modal fade" id="verInstitucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
          <div class="modal-header">
              <h3 class="modal-title text-primary">Detalle de la institucion</h3>
          </div>
          <div class="modal-body">
            <div>

              <div class="row">
                <div class="col-3">
                  <h5 class=""><strong>Institución: </strong></h5>
                </div>
                <div class="col">
                  <h5 class="">{{ institucion.nombre }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col-3">
                  <h5 class=""><strong>Rubro: </strong></h5>
                </div>
                <div class="col">
                  <h5 class="">{{ institucion.rubro }}</h5>
                </div>
              </div>
              
              <div class="row">
                <div class="col-3">
                  <h5 class=""><strong>Correo: </strong></h5>
                </div>
                <div class="col">
                  <h5 class="">{{ institucion.correo }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col-3">
                  <h5 class=""><strong>Contacto: </strong></h5>
                </div>
                <div class="col">
                  <h5 class="">{{ institucion.contacto }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col-3">
                  <h5 class=""><strong>Teléfono: </strong></h5>
                </div>
                <div class="col">
                  <h5 class="">{{ institucion.telefono }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col-3">
                  <h5 class=""><strong>Ubicación: </strong></h5>
                </div>
                <div class="col">
                  <h5 class="">{{ institucion.ubicacion }}</h5>
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
    </div>

    <!-- Modal de la informacion del solicitud -->
    <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title d-flex flex-row-reverse"></h3>
            <span class="d-flex flex-row-reverse bd-highlight col">
                <h5 class=""><strong>Estado:  </strong>
                    <button v-if="form.estado_proyecto_social == 'No iniciado'" class="btn btn-primary" style="cursor: default;">{{ form.estado_proyecto_social }}</button>
                    <button v-else-if="form.estado_proyecto_social == 'En curso'" class="btn btn-success" style="cursor: default;">{{ form.estado_proyecto_social }}</button>
                    <button v-else-if="form.estado_proyecto_social == 'Finalizado'" class="btn btn-info" style="cursor: default;">{{ form.estado_proyecto_social }}</button>
                    <button v-else-if="form.estado_proyecto_social == 'Cancelado'" class="btn btn-danger" style="cursor: default;">{{ form.estado_proyecto_social }}</button>
                </h5>
            </span>
          </div>
          <div class="modal-body">

            <div>
              <h4 class="text-center text-bold">Servicio Social</h4>
              <br/>
              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Duración: </strong>
                        {{ form.fecha_inicio }}  -  {{ form.fecha_fin }}
                    </h5>                           
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Tipo de Servicio: </strong>{{ form.nombre_tipo_servicio }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Descripción de petición: </strong>{{ form.descripcion_peticion }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Cantidad de horas: </strong>{{ form.numero_horas }} h</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Cantidad de estudiantes: </strong>{{ form.cantidad_estudiantes }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Ubicación de las actividades: </strong>{{ form.ubicacion_actividades }}</h5>
                </div>
              </div>

              <hr />
              <h4 class="text-center text-bold">Institución</h4>
              <br/>
              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Institución: </strong>{{ form.nombre_institucion }}</h5>
                </div>
                <div class="col">
                    <h5 class=""><strong>Contacto: </strong>{{ form.contacto_institucion }}</h5>
                </div>
                
              </div>                    
              <div class="row">
                <div class="col">
                    <h5 class=""><strong>Rubro: </strong>{{ form.rubro_institucion }}</h5>
                </div>
                <div class="col">
                    <h5 class=""><strong>Telefono: </strong>{{ form.telefono_institucion }}</h5>
                </div>
                
              </div>
              <div class="row">
                
                <div class="col">
                    <h5 class=""><strong>Ubicación: </strong>{{ form.ubicacion_institucion }}</h5>
                </div>
                <div class="col">
                    <h5 class=""><strong>Correo: </strong>{{ form.correo_institucion }}</h5>
                </div>
              </div>
              <br/>

            </div>  
            <hr class="mb-1"/>
          </div>
          <div class="mb-4">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button> -->
          <div class="d-flex justify-content-center">
            <button class="btn btn-warning" data-dismiss="modal">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    Ocultar detalle
            </button>
            <a type="button" class="ml-2 btn btn-success" :href="`/actividades/${form.idServicio}`" title="Ver informacion de la actividad">Información de las actividades</a>               
              
          </div>
          </div>
        </div>
      </div>
            </div>

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->  
  </div>
</template>

<script>

    import Base from "@/Pages/Base.vue";
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'


    export default {
        components:{
          JetNavLink,
          JetDropdownLink,
          JetAuthenticationCard,
          JetAuthenticationCardLogo,
          JetInput,
          JetCheckbox,
          JetLabel,
          JetValidationErrors,
          Base
        },
        props: ['servicio', 'servicios', 'idEstudiante'],
        methods:{

          //carga informacion de la institucion 
          mostrarInstitucion(info){
            this.institucion.nombre = info.institucion,
            this.institucion.rubro = info.rubro,
            this.institucion.contacto = info.contacto,
            this.institucion.correo = info.correo,
            this.institucion.telefono = info.telefono,
            this.institucion.ubicacion = info.ubicacion
          },
          
          //carga informacion de la solicitud seleccionada al formulario del modal
          mostrarinfo(servicio){
            this.form.idServicio = servicio.proyecto_social_id;
            this.form.fecha_inicio = servicio.fecha_inicio;
            this.form.fecha_fin = servicio.fecha_fin;
            this.form.numero_horas = servicio.numero_horas;
            this.form.estado_proyecto_social = servicio.estado_proyecto_social;
            this.form.cantidad_estudiantes = servicio.cantidad_estudiantes;
            this.form.descripcion_peticion = servicio.descripcion_peticion;
            this.form.ubicacion_actividades = servicio.ubicacion_actividades;
            this.form.fecha_peticion = servicio.fecha_peticion;
            this.form.correo_peticion = servicio.correo_peticion;
            this.form.nombre_carrera = servicio.nombre_carrera;
            this.form.nombre_tipo_servicio = servicio.nombre_tipo_servicio;
            this.form.nombre_facultad = servicio.nombre_facultad;
            this.form.nombre_institucion = servicio.nombre_institucion;
            this.form.contacto_institucion = servicio.contacto_institucion;
            this.form.correo_institucion = servicio.correo_institucion;
            this.form.telefono_institucion = servicio.telefono_institucion;
            this.form.ubicacion_institucion = servicio.ubicacion_institucion;
            this.form.rubro_institucion = servicio.rubro_institucion;
          }
        }, 
        //Data utilizada
        data(){
          return{

            institucion:{
              nombre: '',
              rubro: '',
              contacto: '',
              correo: '',
              telefono: '',
              ubicacion: ''
            },
            
            form: this.$inertia.form({
              proyecto_social_id: this.$props.idServicio,
            }),
            formUp: this.$inertia.form({
              proyecto_social_id: this.$props.idServicio,
            }),
          }
        }, 
        mounted(){
                    
        }
    }
</script>