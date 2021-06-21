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
            <h1 class="m-0">Verificación de cuentas</h1>
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
                    Solicitudes de creación de cuenta de estudiantes en espera
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <!-- todo text 
                            <span>Buscar por</span>
                            <select class="ml-4" v-model="this.facultad" v-on:change="filtrarEstudiantes(this.facultad)">
                                <option value="0" selected>Todos</option>
                                <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                            </select>-->
                            <!--<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#añadirCarrera">
                            <i class="fas fa-plus"></i> Añadir Carrera</button>--> 
                            <hr>
                                <table class="table table-striped table-dark text-center" style="font-size: 20px">
                                    <thead>
                                        <tr>
                                        
                                        <th scope='col'>Carnet</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Acciones</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Modificar aqui-->
                                        <tr scope="row" v-for="(estudiante, index) in estudiantesFiltradas" :key="index">
                                            
                                            <td>{{ estudiante.carnet }}</td>
                                            <td>{{ estudiante.nombre_estudiante }}</td>
                                            <td>{{ estudiante.apellido_estudiante }}</td>
                                            <!--Modificar aqui-->
                                            <td v-if="estudiante.estado_estudiante == 'Activo'">
                                                <form @submit.prevent="cambiarEstado(estudiante)">
                                                    <button type="submit" class="btn btn-success" :class="{ 'text-white-50 bg-green-400': form.processing }">{{ estudiante.estado_estudiante }}</button>
                                                </form>          
                                            </td>
                                            <td v-else>
                                                <form @submit.prevent="cambiarEstado(estudiante)">
                                                    <button type="submit" class="btn btn-primary" :class="{ 'text-white-50 bg-green-400': form.processing }">{{ estudiante.estado_estudiante }}</button>
                                                </form>            
                                            </td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center">

                                                    <!--Modificar aqui CREO QUE YA NO VA
                                                    <inertia-link
                                                    method="delete"
                                                    :href="route('carreras.destroy', carrera.id)"
                                                    v-on:click="mostrarMensajeDelete(carrera)">
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </inertia-link>-->
                                                    
                                                    <!--boton evaluar-->
                                                    <button class="btn btn-warning" v-on:click="mostrarMensajeUpdate(estudiante)" data-toggle="modal" data-target="#evaluar">
                                                        <i class="fas fa-edit mx-12"></i>
                                                    </button>    
                                                
                                                
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



<!-- Modal Insert
<div class="modal fade" id="añadirCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Evaluar estudiante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form @submit.prevent="submit">
            <div class="form-group">
                <jet-label for="nombre_carrera" value="Nombre de la carrera" />
                <jet-input id="nombre_carrera" type="text" v-model="form.nombre_carrera" required autofocus autocomplete="off"/>
            </div>
            <div class="form-group">
                <jet-label for="codigo_carrera" value="Código de la carrera" />
                <jet-input id="codigo_carrera" type="text" v-model="form.codigo_carrera" required autofocus autocomplete="off"/>
            </div>
            <div class="form-group">
                <jet-label for="facultad_id" value="Facultad a la que pertenece" />
                <br/>
                <select id="facultad_id" v-model="form.facultad_id" required>
                    <option disabled value="">Seleccione una facultad</option>
                    <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                </select>
                <hr/>
                <div class="mt-12">
                    <jet-button class="ml-4" :class="{ 'text-white-50 bg-green-400': form.processing }" >
                        <i class="fas fa-plus"></i>  Guardar nueva Carrera  
                    </jet-button>   
                    <jet-button type="button" class="btn btn-danger mx-12" data-dismiss="modal">
                        <inertia-link :href="route('carreras.index')">
                        Cancelar
                        </inertia-link>
                    </jet-button>
                   
                </div>
            </div>
    
 
        </form>
        </div>
    </div>
  </div>
</div>-->

<!-- EVALUAR-->
<div class="modal fade" id="evaluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Evaluar Cuenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form @submit.prevent="submitUpdate(this.formUp)">
            <div class="form-group">
                <jet-label for="nombre_estudiante" value="Nombre del estudiante" />
                <jet-input id="nombre_estudiante" type="text" v-model="formUp.nombre_estudiante" required autofocus autocomplete="off" :value="this.formUp.nombre_estudiante"/>
            </div>
            <div class="form-group">
                <jet-label for="apellido_estudiante" value="Apellido del estudiante" />
                <jet-input id="apellido_estudiante" type="text" v-model="formUp.apellido_estudiante" required autofocus autocomplete="off" :value="this.formUp.apellido_estudiante"/>
            </div>
            <div class="form-group">
                <jet-label for="carnet_estudiante" value="Carnet del estudiante" />
                <jet-input id="carnet_estudiante" type="text" v-model="formUp.carnet_estudiante" required autofocus autocomplete="off" :value="this.formUp.carnet_estudiante"/>
            </div>
             <div class="form-group">
                <jet-label for="sexo_estudiante" value="Sexo" />
                <jet-input id="sexo_estudiante" type="text" v-model="formUp.sexo_estudiante" required autofocus autocomplete="off" :value="this.formUp.sexo_estudiante"/>
            </div>
             <div class="form-group">
                <jet-label for="correo_estudiante" value="Correo" />
                <jet-input id="correo_estudiante" type="text" v-model="formUp.correo_estudiante" required autofocus autocomplete="off" :value="this.formUp.correo_estudiante"/>
            </div>
             <div class="form-group">
                <jet-label for="telefono_estudiante" value="Telefono" />
                <jet-input id="telefono_estudiante" type="text" v-model="formUp.telefono_estudiante" required autofocus autocomplete="off" :value="this.formUp.telefono_estudiante"/>
            </div>
             <div class="form-group">
                <jet-label for="carrera_id" value="Carrera" />
                <jet-input id="carrera_id" type="text" v-model="formUp.carrera_id" required autofocus autocomplete="off" :value="this.formUp.carrera_id"/>
            </div>
             <div class="form-group">
                <jet-label for="dui_estudiante" value="DUI" />
                <jet-input id="dui_estudiante" type="text" v-model="formUp.dui_estudiante" required autofocus autocomplete="off" :value="this.formUp.dui_estudiante"/>
            </div>
             <div class="form-group">
                <jet-label for="nit_estudiante" value="NIT" />
                <jet-input id="nit_estudiante" type="text" v-model="formUp.nit_estudiante" required autofocus autocomplete="off" :value="this.formUp.nit_estudiante"/>
            </div>


            <div class="form-group">

                <div class="mt-12">
                    <jet-button class="ml-4" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="submitUpdate(this.formUp)">
                        <i class="fas fa-plus"></i>  APROBAR
                    </jet-button>   

                    <jet-button type="button" class="btn btn-danger mx-12" data-dismiss="modal">
                        <inertia-link :href="route('carreras.index')">
                        Cancelar
                        </inertia-link>
                    </jet-button>
                    
                </div>
            </div>
    
 
        </form>
        </div>
    </div>
  </div>
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
        props:['estudiantes'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            filtrarEstudiantes(id){
                this.estudiantesFiltradas.splice(0, this.estudiantesFiltradas.length);
                console.log(id);
                this.estudiantes.forEach(element => {
                    if(element.estudiante_id == id){
                        console.log(element);
                        this.estudiantesFiltradas.push(element);
                    }
                });
                console.log(this.estudiantesFiltradas);
                if(id == '0'){
                    this.estudiantes.forEach(element => {
                        this.estudiantesFiltradas.push(element);
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
                // }
                this.form.post(this.route('carreras.store'));
                this.form.nombre_carrera='';
                this.form.facultad_id='';
                this.form.codigo_carrera='';
            },
            cambiarEstado(estudiante){
                console.log(estudiante);
                console.log(estudiante.estado_estudiante);
                if(estudiante.estado_estudiante == 'En Espera'){
                    // carrera.estado_carrera = 'Inactivo';
                    this.formUp.estado_estudiante = 'Realizando Servicio'; 
                    Swal.fire({
                        title: 'El estudiante esta realizando Su Servicio ' + estudiante.nombre_estudiante,
                        text: 'Actualice la página para ver los cambios',
                        icon: 'warning',
                        iconColor: '#FF8000',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                // this.$inertia.put(route("carreras.updateStatus", carrera.id, 'Inactivo'));

                }
                else if(estudiante.estado_estudiante == 'Realizando Servicio'){
                    // carrera.estado_carrera = 'Activo';
                    this.formUp.estado_estudiante = 'Inactivo';
                    Swal.fire({
                        title: 'Se ha inactivado el estudiante ' + estudiante.nombre_estudiante,
                        text: 'Actualice la página para ver los cambios',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                    // this.$inertia.put(route("carreras.updateStatus", carrera.id, 'Activo'));
                }
                this.$inertia.put(route("estudiantes.update",estudiante.id), this.formUp);
                // this.submitUpdate(this.formUp);
            },
            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                Swal.fire({
                    title: 'Se ha actualizado la carrera ' + form.estudiante_carrera,
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                this.$inertia.put(route("estudiantes.update",form.id), this.formUp);
                // this.formUp.nombre_carrera='';
                // this.formUp.facultad_id='';
                // this.formUp.codigo_carrera='';
            },
            //mostrarMensajeDelete(carrera){
                //this.borrado = true;
                //Swal.fire({
                    //title: 'Se ha borrado la carrera ' + carrera.nombre_carrera,
                    //text: 'Actualice la página para ver los cambios',
                    //iconColor: '#CB3234',
                    //icon: 'warning',
                    //confirmButtonText: 'Aceptar',
                   // allowEscapeKey: false,
                 //   allowOutsideClick: false,
               //     showConfirmButton: false,
             //   });
           // },
            mostrarMensajeUpdate(carrera){
                console.log(carrera);
                this.formUp.estado_estudiante = estudiante.estado_estudiante;
                console.log(this.formUp);
            }

        },    
        data(){
            return{
                estudiante:0,
                estudiantesFiltradas:[],
                successGuardado:false,
                formularioNuevaCarrera:false,
                form: this.$inertia.form({
                    nombre_estudiante:'',
                    apellido_estudiante:'',
                    carnet_estudiante:'',
                    estado_estudiante:'En espera',
                    }),
                formUp: this.$inertia.form({
                    nombre_estudiante:'',
                    apellido_estudiante:'',
                    carnet_estudiante:'',
                    codigo_carrera:'',
                    id: '',
                    estado_estudiante:'',
                    }),
                activo: true,    
                }
            },        
        mounted(){
            this.estudiantes.forEach(element => {
                this.estudiantesFiltradas.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }
</script>