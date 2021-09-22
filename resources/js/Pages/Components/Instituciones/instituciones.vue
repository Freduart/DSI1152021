<template>
  <div class="wrapper">
    <!-- Navbar -->
    <Base>
        <template v-slot:header></template>
    </Base>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <!-- Content Header -->
      <div class="content-header">
        <!-- Container fluid -->
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Administración de Instituciones</h1>
            </div><!-- /.col -->          
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- End of Content Header -->

      <!-- Main Content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Main Row -->
          <div class="row">
            <!-- left col -->
            <section class="col-lg-12 connectedSortable">
              <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="ion-clipboard ion mr-1"></i>
                    Listado de Instituciones
                  </h3>
                  <!--Boton para añadir instituciones-->
                  <inertia-link type="button" class="btn btn-success float-right mt-2"  :href="route('instituciones.create')">
                    <i class="fas fa-plus"></i> 
                     Añadir institucion
                    </inertia-link>
                </div>
                <!-- End of Card Header -->
                
                <!-- Card Body -->
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                    <li>                    
                      <hr>
                      <!--Tabla donde apareceran todos las facultades-->
                      <table class="table table-hover text-center" width="500" style="font-size: 20px">
                        <thead class="thead-dark">
                            <tr> 
                            <!-- <th scope='col'>Código</th> -->
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Correo</th>
                            <th scope="col" width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr class="table-secondary" scope="row" v-for="instituciones in institucionesArray" :key="instituciones.id">
                            <!--Aqui devuelven los datos que se mostraran en pantalla -->                           
                            <td>{{ instituciones.id }}</td>
                            <td>{{ instituciones.nombre_institucion }}</td>
                            <td>{{ instituciones.ubicacion_institucion }}</td>
                            <td>{{ instituciones.correo_institucion }}</td>                            
                            <td>
                            <!-- Botones para edit or delete-->
                                <div class="tools">
                                  <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarInfo(instituciones)" title="Ver informacion de la institucion"></jet-button>
                                  
                                  <!-- Boton para editar -->
                                  <inertia-link class="fas fa-edit" title="Editar institucion" :href="route('instituciones.edit', instituciones.id)"></inertia-link>                                  

                                  <!-- Boton para eliminar -->
                                  <jet-button class="fas fa-arrow-alt-circle-down" style='color:#dc3545' title="Eliminar institucion" method="delete" 
                                  v-on:click="deleteInstitucion(Instituciones)"></jet-button>
                                </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </li>
                  </ul>
                </div>     
                <!-- End of Card Body -->
              </div>  
              <!-- End of Card -->      
            </section>
          </div>
        </div>
      </section>
      <!-- End of Main Content -->

      <!-- Modal de la informacion de la institucion -->
        <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <!-- <h5 class="modal-title" id="exampleModalLabel">{{ verDetalleForm.nombre_estudiante }} {{ verDetalleForm.apellido_estudiante }}</h5> -->
                  <h3 class="modal-title text-primary">{{ form.nombre_institucion }}</h3>
                         
              </div>
              <div class="modal-body">
                  
                <div>
                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Contacto: </strong>{{ form.contacto_institucion }}</h5>
                    </div>
                    <div class="col-4">
                      <h5 class=""><strong>Teléfono: </strong>{{ form.telefono_institucion }}</h5>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h5 class=""><strong>Correo: </strong>{{ form.correo_institucion }}</h5>
                    </div>
                    <div class="col">
                      <h5 class=""></h5>
                    </div>
                  </div>
                  
                  <div class="">
                    <div class="">
                      <h5 class=""><strong>Ubicacion: </strong>{{ form.ubicacion_institucion }}</h5>
                    </div>
                    <div class="row">
                      <div>
                        <span class="d-flex flex-row-reverse bd-highlight col">
                          <h5 class=""><strong>Rubro:  </strong>
                            {{ form.rubro_institucion }}
                          </h5>
                        </span>
                      </div>
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
        <!-- Fin del modal de informacion de la institucion -->
    </div>
  </div>
</template>

<script>
  import Base from "@/Pages/Base.vue";
  import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
  import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
  import JetButton from '@/Jetstream/Button'
  import JetInput from '@/Jetstream/Input'  
  import JetLabel from '@/Jetstream/Label'
  import JetValidationErrors from '@/Jetstream/ValidationErrors'

  export default {
    components:{
      JetAuthenticationCard,
      JetAuthenticationCardLogo,
      JetInput,      
      JetLabel,
      JetValidationErrors,
      Base
    },

    props:['instituciones'],

    methods:{
      logout() {
        this.$inertia.post(route('logout'));
      },

      // Carga la informacionn de la institucion seleccionada de la lista
      mostrarInfo(instituciones){
        this.form.nombre_institucion = instituciones.nombre_institucion,
        this.form.contacto_institucion= instituciones.contacto_institucion,
        this.form.correo_institucion= instituciones.correo_institucion,
        this.form.telefono_institucion= instituciones.telefono_institucion,
        this.form.ubicacion_institucion= instituciones.ubicacion_institucion,
        this.form.rubro_institucion= instituciones.rubro_institucion
      },
      
      // Carga la ruta destroy del controllador de instituciones y muestra un mensaje de confirmacion
      deleteInstitucion(instituciones){
        Swal.fire({
          title: '¿Esta seguro que desea eliminar esta institucion?',      
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar',
          cancelButtonText: 'No, cancelar'      
        }).then((result) =>{
          if(result.isConfirmed){
            this.$inertia.delete(route('instituciones.destroy', instituciones.id));            
            Swal.fire(
              '¡Eliminado!',
              'El tipo de servicio social se elimino correctamente',
              'success'
            );
            window.location.reload(true);
          }
        })
      },      
    },

    data(){
      return{      
        // Array para recueprar la lista de instituciones
        institucionesArray:[],      
        // objeto para recuperar una institucion y mostrar su info
        form:{
          nombre_institucion:'',
          contacto_institucion: '',
          correo_institucion: '',
          telefono_institucion: '',
          ubicacion_institucion: '',
          rubro_institucion: '',
        }
      }
    },

    mounted(){
      this.instituciones.forEach(element =>{
        this.institucionesArray.push(element);      
      })    
    },
  }
</script>