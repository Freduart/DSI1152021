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
                    <div class="row">

                        <div class="col">
                            <!-- <div class="chart">
                                    <apexchart type="bar" width="800" height="350" :options="this.graficoBarrasHorizontales.options" :series="this.graficoBarrasHorizontales.series"></apexchart>                                                       
                            </div> -->
                        </div>  
                        <div class="col">
                            <div>
                                <!-- <apexchart type="donut" width="800" height="350" :options="this.graficoDonut.options" :series="this.graficoDonut.series"></apexchart>                                                        -->
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
        props: ['estudiantesBySexo', 'carrera', 'estudiantesByEstado', 'serviciosSocialesByEstado', 'usuario'],
        data:function(){
          return{
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

                //Para el gráfico de barras horizontales
                graficoBarrasHorizontales:{
                    options: {
                        plotOptions:{
                            bar:{
                                horizontal: true,
                                borderRadius: 4,
                                distributed: false,
                            }
                        },
                        dataLabels:{
                            enabled: false,
                        },
                        chart: {
                            type: 'bar',
                        },
                        xaxis: {
                            categories: ['No iniciado', 'En curso', 'Finalizado', 'Cancelado'],
                            labels:{
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
                            colors: ['#E74C3C']
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
                            text:'Cantidad de servicios sociales según estado',
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
                //Fin de gráfico de barras horizontales
            }

        },
        methods: {

            graficoDonutfillData(){

                // const graficoDonutData = [];
                this.estudiantesBySexo.forEach(element => {
                    this.graficoDonutData.push(element.cant);
                    // graficoDonutData.pop();
                    console.log(element.cant);
                });
                
                console.log(this.graficoDonutData);
                this.graficoDonut.series = this.graficoDonutData;

            },

            graficoBarrafillData(){

                this.estudiantesByEstado.forEach(element => {
                    this.graficoBarraData.push(element.estado);
                    console.log(element.estado);
                });
                this.graficoBarras.series[0].data = this.graficoBarraData;

            },

            graficoBarraHorizontalfillData(){

                this.serviciosSocialesByEstado.forEach(element => {
                    this.graficoBarraHorizontalData.push(element.estado);
                    console.log("sdfsdf"+element.estado);
                });
                this.graficoBarrasHorizontales.series[0].data = this.graficoBarraHorizontalData;

            }
            
        },
        mounted(){

            var sideBar = document.getElementById("sideBar");
            sideBar.click();
            setTimeout(function(){
                var sideBar = document.getElementById("sideBar");
                sideBar.click();
            },850);


            console.log(sideBar);
            console.table(this.estudiantesBySexo);
            console.table(this.estudiantesByEstado);

            this.graficoDonutfillData();
            this.graficoBarrafillData();
            this.graficoBarraHorizontalfillData();



        }

    }
    
</script>