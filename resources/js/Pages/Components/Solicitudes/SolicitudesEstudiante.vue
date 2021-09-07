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
            <h1 class="ml-3">Solicitudes del estudiante</h1>
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
                  Solicitudes para participación en proyecto social
                  </h3>
                  <inertia-link type="button" class="btn btn-success float-right mt-2"  :href="route('encargadosescuela.create')">
                      <i class="fas fa-plus"></i> Ver proyectos </inertia-link>
                  <br><br>
                  
              </div>
              <!-- /.card-header -->
              <div class="card-body" v-if="solicitudes.length != 0">
                  <ul class="todo-list" data-widget="todo-list">
                      <li>
                      <!-- todo text -->
                          <!-- tabla de las solicitudes del estudiante -->
                          <table class="table table-hover text-center ">
                              <thead class="thead-dark">
                                  <tr>
                                  <th scope='col' width="40%">Proyecto</th>
                                  <th scope='col'>Tipo</th>
                                  <th scope="col">Fecha</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col" width="15%"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- cargando datos en la tabla -->
                                  <tr class="table-secondary" scope="row" v-for="(solicitud, index) in solicitudes" :key="index">
                                      
                                      <td> {{ solicitud.servicio }}</td>
                                      <td> {{ solicitud.tipo }}</td>
                                      <td> {{ solicitud.fecha }} </td>
                                      <td> {{ solicitud.estado }}</td>
                                      <td >
                                      <!-- General tools such as edit or delete-->
                                          <div class="tools">
                                            <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(solicitud)" title="Ver informacion de la solicitud"></jet-button>
                                            <jet-button v-if="solicitud.estado == 'En espera'" class="fas fa-trash" title="Eliminar solicitud" method="delete" v-on:click="eliminarSolicitud(solicitud)"></jet-button>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </li>
                  </ul>
              </div>
              <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                  No se han encontrado datos
              </div>
              <!-- /.card-body -->
              <!--<div class="card-footer clearfix">
                  
              </div>-->
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

    <!-- Modal de la informacion del solicitud -->
        <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <!-- <h5 class="modal-title" id="exampleModalLabel">{{ verDetalleForm.nombre_estudiante }} {{ verDetalleForm.apellido_estudiante }}</h5> -->
                  <h3 class="modal-title text-primary">Detalle de la solicitud</h3>
                  <span class="d-flex flex-row-reverse bd-highlight col">
                      <button v-if="form.estado == 'En espera'" class="btn btn-primary" disabled>{{ form.estado }}</button>
                            <button v-else-if="form.estado == 'Aceptado'" class="btn btn-success" disabled>{{ form.estado }}</button>
                            <button v-else-if="form.estado == 'Rechazado'" class="btn btn-danger" disabled>{{ form.estado }}</button>
                            
                       
                      <h5 class="mt-2 mr-2"><strong>Estado:</strong></h5> 
                  </span>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button> -->
              </div>
              <div class="modal-body">
                  
                <div>
                  <div class="row">
                    <div class="col">
                      <h4 class="text-uppercase"><strong>Información del servicio social </strong></h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Servicio: </strong> {{ form.servicio }} </h5>
                    </div>
                  </div>
                  <div class="row"> 
                    <div class="col-4">
                      <h5 class=""><strong>Tipo: </strong>{{ form.tipo }}</h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Descripción: </strong>{{ form.descripcion }}</h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Institución: </strong>{{ form.institucion }}</h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Rubro: </strong>{{ form.rubro }}</h5>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Ubicación: </strong>{{ form.ubicacion }}</h5>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col">
                      <h4 class="text-uppercase"><strong>Información de la solicitud </strong></h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Solicitante:</strong> {{ form.nombreEstudiante }} {{ form.apellidoEstudiante}} </h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Fecha solicitud: </strong>{{ form.fecha }}</h5>
                    </div>
                    
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Justificación: </strong>{{ form.justificacion }}</h5>
                    </div>
                  </div>

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


    export default {
        components:{
          JetAuthenticationCard,
          JetAuthenticationCardLogo,
          JetInput,
          JetCheckbox,
          JetLabel,
          JetValidationErrors,
          Base
        },
        props: ['solicitudes'],
        methods:{
          // eliminar solicitud confirmnaod con sweetalert
          eliminarSolicitud(infoServicio){
            if(infoServicio.estado == 'En espera'){
                // mensaje de confirmacion
                Swal.fire({
                  title: '¿Esta seguro que desea eliminar la solicitud?',
                  text: "Al eliminarla deberá volver a enviar la solicitud al proyecto",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminar',
                  cancelButtonText: 'No, cancelar'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // modificando el estado al confirmar
                      this.$inertia.delete(route('solicitudesestudiante.destroy', infoServicio.idSolicitud));
                      Swal.fire(
                      '!Desactivado!',
                      'La solicitud se eliminó correctamente',
                      'success'
                      );
                      window.location.reload(true);
                  }
              })
            }
          },
          //carga informacion de la solicitud seleccionada al formulario del modal
            mostrarinfo(infoServicio){
              this.form.idSolicitud = infoServicio.idSolicitud,
              this.form.servicio = infoServicio.servicio,
              this.form.tipo = infoServicio.tipo,
              this.form.descripcion = infoServicio.descripcion,
              this.form.institucion = infoServicio.institucion,
              this.form.rubro = infoServicio.rubro,
              this.form.ubicacion = infoServicio.ubicacion,
              this.form.nombreEstudiante = infoServicio.nombreEstudiante,
              this.form.apellidoEstudiante = infoServicio.apellidoEstudiante,
              this.form.fecha = infoServicio.fecha,
              this.form.estado = infoServicio.estado,
              this.form.justificacion = infoServicio.justificacion
            }
        }, 
        //Data utilizada
        data(){
          return{
            
            form:{
              idSolicitud: null,
              servicio: '',
              tipo: '',
              descripcion: '',
              institucion: '',
              rubro: '',
              ubicacion: '',
              nombreEstudiante: '',
              apellidoEstudiante: '',
              fecha: '',
              estado: '',
              justificacion: ''
            }
          }
        }, 
        mounted(){
                    
        }
    }
</script>