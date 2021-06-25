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
            <h1 class="m-0">Roles</h1>
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

                <form @submit.prevent="submit">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <!-- facultad del encargado -->
                          <div class="form-group">
                            <jet-label for="permiso" value="Permiso" />
                            <br/>
                            <!-- select para cargar las facultades -->
                            <select class="custom-select" id="permission_id" v-model="form.permission_id" required>
                              <option disabled value="">Seleccione un rol</option>
                              <option v-for="(permis, index) in permisos" :key="index" :value="permis.ident">{{ permis.permiso }}</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                        </div>
                      </div>
                      
                      <div class="">
                        <div class="d-flex justify-content-center align-items-baseline">
                          <!-- botones de accion -->
                          <jet-button type="submit" class="btn btn-primary float-center" :class="{ 'text-white-50': form.processing }" :disabled="form.processing" >
                          <i class="fas"></i> Guardar</jet-button>
                          <div class="mx-2"></div>
                          <inertia-link :href="route('encargadosfacultad.index')" type="button" class="btn btn-danger float-center" >
                          <i class="fas"></i> Cancelar</inertia-link>
                        </div>
                      </div>
                      
                    </div>
                    
                    
                  </form>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <h5 class ="ml-4 mb-4">Listado de permisos del rol</h5>
                  <table class="table table-striped table-dark text-center" style="font-size: 20px">
                    <thead>
                        <tr>
                        
                        <th scope='col'>ID</th>
                        <th scope="col">Permiso</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr scope="row" v-for="(permiso, index) in permisosUser" :key="index">
                            
                            <td>{{ permiso.ident }}</td>
                            <td>{{ permiso.permiso }}</td>
                            
                            <td>
                            <!-- General tools such as edit or delete-->
                                <div class="flex justify-center">
                                    
                                    <button class="btn btn-warning ml-4" v-on:click="mostrarMensajeUpdate(carrera)" data-toggle="modal" data-target="#actualizarCarrera">
                                        <i class="fas fa-edit mx-12"></i>
                                        Quitar
                                    </button>    
                                
                                
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

</template>

<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetButton from '@/Jetstream/Button'
    import Label from '../../Jetstream/Label.vue'
    import Button from '../../Jetstream/Button.vue'

    import Base from "@/Pages/Base.vue";

    export default {
        components:{
            JetNavLink,
            JetDropdownLink,
            JetInput,
            JetLabel,
            JetButton,
            Base
        },
        props:['permisos','permisosUser', 'idrol'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            submit() {
              this.form.post(route('roles.store'));
              Swal.fire(
                '!Guardado!',
                'El permiso se guardo correctamente',
                'success'
                );
                window.location.reload(true);
            }           
        },    
        data(){
            return{
                form: this.$inertia.form({
                  permission_id: '',
                  role_id: this.$props.idrol
                }),  
              }
            },        
        mounted(){
        },
    }
</script>