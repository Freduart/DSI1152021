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
              <h1 class="m-0">Administración de Tipos de servicio social</h1>
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
                    Tipo de servicio social
                  </h3>
                  <!--Boton para añadir facultades-->
                  <button type="button" class="btn btn-success float-right mb-8" data-toggle="modal" data-target="#addTipoServicio">
                    <i class="fas fa-plus"></i> Añadir Tipo servicio social</button> 
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
                            <th scope="col">Tipo de servicio social</th>
                            <th scope="col" width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                          <tr class="table-secondary" scope="row" v-for="tipos in tipoServicioFiltrados" :key="tipos.id">
                            <!--Aqui devuelven los datos que se mostraran en pantalla -->                           
                            <td>{{ tipos.id }}</td>
                            <td>{{ tipos.nombre_tipo_servicio }}</td>
                            <td>
                            <!-- Botones para edit or delete-->
                                <div class="tools">
                                  <!-- Boton para editar -->
                                  <jet-button :href="route('tipoServicio.update', tipos.id)"  data-toggle="modal" v-on:click="mostrarMensajeUpdate(tipos)"
                                  data-target="#updateTipoServicio" title="Tipo servicio social"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>                                  

                                  <!-- Boton para eliminar -->
                                  <jet-button class="fas fa-arrow-alt-circle-down" style='color:#dc3545' title="Eliminar tipo de servicio social" method="delete" 
                                  v-on:click="deleteTipoServicio(tipos)"></jet-button>
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
    </div>
  </div>

  <!-- Modal para insertar un tipo de servicio -->
  <div class="modal fade" id="addTipoServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

      <!-- Modal Header -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Añadir Tipo de Servicio Social</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- End of Modal Header -->

        <!-- Modal Body -->
        <div class="modal-body">
          <form @submit.prevent="submit">
              <div class="form-group">
                  <jet-label for="nombre_tipo_servicio" value="Tipo de servicio social" />
                  <jet-input id="nombre_tipo_servicio" type="text" v-model="form.nombre_tipo_servicio" required autofocus autocomplete="off"/>
              </div>

              <!-- Action buttons -->
              <div class="d-flex justify-content-center align-items-baseline">
                  <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <div class="mt-12">
                                  <button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': form.processing }" >
                                  <i class="fas"></i>Guardar                                  
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <inertia-link :href="route('tipoServicio.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                              Cancelar</inertia-link>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End of action buttons -->

          </form>
        </div>
        <!-- End of Modal Body -->

      </div>
    </div>
  </div>
  <!--Final Modal Insertar facultades-->

  <!-- Modal para actualizar un tipo de servicio -->
  <div class="modal fade" id="updateTipoServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

      <!-- Modal Header -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar Tipo de Servicio Social</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- End of Modal Header -->

        <!-- Modal Body -->
        <div class="modal-body">

          <form @submit.prevent="submitUpdate(this.formUp)">
              <div class="form-group">
                  <jet-label for="nombre_tipo_servicio" value="Tipo de servicio social" />
                  <jet-input id="nombre_tipo_servicio" type="text" v-model="formUp.nombre_tipo_servicio" required autofocus autocomplete="off" :value="this.formUp.nombre_tipo_servicio"/>
              </div>

              <!-- Action buttons -->
              <div class="d-flex justify-content-center align-items-baseline">
                  <div class="row">
                      <div class="col">
                          <div class="form-group">
                              <div class="mt-12">
                                  <button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="updateTipo(this.formUp)">
                                  <i class="fas"></i>Guardar                                  
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <inertia-link :href="route('tipoServicio.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                              Cancelar</inertia-link>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- End of action buttons -->

          </form>
        </div>
        <!-- End of Modal Body -->

      </div>
    </div>
  </div>
  <!-- Fin del modal de actualizar -->
</template>

<script>
  import JetNavLink from '@/Jetstream/NavLink';
  import JetDropdownLink from '@/Jetstream/DropdownLink';
  import JetInput from '@/Jetstream/Input';
  import JetLabel from '@/Jetstream/Label';

  import Base from "@/Pages/Base.vue";

  export default {
    components:{
      JetNavLink,
      JetDropdownLink,
      JetInput,
      JetLabel,
      Base
    },

    props:['tipoServicioSocial'],

    methods:{
      logout() {
        this.$inertia.post(route('logout'));
      },            

      // Mensaje de confirmacion cuando se agrega un nuevo tipo de servicio social
      success(){
        Swal.fire(
            'Guardado con exito!',
            'El tipo de servicio social se agrego correctamente',
            'success'
          );
      },

      // Agrega un nuevo tipo de servicio a partir del modal de servicio socia
      submit(){
        this.form.post(this.route('tipoServicio.store'));
        this.form.nombre_tipo_servicio='';
        this.success();
        window.location.reload(true);      
      },

      submitUpdate(form){
        Swal.fire(
          '¡Guardado con exito!',
          'El tipo de servicio social se actualizo correctamente',
          'success'
        );
        this.$inertia.patch(route("tipoServicio.update",form.id), this.formUp);      
        window.location.reload(true);
      },

      // Borra un nuevo tipo de servicio social a partir de la tabla
      deleteTipoServicio(tipoSerivicioSocial){
        Swal.fire({
          title: '¿Esta seguro que desea eliminar este tipo de servicio?',      
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, eliminar',
          cancelButtonText: 'No, cancelar'      
        }).then((result) =>{
          if(result.isConfirmed){
            this.$inertia.delete(route('tipoServicio.destroy', tipoSerivicioSocial.id));
            Swal.fire(
              '¡Eliminado!',
              'El tipo de servicio social se elimino correctamente',
              'success'
            );
            window.location.reload(true);
          }
        })
      },

      //Cargo la informacion del formulario 
      mostrarMensajeUpdate(tipoServicioSocial){
        this.formUp.nombre_tipo_servicio=tipoServicioSocial.nombre_tipo_servicio;
        this.formUp.id=tipoServicioSocial.id;
      }
      
    },

    data(){
      return{
        tipoServicio:0,
        tipoServicioFiltrados:[],
        successGuardado:false,

        //Este se utiliza a la hora de agregar un tipoServicio
        form: this.$inertia.form({
          nombre_tipo_servicio:'',        
        }),

        //Este se utiliza a la hora de actualizar un tipoServicio
        formUp: this.$inertia.form({
          nombre_tipo_servicio:'',
          id:'',
        })
      }
    },

    mounted(){
      this.tipoServicioSocial.forEach(element =>{
        this.tipoServicioFiltrados.push(element);      
      }),
      this.successGuardado=false;
    },
  }
</script>