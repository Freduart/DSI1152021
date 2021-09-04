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
            <h1 class="m-0">Evaluacion de Solicitudes</h1>
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
                    Evaluacion de Solicitudes de Servicio Social
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            
                            <hr>
                                <table class="table table-hover text-center" width="500" style="font-size: 20px">
                                    <thead class="thead-dark">
                                        <tr>
                                        
                                        <th scope='col'>Codigo</th>
                                        <th scope="col">Nombre del estudiante</th>
                                        <th scope="col">Proyecto Social</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--Aqui devuelven los datos para que se muestren en pantalla-->
                                        <tr class="table-secondary" scope="row" v-for="(solicitud, index) in solicitudesFiltradas" :key="index">
                                            
                                            <td>{{ solicitud.id }}</td>
                                            <td>{{ solicitud.nombre_estudiante }} {{ solicitud.apellido_estudiante }}</td>
                                            <td>{{ solicitud.proyecto_social_id }}</td>
                                            <td>{{ solicitud.estado_solicitud }}</td>
                          
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="flex justify-center">
                                                    
                                                    <!--boton evaluar-->
                                                    <!--class="btn btn-warning"-->
                                                    <button class="btn btn-success" v-on:click="mostrarDatos(solicitud)" data-toggle="modal" data-target="#evaluar">
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
                        <h5 class="modal-title" id="exampleModalLabel">Evaluar Solicitud</h5>
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
                                    <jet-label for="id" value="Codigo" />
                                    <jet-input id="id" type="text" readonly="readonly" v-model="formUp.id" required autofocus autocomplete="id"/>
                                  
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                    <jet-label for="nombre_estudiante" value="Nombre del estudiante" />
                                   <jet-input id="nombre_estudiante" type="text" readonly="readonly" v-model="formUp.nombre_estudiante" required autofocus autocomplete="nombre_estudiante" />

                                </div>
                              </div>

                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="proyecto_social_id" value="Proyecto Social" />
                                  <jet-input id="proyecto_social_id" type="text" readonly="readonly" v-model="formUp.proyecto_social_id" required autofocus autocomplete="proyecto_social_id"/> 
                                </div>
                              </div>



                            </div> 
                                <!--FILA-->
                           
                            <div class="row">
                              

                              <div class="col">
                                <div class="form-group">
                                   <jet-label for="justificacion_solicitud" value="Justificacion" />
                                   <jet-input id="justificacion_solicitud" type="text" readonly="readonly" v-model="formUp.justificacion_solicitud" required autofocus autocomplete="justificacion_solicitud" /> 
                                  
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
                                                <button v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-dark float-center" title="Aprobar" v-on:click="cambiarestado(formUp)"> 
                                                 <i class="fas"></i>APROBAR </button>  

                                                 <button v-else class="btn btn-dark float-center" title="Aprobar" v-on:click="cambiarestado(formUp)"> 
                                                 <i class="fas"></i>APROBAR </button>
                                           </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <inertia-link v-if="estudiante.estado_estudiante == 'En espera'" class="btn btn-warning" title="Desactivar estudiante" method="delete" :href="route('solicitudes.destroy', this.formUp.id)" v-on:click="changestatus(formUp)"> 
                                                 <i class="fas"></i>RECHAZAR </inertia-link>  

                                                 <inertia-link v-else class="btn btn-warning" title="Desactivar estudiante" method="delete" :href="route('solicitudes.destroy', this.formUp.id)"  v-on:click="changestatus(formUp)"> 
                                                 <i class="fas"></i>RECHAZAR </inertia-link>
                                           </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <inertia-link :href="route('solicitudes.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
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
//import Label from '../../Jetstream/Label.vue'
//import Button from '../../Jetstream/Button.vue'

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
        props:['solicitudes'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },

            filtrarByEstado(event){
                this.solicitudesFiltradas.splice(0, this.solicitudesFiltradas.length);
                console.log(event.target.value);
                var estadoText= "En Espera";
                if (event.target.value == 0){
                    estadoText = "Aceptado";
                }
                this.solicitudes.forEach(element => {
                    if(element.estado_solicitud == estadoText){
                        console.log(element);
                        this.solicitudesFiltradas.push(element);
                    }
                });
                console.log(this.solicitudesFiltradas);
            }, 
           

            cambiarestado(solicitud){
                //this.borrado = true;
                if(solicitud.estado_solicitud == 'En espera'){
                    Swal.fire({
                      title: '¿Esta seguro que desea aprobar al estudiante?',
                      text: "El estudiante " +solicitud.nombre_estudiante,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, aprobar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          //var tipo = 1;
                          this.$inertia.put(route('solicitudes.update', solicitud.nombre_estudiante), this.formUp);
                          Swal.fire(
                          '!Aprobado!',
                          'El estudiante se aprobo correctamente',
                          'success'
                          );
                          window.location.reload(true);
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
            changestatus(solicitud){
                //this.borrado = true;
                if(solicitud.estado_solicitud == 'En espera'){
                    Swal.fire({
                      title: '¿Esta seguro que desea rechazar al estudiante?',
                      text: "El estudiante " +solicitud.estudiante_id,
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, rechazar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          //var tipo = 1;
                          //this.$inertia.delete(route('verificarcuenta.eliminar', estudiante.id/*, tipo*/));
                          Swal.fire(
                          '!Rechazado!',
                          'El estudiante se rechazo correctamente',
                          'success'
                          );
                          window.location.reload(true);
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
                
               
                
            },
            mostrarDatos(solicitud){
                console.log(solicitud);
                this.formUp.id=solicitud.id;
                this.formUp.nombre_estudiante=solicitud.nombre_estudiante;
                this.formUp.proyecto_social_id=solicitud.proyecto_social_id;
                this.formUp.justificacion_solicitud=solicitud.justificacion_solicitud;
                this.formUp.estado_solicitud=solicitud.estado_solicitud;
                console.log(this.formUp);
            }

        },    
        data(){
            return{
                    estudiante:0,  //ESTO ME DA ERROR
                    solicitudesFiltradas:[],
                    successGuardado:false,

                    formUp: this.$inertia.form({
                    id:'',
                    estudiante_id:'',
                    proyecto_social_id:'',
                    justificacion_solicitud:'',
                    estado_solicitud:'Aceptado',
                    }),
                activo: true,    
                }
            },        
        mounted(){
            this.solicitudes.forEach(element => {
                this.solicitudesFiltradas.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }
</script>