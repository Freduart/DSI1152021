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
            <h1 class="m-0">Gestion de Actividades</h1>
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
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Listado de actividades realizadas
                    </h3>
                     <!--Boton para añadir actividades -->
                      <button type="button" class="btn btn-success float-right mt-2" data-toggle="modal" data-target="#añadirActividad">
                      <i class="fas fa-plus"></i> Añadir Actividad</button> 
                      <br> <br>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                           
                                <!--Tabla donde apareceran todos las facultades-->
                                <table class="table table-hover text-center" width="500" style="font-size: 20px">
                                    <thead class="thead-dark">
                                        <tr> 
                                        <th scope='col'>Código</th>
                                        <th scope="col">Bitacora</th>
                                        <th scope="col">Nombre de la Actividad</th>
                                        <th scope='col'>Fecha Actividad</th>
                                        <th scope='col'>Total de horas</th>
                                        <th scope='col'>Verificado</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary" scope="row" v-for="(actividad, index) in actividadesFiltradas" :key="index">
                                            
                                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                                            <td>{{ actividad.id }}</td>
                                            <!--<td>{{ actividad.bitacora_id }}</td>-->
                                            <td>{{ actividad.nombre_actividad }}</td>
                                            <td>{{ actividad.fecha_actividad }}</td>
                                            <td>{{ actividad.total_horas }}</td>
                                            <td>{{ actividad.verificado }}</td>
                                            <td>
                                            <!-- Botones para edit or delete-->
                                                <div class="tools">
                                                    <inertia-link class="fas fa-arrow-alt-circle-down" style='color:#dc3545' title="Eliminar actividad" method="delete"
                                                    :href="route('facultades.destroy', facultad.id)"
                                                    v-on:click="mostrarMensajeDelete(facultad)"></inertia-link>
                                                    
                                                    <jet-button :href="route('facultades.update', facultad.id)" v-on:click="mostrarMensajeUpdate(facultad)" data-toggle="modal" 
                                                    data-target="#modificarFacultad" title="Editar Facultad"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>
                                                          
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                        </li>
                    </ul>
                </div>

                <div class="card-footer clearfix">

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



<!-- Modal Insertar los datos de las facultades desde el boton añadir-->
<div class="modal fade" id="añadirActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Actividad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form @submit.prevent="submit">

                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="id" value="Codigo" />
                            <jet-input id="id" type="text" v-model="form.id" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="nombre_actividad" value="Nombre de la Actividad" />
                            <jet-input id="nombre_actividad" type="text" v-model="form.nombre_actividad" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="fecha_actividad" value="Fecha de la actividad" />
                            <jet-input id="fecha_actividad" type="text" v-model="form.id" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="total_horas" value="Total de horas" />
                            <jet-input id="total_horas" type="text" v-model="form.total_horas" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                            <jet-label for="verificado" value="Verificado" />
                            <jet-input id="verificado" type="text" v-model="form.verificado" required autofocus autocomplete="off"/>
                        </div>
                      </div>
                      
                    </div>
            
            
            
            <div class="d-flex justify-content-center align-items-baseline">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="mt-12">
                                <button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': form.processing }" >
                                <i class="fas"></i>Guardar
                                <!--<i class="fas fa-save"></i>  Guardar Facultad --> 
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <inertia-link :href="route('actividades.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                             Cancelar</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
    
 
        </form> <!--FIN FORM-->
        </div>
    </div>
  </div>
</div><!--Final Modal Insertar facultades-->

<!-- Modal para actualizar los campos de las facultades con el boton de edit-->
<div class="modal fade" id="modificarFacultad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Facultad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form @submit.prevent="submitUpdate(this.formUp)">
            <div class="form-group">
                <jet-label for="nombre_facultad" value="Nombre de la facultad" />
                <jet-input id="nombre_facultad" type="text" v-model="formUp.nombre_facultad" required autofocus autocomplete="off" :value="this.formUp.nombre_facultad"/>
            </div>
               <div class="d-flex justify-content-center align-items-baseline">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="mt-12">
                                    <jet-button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="submitUpdate(this.formUp)">
                                    <i class="fas"></i>Guardar
                                         <!--<i class="fas fa-edit"></i>  Modificar-->   
                                     </jet-button>  
                                </div>                  
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-grup">
                                <jet-button :href="route('facultades.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                                 Cancelar</jet-button>
                            </div>
                        </div>

                    </div>
               </div>
 
        </form>
        </div>
    </div>
  </div>
</div>
<!--Final Modal Update de facultades-->

</template>

<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetButton from '@/Jetstream/Button'
    import Label from '../../../Jetstream/Label.vue'
    import Button from '../../../Jetstream/Button.vue'

    import Base from "@/Pages/Base.vue";

    export default {
        components:{
            JetNavLink,
            JetDropdownLink,
            JetInput,
            JetLabel,
            //JetButton,
            Base
        },
        props:['actividades'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            filtrarByActividad(id){
                this.actividadesFiltradas.splice(0, this.actividadesFiltradas.length);
                console.log(id);
                this.actividades.forEach(element => {
                    if(element.actividad_id == id){
                        console.log(element);
                        this.actividadesFiltradas.push(element);
                    }
                });
                console.log(this.actividadesFiltradas);
                if(id == '0'){
                    this.actividades.forEach(element => {
                        this.actividadesFiltradas.push(element);
                        // this.mostrarMensajeSuccess();
                    })     
                }
            },
            mostrarMensajeSuccess(){
                    Swal.fire({
                        title: 'Se ha guardado con éxito',
                        text: 'Actualice la página para ver los cambios',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
            },
            submit(){
                console.log(this.form);
                    this.mostrarMensajeSuccess();
                this.form.post(this.route('actividades.store'));
                this.form.id='';
               // this.form.bitacora_id='';
                this.form.nombre_actividad='';
                this.form.fecha_actividad='';
                this.form.total_horas='';
                this.form.verificado='';
                
            },
            //Muestra mensaje cuando se actualiza los campos
            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                Swal.fire({
                    title: 'Se ha actualizado la actividad' + form.nombre_actividad,
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                this.$inertia.put(route("facultades.update",form.id), this.formUp);
            },
            //Muestra mmensaje cuando se borra los campos
            mostrarMensajeDelete(actividad){
                this.borrado = true;
                Swal.fire({
                    title: 'Se ha borrado la actividad ' + actividad.nombre_actividad,
                    text: 'Actualice la página para ver los cambios',
                    iconColor: '#CB3234',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },
            
            mostrarMensajeUpdate(actividad){
                console.log(actividad);
                this.formUp.id = actividad.id;
               // this.formUp.bitacora_id=actividades.bitacora_id;
                this.formUp.nombre_actividad = actividad.nombre_actividad;
                this.formUp.fecha_actividad = actividad.fecha_actividad;
                this.formUp.total_horas = actividad.total_horas;
                this.formUp.verificado = actividad.verificado;
                console.log(this.formUp);
            }
           
        },    
        data(){
            return{
                facultad:0,
                actividadesFiltradas:[],
                successGuardado:false,
                formularioNuevaCarrera:false,
                form: this.$inertia.form({
                    id: '',
                   // bitacora_id:'',
                    nombre_actividad:'',
                    fecha_Actividad:'',
                    total_horas:'',
                    verificado:'',
                    }),
                formUp: this.$inertia.form({
                    id: '',
                   // bitacora_id:'',
                    nombre_actividad:'',
                    fecha_Actividad:'',
                    total_horas:'',
                    verificado:'',
                    }),
                }
            },        
        mounted(){
            this.actividades.forEach(element => {
                this.actividadesFiltradas.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }
</script>