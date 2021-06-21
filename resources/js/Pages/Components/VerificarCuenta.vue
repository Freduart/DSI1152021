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
                                        <tr scope="row" v-for="(carrera, index) in carrerasFiltradas" :key="index">
                                            
                                            <td>{{ carrera.codigo_carrera }}</td>
                                            <td>{{ carrera.nombre_carrera }}</td>
                                            <td>{{ carrera.nombre_facultad }}</td>
                                            <td v-if="carrera.estado_carrera == 'Activo'">
                                                <form @submit.prevent="cambiarEstado(carrera)">
                                                    <button type="submit" class="btn btn-success" :class="{ 'text-white-50 bg-green-400': form.processing }">{{ carrera.estado_carrera }}</button>
                                                </form>          
                                            </td>
                                            <td v-else>
                                                <form @submit.prevent="cambiarEstado(carrera)">
                                                    <button type="submit" class="btn btn-primary" :class="{ 'text-white-50 bg-green-400': form.processing }">{{ carrera.estado_carrera }}</button>
                                                </form>            
                                            </td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center">

                                                    
                                                    <inertia-link
                                                    method="delete"
                                                    :href="route('carreras.destroy', carrera.id)"
                                                    v-on:click="mostrarMensajeDelete(carrera)">
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </inertia-link>
                                                    
                                                    <button class="btn btn-warning" v-on:click="mostrarMensajeUpdate(carrera)" data-toggle="modal" data-target="#actualizarCarrera">
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



<!-- Modal Insert-->
<div class="modal fade" id="añadirCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir una nueva carrera</h5>
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
                    <!-- <jet-button type="button" class="btn btn-success ml-4" :class="{ 'text-white-50' : form.processing }" :disabled="form.processing">Guardar</jet-button> -->
                </div>
            </div>
    
 
        </form>
        </div>
    </div>
  </div>
</div>

<!-- Modal Update-->
<div class="modal fade" id="actualizarCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar carrera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form @submit.prevent="submitUpdate(this.formUp)">
            <div class="form-group">
                <jet-label for="nombre_carrera" value="Nombre de la carrera" />
                <jet-input id="nombre_carrera" type="text" v-model="formUp.nombre_carrera" required autofocus autocomplete="off" :value="this.formUp.nombre_carrera"/>
            </div>
            <div class="form-group">
                <jet-label for="codigo_carrera" value="Código de la carrera" />
                <jet-input id="codigo_carrera" type="text" v-model="formUp.codigo_carrera" required autofocus autocomplete="off" :value="this.formUp.codigo_carrera"/>
            </div>
            <div class="form-group">
                <jet-label for="facultad_id" value="Facultad a la que pertenece" />
                <br/>
                <select id="facultad_id" v-model="formUp.facultad_id" required>
                    <option disabled value="">Seleccione una facultad</option>
                    <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                </select>
                <hr/>
                <div class="mt-12">
                    <jet-button class="ml-4" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="submitUpdate(this.formUp)">
                        <i class="fas fa-plus"></i>  Actualizar Carrera  
                    </jet-button>   

                    <jet-button type="button" class="btn btn-danger mx-12" data-dismiss="modal">
                        <inertia-link :href="route('carreras.index')">
                        Cancelar
                        </inertia-link>
                    </jet-button>
                    <!-- <jet-button type="button" class="btn btn-success ml-4" :class="{ 'text-white-50' : form.processing }" :disabled="form.processing">Guardar</jet-button> -->
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
        props:['carreras', 'facultades'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            filtrarByFacultad(id){
                this.carrerasFiltradas.splice(0, this.carrerasFiltradas.length);
                console.log(id);
                this.carreras.forEach(element => {
                    if(element.facultad_id == id){
                        console.log(element);
                        this.carrerasFiltradas.push(element);
                    }
                });
                console.log(this.carrerasFiltradas);
                if(id == '0'){
                    this.carreras.forEach(element => {
                        this.carrerasFiltradas.push(element);
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
                // this.successGuardado = true;
                // if(this.form.facultad_id == 0){
                //     alert("Debe seleccionar facultad");
                // }
                // else{
                    this.mostrarMensajeSuccess();
                // }
                this.form.post(this.route('carreras.store'));
                this.form.nombre_carrera='';
                this.form.facultad_id='';
                this.form.codigo_carrera='';
            },
            cambiarEstado(carrera){
                console.log(carrera);
                console.log(carrera.estado_carrera);
                if(carrera.estado_carrera == 'Activo'){
                    // carrera.estado_carrera = 'Inactivo';
                    this.formUp.estado_carrera = 'Inactivo'; 
                    Swal.fire({
                        title: 'Se ha inactivado la carrera ' + carrera.nombre_carrera,
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
                else if(carrera.estado_carrera == 'Inactivo'){
                    // carrera.estado_carrera = 'Activo';
                    this.formUp.estado_carrera = 'Activo';
                    Swal.fire({
                        title: 'Se ha activado la carrera ' + carrera.nombre_carrera,
                        text: 'Actualice la página para ver los cambios',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                    // this.$inertia.put(route("carreras.updateStatus", carrera.id, 'Activo'));
                }
                // // console.log(this.formUp);
                // console.log(carrera.estado_carrera);
                // this.$inertia.put(route("carreras.update", carrera.id), carrera.estado_carrera);
                // console.log(carrera);
                // this.$inertia.put(route('carreras.updateStatus', carrera.estado_carrera), carrera);
                this.$inertia.put(route("carreras.update",carrera.id), this.formUp);
                // this.submitUpdate(this.formUp);
            },
            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                // this.successGuardado = true;
                // if(this.form.facultad_id == 0){
                //     alert("Debe seleccionar facultad");
                // }
                // else{
                    // this.mostrarMensajeUpdate(carrera);
                // }
                // this.form.post(this.route('carreras.update'));
                Swal.fire({
                    title: 'Se ha actualizado la carrera ' + form.nombre_carrera,
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                this.$inertia.put(route("carreras.update",form.id), this.formUp);
                // this.formUp.nombre_carrera='';
                // this.formUp.facultad_id='';
                // this.formUp.codigo_carrera='';
            },
            mostrarMensajeDelete(carrera){
                this.borrado = true;
                Swal.fire({
                    title: 'Se ha borrado la carrera ' + carrera.nombre_carrera,
                    text: 'Actualice la página para ver los cambios',
                    iconColor: '#CB3234',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },
            mostrarMensajeUpdate(carrera){
                console.log(carrera);
                this.formUp.nombre_carrera = carrera.nombre_carrera;
                this.formUp.codigo_carrera = carrera.codigo_carrera;
                this.formUp.facultad_id = carrera.facultad_id;
                this.formUp.estado_carrera = carrera.estado_carrera;
                this.formUp.id = carrera.id;
                console.log(this.formUp);
            }
            // borrar(carrera){
            //     console.log(carrera);
            //     Swal.fire({
            //     title: 'Borrar carrera',
            //     text: 'Se borrará la carrera: ' + carrera.nombre_carrera +
            //           'Código: ' + carrera.codigo_carrera,
            //     icon: 'warning',
            //     showCancelButton: true,
            //     cancelButtonText: 'Cancelar',
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Borrar',
            //     textColor: '#ffffff',
            //     customClass:{
            //         textColor:'text-gray-50'
            //     }
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             Swal.fire(
            //             'Borrado exitoso',
            //             'Actualice la página para ver los cambios',
            //             'success',
            //             );
            //             // this.$inertia.get('carreras.index');
            //         }
            //     })
            // }
        },    
        data(){
            return{
                facultad:0,
                carrerasFiltradas:[],
                successGuardado:false,
                formularioNuevaCarrera:false,
                form: this.$inertia.form({
                    nombre_carrera:'',
                    facultad_id:'',
                    codigo_carrera:'',
                    estado_carrera: 'Activo',
                    }),
                formUp: this.$inertia.form({
                    nombre_carrera:'',
                    facultad_id:'',
                    codigo_carrera:'',
                    id: '',
                    estado_carrera:'',
                    }),
                activo: true,    
                }
            },        
        mounted(){
            this.carreras.forEach(element => {
                this.carrerasFiltradas.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }
</script>