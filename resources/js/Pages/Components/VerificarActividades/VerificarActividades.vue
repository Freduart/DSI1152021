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
              <h1 class="m-0">Bitácora del estudiante</h1>
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
                    <h5><strong>Información del servicio social</strong></h5>
                  </div>
                 
                  <div class="card-body">
                    <!-- <h5 class="mt-2 ml-3" style="margin-bottom: 0.2rem;">{{ proyecto.nombre_peticion }}</h5>
                      <p class="ml-4 mb-1 text-gray" >Tipo Servicio: {{ proyecto.nombre_tipo_servicio }}</p>
                      <p class="ml-4 mb-4 text-gray" >Institución: {{ proyecto.nombre_institucion }}</p> -->
                    <div class="row">
                        
                      <div class="col-sm-6 ml-4">

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Servicio social:</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.proyecto.nombre_peticion }}
                          </div>
                        </div> 

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Tipo de servicio:</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.proyecto.nombre_tipo_servicio }}
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Institucion:</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.proyecto.nombre_institucion }}
                          </div>
                        </div>
                       
                        <div class="row">
                          <div class="col-md-5">
                            <strong>Nombre Estudiante:</strong>
                          </div>
                          <div class="col-md-6">
                            {{ $props.estudiante.nombre_estudiante }} {{ $props.estudiante.apellido_estudiante }}
                          </div>
                        </div> 

                        

                        <div class="row">
                          <div class="col-md-5">
                            <strong>Estado de las actividades:</strong>
                          </div>
                          <div class="col-md-6">
                            <h5 class="">
                                  <button v-if="$props.proyecto.estado_bitacora == 'En curso'" class="btn btn-primary" style="cursor: default;">{{ $props.proyecto.estado_bitacora }}</button>
                                  <button v-else-if="$props.proyecto.estado_bitacora == 'Finalizado'" class="btn btn-success" style="cursor: default;">{{ $props.proyecto.estado_bitacora }}</button>
                            </h5>
                          </div>
                        </div> 
                        <!--Boton para finalizar actividades-->
                        <div class="col">
                          <div class="form-group">
                            <a type="button" class="btn btn-secondary float-left mt-2 mr-2" :href="`/serviciossociales/${proyecto.idServicio}`">
                              <i class="fa fa-arrow-left"></i> Regresar al servicio social
                            </a>
                            <a v-if="proyecto.estado_bitacora == 'En curso' && actividadesFiltradas.length != 0" type="button" class="btn btn-warning float-left mt-2" v-on:click="concederHoras();">
                              <i class="fa fa-clipboard-check"></i> Conceder horas al estudiante
                            </a>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                  
              </div>

              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mt-2 ml-3"><strong>Lista de Actividades</strong></h5>
                   <div class="row">
                      <!--Boton para añadir actividades-->
                      <div class="col">
                          <div v-if="actividadesFiltradas.length != 0" class="form-group">
                            <button v-if="proyecto.estado_bitacora == 'En curso'" type="button" class="btn btn-success float-right" v-on:click="aceptarTodas();">
                            <i class="fas fa-check-circle"></i> Aceptar todas las actividades</button> 
                          </div>
                      </div>
                    </div>
                  
                  
                  
                </div>

                
                <!-- /.card-header -->
                
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                    <li>
                      <!--Tabla donde apareceran todos las actividades-->
                      <div v-if="actividadesFiltradas.length != 0">
                      
                      <table class="table table-hover text-center" width="500" style="font-size: 20px">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Actividad</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Horas</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="table-secondary" scope="row" v-for="(actividad, index) in actividadesFiltradas" :key="index">
                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                            <td>{{ actividad.nombre_actividad }}</td>
                            <td>{{ actividad.fecha_actividad }}</td>
                            <td>{{ actividad.total_horas }}</td>
                            <td>
                              <div class="flex justify-center">      
                                <!--boton verificar-->
                                <button v-if="actividad.verificado == 'En espera'" class="btn btn-warning" v-on:click="mostrarDatos(actividad)" data-toggle="modal" data-target="#verificar">
                                  <i class="fa fa-glasses"></i> &nbsp; <strong> Verificar </strong>
                                </button>
                                <button v-else-if="actividad.verificado == 'Reportada'" class="btn btn-danger" style="cursor: default;"><i>{{ actividad.verificado }}</i></button>
                                <button v-else-if="actividad.verificado == 'Aceptada'" class="btn btn-success" style="cursor: default;"><i>{{ actividad.verificado }}</i></button>
                                
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <h5> 
                          <strong>Total de horas aceptadas: 
                          <!--Llamamos la variblae total, que tiene el total de horas de las actividades realizadas-->
                          {{ this.horasTotales }} horas 
                          </strong>
                      </h5>
                      </div>
                      <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                          No se han encontrado datos
                      </div>
                    </li>
                  </ul>
                </div>  
                


              </div>
            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->
      
    </div><!-- /.content-wrapper -->
  </div>

  <!-- Modal para la verificación de las actividades de los estudiantes-->
  <div class="modal fade" id="verificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <!--Contenido de la modal-->
      <div class="modal-content">
        <!--Encabezado de la modal-->
        <div class="modal-header">
          <!--Título de la modal-->
          <h5 class="modal-title" id="exampleModalLabel">Información General de la Actividad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div><!--Fin del encabezado-->
        <!--Cuerpo de la modal-->
        <div class="modal-body">
          <div class="card-body">
            <table class="">
              <tr>
                <td><h5 class=""><strong>Estudiante: </strong></h5></td>
                <td><h5>{{ form.nombre_estudiante }} {{ form.apellido_estudiante }}</h5></td>
              </tr>
              <tr>
                <td><h5 class=""><strong>Nombre de la actividad: </strong></h5></td>
                <td><h5>{{ form.nombre_actividad }}</h5></td>
              </tr>
              <tr>
                <td><h5 class=""><strong>Fecha de la actividad: </strong></h5></td>
                <td><h5>{{ form.fecha_actividad }}</h5></td>
              </tr>
              <tr>
                <td><h5 class=""><strong>Total de horas en la actividad: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></h5></td>
                <td><h5>{{ form.total_horas }}</h5></td>
              </tr>
              <tr>
                <td><h5><strong>Estado de actividad:</strong></h5></td>
                <td>
                <h5><strong>
                  <button v-if="form.verificado == 'En espera'" class="btn btn-info" style="cursor: default;" disabled>
                    <i class="far fa-clock"></i> &nbsp; <strong> En espera </strong>
                  </button>
                </strong></h5>
                </td>
              </tr>
            </table>
          </div><!-- Fin card body-->

          <!--Sección de botones-->
          <div class="card-footer clearfix">
            <div class="d-flex justify-content-center align-items-baseline">
              <!--Fila de los botones-->
              <div class="row">
                <!--Primera columna-->
                <div class="col">
                  <!--boton de verificación de actividad-->
                  <button class="btn btn-warning" title="Verificar actividad" v-on:click="verificacion(form)"> 
                    <i class="fas"></i>Aceptar
                  </button>
                </div><!--Fin primera columna-->

                <!--Segunda columna-->
                <div class="col">
                  <!--boton de reportar actividad-->
                  <button class="btn btn-danger" title="Verificar actividad" v-on:click="reportar(form)"> 
                    <i class="fas"></i>Reportar 
                  </button>
                  <!--<button v-else class="btn btn-danger float-center" title="Verificar actividad" v-on:click="Reportar(form)">
                    <i class="fas"></i>Reportar
                  </button>-->
                </div><!--Fin Segunda columna-->

                <!--Tercera columna-->
                <div class="col">
                  <!--boton atras-->
                  <button :href="route('verificaractividades.index')" class="btn btn-dark float-center" title="Atras" data-dismiss="modal">
                    <i class="fas"></i>Atrás
                  </button>
                </div><!--Fin Tercera columna-->
              </div><!--Fin de la fila de los botones-->
            </div>
          </div>
          <!--Fin de sección de botones-->
        </div><!--Fin cuerpo de la modal-->
      </div><!--Fin contenido de la modal-->
    </div>
  </div>

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
        props:['actividades', 'proyecto', 'estudiante'],
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
          
          //Metodo para la verificación de la actividad
            verificacion(actividad){
              if(actividad.verificado == 'En espera'){
                this.form.verificado = 'Aceptada';
                Swal.fire({
                  title:'¿Está seguro que desea dar por verificada la actividad?',
                  text: "Actividad: " + actividad.nombre_actividad,
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, dar por verificada',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    this.$inertia.put(route('verificaractividades.update', actividad.id), this.form);
                    Swal.fire({
                    title: 'Actividad Verificada',
                    text: 'La actividad ' + actividad.nombre_actividad + ' ha sido verificada correctamente',
                    iconColor: '#CB3234',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });

                  }
                })
              }
            },

            // Método para reportar la actividad
            reportar(actividad){
              if(actividad.verificado == 'En espera'){
                this.form.verificado = 'Reportada';
                Swal.fire({
                  title:'¿Está seguro que desea reportar la actividad?',
                  text: "Actividad: " +actividad.nombre_actividad,
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    this.$inertia.put(route('verificaractividades.update', actividad.id), this.form);
                    Swal.fire({
                    title: 'Actividad Reportada',
                    text: 'La actividad ' + actividad.nombre_actividad + ' ha sido reportada correctamente',
                    iconColor: '#CB3234',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                    
                  }
                })
              }
            },

            aceptarTodas(){
              this.form.verificado = 'Aceptadas';
              Swal.fire({
                  title:'¿Está seguro que desea aceptar todas las actividades?',
                  text: "Todas las actividades serán aceptadas, incluso las que estan reportadas",
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    //this.$inertia.put(route('verftodas'), this.form);
                    this.$inertia.put(route('verificaractividades.update', this.estudiante.idE), this.form);
                    Swal.fire({
                    title: 'Actividades aceptadas',
                    text: 'La actividades del estudiante ' + this.estudiante.nombre_estudiante + ' ' + this.estudiante.apellido_estudiante +' han sido aceptadas correctamente',
                    iconColor: '#CB3234',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                    
                  }
                })
            },

            concederHoras(){
              var cont = 0;
              var actividades = this.actividades;
              for(var actividad of actividades){
                  if (actividad.verificado == 'En espera' || actividad.verificado == 'Reportada'){
                      cont++;
                  }
              } 

              if (cont == 0){
                this.form.verificado = 'Finalizadas';
                Swal.fire({
                  title:'¿Está seguro que desea conceder horas al estudiante?',
                  text: "Se dará como finalizadas las actividades del estudiante para el servicio social. El estudiante NO podrá realizar más actividades para este proyecto.",
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    //this.$inertia.put(route('verftodas'), this.form);
                    this.$inertia.put(route('verificaractividades.update', this.estudiante.idE), this.form);
                    Swal.fire({
                    title: 'Actividades Finalizadas del estudiante',
                    text: 'El estudiante ' + this.estudiante.nombre_estudiante + ' ' + this.estudiante.apellido_estudiante +' ha finalizado las actividades del servicio social',
                    iconColor: '#CB3234',
                    icon: 'success',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    showConfirmButton: true,
                    }).then((result) => {
                      if (result.isConfirmed) {
                        location.reload();
                      }
                    });
                    
                  }
                })
              } else {
                Swal.fire({
                    title: 'Error',
                    text: "No es posible conceder horas ya que hay actividades que se encuentran sin verificar o que están reportadas.",
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    allowEscapeKey: true,
                    allowOutsideClick: true,
                    showConfirmButton: true,  
                })
              }
              
            },

            //carga informacion de la actividad seleccionada al formulario del modal
            mostrarDatos(actividad){
              this.form.id = actividad.id,
              this.form.nombre_estudiante = actividad.nombre_estudiante,
              this.form.apellido_estudiante = actividad.apellido_estudiante,
              this.form.nombre_actividad = actividad.nombre_actividad,
              this.form.fecha_actividad = actividad.fecha_actividad,
              this.form.total_horas = actividad.total_horas,
              this.form.verificado = actividad.verificado,
              this.form.estudiante_id = actividad.idE,
              this.form.proyecto_social_id = this.proyecto.idServicio
            },

            calcularTotal(){
              var total = 0;
              this.actividades.forEach(element => {
                if(element.verificado == 'Aceptada'){
                  total += element.total_horas;
                }
              });
              this.horasTotales = total;
              
            }
    },    
      
    data(){
        return{
          actividad:0,
          actividadesFiltradas:[],
          proyectosFiltradas:[],
          successGuardado:false,
          horasTotales:0,
          //formularioNuevaCarrera:false,
          form: this.$inertia.form({
            id:'',
            nombre_actividad:'',
            fecha_actividad:'',
            total_horas:0,
            verificado:'En espera',
            nombre_estudiante: '',
            apellido_estudiante: '',
            proyecto_social_id: this.proyecto.idServicio,
            estudiante_id: this.estudiante.idE,
          }),
          formUp: this.$inertia.form({
            id:'',
            nombre_actividad:'',
            fecha_actividad:'',
            total_horas:'',
            verificado:'En espera',
            //proyecto_social_id: this.props.proyecto.proyecto_social_id,
            //estudiante_id:'',
          }),
        }
    },        
    
    mounted(){
      this.actividades.forEach(element => {
        this.actividadesFiltradas.push(element);
      }),
      // this.mostrarMensajeSuccess();
      this.successGuardado = false; 
      this.calcularTotal();        
    },
  }
</script>