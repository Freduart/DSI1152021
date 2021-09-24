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
                        <h1 class="m-0">Constancia de cumplimiento de servicio social </h1>
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
                                    Lista de Servicios Sociales Completados
                                </h3>
                            </div>
                            <div  v-if="serviciosFiltrados.length != 0">
                                <div class="card-body">
                                    <div class="col-sm-6">
                                        <table>
                                            <tr>
                                                <td><h5 class="m-0"> Nombre Estudiante &nbsp; &nbsp; &nbsp; &nbsp; </h5></td>
                                                <td><strong>{{ $props.est }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><h5 class="m-0">  Carrera: &nbsp; </h5></td>
                                                <td><strong>{{ $props.car }}</strong></td>
                                            </tr>
                                                <td><h5 class="m-0">  Facultad: &nbsp; </h5></td>
                                                <td><strong>{{ $props.fac }}</strong></td>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <ul class="todo-list" data-widget="todo-list">
                                        <li>
                                            <!--Tabla donde apareceran todas los proyectos-->
                                            <table class="table table-hover text-center" width="500" style="font-size: 20px" id ="act">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Servicio Social</th>
                                                        <th scope="col">Lugar de ejecución</th>
                                                        <th scope="col">Fecha Inicio</th>
                                                        <th scope="col">Fecha Fin</th>
                                                        <th scope="col">Número de horas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="table-secondary" scope="row" v-for="(servicio, index) in serviciosFiltrados" :key="index">
                                                        <!--Aqui devuelven los datos que se mostraran en pantalla -->
                                                        <td>{{ servicio.tipo }}</td>
                                                        <td>{{ servicio.ubicacion }}</td>
                                                        <td>{{ servicio.inicio }}</td>
                                                        <td>{{ servicio.fin }}</td>
                                                        <td>{{ servicio.horas }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </li>
                                    </ul>
                                </div>  <!--AQUI TERMINAR CARD-BODY -->
                                <div class ="card-body">
                                    <div class = "d-flex justify-content-center">
                                        <h5>
                                            <strong>Total: 
                                            <!--Llamamos la variblae total, que tiene el total de horas de los proyectos realizados-->
                                            {{ this.total }} 
                                            </strong>
                                        </h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class = "d-flex justify-content-center">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col">
                                                    <div class = "d-flex justify-content-center">
                                                        <h5 class="m-0"> Encargado de Escuela </h5>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class = "d-flex justify-content-center">
                                                        <h5 class="m-0"> Encargado de Facultad </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class = "d-flex justify-content-center">
                                                        {{ $props.encargadoE }}
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class = "d-flex justify-content-center">
                                                        {{ $props.encargadoF }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else class="alert alert-warning ml-4 mr-4 mt-3" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                                No se han encontrado datos
                            </div>
                        </div><!-- /.card -->
                    </section>
                </div><!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>

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
      props:['encargadoE', 'encargadoF','servicios', 'est', 'car', 'fac'],
      methods:{
        logout() {
          this.$inertia.post(route('logout'));
        },
      },

      data(){
        return{
            servicio:0,
            peticion:0,
            tiposervicio:0,
            total:0,
            actividad:0,
            encargadoE:'',
            encargadoF:'',
            estudiante:'',
            facultad:'',
            carrera:'',
            serviciosFiltrados:[],
            successGuardado:false,
          form:{
            idServicio:'',
            idPeticion:'',
            tipo:'',
            ubicacion:'',
            inicio:'',
            fin:'',
            horas:'',
            encargadoE:'',
            encargadoF:'',
            estudiante:'',
            facultad:'',
            carrera:'',
          }
          /*formUp: this.$inertia.form({
            id:'',
            nombre_actividad:'',
            fecha_actividad:'',
            total_horas:'',
            verificado:'',
          }),*/
        }
      }, 

      mounted(){
        this.servicios.forEach(element => {
          this.serviciosFiltrados.push(element);
        })

        //For para recorrer los elementos de las actividades
        this.servicios.forEach(element => {
          //if que me selecciona solo las actividades que tienen como verificado la aceptación
          //if(element.verificado == 'Aceptada'){
            //suma para contabilizar las el total de horas de los proyectos sociales
            this.total += element.horas;
          //}
        })      
      },
    }
</script>