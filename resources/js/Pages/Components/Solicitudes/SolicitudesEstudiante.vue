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
              <!-- creacion de una card por cada facultad donde tengan asignados encargados -->
              <div class="card-body" v-if="solicitudes.length != 0">
                  <ul class="todo-list" data-widget="todo-list">
                      <li>
                      <!-- todo text -->
                          <!-- tabla de los encargados de acuerdo al estado -->
                          <table class="table table-hover text-center ">
                              <thead class="thead-dark">
                                  <tr>
                                  <th scope='col'>Proyecto</th>
                                  <th scope="col">Institución</th>
                                  <th scope="col">Fecha</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col" width="15%"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- cargando datos en la tabla -->
                                  <tr class="table-secondary" scope="row" v-for="(solicitud, index) in solicitudes" :key="index">
                                      
                                      <td> {{ solicitud.nombre }}</td>
                                      <td> {{ solicitud.institucion }}</td>
                                      <td> dd/MM/yyy </td>
                                      <td> {{ solicitud.estado }}</td>
                                      <td >
                                      <!-- General tools such as edit or delete-->
                                          <div class="tools">
                                              <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" title="Ver informacion de la solicitud"></jet-button>
                                              
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

    <!-- Modal de la informacion del encargado -->
    




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
          // Cambiar estado del encargado confirmnaod con sweetalert
          cambiarestado(){
                
          },
          //carga informacion del encargado seleccionado al formulario del modal
          mostrarinfo(){
              
          }
        }, 
        //Data utilizada
        data(){
          return{
            
            form: {
              
            }
          }
        }, 
        mounted(){
          // Llena las facultades y encargados al cargar pagina
          
        }
    }
</script>