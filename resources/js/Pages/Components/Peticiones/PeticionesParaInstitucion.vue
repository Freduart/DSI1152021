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
            <h1 class="m-0">Peticiones de la Institución: <u>{{ this.institucion.nombre_institucion }}</u></h1>
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
                    Peticiones
                    </h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <!-- todo text -->
                            
                            <!-- <span>Buscar por</span>
                            <select class="col-2 ml-3 custom-select" v-model="this.facultad" v-on:change="filtrarByFacultad(this.facultad)">
                                <option value="0" selected>Todos</option>
                                <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                            </select>
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#añadirCarrera">
                            <i class="fas fa-plus"></i> Añadir Carrera</button>  -->
                            <hr>
                                <table class="table table-hover text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                        
                                        <th scope='col'>Nombre</th>
                                        <th scope="col">Ubicación</th>
                                        <th scope="col">Fecha de Inicio</th>
                                        <th scope="col">Fecha de Finalización</th>
                                        <th scope="col">Estado de Petición</th>
                                        <th scope="col">Estado del servicio social</th>
                                        <th scope="col" width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr scope="row" class="table-secondary" v-for="(peticion, index) in this.peticiones" :key="index">
                                            <td>{{ peticion.nombre_peticion }}</td>
                                            <td>{{ peticion.ubicacion_actividades }}</td>
                                            <td>{{ peticion.fecha_peticion }}</td>
                                            <td>{{ peticion.fecha_peticion_fin }}</td>
                                            <td>{{ peticion.estado_peticion }}</td>
                                            <td v-if="peticion.estado_peticion == 'Aceptado'">{{ peticion.estado_proyecto_social }}</td>
                                            <td v-else>N/A</td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                    <!-- <inertia-link
                                                    method="delete"
                                                    :href="route('carreras.destroy', carrera.id)"
                                                    v-on:click="mostrarMensajeDelete(carrera)">
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </inertia-link> -->
                                            <!--                                                     
                                                    <button class="btn btn-warning ml-4" v-on:click="mostrarMensajeUpdate(carrera)" data-toggle="modal" data-target="#actualizarCarrera">
                                                        <i class="fas fa-edit mx-12"></i>
                                                        Editar
                                                    </button>     -->
                                                
                                                    <div class="tools">
                                                        <!-- <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verServicioSocial" v-on:click="mostrarinfo(peticion)" title="Ver informacion del servicio social"></jet-button> -->
                                                        <inertia-link v-if="peticion.estado_proyecto_social != 'En curso'" :href="route('peticiones.edit', peticion.peticion_id)">
                                                            <!-- <jet-button type="button" class="fas fa-edit text-yellow" title="Editar petición"></jet-button> -->
                                                            <i class="fas fa-edit" aria-hidden="true"></i>
                                                        </inertia-link>
                                                        <!-- <jet-button  v-if="carrera.estado_carrera == 'Activo'" class="fas fa-arrow-alt-circle-down text-red" title="Dar de baja a carrera" method="delete" v-on:click="cambiarEstado(carrera)"></jet-button>     
                                                        <jet-button v-else class="fas fa-arrow-alt-circle-up text-green" title="Activar carrera" method="delete" v-on:click="cambiarEstado(carrera)"></jet-button> -->
                                                    </div>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
                <!-- <hr/>
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li> -->
                            <!-- todo text -->
                            <!-- <h3>Añadir nueva carrera</h3>
                            <hr>

                <div class="mx-12">
              <form @submit.prevent="submit" class="bg-gray-50 m-8 h-10">
                <div class="form-group">
                    <jet-label for="nombre_carrera" value="Nombre de la carrera" />
                    <jet-input id="nombre_carrera" type="text" v-model="form.nombre_carrera" required autofocus/>
                </div>
                <div class="form-group">
                    <jet-label for="codigo_carrera" value="codigo de la carrera" />
                    <jet-input id="codigo_carrera" type="text" v-model="form.codigo_carrera" required autofocus/>
                </div>
                <div class="form-group">
                    <jet-label for="facultad_id" value="Facultad a la que pertenece" />
                    <br/>
                    <select id="facultad_id" v-model="form.facultad_id" required>
                        <option disabled value="">Seleccione una facultad</option>
                        <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                    </select>
                    <jet-button class="ml-4" :class="{ 'text-white-50 bg-green-400': form.processing }" :disabled="form.processing">
                        Guardar nueva Carrera
                    </jet-button>
                </div>
            </form> 
                </div>

                        </li>
                    </ul>
                </div> -->

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
        props:['peticiones', 'institucion'],
        methods:{

        },    
        data(){
            return{
                form: this.$inertia.form({
                    // nombre_peticion: this.$props.peticiones.nombre_peticion,
                    // descripcion_peticion: this.$props.peticiones.descripcion_peticion,
                    // cantidad_estudiantes: this.$props.peticiones.cantidad_estudiantes,
                    // ubicacion_actividades: this.$props.peticiones.ubicacion_actividades,
                    // fecha_peticion: this.$props.peticiones.fecha_peticion,
                    // fecha_peticion_fin: this.$props.peticiones.fecha_peticion_fin,
                    // cantidad_horas: 0,
                    // otros_tipo_servicio: this.$props.peticiones.otros_tipo_servicio,
                    // estado_peticion: this.$props.peticiones.estado_peticion,
                    // correo_peticion: this.$props.peticiones.correo_peticion,
                    // carrera_id: this.$props.peticiones.carrera_id,
                    // facultad_id: this.$props.idFacultad.id,
                    // tipo_servicio_social_id: this.$props.peticiones.tipo_servicio_social_id,
                    // institucion_id: this.$props.peticiones.institucion_id,
                }),
            }
        },            
        mounted(){
            console.table(this.peticiones);
        },
    }
</script>