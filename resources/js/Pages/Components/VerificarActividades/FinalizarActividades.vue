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
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                    <li>
                      <!--Tabla donde apareceran todos las actividades aceptadas-->
                      <table class="table table-hover text-center" width="500" style="font-size: 20px">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre de la Actividad</th>
                            <th scope="col">Estado de la actividad</th>
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
                                <i>Aceptada</i>
                              </button>
                              <button v-if="actividad.verificado == 'Finalizada'" class="btn btn-primary" style="cursor: default;">
                                <i>Finalizada</i>
                              </button>
                            </td>
                            <!--<td>-->
                              <!-- checkbox en cada fila de las actividades aceptadas-->
                              <!--<div  class="icheck-primary d-inline ml-2">
                                <input type="checkbox" class="checkBoxClass" value="" name="todo1" id="todoCheck1" style="width:20px;height:20px;">
                                  <label for="todoCheck1-sm"></label>
                              </div>-->
                            <!--</td>-->
                            <td>
                              <div class="tools">
                                <!--Botón para ver el detalle de la actividad-->
                                <jet-button class="fas fa-arrow-alt-circle-down text-blue" title="Finalizar actividad" method="delete" v-on:click="finalizar(actividad)"></jet-button>
                                <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarDatos(actividad)" title="Ver más información de la actividad"></jet-button>
                                
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <!--<div class="card-body">-->
                        <!--Botón para finalizar las actividades seleccionadas con checkbox-->
                        <!--<button class="btn btn-warning float-cneter" title="Verificar actividad">
                          <i class="fas"></i>Finalizar actividades
                        </button>
                      </div>-->
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

  <!-- Modal para la verificación de las actividades aceptadas de los estudiantes-->
  <div class="modal fade" id="verInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <!--Contenido de la modal-->
      <div class="modal-content">
        <!--Encabezado de la modal-->
        <div class="modal-header">
          <!--Título de la modal-->
          <h5 class="modal-title" id="exampleModalLabel">Información de la actividad</h5>
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
              <!--<div class="col">
                <div class="form-group">
                  <jet-label for="bitacora_id" value="Código de bitácora" />
                  <jet-input id="bitacora_id" type="text" readonly="readonly" v-model="form.bitacora_id" required autofocus autocomplete="bitacora_id"/>
                </div>
              </div>-->
              <!--Fin de la segunda columna-->
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
                <!--Columna-->
                <div class="col">
                  <!--boton atras-->
                  <button :href="route('verificaractividades.index')" class="btn btn-dark float-center" title="Atras" data-dismiss="modal">
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



            /*verificar(actividad){
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
            },*/

           /* seleccionar_todo(){
             for (i=0;i<todoCheck1.elements.length;i++)
                  if(todoCheck1.elements[i].type == ".checkbox")
                 todoCheck1.elements[i].checked=1
            },*/

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
    
    //función para seleccionar todos los checkbox a la vez
    //$(function(e){
      //$("#chkCheckAll").click(function(){
        //$(".checkBoxClass").prop('checked',$(this).prop('checked'));
      //})
    //});

</script>