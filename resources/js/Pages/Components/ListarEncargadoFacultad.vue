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
            <h1 class="m-0">Gestión de encargados de facultad</h1>
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
                    Encargados por facultad
                    </h3>
                    <inertia-link type="button" class="btn btn-success float-right"  :href="route('encargadosfacultad.create')">
                        <i class="fas fa-plus"></i> Añadir encargado de facultad</inertia-link>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                        <!-- todo text -->
                            <span>Mostrar por estado:</span>
                            <select class="ml-4" v-on:change="filtrarByEstado($event)">
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <hr>
                            <table class="table table-striped table-dark text-center">
                                <thead>
                                    <tr>
                                    
                                    <th scope='col'>Código</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Facultad</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col" width="15%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr scope="row" v-for="(encargado, index) in encargadosFFiltrados" :key="index">
                                        
                                        <td>{{ encargado.codigo_encargado_facultad }}</td>
                                        <td>{{ encargado.nombre_encargado_facultad }} {{encargado.apellido_encargado_facultad }}</td>
                                        <td>{{ encargado.nombre_facultad }}</td>
                                        <td>{{ encargado.estado_encargado_facultad }}</td>
                                        <td>
                                        <!-- General tools such as edit or delete-->
                                            <div class="tools">
                                                <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(encargado)" title="Ver informacion del encargado"></jet-button>
                                                <inertia-link class="fas fa-edit" title="Editar encargado" :href="route('encargadosfacultad.edit', encargado.idEncargado)"></inertia-link>
                                                <jet-button  v-if="encargado.estado_encargado_facultad == 'Activo'" class="fas fa-arrow-alt-circle-down" title="Dar de baja a encargado" method="delete" v-on:click="cambiarestado(encargado)"></jet-button>     
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

        <!-- Modal Insert-->
        <div class="modal fade" id="verInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Información del encargado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form @submit.prevent="submit">
                          <div class="card-body">
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="nombre" value="Nombres" />
                                  <jet-input id="nombre" type="text" readonly="readonly" v-model="form.nombre_encargado_facultad" required autofocus autocomplete="nombre" />
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="apellido" value="Apellidos" />
                                  <jet-input id="apellido" type="text" readonly="readonly" v-model="form.apellido_encargado_facultad" required autofocus autocomplete="apellido" />
                                </div>
                              </div>
                            </div> 
                                
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="correo" value="Correo" />
                                  <jet-input id="correo" type="email" readonly="readonly" v-model="form.correo_encargado_facultad" required />
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="telefono" value="Telefono" />
                                  <jet-input id="telefono" type="text" readonly="readonly" v-model="form.telefono_encargado_facultad" required autofocus autocomplete="telefono" />
                                </div>
                              </div>
                            </div> 

                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="dui" value="Dui" />
                                  <jet-input id="dui" type="text" readonly="readonly" v-model="form.dui_encargado_facultad" required autofocus autocomplete="dui" />
                                </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                  <jet-label for="Codigo" value="Codigo empleado" />
                                  <jet-input id="Codigo" type="text" readonly="readonly" v-model="form.codigo_encargado_facultad" required autofocus autocomplete="Codigo" />
                                </div>
                              </div>
                            </div> 

                            <div class="form-group">
                                <jet-label for="facultad" value="Facultad" />
                                <jet-input id="facultad" type="text" v-model="form.nombre_facultad" required autofocus autocomplete="Facultad" />
                              </div>
                            <hr>
                          </div>

                          <div class="card-footer clearfix"> 
                            <div class="my-2">
                              <div class="d-flex justify-content-center align-items-baseline">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                              </div>
                            </div>
                          </div>
                        </form>
                        
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
        props: ['encargadosF', 'facultades'],
        methods:{
            filtrarByEstado(event){
                this.encargadosFFiltrados.splice(0, this.encargadosFFiltrados.length);
                console.log(event.target.value);
                var estadoText= "Activo";
                if (event.target.value == 0){
                    estadoText = "Inactivo";
                }
                this.encargadosF.forEach(element => {
                    if(element.estado_encargado_facultad == estadoText){
                        console.log(element);
                        this.encargadosFFiltrados.push(element);
                    }
                });
                console.log(this.encargadosFFiltrados);
            }, 
            cambiarestado(encargado){
                this.borrado = true;
                if(encargado.estado_encargado_facultad == 'Activo'){
                    Swal.fire({
                      title: '¿Esta seguro que desea desactivar al encargado?',
                      text: "El encargado " + encargado.nombre_encargado_facultad + " " + encargado.apellido_encargado_facultad + " con codigo " + encargado.codigo_encargado_facultad +" no podrá iniciar sesión mientras este desactivado.",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, desactivar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          //var tipo = 1;
                          this.$inertia.delete(route('encargadosfacultad.destroy', encargado.idEncargado/*, tipo*/));
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
                      text: "El encargado " + encargado.nombre_encargado_facultad + " " + encargado.apellido_encargado_facultad + " con codigo " + encargado.codigo_encargado_facultad +" se habilitará y podrá iniciar sesión.",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, activar',
                      cancelButtonText: 'No, cancelar'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          //var tipo = 1;
                          this.$inertia.delete(route('encargadosfacultad.destroy', encargado.idEncargado/*, tipo*/));
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
            mostrarinfo(encargado){
                //this.$inertia.get(route('encargadosfacultad.destroy', encargado.idEncargado/*, tipo*/));
              this.form.codigo_encargado_facultad = encargado.codigo_encargado_facultad,
              this.form.nombre_encargado_facultad = encargado.nombre_encargado_facultad,
              this.form.apellido_encargado_facultad = encargado.apellido_encargado_facultad,
              this.form.correo_encargado_facultad = encargado.correo_encargado_facultad,
              this.form.nombre_facultad = encargado.nombre_facultad,
              this.form.estado_encargado_facultad = encargado.estado_encargado_facultad,
              this.form.user_id= null,
              this.form.dui_encargado_facultad = encargado.dui_encargado_facultad,
              this.form.telefono_encargado_facultad = encargado.telefono_encargado_facultad
                
            }
        }, 
        data(){
          return{
            encargadosFFiltrados:[],
            /*informacionencargado: {
                codigo_encargado_facultad: this.$props.encargadoinfo.codigo_encargado_facultad,
                nombre_encargado_facultad: this.$props.encargadoinfo.nombre_encargado_facultad,
                apellido_encargado_facultad: this.$props.encargadoinfo.apellido_encargado_facultad,
                correo_encargado_facultad: this.$props.encargadoinfo.correo_encargado_facultad,
                facultad_id: this.$props.encargadoinfo.facultad_id,
                estado_encargado_facultad: this.$props.encargadoinfo.estado_encargado_facultad,
                user_id: null,
                dui_encargado_facultad: this.$props.encargadoinfo.dui_encargado_facultad,
                telefono_encargado_facultad: this.$props.encargadoinfo.telefono_encargado_facultad
            }*/
            form: this.$inertia.form({
              codigo_encargado_facultad: '',
              nombre_encargado_facultad: '',
              apellido_encargado_facultad: '',
              correo_encargado_facultad: '',
              facultad_id: '',
              estado_encargado_facultad: '',
              user_id: null,
              dui_encargado_facultad: '',
              telefono_encargado_facultad: ''
            })
          }
        }, 
        mounted(){
            this.encargadosF.forEach(element => {
                if (element.estado_encargado_facultad == 'Activo'){
                    this.encargadosFFiltrados.push(element);
                }
            }),
            // this.mostrarMensajeSuccess();
            this.successGuardado = false;        
        }, 
    }
</script>