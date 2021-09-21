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
              <h1 class="m-0">Bitacora </h1>
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
                    Lista de Actividades
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <ul class="todo-list" data-widget="todo-list">
                    <li>
                      <!--Tabla donde apareceran todas las actividades-->
                      <table class="table table-hover text-center" width="500" style="font-size: 20px" id ="act">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Nombre de la Actividadd</th>
                            <th scope="col">Horas de la Actividad</th>
                            <th scope="col">Estado de la Actividad</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="table-secondary" scope="row" v-for="(actividad, index) in actividadesFiltradas" :key="index">
                            <!--Aqui devuelven los datos que se mostraran en pantalla -->
                            <td>{{ actividad.id }}</td>
                            <td>{{ actividad.nombre_actividad }}</td>
                            <td>{{ actividad.total_horas }}</td>
                            <td>
                              <button v-if="actividad.verificado == 'Aceptada'" class="btn btn-info" style="cursor: default;">
                                <i>Aceptada</i>
                              </button>
                              <button v-if="actividad.verificado == 'Reportada'" class="btn btn-warning" style="cursor: default;">
                                <i>Reportada</i>
                              </button>
                            </td>
                            <td>
                              <!-- Botones para ver información-->
                              <div class="tools">
                                <jet-button type="button" class="fas fa-info-circle text-green" data-toggle="modal" data-target="#verInfo" v-on:click="mostrarinfo(actividad)" title="Ver mas informacion de la actividad"></jet-button>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <h5>
                        <strong>Total de horas que ha realizado: 
                          <!--Llamamos la variblae total, que tiene el total de horas de las actividades realizadas-->
                          {{ this.total }} 
                        </strong>
                      </h5>
                    </li>
                  </ul>
                </div>  <!--AQUI TERMINAR CARD-BODY -->
              </div><!-- /.card -->
            </section>
          </div><!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section><!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
          <div>
            <div class="row">
              <div class="col">
                <h5 class=""><strong>Nombre de la actividad: </strong>{{ form.nombre_actividad }}</h5>
              </div>
              <!--<div class="col-4">
                <h5 class=""><strong>Teléfono: </strong>{{ form.telefono_encargado_escuela }}</h5>
              </div>-->
            </div>

            <div class="row">
              <div class="col">
                <h5 class=""><strong>Fecha de la actividad: </strong>{{ form.fecha_actividad }}</h5>
              </div>
              <div class="col">
                <h5 class=""></h5>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <h5 class=""><strong>Total de horas que realizo la actividad: </strong>{{ form.total_horas }}</h5>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <h5><strong>La actividad fue: 
                  <button v-if="form.verificado == 'Aceptada'" class="btn btn-info" style="cursor: default;">
                    <i>Aceptada</i>
                  </button>
                  <button v-if="form.verificado == 'Reportada'" class="btn btn-warning" style="cursor: default;">
                    <i>Reportada</i>
                  </button>
                </strong></h5>
              </div>
            </div>
          </div>  
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



<!--<script src="/path/to/dist/jquery.inputmask.min.js"></script>-->


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
           
        submit(){
          console.log(this.form);
          this.mostrarMensajeSuccess();
          this.form.post(this.route('actividades.store'));
          this.form.id='';
          this.form.nombre_actividad='';
          this.form.fecha_actividad=''
          this.form.total_horas='';
        },
            
        mostrarMensajeUpdate(actividad){
          console.log(actividad);
          this.formUp.id = actividad.id;
          this.formUp.nombre_actividad = actividad.nombre_actividad;
          this.formUp.fecha_actividad = actividad.fecha_actividad;
          this.formUp.total_horas = actividad.total_horas;
          console.log(this.formUp);
        },

        //carga informacion de la actividad seleccionada al formulario del modal
        mostrarinfo(actividad){
          this.form.id = actividad.id,
          this.form.nombre_actividad = actividad.nombre_actividad,
          this.form.fecha_actividad = actividad.fecha_actividad,
          this.form.total_horas = actividad.total_horas,
          this.form.verificado = actividad.verificado
        },
      },

      data(){
        return{
          total:0,
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
          }),
          formUp: this.$inertia.form({
            id:'',
            nombre_actividad:'',
            fecha_actividad:'',
            total_horas:'',
            verificado:'',
          }),
        }
      }, 

      mounted(){
        this.actividades.forEach(element => {
          this.actividadesFiltradas.push(element);
        })

        //For para recorrer los elementos de las actividades
        this.actividades.forEach(element => {
          //if que me selecciona solo las actividades que tienen como verificado la aceptación
          if(element.verificado == 'Aceptada'){
            //suma para contabilizar las el total de horas de las actividades aceptadas
            this.total += element.total_horas;
          }
        })       
      },
    }
</script>