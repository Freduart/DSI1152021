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
              <h1 class="m-0">Finalizar Proyectos Sociales</h1>
            </div><!-- /.col -->          
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div  v-if="proyectosFiltrados.length != 0">
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
                        Lista de servicios sociales
                    </h3>

                    <div class="card-tools">
                    <!-- <ul class="pagination pagination-sm">
                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                    </ul> -->
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                          <table class="table table-hover text-center" width="500" style="font-size: 20px">
                            <thead class="thead-dark">
                              <tr>
                                <th scope='col'>Tipo de Servicio</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Institución</th>
                                <th scope="col">Estado</th>
                                <th scope="col" width="15%">Acción</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr scope="row" class="table-secondary" v-for="(proyecto, index) in proyectosFiltrados" :key="index">
                                <td>{{ proyecto.nombreTipo }}</td>
                                <td>{{ proyecto.nombre_carrera }}</td>
                                <td>{{ proyecto.nombreIns }}</td>
                                <td>
                                  <button v-if="proyecto.estadoP == 'En curso'" class="btn btn-success" style="cursor: default;">
                                    <i class="fas fa-spinner"></i> <strong> &nbsp; En curso</strong>
                                  </button>
                                </td>
                                <td>
                                  <div class = "d-flex justify-content-center">
                                    <div class="tools">
                                      <!--Botón para ver el detalle del proyecto-->
                                        <jef-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarDatos(proyecto)" title="Ver informacion del servicio social"></jef-button>
                                        <!--Botón para finalizar el proyecto-->
                                        <inertia-link class="fas fa-arrow-alt-circle-down text-blue" title="Finalizar proyecto" v-on:click="finalizar(proyecto)"></inertia-link>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </li>
                      </ul>
                    </div>
                  </div><!-- /.card -->
                </section><!-- right col -->
              </div><!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
          </section>
        </div>
        <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
          No se han encontrado datos
        </div>
        <!-- /.content -->
      </div>
        <!-- /.content-wrapper -->
    </div>

    <!-- Modal para la verificación de las actividades aceptadas de los estudiantes-->
    <div class="modal fade" id="verInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <!--Contenido de la modal-->
        <div class="modal-content">
          <!--Encabezado de la modal-->
          <div class="modal-header">
            <!--Título de la modal-->
            <h5 class="modal-title" id="exampleModalLabel">Información del Proyecto Social</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div><!--Fin del encabezado-->
          <!--Cuerpo de la modal-->
          <div class="modal-body">
            <div class="card-body">
              <h4 class="text-dark text-center underline"><u>Institución</u></h4>
              <br/>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Institución: &nbsp; </strong>{{ formUp.nombreIns }}</h5>
                </div>
                <div class="col">
                  <h5 class=""><strong>Rubro: &nbsp; </strong>{{ formUp.rubro }}</h5>
                </div>
              </div>                    
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Contacto: &nbsp;</strong>{{ formUp.contactoIns }}</h5>
                </div>
                <div class="col">
                  <h5 class=""><strong>Correo: &nbsp;</strong>{{ formUp.correoIns }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Teléfono: &nbsp;</strong>{{ formUp.telIns }}</h5>
                </div>
                <div class="col">
                  <h5 class=""><strong>Ubicación: &nbsp;</strong>{{ formUp.ubic }}</h5>
                </div>
              </div>
              <hr/>
              <h4 class="text-dark text-center underline"><u>Servicio Social</u></h4>
              <br/>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Fecha de inicio: &nbsp;</strong>{{ formUp.fI }}</h5>                           
                </div>
                <div class="col">
                  <h5 class=""><strong>Fecha de finalización: &nbsp;</strong>{{ formUp.fF }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Cantidad de horas: &nbsp;</strong>{{ formUp.cantH }} </h5>
                </div>
                <div class="col">
                  <h5 class=""><strong>Cantidad de estudiantes: &nbsp;</strong>{{ formUp.cantE }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Tipo de Servicio: &nbsp;</strong>{{ formUp.nombreTipo }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Ubicación de las actividades: &nbsp;</strong>{{ formUp.ubicAc }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Descripción de petición: &nbsp;</strong>{{ formUp.dp }}</h5>
                </div>
              </div>
              <hr/>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Facultad: &nbsp;</strong>{{ formUp.nombreFa }} </h5>
                </div>
                <div class="col">
                  <h5 class=""><strong>Carrera: &nbsp;</strong>{{ formUp.nombre_carrera }}</h5>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Estado: &nbsp;
                  <button v-if="formUp.estadoP == 'En curso'" class="btn btn-success" style="cursor: default;" disabled="true">
                    <i class="fas fa-spinner"></i> &nbsp; <strong> En curso </strong>
                  </button></strong></h5>
                </div>
              </div>
              <hr class="mb-1"/>

            </div><!-- Fin card body-->

            <!--Sección de botones-->
            <div class="card-footer clearfix">
              <div class="d-flex justify-content-center align-items-baseline">
                <!--Fila de los botones-->
                <div class="row">
                  <!--Columna-->
                  <div class="col">
                    <!--boton atras-->
                    <button :href="route('finproyecto.index')" class="btn btn-dark float-center" title="Atras" data-dismiss="modal">
                      <i class="fas"></i>Atrás
                    </button>
                  </div><!--Fin columna-->
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
        props:['proyectos'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            finalizar(proyecto){
            console.log(proyecto);
                console.log(proyecto.estadoP);
                if(proyecto.estadoP == 'En curso'){
                    this.formUp.estadoP = 'Finalizado'; 
                    Swal.fire({
                        title: 'Se ha finalizado el servicio social ' + proyecto.idPro,
                        text: 'Actualice la página para ver los cambios',
                        icon: 'warning',
                        iconColor: '#FF8000',
                        confirmButtonText: 'Aceptar',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                }
                this.$inertia.put(route("finproyecto.update", proyecto.idPro), this.formUp);
            },

            verificacion(proyecto){
              if(proyecto.estadoP == 'En curso'){
                Swal.fire({
                  title:'¿Está seguro que desea dar por verificada la actividad?',
                  text: "Código " + proyecto.idPro + " Nombre de actividad" + proyecto.nombreTipo,
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, dar por verificada',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    this.$inertia.put(route('finproyecto.update', proyecto.id), this.formUp);
                    Swal.fire(
                      '!Verificada',
                      'La actividad a sido verificada correctamente',
                      'success'
                    );
                    window.location.reload(true);
                  }
                })
              }
            },
            
            mostrarDatos(proyecto){
                console.log(proyecto);
                this.formUp.nombre_carrera = proyecto.nombre_carrera;
                this.formUp.nombreTipo = proyecto.nombreTipo;
                this.formUp.nombreIns = proyecto.nombreIns;
                this.formUp.estadoP = proyecto.estadoP;
                this.formUp.rubro = proyecto.rubro;
                this.formUp.contactoIns = proyecto.contactoIns;
                this.formUp.correoIns = proyecto.correoIns;
                this.formUp.telIns = proyecto.telIns;
                this.formUp.ubic = proyecto.ubic;
                this.formUp.fI = proyecto.fI;
                this.formUp.fF = proyecto.fF;
                this.formUp.dp = proyecto.dp;
                this.formUp.cantE = proyecto.cantE;
                this.formUp.cantH = proyecto.cantH;
                this.formUp.ubicAc = proyecto.ubicAc;
                this.formUp.nombreFa = proyecto.nombreFa;
                this.formUp.idPro = proyecto.idPro;
                console.log(this.formUp);
            }
        },    
        data(){
            return{
                proyectosFiltrados:[],
                successGuardado:false,
                formularioNuevaCarrera:false,
                form: this.$inertia.form({
                    nombre_carrera:'',
                    nombreIns:'',
                    estadoP:'',
                    nombreTipo:'',
                    rubro:'',
                    contactoIns:'',
                    correoIns:'',
                    telIns:'',
                    ubic:'',
                    fI:'',
                    fF:'',
                    dp:'',
                    cantE:'',
                    cantH:'',
                    ubicAc:'',
                    nombreFa:'',
                    idPro:'',
                    }),
                formUp: this.$inertia.form({
                    nombre_carrera:'',
                    nombreIns:'',
                    estadoP:'',
                    nombreTipo:'',
                    rubro:'',
                    contactoIns:'',
                    correoIns:'',
                    telIns:'',
                    ubic:'',
                    fI:'',
                    fF:'',
                    dp:'',
                    cantE:'',
                    cantH:'',
                    ubicAc:'',
                    nombreFa:'',
                    idPro:'',
                    }),  
                }
            },        
        mounted(){
            this.proyectos.forEach(element => {
                this.proyectosFiltrados.push(element);
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        },
    }
</script>