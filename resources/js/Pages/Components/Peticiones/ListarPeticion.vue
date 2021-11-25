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
              <h1 class="m-0">Administración de peticiones</h1>
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
                    Listado de peticiones de servicio social
                  </h3>
                  <!--Boton para añadir instituciones-->
                  <inertia-link type="button" class="btn btn-success float-right mt-2"  :href="route('peticiones.create')">
                    <i class="fas fa-plus"></i> 
                     Añadir Peticion
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
                              <th scope="col">Institucion</th>
                              <th scope="col">Titulo</th>
                              <th scope="col">Ubicacion</th>
                              <th scope="col">Tipo de servicio</th>
                              
                              <th scope="col" width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr class="table-secondary" scope="row" v-for="(peticiones, index) in peticionesArray" :key="index">
                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                            <td>{{ peticiones.nombre_institucion }}</td>
                            <td>{{ peticiones.nombre_peticion }}</td>
                            <td>{{ peticiones.ubicacion_actividades }}</td>
                            <td>{{ peticiones.nombre_tipo_servicio }}</td>                                                     
                            <td>
                            <!-- Botones para edit or delete-->
                                <div class="tools">
                                  <!-- Ver informacion -->
                                  <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarInfo(peticiones)" title="Ver informacion de la institucion"></jet-button>
                                  
                                  <!-- Boton para editar -->
                                  <inertia-link 
                                  v-if="$page.props.user && ($page.props.user.rol == 'Encargado Facultad' || $page.props.user.rol == 'Encargado Escuela')"
                                  class="fas fa-edit" title="Editar peticion" 
                                  :href="route('peticiones.edit', peticiones.idPeticion)"></inertia-link>

                                  <!-- Boton para eliminar -->
                                  <!-- <jet-button class="fas fa-arrow-alt-circle-down" style='color:#dc3545' title="Eliminar institucion" method="delete" 
                                  v-on:click="deleteInstitucion(instituciones)"></jet-button> -->
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
                  <h5 class="modal-title" id="exampleModalLabel">Titulo: {{ formUp.nombre_peticion }}</h5>
                  <h5 class="modal-title text-primary">{{ formUp.nombre_institucion }}</h5>
                         
              </div>
              <div class="modal-body">
                  
                <div>
                  <div class="row">
                    <div class="col-md-12">
                      <h5 class=""><strong>Descripcion: </strong>{{ formUp.descripcion_peticion }}</h5>
                    </div>                    
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <h5 class=""><strong>Cantidad de estudiantes solicitada: </strong>{{ formUp.cantidad_estudiantes }}</h5>
                    </div>

                    <div class="col-md-12">
                      <h5 class=""><strong>Correo: </strong>{{ formUp.correo_peticion }}</h5>
                    </div>

                    <div class="col-md-12">
                      <h5 class=""><strong>Ubicacion: </strong>{{ formUp.ubicacion_actividades }}</h5>
                    </div>

                    <div class="col-md-12">
                      <h5 class=""><strong>Fecha inicio: </strong>{{ formUp.fecha_peticion }}</h5>
                    </div>

                    <div class="col-md-12">
                      <h5 class=""><strong>Mas detalle: </strong>{{ formUp.otros_tipo_servicio }}</h5>
                    </div>                      
                  
                    <div class="col-md-12">
                      <h5 class=""><strong>Carrera solicitada: </strong>{{ formUp.nombre_carrera }}</h5>
                    </div>
                  
                    <div class="col-md-12">
                      <h5 class=""><strong>Tipo de servicio: </strong>{{ formUp.nombre_tipo_servicio }}</h5>
                    </div>                                    
                    <div class="row">
                      <div>
                        <span class="d-flex flex-row-reverse bd-highlight col">
                          <!-- <h5 class=""><strong>Rubro:  </strong>
                            {{ form.rubro_institucion }}
                          </h5> -->
                        </span>
                      </div>
                    </div>
                  </div>

                </div>  
                <hr class="mb-1"/>
              </div>
              <div class="d-flex justify-content-center align-items-baseline">
                <div class="row">

                  <!-- Boton para visualizar -->
                  <div class="col-md-3">
                    <div class="form-group">
                      <inertia-link :href="route('peticiones.index')" type="button" class="btn btn-warning float-center" data-dismiss="modal">
                      <i class="fas fa-eye-slash" aria-hidden="true"></i> Cerrar </inertia-link>                  
                    </div>
                  </div>

                  <div class="col-md-1"></div>

                  <!-- Boton para aprobar -->
                  <div class="col-md-3">
                    <div class="form-group">
                      <!-- <button v-if="peticiones.estado_peticion == 'En espera'" class="btn btn-success float-center" title="Aceptar peticion" v-on:click="cambiarEstado(form)"> 
                        <i class="fas fa-check" aria-hidden="true"></i> Aceptar </button>   -->

                        <button 
                        v-if="$page.props.user && ($page.props.user.rol == 'Encargado Facultad' || $page.props.user.rol == 'Encargado Escuela')"
                        class="btn btn-success float-center" 
                        title="Activar estudiante" 
                        v-on:click="cambiarEstado(this.formUp)"> 
                        <i class="fas fa-check" aria-hidden="true"></i> Aceptar </button>
                    </div>
                  </div>

                  <div class="col-md-1"></div>

                  <!-- Boton para rechazar -->
                  <div class="col-md-3">
                    <div class="form-group">

                      <!-- <inertia-link v-if="this.peticiones.estado_peticion == 'En espera'" class="btn btn-danger" title="Desactivar institucion"  v-on:click="rechazarEstado(formUp)"> 
                        <i class="fas fa-times" aria-hidden="true"></i> Rechazar </inertia-link>   -->

                        <button 
                        v-if="$page.props.user && ($page.props.user.rol == 'Encargado Facultad' || $page.props.user.rol == 'Encargado Escuela')"
                        class="btn btn-danger" title="Desactivar estudiante" 
                        method="delete" 
                        v-on:click="rechazarEstado(this.formUp)"> 
                        <i class="fas fa-times" aria-hidden="true"></i> Rechazar </button>
                    </div>
                  </div>
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

    props:['peticiones'],

    methods:{
      logout() {
        this.$inertia.post(route('logout'));
      },

      // Carga la informacionn de la institucion seleccionada de la lista
      mostrarInfo(peticiones){
        this.formUp.id = peticiones.idPeticion,
        this.formUp.cantidad_estudiantes = peticiones.cantidad_estudiantes,
        this.formUp.nombre_peticion = peticiones.nombre_peticion,
        this.formUp.descripcion_peticion =peticiones.descripcion_peticion,
        this.formUp.ubicacion_actividades = peticiones.ubicacion_actividades,
        this.formUp.fecha_peticion =peticiones.fecha_peticion,        
        this.formUp.otros_tipo_servicio =peticiones.otros_tipo_servicio,
        this.formUp.estado_peticion = peticiones.estado_peticion,
        this.formUp.correo_peticion= peticiones.correo_peticion,
        this.formUp.nombre_carrera =peticiones.nombre_carrera,
        this.formUp.nombre_tipo_servicio =peticiones.nombre_tipo_servicio,
        this.formUp.nombre_institucion = peticiones.nombre_institucion        
      },    
      
      // Aca se acepta la peticon de servicio social
    cambiarEstado(peticion){
      console.log(peticion);
        Swal.fire({
          title: '¿Esta seguro que desea aceptar la peticion de servicio social?',
          text: "Titulo: "+ peticion.nombre_peticion + ", institucion: "+ peticion.nombre_institucion,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, aceptar',
          cancelButtonText: 'No, cancelar'
        }).then((result)=> {
          if(result.isConfirmed){
            
              Swal.fire(
                '!Aceptado!',
                'La peticion se acepto correctamente',
                'success'
              );
              this.$inertia.put(route('peticiones.update', peticion.id), this.formUp);
              window.location.reload(true);
          }
        })
      
    },


    rechazarEstado(peticion){
      console.log(peticion);
        Swal.fire({
          title: '¿Esta seguro que desea rechazar la peticion de servicio social?',
          text: "Titulo: "+ peticion.nombre_peticion + ", institucion: "+ peticion.nombre_institucion,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, aceptar',
          cancelButtonText: 'No, cancelar'
        }).then((result)=> {
          if(result.isConfirmed){
            
              Swal.fire(
                '!Rechazado!',
                'La peticion se rechazo correctamente',
                'success'
              );
              
            this.$inertia.delete(route('peticiones.destroy', peticion));
            window.location.reload(true);
          }
        })
      
    },
      
    },

    data(){
      return{      
        // Array para recueprar la lista de peticiones
        peticionesArray:[],      
        // objeto para recuperar una peticion y mostrar su info
        formUp: this.$inertia.form({          
          id: '',
          nombre_peticion:'',
          descripcion_peticion: '',
          cantidad_estudiantes: '',
          ubicacion_actividades: '',
          fecha_peticiones: '',
          otros_tipo_servicio: '',
          estado_peticion: 'En espera',
          correo_peticion: '',
          nombre_carrera:'',
          nombre_tipo_servicio:'',
          nombre_institucion:'',          
        }),
        
      }
    },

    mounted(){
      // window.location.reload(true);
      this.peticiones.forEach(element =>{
        this.peticionesArray.push(element);      
      })    
    },
  }
</script>