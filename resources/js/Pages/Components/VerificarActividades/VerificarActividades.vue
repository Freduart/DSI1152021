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
              <h1 class="m-0">Verificación de actividades</h1>
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
                      Lista de Actividades de los estudiantes
                  </h3>
                  <br>
                  
                  <!--Boton para finalizar actividades-->
                  <div class="col">
                    <div class="form-group">
                      <inertia-link type="button" class="btn btn-success float-left mt-2"  :href="route('finalizaractividades.index')">
                        <i class="fa fa-check-square"></i> Finalizar Actividades
                      </inertia-link>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                    <li>
                      <!--Tabla donde apareceran todos las actividades-->
                      <table class="table table-hover text-center" width="500" style="font-size: 20px">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre de la Actividad</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr class="table-secondary" scope="row" v-for="(actividad, index) in actividadesFiltradas" :key="index">
                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                            <td>{{ actividad.id }}</td>
                            <td>{{ actividad.nombre_actividad }}</td>
                            <td>
                              <div class="flex justify-center">      
                                <!--boton verificar-->
                                <button class="btn btn-success" v-on:click="mostrarDatos(actividad)" data-toggle="modal" data-target="#verificar">
                                  <i>Verificar</i>
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
            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  </div>

  <!-- Modal para la verificación de las actividades de los estudiantes-->
  <div class="modal fade" id="verificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <!--Contenido de la modal-->
      <div class="modal-content">
        <!--Encabezado de la modal-->
        <div class="modal-header">
          <!--Título de la modal-->
          <h5 class="modal-title" id="exampleModalLabel">Verificar actividad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div><!--Fin del encabezado-->
        <!--Cuerpo de la modal-->
        <div class="modal-body">
          <div class="card-body">
            <!--Primera fila de la modal-->
            <div class="row">
              <!--Primera columna de la fila-->
              <div class="col">
                <div class="form-group">
                  <jet-label for="id_actividad" value="Código de la actividad" />
                  <jet-input id="id_actividad" type="text" readonly="readonly" v-model="form.id" required autofocus autocomplete="id_actividad"/>
                </div>
              </div><!--Fin de la primera columna-->
              <!--Segunda columna de la fila-->
              <div class="col">
                <div class="form-group">
                  <jet-label for="bitacora_id" value="Código de bitácora" />
                  <jet-input id="bitacora_id" type="text" readonly="readonly" v-model="form.bitacora_id" required autofocus autocomplete="bitacora_id"/>
                </div>
              </div><!--Fin de la segunda columna-->
            </div><!--Fin de la primera fila-->

            <!--Segunda fila-->
            <div class="row">
              <!--Primera columna de la fila-->
              <div class="col">
                <div class="form-group">
                  <jet-label for="nombre_actividad" value="Nombre de la actividad" />
                  <jet-input id="nombre_actividad" type="text" readonly="readonly" v-model="form.nombre_actividad" required autofocus autocomplete="nombre_actividad"/>
                </div>
              </div><!--Fin de la primera columna-->
            </div><!--Fin de la segunda fila-->

            <!--Tercera fila de la modal-->
            <div class="row">
              <!--Primera columna de la fila-->
              <div class="col">
                <div class="form-group">
                  <jet-label for="fecha_actividad" value="Fecha de la actividad" />
                  <jet-input id="fecha_actividad" type="text" readonly="readonly" v-model="form.fecha_actividad" required autofocus autocomplete="fecha_actividad"/>
                </div>
              </div><!--Fin de la primera columna-->
              <!--Segunda columna de la fila-->
              <div class="col">
                <div class="form-group">
                  <jet-label for="total_horas" value="Total de horas en la actividad" />
                  <jet-input id="total_horas" type="text" readonly="readonly" v-model="form.total_horas" required autofocus autocomplete="total_horas"/>
                </div>
              </div><!--Fin de la segunda columna-->
            </div><!--Fin de la tercera fila-->

          </div><!-- Fin card body-->

          <!--Sección de botones-->
          <div class="card-footer clearfix">
              <div class="d-flex justify-content-center align-items-baseline">
                <!--Fila de los botones-->
                <div class="row">
                  <!--Primera columna-->
                  <div class="col">
                    <!--boton de verificación de actividad-->
                    <button v-if="actividad.verificado == '0'" class="btn btn-warning float-center" title="Verificar actividad" v-on:click="verificacion(form)">
                      <i class="fas"></i>Aceptar
                    </button>
                    <button v-else class="btn btn-warning float-cneter" title="Verificar actividad" v-on:click="verificacion(form)">
                      <i class="fas"></i>Aceptar
                    </button>
                  </div><!--Fin primera columna-->
                  <!--Segunda columna-->
                  <div class="col">
                    <!--boton de reportar actividad-->
                    <button v-if="actividad.verificado == '0'" class="btn btn-danger float-center" title="Verificar actividad" v-on:click="Reportar(form)">
                      <i class="fas"></i>Reportar
                    </button>
                    <button v-else class="btn btn-danger float-cneter" title="Verificar actividad" v-on:click="Reportar(form)">
                      <i class="fas"></i>Reportar
                    </button>
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
        props:['actividades'],
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
            },
            /*filtrarByActividad(event){
              this.actividadesFiltradas.splice(0, this.actividadesFiltradas.length);
              console.log(event.target.value);
              var verificadoText= "0";
              if (event.target.value == 0){
                verificadoText= "1";
              }
              this.actividad.forEach(element =>{
                if(element.verificado=verificadoText){
                  console.log(element);
                  this.actividadesFiltradas.push(element);
                }
              });
              console.log(this.actividadesFiltradas);
            },*/
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
              if(actividad.verificado == '0'){
                Swal.fire({
                  title:'¿Está seguro que desea dar por verificada la actividad?',
                  text: "Código " + actividad.id + " Nombre de actividad" + actividad.nombre_actividad,
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, dar por verificada',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    this.$inertia.put(route('verificaractividades.update', actividad.id), this.formUp);
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

            // Método para reportar la actividad
            Reportar(actividad){
              if(actividad.verificado == '0'){
                Swal.fire({
                  title:'¿Está seguro que desea reportar la actividad?',
                  text: "Código " +actividad.id + " Nombre de actividad " +actividad.nombre_actividad,
                  icon:'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Aceptar',
                  cancelButtonText: 'No, cancelar'
                }).then((result)=>{
                  if(result.isConfirmed){
                    //this.$inertia.put(route('verificaractividades.report', actividad.id), this.formUp);
                    Swal.fire(
                      '!Reportada',
                      'La actividad ha sido reportada correctamente',
                      'success'
                    );
                    window.location.reload(true);
                  }
                })
              }
            },

            //carga informacion de la actividad seleccionada al formulario del modal
            mostrarDatos(actividad){
              this.form.id = actividad.id,
              this.form.nombre_actividad = actividad.nombre_actividad,
              this.form.fecha_actividad = actividad.fecha_actividad,
              this.form.total_horas = actividad.total_horas,
              this.form.verificado = actividad.verificado
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
                    verificado:'0',
                    }),
                formUp: this.$inertia.form({
                    id:'',
                    nombre_actividad:'',
                    fecha_actividad:'',
                    total_horas:'',
                    verificado:'0',
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
</script>