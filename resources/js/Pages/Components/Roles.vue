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
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Roles
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <table class="table table-hover text-center">
                                <thead class="thead-dark">
                                    <tr> 
                                    <th scope='col'>ID</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-secondary" scope="row" v-for="(rol, index) in roles" :key="index">
                                        
                                        <td>{{ rol.id }}</td> 
                                        <td>{{ rol.name }}</td>
                                        <td>
                                        <!-- General tools such as edit or delete-->
                                            <div class="d-flex justify-content-end">
                                                    
                                            <inertia-link class="ml-4" :href="route('roles.edit', rol.id)" >
                                                <i class="fas fa-edit"></i>   
                                            </inertia-link>  
                                            
                                            </div>
                                        </td>
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
        props:['roles'],
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