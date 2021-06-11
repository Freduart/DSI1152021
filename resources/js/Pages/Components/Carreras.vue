<template>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <!-- <a href="index3.html" class="nav-link">Home</a> -->
                    <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </jet-nav-link>
                </li>

                <form @submit.prevent="logout">
                    <li class="nav-item d-none d-sm-inline-block"> 
                        <jet-dropdown-link class="nav-item d-none d-sm-inline-block" as="button"> 
                            Cerrar Sesión
                        </jet-dropdown-link>
                    </li> 
                </form>  
                
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">            
                <span class="brand-text font-weight-light">SASS - UES</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <inertia-link :href="route('carreras.index')" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Administrar carreras</p>
                        </inertia-link>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Opcion 2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Opcion 3</p>
                        </a>
                    </li>
                    </ul>
                </li>            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
    <!-- <section class="container">
        <div class="container-fluid">
             <table class="table table-striped table-dark">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Carrera</th>
                    <th scope="col">Facultad</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section> -->


        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administración de Carreras</h1>
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
            <section class="col-lg-7 connectedSortable">
                <!-- TO DO List -->
                <!-- Ejemplo de como podria ser una tabla pero se tendria que añadir al width del 100% -->
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Carreras
                    </h3>

                    <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                    </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <!-- todo text -->
                            <span>Buscar por</span>
                            <select class="ml-4" v-model="this.facultad" v-on:change="filtrarByFacultad(this.facultad)">
                                <option value="0" selected>Todos</option>
                                <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                            </select>
                            <hr>
                                <table class="table table-striped table-dark text-center">
                                    <thead>
                                        <tr>
                                        
                                        <th scope='col'>Código</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Facultad</th>
                                        <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr scope="row" v-for="(carrera, index) in carrerasFiltradas" :key="index">
                                            
                                            <td>{{ carrera.codigo }}</td>
                                            <td>{{ carrera.nombre }}</td>
                                            <td>{{ carrera.nombre_facultad }}</td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="tools">
                                                <i class="fas fa-edit"></i>
                                                <i class="fas fa-trash"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button type="button" class="btn btn-success float-right"><i class="fas fa-plus"></i> Añadir Carrera</button>
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
    export default {
        components:{
            JetNavLink,
            JetDropdownLink,
        },
        props:['carreras', 'facultades'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            filtrarByFacultad(id){
                this.carrerasFiltradas.splice(0, this.carrerasFiltradas.length);
                console.log(id);
                this.carreras.forEach(element => {
                    if(element.id == id){
                        console.log(element);
                        this.carrerasFiltradas.push(element);
                    }
                });
                console.log(this.carrerasFiltradas);
                if(id == '0'){
                    this.carreras.forEach(element => {
                        this.carrerasFiltradas.push(element);
                    })     
                }
            },
        },    
        data(){
            return{
                facultad:0,
                carrerasFiltradas:[],
            }         
        },
        mounted(){
            this.carreras.forEach(element => {
                this.carrerasFiltradas.push(element);
            })  
        }
    }
</script>