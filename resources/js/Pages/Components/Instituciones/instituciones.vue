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
                    Instituciones
                  </h3>
                  <!--Boton para añadir facultades-->
                  <!-- <button type="button" class="btn btn-success float-right mb-8" data-toggle="modal" data-target="#addTipoServicio">
                    <i class="fas fa-plus"></i> Añadir Institucion</button>  -->
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
                            <!-- <td>{{ tipos.nombre_tipo_servicio }}</td> -->
                            <td>
                            <!-- Botones para edit or delete-->
                                <div class="tools">
                                  <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarInfo(instituciones)" title="Ver informacion de la institucion"></jet-button>
                                  <!-- Boton para editar -->
                                  <!-- <jet-button :href="route('tipoServicio.update', tipos.id)"  data-toggle="modal" v-on:click="mostrarMensajeUpdate(tipos)"
                                  data-target="#updateTipoServicio" title="Tipo servicio social"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>                                   -->

                                  <!-- Boton para eliminar -->
                                  <!-- <jet-button class="fas fa-arrow-alt-circle-down" style='color:#dc3545' title="Eliminar tipo de servicio social" method="delete" 
                                  v-on:click="deleteTipoServicio(tipos)"></jet-button> -->
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
                  <span class="d-flex flex-row-reverse bd-highlight col">
                      
                      <button class="btn btn-dark text-light text-lg" style="cursor: default;">
                          {{ form.rubro_institucion }}                   
                      </button>    
                      <h5 class="mt-2 mr-2"><strong>Codigo:</strong></h5> 
                      <!-- <h3 class="modal-title text-primary border rounded-lg mx-4">{{ verDetalleForm.carnet_estudiante }} </h3> -->
                  </span>                  
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
                          <h5 class=""><strong>Estado:  </strong>
                            <strong>{{ form.rubro_institucion }}</strong>
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
   import JetNavLink from '@/Jetstream/NavLink';
    import JetDropdownLink from '@/Jetstream/DropdownLink';
    import JetInput from '@/Jetstream/Input';
    import JetLabel from '@/Jetstream/Label';
    import JetButton from '@/Jetstream/Button';
    import Label from '../../../Jetstream/Label.vue';
    import Button from '../../../Jetstream/Button.vue';

    import Base from "@/Pages/Base.vue";

export default {
  components:{
    JetNavLink,
    JetDropdownLink,
    JetInput,
    JetLabel,
    Base
  },

  props:['instituciones'],

  methods:{
    logout() {
      this.$inertia.post(route('logout'));
    },

    // Carga la informacionn de la institucion seleccionada de la lista
    mostrarInfo(institucion){
      this.form.nombre_institucion = institucion.nombre_institucion,
      this.form.contacto_institucion= institucion.contacto_institucion,
      this.form.correo_institucion= institucion.correo_institucion,
      this.form.telefono_institucion= institucion.telefono_institucion,
      this.form.ubicacion_institucion= institucion.ubicacion_institucion,
      this.form.rubro_institucion= institucion.rubro_institucion
    },

    // filtrarByFacultad(id){
    //     this.tipoServicioFiltrados.splice(0, this.tipoServicioFiltrados.length);        
    //     this.tipoServicioSocial.forEach(element => {
    //       if(element.tipo_servicio_social_id == id){              
    //           this.tipoServicioFiltrados.push(element);
    //       }
    //     });        
    //     if(id == '0'){
    //       this.tipoServicioSocial.forEach(element => {
    //           this.tipoServicioFiltrados.push(element);              
    //       })     
    //     }
    // },     

    success(){
      Swal.fire(
          'Guardado con exito!',
          'El tipo de servicio social se agrego correctamente',
          'success'
        );
    },

    // submit(){
    //   this.form.post(this.route('tipoServicio.store'));
    //   this.form.nombre_tipo_servicio='';
    //   this.success();
    //   window.location.reload(true);      
    // },

    // submitUpdate(form){
    //   Swal.fire(
    //     '¡Guardado con exito!',
    //     'El tipo de servicio social se actualizo correctamente',
    //     'success'
    //   );
    //   this.$inertia.patch(route("tipoServicio.update",form.id), this.formUp);      
    //   window.location.reload(true);
    // },

    // deleteTipoServicio(tipoSerivicioSocial){
    //   Swal.fire({
    //     title: '¿Esta seguro que desea eliminar este tipo de servicio?',      
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Si, eliminar',
    //     cancelButtonText: 'No, cancelar'      
    //   }).then((result) =>{
    //     if(result.isConfirmed){
    //       this.$inertia.delete(route('tipoServicio.destroy', tipoSerivicioSocial.id));
    //       Swal.fire(
    //         '¡Eliminado!',
    //         'El tipo de servicio social se elimino correctamente',
    //         'success'
    //       );
    //       window.location.reload(true);
    //     }
    //   })
    // },

    //Cargo la informacion del formulario 
    // mostrarMensajeUpdate(tipoServicioSocial){
    //   this.formUp.nombre_tipo_servicio=tipoServicioSocial.nombre_tipo_servicio;
    //   this.formUp.id=tipoServicioSocial.id;
    // }
    
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

      //Este se utiliza a la hora de agregar un tipoServicio
      // form: this.$inertia.form({
      //   nombre_tipo_servicio:'',        
      // }),

      //Este se utiliza a la hora de actualizar un tipoServicio
      // formUp: this.$inertia.form({
      //   nombre_tipo_servicio:'',
      //   id:'',
      // })
    }
  },

  mounted(){
    this.instituciones.forEach(element =>{
      this.institucionesArray.push(element);      
    })    
  },
}
</script>