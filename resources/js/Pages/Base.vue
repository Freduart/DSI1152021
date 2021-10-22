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

            
            <!-- <li class="nav-item d-none d-sm-inline-block mx-4">
                <a href="index3.html" class="nav-link">Home</a>
                <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Inicio
                </jet-nav-link>
            </li> -->

            <!-- <form @submit.prevent="logout">
                <li class="d-flex flex-row-reverse bd-highlight col"> 
                    <button class="btn btn-primary d-flex flex-row-reverse bd-highlight col" as="button"> 
                        Cerrar Sesión
                    </button>
                </li> 
            </form>   -->

            <div v-if="$page.props.user">
                <form @submit.prevent="logout">
                    
                        <button class="btn btn-info"> 
                            Cerrar Sesión
                        </button>
                    
                </form>
            </div>
            <template v-else>
              <inertia-link :href="route('login')" class="btn btn-success">                
                Iniciar Sesión
              </inertia-link>
              
              <!-- <inertia-link v-if="canRegister" :href="route('estudiantes.create')" class="ml-4 text-muted">
                Registrarse
              </inertia-link>  -->

              <button type="button" class="btn btn-primary ml-4" v-on:click="mostrarFormularioEstudiante()">
                Registrarse
              </button>

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
    <div class="sidebar" :key="componentKey">

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
                    <li v-if="is('Administrador')" class="nav-item">
                        <inertia-link :href="route('carreras.index')" class="nav-link" >
                        <i class="fa fa-graduation-cap nav-icon"></i>
                        <p>Carreras</p>
                        </inertia-link>
                    </li>
                    <li v-if="is('Unidad de Proyeccion Social') || is('Administrador')" class="nav-item">
                        <!--<a v-if="is('Estudiante')" href="#" class="nav-link">-->
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

                    <li v-if="is('Encargado Facultad')" class="nav-item">
                        <inertia-link :href="route('encargadosescuela.index')" :active="route().current('encargadosescuela.index')" class="nav-link">
                            <i class="fa fa-chalkboard-teacher nav-icon" aria-hidden="true"></i>
                            <p>Encargados por escuela</p>
                        </inertia-link>
                    </li>
                  
                    <li v-if="is('Administrador')" class="nav-item">
                            <inertia-link :href="route('facultades.index')" class="nav-link">
                            <i class="fa fa-building nav-icon"></i>
                            <p>Facultades</p>
                            </inertia-link>
                    </li>

                    <li v-if="is('Encargado Facultad') || is('Encargado Escuela') || is('Unidad de Proyeccion Social')" class="nav-item">
                            <inertia-link :href="route('estudiantes.index')" class="nav-link">
                            <i class="fa fa-user-friends nav-icon" aria-hidden="true"></i>
                            <p>Estudiantes</p>
                            </inertia-link>
                    </li>

                    <li v-if="is('Encargado Escuela')" class="nav-item">
                            <inertia-link :href="route('verificarcuenta.index')" class="nav-link">
                            <i class="fas fa-file nav-icon"></i>
                            <p>Verificar Cuenta</p>
                            </inertia-link>
                    </li>

                    <li v-if="is('Administrador')" class="nav-item">
                            <inertia-link :href="route('usuarios.index')" class="nav-link">
                            <i class="fas fa-user-circle nav-icon"></i>
                            <p>Usuarios</p>
                            </inertia-link>
                    </li>

                     <li v-if="is('Administrador')" class="nav-item">
                            <inertia-link :href="route('roles.index')" class="nav-link">
                            <i class="fas fa-key nav-icon"></i>
                            <p>Roles</p>
                            </inertia-link>
                    </li>

                    <li v-if="is('Encargado Escuela')" class="nav-item">
                            <inertia-link :href="route('solicitudes.index')" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Evaluacion de Solicitudes</p>
                            </inertia-link>
                    </li>

                    <!-- <li v-if="is('Encargado Escuela')" class="nav-item">
                            <inertia-link :href="route('verificaractividades.index')" class="nav-link">
                            <i class="nav-icon fa fa-clipboard "></i>
                            <p>Verificar Actividades</p>
                            </inertia-link>
                    </li> -->

                    <!-- <li v-if="is('Encargado Escuela')" class="nav-item">
                            <inertia-link :href="route('establecerha.index')" class="nav-link">
                            <i class="nav-icon fa fa-clipboard "></i>
                            <p>Establecer cantidad de Horas y Alumnos</p>
                            </inertia-link>
                    </li> -->

                    <!-- https://es.vuejs.org/v2/guide/conditional.html -->
                    <!-- https://www.npmjs.com/package/laravel-permission-to-vuejs -->
                    <li v-if="is('Estudiante')" class="nav-item">
                            <inertia-link :href="route('solicitudesestudiante.index')" class="nav-link">
                            <i class="fas fa-paper-plane nav-icon"></i>
                            <p>Mis solicitudes</p>
                            </inertia-link> 
                    </li>
                    
                    <li v-if="is('Encargado Escuela') || is('Encargado Facultad') || is('Estudiante') || is('Unidad de Proyeccion Social')" class="nav-item">
                            <inertia-link :href="route('serviciossociales.index')" class="nav-link">
                            <i class="fa fa-th-large nav-icon"></i>
                            <p>Servicios Sociales</p>
                            </inertia-link>
                    </li>

                     <li v-if="is('Estudiante')" class="nav-item">
                            <inertia-link :href="route('serviciosDisponibles')" class="nav-link">
                            <i class="fa fa-calendar-check nav-icon"></i>
                            <p>Servicios Disponibles</p>
                            </inertia-link>
                    </li>

                    <!-- <li class="nav-item">
                            <inertia-link :href="route('constancia.index')" class="nav-link">
                            <i class="fas fa-medal nav-icon"></i>
                            <p>Constancia de cumplimiento</p>
                            </inertia-link>
                    </li> -->

                    <!-- Cuando es un solo elemento -->
                    <!-- <li class="nav-item">
                        <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                        </a>
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
import { getCurrentInstance } from '@vue/runtime-core';

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
        // data(){
        //   return{
        //     componentKey:2,
        //   };
        // },
        methods:{
        //     forceRerender(){
        //       this.componentKey+=1;
        //     }
          logout() {
              this.$inertia.post(route('logout'));
              window.location.reload();
            },
          mostrarFormularioEstudiante(){
              this.$inertia.get(route('estudiantes.create'));
          },
        },
        mounted(){

        },
        setup(){
          // const instance = getCurrentInstance();
          // instance.proxy.$forceUpdate();
          // window.location.reload();
        }
    }   
</script>
