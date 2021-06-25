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
            <h1 class="m-0">Usuarios</h1>
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
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Usuarios
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <!-- todo text -->
                            <!-- <span>Buscar por</span> -->
                            <!-- <select class="col-2 ml-3 custom-select" v-model="this.facultad" v-on:change="filtrarByFacultad(this.facultad)">
                                <option value="0" selected>Todos</option>
                                <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                            </select> -->
                            <!--<button type="button" class="btn btn-success mb-8">
                            <i class="fas fa-plus"></i> Añadir</button> -->
                            <hr>
                                <table class="table table-striped text-center" width="500" style="font-size: 20px">
                                    <thead>
                                        <tr> 
                                        <th scope='col'>ID</th>
                                        <th scope="col">Usuarios</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Rol</th>
                                        <!--<th scope="col"></th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr scope="row" v-for="(usuario, index) in usuarios" :key="index">
                                            
                                            <td>{{ usuario.ident }}</td> 
                                            <td>{{ usuario.username }}</td>
                                            <td>{{ usuario.email }}</td>
                                            <td>{{ usuario.rol }}</td>
                                            <!--<td>
                                                <div class="d-flex justify-content-end">
                                                       
                                                <inertia-link class="ml-4" :href="route('usuarios.edit', usuario.ident)" >
                                                    <i class="fas fa-edit"></i>  Editar  
                                                </inertia-link>  
                                                
                                                </div>
                                            </td>-->
                                        </tr>
                                    </tbody>
                                </table>

                        </li>
                    </ul>
                </div>

                <div class="card-footer clearfix">
                    <!-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#añadirCarrera">
                    <i class="fas fa-plus"></i> Añadir Carrera</button>  -->



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
        props:['usuarios'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            }           
        },    
        data(){
            return{
                
                }
            },        
        mounted(){
        },
    }
</script>