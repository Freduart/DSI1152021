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
                <div v-if="estudiantesFiltradas.length != 0">
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            
                            <hr>
                                <table class="table table-hover text-center" width="500" style="font-size: 20px">
                                    <thead class="thead-dark">
                                        <tr>
                                        
                                        <th scope='col'>Carnet</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Aqui devuelven los datos para que se muestren en pantalla-->
                                        <tr class="table-secondary" scope="row" v-for="(estudiante, index) in estudiantesFiltradas" :key="index">
                                            
                                            <td>{{ estudiante.carnet_estudiante }}</td>
                                            <td>{{ estudiante.nombre_estudiante }}</td>
                                            <td>{{ estudiante.apellido_estudiante }}</td>
                                            <td>{{ estudiante.estado_estudiante }}</td>
                          
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
                </div>
                <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                    No se han encontrado datos
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
        </div><!---->
        <!-- Boton EVALUAR que evaluara-->
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

                                     <jet-label for="materias_cursadas" value="Porcentaje de avance del alumno en la carrera (%)" />
                                     
                                     <jet-input v-if="formUp.porcentaje_aprobacion >= 60" id="materias_cursadas" type="text" readonly="readonly" v-model="formUp.porcentaje_aprobacion" required autofocus autocomplete="materias_cursadas"/>
                                     <jet-input v-else id="materias_cursadas" type="text" style="border: 1px solid red; font-color: red;" readonly="readonly" v-model="formUp.porcentaje_aprobacion" required autofocus autocomplete="materias_cursadas"/>
            
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

                            <div class="row">
                                <div class="col">
                                    <div class="form-group text-center">
                                        <jet-label for="archivo_comprobacion" value="Captura de comprobacion de avance de carrera" />
                                        <div v-if="formUp.archivo_comprobante_path">
                                            <a :href="formUp.archivo_comprobante_url" target="_blank">
                                                <br/>
                                                <img id="archivoComprobante" :src="formUp.archivo_comprobante_url" style="height: 200px; width: 300px; rounded: 15px;" @mouseover="efectoBlur()" @mouseleave="salidaEfectoBlur()" alt="archivo de comprobacion de avance"/>
                                            </a>
                                        </div>
                                        <div v-else>
                                            <img src="https://coacademy-server-jc.com/uploads/courses/images/890.jpg" style="height: 200px; width: 300px; rounded: 15px;" alt="archivo de comprobacion de avance"/>
                                        </div>

                                        <!-- <small>{{ formUp.archivo_comprobante_url }}</small> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div v-if="this.existeObservacion" class="form-group" style="cursor:pointer;">
                                        <div v-on:click="agregarObservaciones()">
                                        <i class="fa fa-eye text-primary" aria-hidden="true"></i> Agregar observaciones
                                        </div>
                                        <div>
                                            <textarea class="form-control" rows="3" v-model="this.formUp.observacion_registro"/>
                                        </div>
                                    </div>
                                    <div v-else class="form-group" style="cursor:pointer;">
                                        <div v-on:click="agregarObservaciones()">
                                        <i class="fa fa-eye" aria-hidden="true"></i> Agregar observaciones
                                        </div>
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
                                                <button v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-dark float-center" title="Activar estudiante" v-on:click="cambiarestado(formUp)"> 
                                                 <i class="fas"></i>APROBAR </button>  

                                                 <button v-else class="btn btn-dark float-center" title="Activar estudiante" v-on:click="cambiarestado(formUp)"> 
                                                 <i class="fas"></i>APROBAR </button>
                                           </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <button v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-warning" title="Desactivar estudiante" method="delete" v-on:click="changestatus(formUp)"> 
                                                 <i class="fas"></i>DENEGAR </button>  

                                                 <button v-else class="btn btn-warning" title="Desactivar estudiante" method="delete" v-on:click="changestatus(formUp)"> 
                                                 <i class="fas"></i>DENEGAR </button>
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
        </div><!-- FIN Boton EVALUAR que evaluara-->



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
                          window.location.reload(true);
                      }
                  })
                }
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
                          console.log(estudiante)
                          //var tipo = 1;
                          //this.$inertia.delete(route('verificarcuenta.eliminar', estudiante.id/*, tipo*/));

                          this.$inertia.delete(route('verificarcuenta.destroy', this.formUp))
                          Swal.fire(
                          '!Desactivado!',
                          'El estudiante se desactivo correctamente',
                          'success'
                          );
                          window.location.reload(true);
                      }
                  })
                }
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
                this.formUp.porcentaje_aprobacion = estudiante.porcentaje_aprobacion;
                this.formUp.archivo_comprobante_url = estudiante.archivo_comprobante_url.replace('localhost', '127.0.0.1:8000');
                this.formUp.archivo_comprobante_path = estudiante.archivo_comprobante_path;
                this.formUp.observacion_registro = estudiante.observacion_registro;
                console.log(this.formUp);
            },
            efectoBlur(){
                var img = document.getElementById("archivoComprobante");
                img.style.filter = 'blur(6px)';
            },
            salidaEfectoBlur(){
                var img = document.getElementById("archivoComprobante");
                img.style.filter = 'blur(0px)';                
            },
            agregarObservaciones(){
                this.existeObservacion = !this.existeObservacion;
                console.log(this.existeObservacion);
            }

        },    
        data(){
            return{
                estudiante:0,
                estudiantesFiltradas:[],
                successGuardado:false,
                formularioNuevaCarrera:false,
                existeObservacion:false,                
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
                    porcentaje_aprobacion:'',
                    archivo_comprobante_url:'',
                    archivo_comprobante_path:'',
                    observacion_registro:''
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
        setup(){
            
        }
    }
</script>