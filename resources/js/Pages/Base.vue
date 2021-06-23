<template>

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->
    <slot name="header"></slot>
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
                        <inertia-link :href="route('carreras.index')" class="nav-link" >
                        <i class="fa fa-graduation-cap nav-icon"></i>
                        <p>Administrar carreras</p>
                        </inertia-link>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
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
                            <i class="fa fa-user-circle nav-icon" aria-hidden="true"></i>
                            <p>Estudiantes</p>
                            </inertia-link>
                    </li>

                    <li class="nav-item">
                            <inertia-link :href="route('verificarcuenta.index')" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Verificar Cuenta</p>
                            </inertia-link>
                    </li>
                    
                    <!-- Cuando es un solo elemento -->
                    <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
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


    
    
</template>

<script>

    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    export default {
        components:{
            name: 'menu',
            JetNavLink,
            JetDropdownLink,
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