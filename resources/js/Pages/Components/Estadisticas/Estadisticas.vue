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
            <h1 class="m-0">Estadísticas del sistema</h1>
 
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
                <div class="card" id="cardBase">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    </h3>

                    <div class="card-tools">

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                        <li>
                            <!-- todo text -->

                    <!-- Para poner los gráficos -->
                    <div class="row">

                        <div class="col">
                            <div id="chart">
                                <apexchart id="donut" type="donut" width="600" height="350" :options="this.graficoDonut.options" :series="this.graficoDonut.series"></apexchart>                                                       
                                <!-- <apexchart type="bar" width="800" height="350" :options="this.graficoBarras.options" :series="this.graficoBarras.series"></apexchart>                                -->
                            </div>
                        </div>
                        <div class="col float-right">
                                <apexchart id="barras" type="bar" width="600" height="350" :options="this.graficoBarras.options" :series="this.graficoBarras.series"></apexchart>                                                       
                        </div>

                    </div>
                    <div class="row mt-5 ">
                        
                        <div class="col" v-if="this.usuario.rol == 'Encargado Escuela'">
                            <h5 style="font-weight: 1; font-family: 'Arial'; font-size: 20px; font-color: 'black'">Cantidad de servicios sociales clasificados por tipo:</h5>
                            <table class="table table-hover text-center">
                                <thead class="thead-dark">
                                    <th scope="col">TipoServicioSocial</th>
                                    <th scope="col">Cantidad</th>
                                </thead>
                                <tbody>
                                    <tr class="table-secondary" scope="row" v-for="(ss, index) in this.serviciosSocialesByTipo" :key="index">
                                        <td>{{ ss.nombre_tipo_servicio }}</td>
                                        <td>{{ ss.cantTipo }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  

                        <div class="col  float-right">
                            <div>
                                <!-- <apexchart type="donut" width="800" height="350" :options="this.graficoDonut.options" :series="this.graficoDonut.series"></apexchart>                                                        -->
                                <div class="chart">
                                        <apexchart type="pie" width="800" height="350" :options="this.graficoPastel.options" :series="this.graficoPastel.series"></apexchart>                                                       
                                </div>
                            </div>
                        </div>

                    </div>

                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                    <!-- <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#añadirCarrera">
                    <i class="fas fa-plus"></i> Añadir Carrera</button>  -->



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
    
    </div>


</template>

<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetButton from '@/Jetstream/Button'
    import VueApexCharts from "vue3-apexcharts";


    import Base from "@/Pages/Base.vue";

    export default {
        components:{
            JetNavLink,
            JetDropdownLink,
            JetInput,
            JetLabel,
            JetButton,
            Base,
            apexchart: VueApexCharts,
        },
        props: ['estudiantesBySexo', 'carrera', 'estudiantesByEstado', 'serviciosSocialesByEstado', 'usuario', 'serviciosSocialesByTipo'],
        data:function(){
          return{

                mostrar: false,

                cantEstudiantesM:0,
                cantEstudiantesF:0,

                cantEstudiantesActivos:0,
                cantEstudiantesInactivos:0,
                cantEstudiantesRealizandoServicio:0,
                cantEstudiantesEnEspera:0,
                cantEstudiantesServicioFinalizado:0,

                cantServiciosSocialNoIniciado:0,
                cantServiciosSocialEnCurso:0,
                cantServiciosSocialFinalizado:0,

                graficoDonutData: [],
                graficoBarraData: [],
                graficoBarraHorizontalData: [],
                //Para el gráfico de barras
                graficoBarras:{  
                    options: {
                        plotOptions:{
                            bar:{
                                horizontal: false,
                                borderRadius: 4,
                                distributed: true,
                            }
                        },
                        colors:['#E74C3C', '#2ECC71', '#AAB7B8', '#3498DB', '#F1C40F'],
                        dataLabels:{
                            enabled: false,
                        },
                        chart: {
                            type: 'bar',
                        },
                        xaxis: {
                            categories: ['Inactivo', 'Activo', 'En Espera', 'Realizando Servicio', 'Servicio Finalizado'],
                            labels:{
                                show: false,
                                style:{
                                    fontSize: '12px',
                                }
                            }
                        },
                        yaxis:{
                            labels:{
                                style:{
                                    fontSize: '14px'
                                }
                            }
                        },
                        fill: {
                            colors: ['#E74C3C', '#2ECC71', '#AAB7B8', '#3498DB', '#F1C40F']
                        },
                        bar:{
                            horizontal: true,
                        },
                        legend:{
                            show: true,
                            position: 'bottom',
                            fontSize: '16px'
                        },
                        title:{
                            text:'Cantidad de estudiantes según estado:',
                            style:{
                                fontWeight: 1,
                                fontFamily: 'Arial',
                                fontSize: '20px',
                            }                            
                        }
                        
                    },
                    series: [{
                        name: 'Cantidad de Estudiantes',
                        data: [],
                    }]
                },
                //Fin grafico de barras

                //Para el gráfico de donut
                graficoDonut:{
                    series:[],
                    chart:{
                        type:'donut',
                    },
                    options:{
                        plotOptions:{
                            pie:{
                                donut:{
                                    labels:{
                                        show: true,
                                        name:{
                                            show: true,
                                        },
                                        total:{
                                            show: true,
                                            color: 'black',
                                            showAlways: false,
                                            fontSize: '16px',
                                        }
                                    }
                                }
                            }
                        },
                        fill:{
                            colors:['#5DADE2','#EC7063'],
                        },
                        labels: ['Masculino', 'Femenino'],
                        legend:{
                            markers:{
                                fillColors:['#5DADE2','#EC7063']
                            }
                        },
                        tooltip:{
                            enabled: true,
                            followCursor: false,
                            fillSeriesColor: false,
                            marker:{
                                show:false,
                            }
                        },
                        title:{
                            text:'Cantidad de estudiantes clasificados según sexo:',
                            style:{
                                fontWeight: 1,
                                fontFamily: 'Arial',
                                fontSize: '20px',
                            }
                        }   
                    },

                },
                //Fin de gráfico de donut

                //Para el gráfico de pastel
                graficoPastel:{
                    series:[],
                    chart:{
                        type:'pie',
                    },
                    options:{
                        plotOptions:{
                            pie:{
                                donut:{
                                    labels:{
                                        show: false,
                                        name:{
                                            show: true,
                                        },
                                        total:{
                                            show: false,
                                            color: 'black',
                                            showAlways: false,
                                            fontSize: '16px',
                                        }
                                    }
                                }
                            }
                        },
                        fill:{
                            colors:['#34495E','#2ECC71','#2980B9'],
                        },
                        labels: ['No Iniciado', 'En Curso', 'Finalizado'],
                        legend:{
                            markers:{
                                fillColors:['#34495E','#2ECC71','#2980B9']
                            }
                        },
                        tooltip:{
                            enabled: true,
                            followCursor: false,
                            fillSeriesColor: false,
                            marker:{
                                show:false,
                            }
                        },
                        title:{
                            text:'Cantidad de servicios sociales clasificados por estado:',
                            style:{
                                fontWeight: 1,
                                fontFamily: 'Arial',
                                fontSize: '20px',
                            }
                        }   
                    },

                },
                //Fin de gráfico de pastel
            }

        },
        methods: {

            graficoDonutfillData(){

                this.estudiantesBySexo.forEach(element=> {
                    if(element.sexo_estudiante == 'Masculino'){
                        this.cantEstudiantesM++;
                    }else{
                        this.cantEstudiantesF++;
                    }
                });
                this.graficoDonut.series.push(this.cantEstudiantesM);
                this.graficoDonut.series.push(this.cantEstudiantesF);
                console.log(this.graficoDonut);

            },

            graficoBarrafillData(){
                this.estudiantesByEstado.forEach(element => {
                    if(element.estado_estudiante == 'Activo'){ this.cantEstudiantesActivos++ }
                    if(element.estado_estudiante == 'Inactivo'){ this.cantEstudiantesInactivos++ }
                    if(element.estado_estudiante == 'Realizando servicio'){ this.cantEstudiantesRealizandoServicio++ }
                    if(element.estado_estudiante == 'En espera'){ this.cantEstudiantesEnEspera++ }
                    if(element.estado_estudiante == 'Servicio finalizado'){ this.cantEstudiantesServicioFinalizado++ }
                });

                this.graficoBarras.series[0].data.push(this.cantEstudiantesInactivos);
                this.graficoBarras.series[0].data.push(this.cantEstudiantesEnEspera);
                this.graficoBarras.series[0].data.push(this.cantEstudiantesRealizandoServicio);
                this.graficoBarras.series[0].data.push(this.cantEstudiantesActivos);
                this.graficoBarras.series[0].data.push(this.cantEstudiantesServicioFinalizado);
            },

            graficoBarraHorizontalfillData(){

                console.table(this.serviciosSocialesByEstado);
                this.serviciosSocialesByEstado.forEach(element => {
                    if(element.estado_proyecto_social == 'No iniciado'){ this.cantServiciosSocialNoIniciado++ }
                    if(element.estado_proyecto_social == 'En curso'){ this.cantServiciosSocialEnCurso++ }
                    if(element.estado_proyecto_social == 'Finalizado'){ this.cantServiciosSocialFinalizado++ }
                });

                this.graficoPastel.series.push(this.cantServiciosSocialNoIniciado);
                this.graficoPastel.series.push(this.cantServiciosSocialEnCurso);
                this.graficoPastel.series.push(this.cantServiciosSocialFinalizado);

                console.log(this.graficoPastel);

            }
            
        },
        mounted(){

            var sideBar = document.getElementById("sideBar");
            sideBar.click();
            setTimeout(function(){
                var sideBar = document.getElementById("sideBar");
                sideBar.click();
            },850);

            this.graficoDonutfillData();
            this.graficoBarrafillData();
            this.graficoBarraHorizontalfillData();

            setTimeout(function(){
                this.mostrar = true;
            }, 800); 

        }

    }
    
</script>