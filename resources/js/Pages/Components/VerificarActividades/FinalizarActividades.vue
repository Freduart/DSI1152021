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
              <h1 class="m-0">Finalizar Actividades</h1>
            </div><!-- /.col -->          
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

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
                    Lista de actividades aceptadas
                  </h3>
                </div>
                <!-- /.card-header -->
                <!--<div class="card-body">
                  <div class="col">
                    <strong>Seleccionar todo: &nbsp; </strong>-->
                    <!-- CheckBox para poder seleccionar todas las actividades a la vez-->
                    <!--<input type="checkbox" style="width:20px;height:20px;" id="chkCheckAll">
                  </div>
                </div>-->
                <div  v-if="actividadesFiltradas.length != 0">
                  <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                      <li>
                      <!--Tabla donde apareceran todos las actividades aceptadas-->
                        <table class="table table-hover text-center" width="500" style="font-size: 20px">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Código de actividad</th>
                              <th scope="col">Nombre de la Actividad</th>
                              <th scope="col">Estado de la actividad</th>
                              <!--<th scope="col">Código de bitácora</th>-->
                              <th scope="col" width="15%">Acción</th>
                              <!--<th scope="col" width="15%"></th>-->
                            </tr>
                          </thead>

                          <tbody>
                            <tr class="table-secondary" scope="row" v-for="(actividad, index) in actividadesFiltradas" :key="index">
                              <!--Aqui devuelven los datos que se mostraran en pantalla -->
                              <td>{{ actividad.id }}</td>
                              <td>{{ actividad.nombre_actividad }}</td>
                              <td>
                                <!-- se coloca un botón no funcional solo para mostrar si la actividad ha sido aceptada-->
                                <button v-if="actividad.verificado == 'Aceptada'" class="btn btn-success" style="cursor: default;">
                                  <i class="fa fa-thumbs-up"></i> &nbsp; <strong> Aceptada </strong>
                                </button>
                                <button v-if="actividad.verificado == 'Finalizada'" class="btn btn-primary" style="cursor: default;">
                                  <i class="fa fa-award nav-icon"></i> &nbsp; <strong> Finalizada </strong>
                                </button>
                              </td>
                            <!--<td>{{ actividad.idBitacora }}</td>-->
                            <!--<td>-->
                              <!-- checkbox en cada fila de las actividades aceptadas-->
                              <!--<div  class="icheck-primary d-inline ml-2">
                                <input type="checkbox" class="checkBoxClass" value="" name="todo1" id="todoCheck1" style="width:20px;height:20px;">
                                  <label for="todoCheck1-sm"></label>
                              </div>-->
                            <!--</td>-->
                              <td>
                                <div class = "d-flex justify-content-center">
                                  <div class="tools">
                                    <!--Botón para ver el detalle de la actividad-->
                                    <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarDatos(actividad)" title="Ver más información de la actividad"></jet-button>
                                    <!--Botón para finalizar la actividad-->
                                    <jet-button class="fas fa-arrow-alt-circle-down text-blue" title="Finalizar actividad" method="delete" v-on:click="finalizar(actividad)"></jet-button>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="card-body">
                          <!--Botón para finalizar proyectos-->
                          <inertia-link type="button" class="btn btn-warning float-left mt-2"  :href="route('finproyecto.index')">
                            <i class="fa fa-flag-checkered"></i> <strong> &nbsp; Finalizar Proyecto Social</strong>
                          </inertia-link>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                  No se han encontrado datos
                </div>
              </div>
            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  </div>

  <!-- Modal de la informacion de la actividad -->
  <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-primary"><strong>Información de la actividad</strong></h5>
            <!--<h3 class="modal-title text-primary">{{ form.nombre_actividad }} </h3>-->
            <span class="d-flex flex-row-reverse bd-highlight col">
            <button class="btn btn-dark text-light text-lg" style="cursor: default;">
              {{ form.id }}                   
            </button>    
            <h5 class="mt-2 mr-2"><strong>Codigo:</strong></h5> 
          </span>
        </div>
        <div class="modal-body">

          <table>
            <tr>
              <td><h5 class=""><strong>Nombre de la actividad: </strong></h5></td>
              <td><h5>{{ form.nombre_actividad }}</h5></td>
            </tr>
            <tr>
              <td><h5 class=""><strong>Fecha de la actividad: </strong></h5></td>
              <td><h5>{{ form.fecha_actividad }}</h5></td>
            </tr>
            <tr>
              <td><h5 class=""><strong>Total de horas de la actividad: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></h5></td>
              <td><h5>{{ form.total_horas }}</h5></td>
            </tr>
            <tr>
              <td><h5><strong>Estado de la actividad:</strong></h5></td>
              <td>
                <h5><strong>
                  <button v-if="form.verificado == 'Aceptada'" class="btn btn-success" style="cursor: default;" disabled>
                    <i class="fa fa-thumbs-up"></i> &nbsp; <strong> Aceptada </strong>
                  </button>
                  <button v-if="form.verificado == 'Finalizada'" class="btn btn-primary" style="cursor: default;" disabled>
                    <i class="fa fa-award nav-icon"></i> &nbsp; <strong> Finalizada </strong>
                  </button>
                </strong></h5>
              </td>
            </tr>
          </table>  
          <hr class="mb-1"/>
        </div>
        <div class="mb-4">
          <div class="d-flex justify-content-center">
            <button class="btn btn-dark" data-dismiss="modal">
              <i class="fa fa-eye-slash" aria-hidden="true"></i>
                Ocultar detalle
            </button>
          </div>
        </div>
      </div>
    </div>
  </div> <!--MODAL DE INFORMACION DE LA ACTIVIDAD -->

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
                    if(element.bitacora_id == id){
                        console.log(element);
                        this.actividadesFiltradas.push(element);
                    }
                });
                console.log(this.actividadesFiltradas);
                if(id == '0'){
                    this.actividades.forEach(element => {
                        this.acividadesFiltradas.push(element);
                        // this.mostrarMensajeSuccess();
                    })     
                }
            },
          
            //Metodo para finalizar la actividad
            finalizar(actividad){
            console.log(actividad);
                console.log(actividad.verificado);
                if(actividad.verificado == 'Aceptada'){
                    this.formUp.verificado = 'Finalizada'; 
                    Swal.fire({
                        title: 'Se ha finalizado la actividad ' + actividad.nombre_actividad,
                        text: 'Actualice la página para ver los cambios',
                        icon: 'warning',
                        iconColor: '#FF8000',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                }
                this.$inertia.put(route("finalizaractividades.update", actividad.id), this.form);
            },

            //carga informacion de la actividad seleccionada al formulario del modal
            mostrarDatos(actividad){
              this.form.id = actividad.id,
              this.form.nombre_actividad = actividad.nombre_actividad,
              this.form.fecha_actividad = actividad.fecha_actividad,
              this.form.total_horas = actividad.total_horas,
              this.form.verificado = actividad.verificado,
              this.form.idBitacora = actividad.idBitacora
            }
        },    
        data(){
            return{
                actividad:0,
                actividadesFiltradas:[],
                successGuardado:false,
                //formularioNuevaCarrera:false,
                form: this.$inertia.form({
                    id:'',
                    nombre_actividad:'',
                    fecha_actividad:'',
                    total_horas:'',
                    verificado:'',
                    idBitacora:'',
                    }),
                formUp: this.$inertia.form({
                    id:'',
                    nombre_actividad:'',
                    fecha_actividad:'',
                    total_horas:'',
                    verificado:'',
                    idBitacora:'',
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
    
    //función para seleccionar todos los checkbox a la vez
    //$(function(e){
      //$("#chkCheckAll").click(function(){
        //$(".checkBoxClass").prop('checked',$(this).prop('checked'));
      //})
    //});

</script>