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
                             <!--<h6 class="ml-4 mt-2">Mostrar por estado:
                            <select class="col-2 ml-3 custom-select" v-on:change="filtrarByEstado($event)">
                                <option value="1" selected>En espera</option>
                                <option value="0">Activo</option>
                            </select></h6>-->
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
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Modificar aqui-->
                                        <tr scope="row" v-for="(estudiante, index) in estudiantesFiltradas" :key="index">
                                            
                                            <td>{{ estudiante.carnet_estudiante }}</td>
                                            <td>{{ estudiante.nombre_estudiante }}</td>
                                            <td>{{ estudiante.apellido_estudiante }}</td>
                                            <td>{{ estudiante.estado_estudiante }}</td>
                                            <!--Modificar aqui
                                            <td>
                                                <jet-button  v-if="estudiante.estado_estudiante == 'En espera'" class="fas fa-arrow-alt-circle-down" title="Dar de baja a estudiante" method="delete" v-on:click="cambiarestado(estudiante)"></jet-button>     
                                                <jet-button v-else class="fas fa-arrow-alt-circle-up" title="Activar estudiante" method="delete" v-on:click="cambiarestado(estudiante)"></jet-button>
                                            </td>-->


                                            <!--<td v-if="estudiante.estado_estudiante == 'En espera'">
                                                <form @submit.prevent="cambiarEstado(estudiante)">
                                                    <button type="submit" class="btn btn-success" :class="{ 'text-white-50 bg-green-400': form.processing }">{{ estudiante.estado_estudiante }}</button>
                                                </form>          
                                            </td>
                                            <td v-else>
                                                <form @submit.prevent="cambiarEstado(estudiante)">
                                                    <button type="submit" class="btn btn-primary" :class="{ 'text-white-50 bg-green-400': form.processing }">{{ estudiante.estado_estudiante }}</button>
                                                </form>            
                                            </td>-->
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center">
                                                    
                                                    <!--boton evaluar-->
                                                    <!--class="btn btn-warning"-->
                                                    <button class="btn btn-success" v-on:click="mostrarDatos(estudiante)" data-toggle="modal" data-target="#evaluar">
                                                        <!--<i class="fas fa-edit mx-12"></i>-->
                                                        <i>Evaluar</i>
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
        </div><!---->
        <!-- EVALUAR-->
      <div class="modal fade" id="evaluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Evaluar cuenta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form @submit.prevent="submitUpdate(this.formUp)">
                          <div class="card-body">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                    <jet-label for="nombre_estudiante" value="Nombre del estudiante" />
                                    <jet-input id="nombre_estudiante" type="text" readonly="readonly" v-model="formUp.nombre_estudiante" required autofocus autocomplete="nombre_estudiante"/>
                                  
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                    <jet-label for="apellido_estudiante" value="Apellido del estudiante" />
                                   <jet-input id="apellido_estudiante" type="text" readonly="readonly" v-model="formUp.apellido_estudiante" required autofocus autocomplete="apellido_estudiante" />

                                </div>
                              </div>
                            </div> 
                                <!--FILA-->
                           
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="carnet_estudiante" value="Carnet del estudiante" />
                                  <jet-input id="carnet_estudiante" type="text" readonly="readonly" v-model="formUp.carnet_estudiante" required autofocus autocomplete="carnet_estudiante"/> 
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                   <jet-label for="sexo_estudiante" value="Sexo" />
                                   <jet-input id="sexo_estudiante" type="text" readonly="readonly" v-model="formUp.sexo_estudiante" required autofocus autocomplete="sexo_estudiante" /> 
                                  
                                </div>
                              </div>
                            </div> 

                            <!--FILA-->

                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                <jet-label for="correo_estudiante" value="Correo" />
                                <jet-input id="correo_estudiante" type="text" readonly="readonly" v-model="formUp.correo_estudiante" required autofocus autocomplete="correo_estudiante" />
                                 
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                    <jet-label for="telefono_estudiante" value="Telefono" />
                                    <jet-input id="telefono_estudiante" type="text" readonly="readonly" v-model="formUp.telefono_estudiante" required autofocus autocomplete="telefono_estudiante" />
                                  
                                </div>
                              </div>
                            </div> 

                            <!--FILA-->

                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                 <jet-label for="carrera_id" value="Carrera" />
                                 <jet-input id="carrera_id" type="text" readonly="readonly" v-model="formUp.carrera_id" required autofocus autocomplete="carrera_id" />
                                  
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">

                                    <jet-label for="dui_estudiante" value="DUI" />
                                    <jet-input id="dui_estudiante" type="text" readonly="readonly" v-model="formUp.dui_estudiante" required autofocus autocomplete="dui_estudiante" />
                                  
                                </div>
                              </div>
                            </div> 

                            <!--FILA-->

                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                 <jet-label for="nit_estudiante" value="NIT" />
                                 <jet-input id="nit_estudiante" type="text" readonly="readonly" v-model="formUp.nit_estudiante" required autofocus autocomplete="nit_estudiante" />
                                  
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">

                                     <jet-label for="materias_cursadas" value="Materias Cursadas" />
                                     <jet-input id="materias_cursadas" type="text" readonly="readonly" v-model="formUp.materias_cursadas" required autofocus autocomplete="materias_cursadas" />
                                  
                                </div>
                              </div>
                            </div> 

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                       <jet-label for="cantidad_horas_ss" value="Cantidad de Horas de Servicio Social" />
                                       <jet-input id="cantidad_horas_ss" type="text" readonly="readonly" v-model="formUp.cantidad_horas_ss" required autofocus autocomplete="cantidad_horas_ss" />
                                    </div>
                                </div>
                            </div>

                            <hr>
                          </div>

                          <!--<div class="card-footer clearfix">--> 
                            <div class="d-flex justify-content-center align-items-baseline">
                                   <div class="row">
                                       <div class="col">
                                            <div class="form-group">
                                                <button v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-primary" title="Activar estudiante" v-on:click="cambiarestado(formUp)"> 
                                                 <i class="fas"></i>APROBAR </button>  

                                                 <button v-else class="btn btn-primary" title="Activar estudiante" v-on:click="cambiarestado(formUp)"> 
                                                 <i class="fas"></i>APROBAR </button>
                                           </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <inertia-link v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-warning" title="Desactivar estudiante" method="delete" :href="route('verificarcuenta.destroy', this.formUp.id)" v-on:click="changestatus(formUp)"> 
                                                 <i class="fas"></i>DENEGAR </inertia-link>  

                                                 <inertia-link v-else class="btn btn-warning" title="Desactivar estudiante" method="delete" :href="route('verificarcuenta.destroy', this.formUp.id)"  v-on:click="changestatus(formUp)"> 
                                                 <i class="fas"></i>DENEGAR </inertia-link>
                                           </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <inertia-link :href="route('verificarcuenta.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
                                                <i class="fas"></i> Cancelar</inertia-link>
                                           </div>
                                        </div>


                                    </div>


                            </div>
                          <!--</div>-->
                          
                          
                        </form><!--FIN FORM-->
                        
                    </div>
                </div>
            </div>
        </div>



    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
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

            filtrarByEstado(event){
                this.estudiantesFiltradas.splice(0, this.estudiantesFiltradas.length);
                console.log(event.target.value);
                var estadoText= "En Espera";
                if (event.target.value == 0){
                    estadoText = "Activo";
                }
                this.estudiantes.forEach(element => {
                    if(element.estado_estudiante == estadoText){
                        console.log(element);
                        this.estudiantesFiltradas.push(element);
                    }
                });
                console.log(this.estudiantesFiltrados);
            }, 
            /*filtrarEstudiantes(id){
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
                    })     
                }
            },*/


            /*cambiarEstado(estudiante){
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
                }
                this.$inertia.put(route("estudiantes.update",estudiante.id), this.formUp);
                // this.submitUpdate(this.formUp);
            },*/

            cambiarestado(estudiante){
                //this.borrado = true;
                if(estudiante.estado_estudiante == 'En espera'){
                    Swal.fire({
                      title: '¿Esta seguro que desea activar al estudiante?',
                      text: "El estudiante " +estudiante.nombre_estudiante + " " + estudiante.apellido_estudiante + " con carnet " + estudiante.carnet_estudiante,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, activar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          //var tipo = 1;
                          this.$inertia.put(route('verificarcuenta.update', estudiante.id), this.formUp);
                          Swal.fire(
                          '!Activado!',
                          'El estudiante se activo correctamente',
                          'success'
                          );
                          //window.location.reload(true);
                      }
                  })
                }
                 /*else {
                  Swal.fire({
                      title: '¿Esta seguro que desea activar al encargado?',
                      text: "El encargado " + estudiante.nombre_estudiante + " " + estudiante.apellido_estudiante + " con codigo " + estudiante.carnet_estudiante +" se habilitará y podrá iniciar sesión.",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, activar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          
                          this.$inertia.delete(route('verificarcuenta.destroy', estudiante.id));
                          Swal.fire(
                          '!Activado!',
                          'El estudiante se activó correctamente',
                          'success'
                          );
                          window.location.reload(true);
                      }
                  })
                }*/
                
            },
            changestatus(estudiante){
                //this.borrado = true;
                if(estudiante.estado_estudiante == 'En espera'){
                    Swal.fire({
                      title: '¿Esta seguro que desea desactivar al estudiante?',
                      text: "El estudiante " +estudiante.nombre_estudiante + " " + estudiante.apellido_estudiante + " con carnet " + estudiante.carnet_estudiante,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, desactivar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          //var tipo = 1;
                          //this.$inertia.delete(route('verificarcuenta.eliminar', estudiante.id/*, tipo*/));
                          Swal.fire(
                          '!Desactivado!',
                          'El estudiante se desactivo correctamente',
                          'success'
                          );
                          //window.location.reload(true);
                      }
                  })
                }
                 /*else {
                  Swal.fire({
                      title: '¿Esta seguro que desea activar al encargado?',
                      text: "El encargado " + estudiante.nombre_estudiante + " " + estudiante.apellido_estudiante + " con codigo " + estudiante.carnet_estudiante +" se habilitará y podrá iniciar sesión.",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, activar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          
                          this.$inertia.delete(route('verificarcuenta.destroy', estudiante.id));
                          Swal.fire(
                          '!Activado!',
                          'El estudiante se activó correctamente',
                          'success'
                          );
                          window.location.reload(true);
                      }
                  })
                }*/
                
            },

            submitUpdate(form){
                console.log(this.formUp);
                console.log(form);
                
               
                /*Swal.fire({
                    title: 'Se ha actualizado la carrera ' + form.nombre_estudiante,
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });*/
                //this.$inertia.put(route("verificarcuenta.update",form.id), this.formUp);
            },
            mostrarDatos(estudiante){
                console.log(estudiante);
                this.formUp.id=estudiante.id;
                this.formUp.nombre_estudiante=estudiante.nombre_estudiante;
                this.formUp.apellido_estudiante=estudiante.apellido_estudiante;
                this.formUp.carnet_estudiante=estudiante.carnet_estudiante;
                this.formUp.sexo_estudiante=estudiante.sexo_estudiante;
                this.formUp.correo_estudiante=estudiante.correo_estudiante;
                this.formUp.telefono_estudiante=estudiante.telefono_estudiante;
                this.formUp.carrera_id=estudiante.carrera_id;
                this.formUp.dui_estudiante=estudiante.dui_estudiante;
                this.formUp.nit_estudiante=estudiante.nit_estudiante;
                this.formUp.materias_cursadas=estudiante.materias_cursadas;
                this.formUp.cantidad_horas_ss=estudiante.cantidad_horas_ss;
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
                /*form: this.$inertia.form({
                    nombre_estudiante:'',
                    apellido_estudiante:'',
                    carnet_estudiante:'',
                    sexo_estudiante:'',
                    correo_estudiante:'',
                    telefono_estudiante:'',
                    carrera_id:'',
                    dui_estudiante:'',
                    nit_estudiante:'',
                    materias_cursadas:'',
                    cantidad_horas_ss:'',
                    estado_estudiante:'En espera',
                    }),*/
                formUp: this.$inertia.form({
                    id:'',
                    nombre_estudiante:'',
                    apellido_estudiante:'',
                    carnet_estudiante:'',
                    sexo_estudiante:'',
                    correo_estudiante:'',
                    telefono_estudiante:'',
                    carrera_id:'',
                    dui_estudiante:'',
                    nit_estudiante:'',
                    materias_cursadas:'',
                    cantidad_horas_ss:'',
                    estado_estudiante:'Activo',
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