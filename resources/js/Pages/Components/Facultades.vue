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
            <h1 class="m-0">Administración de Facultades</h1>
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
                    Facultades
                    </h3>
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
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#añadirFacultad">
                            <i class="fas fa-plus"></i> Añadir</button> 
                            <hr>
                                <table class="table table-striped table-dark text-center" width="500" >
                                    <thead>
                                        <tr> 
                                        <th scope='col'>Código</th>
                                        <th scope="col">Nombre de la Facultad</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr scope="row" v-for="(facultad, index) in facultadesFiltradas" :key="index">
                                            
                                            <td>{{ facultad.id }}</td>
                                            <td>{{ facultad.nombre_facultad }}</td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center">
                                                    <inertia-link
                                                    method="delete"
                                                    :href="route('facultades.destroy', facultad.id)"
                                                    v-on:click="mostrarMensajeDelete(facultad)">
                                                        <button class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </inertia-link>
                                                    <button class="btn btn-warning" v-on:click="mostrarMensajeUpdate(facultad)" data-toggle="modal" data-target="#modificarFacultad">
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



<!-- Modal Insert-->
<div class="modal fade" id="añadirFacultad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Añadir Facultad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form @submit.prevent="submit">
            <div class="form-group">
                <jet-label for="nombre_facultad" value="Nombre de la Facultad" />
                <jet-input id="nombre_facultad" type="text" v-model="form.nombre_facultad" required autofocus autocomplete="off"/>
            </div>
            <!-- <div class="form-group">
                 <jet-label for="facultad_id" value="Codigo de la facultad" />
                 <jet-input id="facultad_id" type="text" v-model="form.facultad_id" required autofocus autocomplete="off"/>
            </div>-->
            <div class="form-group">

                <br/>
                <hr/>
                <div class="mt-12">
                    <jet-button class="ml-4" :class="{ 'text-white-50 bg-green-400': form.processing }" >
                        <button type="button" class="btn btn-primary">Guardar Facultad</button>
                        <!--<i class="fas fa-save"></i>  Guardar Facultad --> 
                    </jet-button>   
                    <jet-button type="button" class="btn btn-danger mx-12" data-dismiss="modal">
                        <inertia-link :href="route('facultades.index')">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        </inertia-link>
                    </jet-button>
                    
                </div>
            </div>
    
 
        </form>
        </div>
    </div>
  </div>
</div><!--Final Modal Insert-->

<!-- Modal Update-->
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
            <!--<div class="form-group">
                <jet-label for="facultad_id" value="Codigo de la facultad" />
                <jet-input id="facultad_id" type="text" v-model="formUp.facultad_id" required autofocus autocomplete="off"/>
            </div>-->
            <div class="form-group">
                <br/>
                <hr/>
                <div class="mt-12">
                    <jet-button class="ml-4" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="submitUpdate(this.formUp)">
                        <button type="button" class="btn btn-primary">Modificar</button>
                        <!--<i class="fas fa-edit"></i>  Modificar-->   
                    </jet-button>   

                    <jet-button type="button" class="btn btn-danger mx-12" data-dismiss="modal">
                        <inertia-link :href="route('facultades.index')">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        </inertia-link>
                    </jet-button>
                    
                </div>
            </div>
    
 
        </form>
        </div>
    </div>
  </div>
</div>
<!--Final Modal Update-->

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
        props:['facultades'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            filtrarByFacultad(id){
                this.facultadesFiltradas.splice(0, this.facultadesFiltradas.length);
                console.log(id);
                this.facultades.forEach(element => {
                    if(element.facultad_id == id){
                        console.log(element);
                        this.facultadesFiltradas.push(element);
                    }
                });
                console.log(this.facultadesFiltradas);
                if(id == '0'){
                    this.facultades.forEach(element => {
                        this.facultadesFiltradas.push(element);
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
                this.form.post(this.route('facultades.store'));
                this.form.nombre_facultad='';
                //this.form.facultad_id='';
            },
           
            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                Swal.fire({
                    title: 'Se ha actualizado la facultad ' + form.nombre_facultad,
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
            mostrarMensajeDelete(facultad){
                this.borrado = true;
                Swal.fire({
                    title: 'Se ha borrado la facultad ' + facultad.nombre_facultad,
                    text: 'Actualice la página para ver los cambios',
                    iconColor: '#CB3234',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },
            mostrarMensajeUpdate(facultad){
                console.log(facultad);
                this.formUp.nombre_facultad = facultad.nombre_facultad;
                //this.formUp.facultad_id = facultad.facultad_id;
                this.formUp.id = facultad.id;
                console.log(this.formUp);
            }
           
        },    
        data(){
            return{
                facultad:0,
                facultadesFiltradas:[],
                successGuardado:false,
                formularioNuevaCarrera:false,
                form: this.$inertia.form({
                    nombre_facultad:'',
                    //facultad_id:'',
                    }),
                formUp: this.$inertia.form({
                    nombre_facultad:'',
                    //facultad_id:'',
                    id: '',
                    }),
                }
            },        
        mounted(){
            this.facultades.forEach(element => {
                this.facultadesFiltradas.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }
</script>