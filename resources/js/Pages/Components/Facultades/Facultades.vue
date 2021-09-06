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
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Lista de Facultades
                    </h3>

                     <!--Boton para añadir facultades-->
                            <button type="button" class="btn btn-success float-right mt-2" data-toggle="modal" data-target="#añadirFacultad">
                            <i class="fas fa-plus"></i> Añadir Facultades</button> 
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
                                        <!-- <th scope='col'>Código</th> -->
                                        <th scope="col">Nombre de la Facultad</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary" scope="row" v-for="(facultad, index) in facultadesFiltradas" :key="index">
                                            
                                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                                            <td>{{ facultad.nombre_facultad }}</td>
                                            <td>
                                            <!-- Botones para edit or delete-->
                                                <div class="tools">
                                                    
                                                    
                                                    <jet-button :href="route('facultades.update', facultad.id)" v-on:click="mostrarMensajeUpdate(facultad)" data-toggle="modal" 
                                                    data-target="#modificarFacultad" title="Editar Facultad"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>

                                                    <inertia-link class="fas fa-arrow-alt-circle-down" style='color:#dc3545' title="Dar de baja a Facultad" method="delete"
                                                    :href="route('facultades.destroy', facultad.id)"
                                                    v-on:click="mostrarMensajeDelete(facultad)"></inertia-link>
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
                            <inertia-link :href="route('facultades.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                             Cancelar</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
    
 
        </form>
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
            //Muestra mensaje cuando se actualiza los campos
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
            //Muestra mmensaje cuando se borra los campos
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