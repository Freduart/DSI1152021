<template>
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

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
            <h1 class="ml-3">Gestión de encargados de escuela</h1>
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
                  <h3 class="card-title mt-3 mb-3 ml-2">
                  <i class="ion ion-clipboard mr-1"></i>
                  Listado de encargados de escuela por cada facultad
                  </h3>
                  <inertia-link type="button" class="btn btn-success float-right mt-2"  :href="route('encargadosescuela.create')">
                      <i class="fas fa-plus"></i> Añadir encargado de escuela</inertia-link>
                  <br><br>
                  <!-- select para indicar el estado que se desea -->
                  <h6 class="ml-4 mt-2">Mostrar por estado:
                  <select class="col-2 ml-3 custom-select" v-on:change="filtrarByEstado($event)">
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                  </select></h6>
                  
              </div>
              <!-- /.card-header -->
              <!-- creacion de una card por cada facultad donde tengan asignados encargados -->
              <div class="card-body" v-for="(facultad, index) in facultadesFiltradas" :key="index">
                  <ul class="todo-list" data-widget="todo-list">
                      <li>
                      <!-- todo text -->
                        <h5 class="mt-2 ml-3" style="margin-bottom: 0.2rem;">{{ facultad.nombre_facultad }}</h5>
                        <p class="ml-4 mb-4 text-gray" v-if="facultad.nombre_encargado_facultad != null">Encargado: {{ facultad.nombre_encargado_facultad }} {{ facultad.apellido_encargado_facultad }}</p>
                        <p class="ml-4 mb-4 text-gray" v-else>Encargado: No asignado</p>
                          <!-- tabla de los encargados de acuerdo al estado -->
                          <table class="table table-hover text-center ">
                              <thead class="thead-dark">
                                  <tr>
                                  
                                  <th scope='col'>Código</th>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Carrera</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col" width="15%"></th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <!-- cargando datos en la tabla -->
                                  <tr class="table-secondary" scope="row" v-for="(encargado, index) in encargadosEFiltrados" :key="index">
                                      
                                      <td v-if="encargado.nombre_facultad == facultad.nombre_facultad">
                                        {{ encargado.codigo_encargado_escuela }}
                                      </td>
                                      <td v-if="encargado.nombre_facultad == facultad.nombre_facultad">
                                        {{ encargado.nombre_encargado_escuela }} {{encargado.apellido_encargado_escuela }}
                                      </td>
                                      <td v-if="encargado.nombre_facultad == facultad.nombre_facultad">
                                        {{ encargado.nombre_carrera }}
                                      </td>
                                      <td v-if="encargado.nombre_facultad == facultad.nombre_facultad">
                                        {{ encargado.estado_encargado_escuela }}
                                      </td>
                                      <td v-if="encargado.nombre_facultad == facultad.nombre_facultad">
                                      <!-- General tools such as edit or delete-->
                                          <div class="tools">
                                              <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(encargado)" title="Ver informacion del encargado"></jet-button>
                                              <inertia-link class="fas fa-edit" title="Editar encargado" :href="route('encargadosescuela.edit', encargado.idEncargado)"></inertia-link>
                                              <jet-button  v-if="encargado.estado_encargado_escuela == 'Activo'" class="fas fa-arrow-alt-circle-down" title="Dar de baja a encargado" method="delete" v-on:click="cambiarestado(encargado)"></jet-button>     
                                              <jet-button v-else class="fas fa-arrow-alt-circle-up" title="Activar a encargado" method="delete" v-on:click="cambiarestado(encargado)"></jet-button>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </li>
                  </ul>
              </div>
              <!-- /.card-body -->
              <!--<div class="card-footer clearfix">
                  
              </div>-->
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

      <!-- Modal de la informacion del encargado -->
      

    <div class="modal fade" id="verInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <!-- <h5 class="modal-title" id="exampleModalLabel">{{ verDetalleForm.nombre_estudiante }} {{ verDetalleForm.apellido_estudiante }}</h5> -->
              <h3 class="modal-title text-primary">{{ form.nombre_encargado_escuela }} {{ form.apellido_encargado_escuela }}</h3>
              <span class="d-flex flex-row-reverse bd-highlight col">
                  
                  <button class="btn btn-dark text-light text-lg" style="cursor: default;">
                      {{ form.codigo_encargado_escuela }}                   
                  </button>    
                  <h5 class="mt-2 mr-2"><strong>Codigo:</strong></h5> 
                  <!-- <h3 class="modal-title text-primary border rounded-lg mx-4">{{ verDetalleForm.carnet_estudiante }} </h3> -->
              </span>
              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button> -->
          </div>
          <div class="modal-body">
              
            <div>
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Correo: </strong>{{ form.correo_encargado_escuela }}</h5>
                </div>
                <div class="col-4">
                  <h5 class=""><strong>Teléfono: </strong>{{ form.telefono_encargado_escuela }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <h5 class=""><strong>DUI: </strong>{{ form.dui_encargado_escuela }}</h5>
                </div>
                <div class="col">
                  <h5 class=""></h5>
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <h5 class=""><strong>Facultad: </strong>{{ form.nombre_facultad }}</h5>
                </div>
              </div>

              <div class="row">
                <div class="col">
                <h5><strong>Carrera: </strong>{{ form.nombre_carrera }}</h5>
                </div>
              </div>

              <div class="row">
                <div>
                  <span class="d-flex flex-row-reverse bd-highlight col">
                    <h5 class=""><strong>Estado:  </strong>
                      <button v-if="form.estado_encargado_escuela == 'Activo'" class="btn btn-primary" disabled>{{ form.estado_encargado_escuela }}</button>
                      <button v-else-if="form.estado_encargado_escuela == 'Inactivo'" class="btn btn-danger" disabled>{{ form.estado_encargado_escuela }}</button>
                      </h5>
                  </span>
                </div>
              </div>

            </div>  
            <hr class="mb-1"/>
          </div>
          <div class="mb-4">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> -->
              <div class="d-flex justify-content-center">
                  <button class="btn btn-warning" data-dismiss="modal">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                    Ocultar detalle
                  </button>
              </div>
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
    <!-- /.control-sidebar -->  
  </div>
</template>

<script>

    import Base from "@/Pages/Base.vue";
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'


    export default {
        components:{
          JetAuthenticationCard,
          JetAuthenticationCardLogo,
          JetInput,
          JetCheckbox,
          JetLabel,
          JetValidationErrors,
          Base
        },
        props: ['encargadosE', 'facultades', 'carreras'],
        methods:{
          // Función para fitrar las facultades 
          filtrarByEstado(event){
              //limpia estructura de las facultades de los encargados por estado
              this.facultadesFiltradas.splice(0, this.facultadesFiltradas.length);
              var estadoText= "Activo";
              if (event.target.value == 0){
                  estadoText = "Inactivo";
              }
              //llenado de la estructura de las facultades de los encargados por estado seleccionado
              this.facultades.forEach(element => {
                  if(element.estado_encargado_escuela == estadoText){
                      console.log(element);
                      this.facultadesFiltradas.push(element);
                  }
              });
              console.log(this.facultadesFiltradas);

              //limpiar estructura de encargados filtradas por estado
              this.encargadosEFiltrados.splice(0, this.encargadosEFiltrados.length);
                console.log(event.target.value);
                var estadoText= "Activo";
                if (event.target.value == 0){
                    estadoText = "Inactivo";
                }
                //llenado de la estructura de las facultades de los encargados por estado seleccionado
                this.encargadosE.forEach(element => {
                    if(element.estado_encargado_escuela == estadoText){
                        console.log(element);
                        this.encargadosEFiltrados.push(element);
                    }
                });
                console.log(this.encargadosEFiltrados);
          }, 
          // Cambiar estado del encargado confirmnaod con sweetalert
          cambiarestado(encargado){
              this.borrado = true;
              if(encargado.estado_encargado_escuela == 'Activo'){
                  Swal.fire({
                    title: '¿Esta seguro que desea desactivar al encargado?',
                    text: "El encargado " + encargado.nombre_encargado_escuela + " " + encargado.apellido_encargado_escuela + " con codigo " + encargado.codigo_encargado_escuela +" no podrá iniciar sesión mientras este desactivado.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, desactivar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // modificando el estado
                        this.$inertia.delete(route('encargadosescuela.destroy', encargado.idEncargado));
                        Swal.fire(
                        '!Desactivado!',
                        'El encargado se desactivó correctamente',
                        'success'
                        );
                        window.location.reload(true);
                    }
                })
              } else {
                Swal.fire({
                    title: '¿Esta seguro que desea activar al encargado?',
                    text: "El encargado " + encargado.nombre_encargado_escuela + " " + encargado.apellido_encargado_escuela + " con codigo " + encargado.codigo_encargado_escuela +" se habilitará y podrá iniciar sesión.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, activar',
                    cancelButtonText: 'No, cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // modificando el estado
                        this.$inertia.delete(route('encargadosescuela.destroy', encargado.idEncargado));
                        Swal.fire(
                        '!Activado!',
                        'El encargado se activó correctamente',
                        'success'
                        );
                        window.location.reload(true);
                    }
                })
              }
                
            },
            //carga informacion del encargado seleccionado al formulario del modal
            mostrarinfo(encargado){
              this.form.codigo_encargado_escuela = encargado.codigo_encargado_escuela,
              this.form.nombre_encargado_escuela = encargado.nombre_encargado_escuela,
              this.form.apellido_encargado_escuela = encargado.apellido_encargado_escuela,
              this.form.correo_encargado_escuela = encargado.correo_encargado_escuela,
              this.form.nombre_carrera = encargado.nombre_carrera,
              this.form.nombre_facultad = encargado.nombre_facultad,
              this.form.estado_encargado_escuela = encargado.estado_encargado_escuela,
              this.form.user_id= null,
              this.form.dui_encargado_escuela = encargado.dui_encargado_escuela,
              this.form.telefono_encargado_escuela = encargado.telefono_encargado_escuela
                
            }
        }, 
        //Data utilizada
        data(){
          return{
            encargadosEFiltrados:[],
            facultadesFiltradas:[],
            form: {
              codigo_encargado_escuela: '',
              nombre_encargado_escuela: '',
              apellido_encargado_escuela: '',
              correo_encargado_escuela: '',
              nombre_carrera: '',
              nombre_facultad: '',
              estado_encargado_escuela: 'Activo',
              user_id: null,
              dui_encargado_escuela: '',
              telefono_encargado_escuela: '',
            }
          }
        }, 
        mounted(){
          // Llena las facultades y encargados al cargar pagina
          this.facultades.forEach(element => {
              if (element.estado_encargado_escuela == 'Activo'){
                  this.facultadesFiltradas.push(element);
              }
          }),
          this.encargadosE.forEach(element => {
              if(element.estado_encargado_escuela == 'Activo'){
                  this.encargadosEFiltrados.push(element);
              }
          });
        }, 
    }
</script>