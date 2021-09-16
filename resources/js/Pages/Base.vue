<template>

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
    <slot name="header"></slot>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark ">
        <!-- Left navbar links -->
        <ul class="navbar-nav col-sm-12">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

            <div v-if="$page.props.user">
                <form @submit.prevent="logout">
                    
                        <button class="btn btn-info"> 
                            Cerrar Sesión
                        </button>
                    
                </form>
            </div>
            <template v-else>
                <div class=" col-sm-12">
                    <div class="button-log">
                        <inertia-link :href="route('login')" class="btn btn-success">
                            Iniciar Sesión
                        </inertia-link>


                        <button type="button" class="btn btn-primary ml-4" v-on:click="mostrarFormularioEstudiante()">
                            Registrarse
                        </button>
                    </div>
                </div>
                <div ng-show="base_view" class="delete_right"
	style="top: 54px; left: 0px;width: 70%; margin-top: 2%;margin-left: 22%;margin-right: 10%; background-color: #F7F4F4;   -webkit-box-shadow: 0 8px 20px rgba(100, 100, 100, 0.85); z-index: 10;">
    <a class="delete_right"></a></div>
            </template>            
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">            
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
                        <inertia-link href="/" class="nav-link" >
                        <i class="fa fa-home nav-icon"></i>
                        <p>Inicio</p>
                        </inertia-link>
                    </li>
                    <li class="nav-item">
                        <inertia-link :href="route('carreras.index')" class="nav-link" >
                        <i class="fa fa-graduation-cap nav-icon"></i>
                        <p>Carreras</p>
                        </inertia-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p>
                            Encargados
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <inertia-link :href="route('encargadosfacultad.index')" :active="route().current('encargadosfacultad.index')" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Encargados por facultad</p>
                            </inertia-link>
                        </li>
                        <li class="nav-item">
                            <inertia-link :href="route('encargadosescuela.index')" :active="route().current('encargadosescuela.index')" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Encargados por escuela</p>
                            </inertia-link>
                        </li>
                        </ul>
                    </li>
                  
                    <li class="nav-item">
                            <inertia-link :href="route('facultades.index')" class="nav-link">
                            <i class="far fa-building nav-icon"></i>
                            <p>Facultades</p>
                            </inertia-link>
                    </li>

                    <li class="nav-item">
                            <inertia-link :href="route('estudiantes.index')" class="nav-link">
                            <i class="fa fa-user-friends nav-icon" aria-hidden="true"></i>
                            <p>Estudiantes</p>
                            </inertia-link>
                    </li>

                    <li class="nav-item">
                            <inertia-link :href="route('verificarcuenta.index')" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Verificar Cuenta</p>
                            </inertia-link>
                    </li>

                    <li class="nav-item">
                            <inertia-link :href="route('usuarios.index')" class="nav-link">
                            <i class="fas fa-user-circle nav-icon"></i>
                            <p>Usuarios</p>
                            </inertia-link>
                    </li>

                     <li class="nav-item">
                            <inertia-link :href="route('roles.index')" class="nav-link">
                            <i class="fas fa-key nav-icon"></i>
                            <p>Roles</p>
                            </inertia-link>
                    </li>

                        <!-- Tag para las peticiones -->
                        <!-- <li class="nav-item">
                            <inertia-link :href="route('peticiones.index')" class="nav-link">
                            <i class="fas fa-key nav-icon"></i>
                            <p>Peticiones de servicio social</p>
                            </inertia-link>
                        </li> -->
                    </ul>
                </li>            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>


    
    
</template>

<script>

    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    export default {
        components:{
            name: 'menu',
            JetNavLink,
            JetDropdownLink
        },
          props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
             },
            mostrarFormularioEstudiante(){
                this.$inertia.get(route('estudiantes.create'));
            }
        },
        mounted(){
            /*$(".nav li").on("click", function(){
              $(".nav").find(".active").removeClass("active");
              $(this).addClass("active");
            });*/
            
          /*$(function() {
  
            // elementos de la lista
            var menues = $(".nav li a"); 
            var menues2 = $(".nav li"); 

            // manejador de click sobre todos los elementos
            menues.click(function() {
              // eliminamos active de todos los elementos
              menues.removeClass("active");
              // activamos el elemento clicado.
              $(this).addClass("active");
            });

            menues2.click(function() {
              // eliminamos active de todos los elementos
              menues.removeClass("menu-is-opening");
              menues.removeClass("menu-open");
              // activamos el elemento clicado.
              $(this).addClass("menu-is-opening");
              $(this).addClass("menu-open");
            });

          });*/
          
        }
    }   
    
</script>
