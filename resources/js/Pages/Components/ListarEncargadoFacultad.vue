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
                    <button type="button" class="btn btn-success float-right"><i class="fas fa-plus"></i> Añadir encargado de facultad</button>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                    <li >
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
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Facultad</th>
                                        <th scope="col" width="10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr scope="row" v-for="(encargado, index) in encargadosFFiltrados" :key="index">
                                            
                                            <td>{{ encargado.codigo_encargado_facultad }}</td>
                                            <td>{{ encargado.nombre_encargado_facultad }}</td>
                                            <td>{{ encargado.apellido_encargado_facultad }}</td>
                                            <td>{{ encargado.correo_encargado_facultad }}</td>
                                            <td>{{ encargado.telefono_encargado_facultad }}</td>
                                            <td>{{ encargado.estado_encargado_facultad }}</td>
                                            <td>{{ encargado.nombre_facultad }}</td>
                                            <td>
                                            <!-- General tools such as edit or delete-->
                                                <div class="tools">
                                                <i class="fas fa-edit"></i>
                                                <i class="fas fa-trash"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                    </li>
                    </ul>
                </div>
                <!-- /.card-body -->
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

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->  
            </div>
</template>

<script>

    import Base from "@/Pages/Base.vue";

    export default {
        components:{
            Base
        },
        props: ['encargadosF'],
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
            }
        }, 
        data(){
            return{
                encargadosFFiltrados:[],
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