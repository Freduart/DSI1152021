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
            <h1 class="m-0">Establecer cantidad de horas y estudiantes</h1>
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
                    Lista de servicios sociales
                    </h3>
                          <br>
                            
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                           
                                <!--Tabla donde apareceran todos las actividadess-->
                                <table class="table table-hover text-center" width="500" style="font-size: 20px">
                                    <thead class="thead-dark">
                                        <tr> 
                                        <th scope="col">Institución</th>
                                        <th scope="col">Tipo de servicio</th>
                                        <th scope="col">Carrera</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="table-secondary" scope="row" v-for="(servicio, index) in serviciosFiltrados" :key="index">
                                            
                                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                                            <td>{{ servicio.institucion }}</td>
                                            <td>{{ servicio.tipo}}</td>
                                            <td>{{ servicio.carrera }}</td>
                                            <td>{{ servicio.estado }}</td>
    
                                            <td>
                                            <!-- Botones para edit or delete-->
                                                <div class="tools">

                                                  <!-- BOTON DE VER INFORMACION -->
                                                        <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(servicio)" title="Ver mas informacion del Servicio Social"></jet-button>

                                                  <!-- BOTON DE EDITAR -->
                                                  <jet-button  v-on:click="mostrarMensajeUpdate(servicio)" data-toggle="modal" 
                                                    data-target="#modificarCantidad" title="Editar Cantidad de Horas y Estudiantes"> <i class="fas fa-edit" style='color:#007bff'></i> </jet-button>

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





  <!-- Modal para ACTUALIZAR los campos de las cantidades de hora y estudiantes con el boton de edit-->
 <div class="modal fade" id="modificarCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modificar Cantidad de Horas y estudiantes al Servicio Social</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
      <div class="modal-body">
        
        <!-- MUESTRA EN PANTALLA LOS CAMPOS LLENOS CON LOS DATOS INGRESADOS LISTOS PARA SER MODIFICADOS--->
          <form @submit.prevent="submitUpdate(this.formUp)">
            <div class="card-body">
                    <div class="row">
                      <div class="col">
                       <div class="form-group">
                            <jet-label for="horas" value="Cantidad de Horas para el Servicio Social" />
                            <jet-input id="horas" type="text" v-model="formUp.horas" required autofocus autocomplete="off" :value="this.formUp.horas"/>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="col">
                            <div class="form-group">
                                 <jet-label for="cantidad" value="Cantidad de Estudiantes para el Servicio Social" />
                                 <jet-input id="cantidad" type="text" v-model="formUp.cantidad" required autofocus autocomplete="off" :value="this.formUp.cantidad"/>
                            </div>
                      </div>
                    </div>
                    <br>
                    <br>

                </div>



            <!--BOTONES DE GUARDAR Y CANCELAR EN ACTUALIZAR -->
               <div class="d-flex justify-content-center align-items-baseline">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div class="mt-12">
                                    <jet-button class="btn btn-dark float-center" :class="{ 'text-white-50 bg-green-400': formUp.processing }" v-on:click="submitUpdate(this.formUp)">
                                    <i class="fas"></i>Guardar
                                          
                                     </jet-button>  
                                </div>                  
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-grup">
                                <jet-button :href="route('establecerha.index')" type="button" class="btn btn-danger float-center" data-dismiss="modal">
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
 <!--Final Modal Update de Cantidades-->




  <!-- Modal de la informacion del Servicio Social -->
    <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
             
             <h5 class="modal-title text-primary"><strong>Información del Servicio Social</strong></h5>
              <span class="d-flex flex-row-reverse bd-highlight col">
                  
                  <button class="btn btn-dark text-light text-lg" style="cursor: default;">
                      {{ form.tipo }}                   
                  </button>    
                  <h5 class="mt-2 mr-2"><strong>Tipo de Servicio Social:</strong></h5> 
              </span>
          </div>
          <div class="modal-body">
              
            <div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Nombre de la institución: </strong>{{ form.institucion }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Carrera: </strong>{{ form.carrera }}</h5>
                </div>
                <div class="col">
                  <h5 class=""></h5>
                </div>
              </div>
              
               

              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Cantidad de horas para el Servicio Social: </strong>{{ form.horas }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Cantidad de estudiantes para el Servicio Social: </strong>{{ form.cantidad }}</h5>
                </div>
              </div>

            </div>  
            <hr class="mb-1"/>
          </div>
          <div class="mb-4">
              <div class="d-flex justify-content-center">
                  <button class="btn btn-warning" data-dismiss="modal">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    Ocultar detalle
                  </button>
              </div>
          </div>
        </div>
      </div>
    </div> <!--MODAL DE INFORMACION DE establecer HA -->


</template>




<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetButton from '@/Jetstream/Button'
    import Label from '../../../Jetstream/Label.vue'
    import Button from '../../../Jetstream/Button.vue'
   // import Inputmask from"inputmask";

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
        props:['servicios'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
           
            //Muestra mensaje cuando se actualiza los campos
            submitUpdate(form){
                //alert(this.formUp.idPeticion);
                console.log(this.formUp);
                console.log(form);
                Swal.fire({
                    title: 'Se han actualizado las cantidades ',
                    text: 'Actualice la página para ver los cambios',
                    icon: 'success',
                    iconColor: '#FF8000',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                this.$inertia.put(route("establecerha.update", this.formUp.idServicio), this.formUp);
            },
            mostrarMensajeUpdate(servicio){
                console.log(servicio);
                //this.formUp.institucion = servicio.institucion;
                //this.formUp.tipo= servicio.tipo;
                //this.formUp.carrera = servicio.carrera;
                //this.formUp.estado= servicio.estado;
                this.formUp.cantidad= servicio.cantidad;
                this.formUp.horas = servicio.horas;                
                this.formUp.idServicio = servicio.idServicio;
                this.formUp.idPeticion = servicio.idPeticion;
                
                console.log(this.formUp);
            },

            //carga informacion de la actividad seleccionada al formulario del modal
            mostrarinfo(servicio){
                this.form.institucion = servicio.institucion;
                this.form.tipo = servicio.tipo;
                this.form.carrera = servicio.carrera;
                this.form.estado = servicio.estado;
                this.form.cantidad = servicio.cantidad;
                this.form.horas = servicio.horas;
                
            }
           
        },    
        data(){
            return{
                servicio:0,
                serviciosFiltrados:[],
                successGuardado:false,
                
                form: this.$inertia.form({
                    institucion:'',
                    tipo:'',
                    carrera:'',
                    estado:'',
                    cantidad:'0',
                    horas:'0',
                    }),
                formUp: this.$inertia.form({
                    //institucion:'',
                    //tipo:'',
                    //carrera:'',
                    //estado:'',
                    cantidad:0,
                    horas:0,
                    idServicio:0,
                    idPeticion:0
                    }),
                }
            },        
        mounted(){
            this.servicios.forEach(element => {
                this.serviciosFiltrados.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }

</script>