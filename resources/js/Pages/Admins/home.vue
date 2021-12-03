<template>
  <!-- <div class="wrapper"> -->
    <!-- Navbar -->
    <!-- <Base>
      <template v-slot:header></template>
    </Base>  -->

    <component-to-re-render :key="componentKey" />
    
    <!-- content-wrapper -->
    <!-- <div class="content-wrapper"> -->
      <div class="content-header">
        <div class="container-fuild">
          <!-- Navbar -->
          <nav class="navbar navbar-light bg-light">
            <div class="col-md-10">
              <a class="navbar-brand" href="/">
              <img src="https://www.ues.edu.sv/storage/app/media/minerva2.png" width="40" height="40" class="d-inline-block align-top" alt="">
              Universidad de El Salvador
            </a>  
            </div>
            <div class="col-md-2">
              <inertia-link :href="route('login')">                
                <u> Iniciar sesion</u>
              </inertia-link>
              /                                      
              <inertia-link :href="route('estudiantes.create')">
                <u> Registrarse </u>
              </inertia-link>
            </div>
          </nav>
          <!-- Navbar -->         
          <br>
        </div>                 
        <!-- Container card -->
        <div class="container-fuild card">
          <div class="row mb-12">
            <div class="col-sm-12">
              <!-- Carousel -->
              <div id="carousel" class="carousel slide" data-ride="carousel">                
                <ol class="carousel-indicators">
                  <li data-target="#carousel" style="background-color: black" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel" style="background-color: black" data-slide-to="1"></li>
                  <li data-target="#carousel" style="background-color: black" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  
                  <!-- First carousel's item -->
                  <div class="carousel-item active">   
                    <div class="card mb-3">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <img src="https://pbs.twimg.com/media/EkT1vmxWAAQzbAs.jpg" class="rounded d-block w-100 h-100" alt="minerva">                    
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Universidad de El Salvador</h5>
                            <p class="card-text">Hacia La Libertad Por La Cultura</p>
                            <p class="card-text"><small class="text-muted"></small></p>
                          </div>
                        </div>
                      </div>
                    </div>                                     
                  </div>
                  <!-- End of the carousel's item -->

                  <!-- Second carousel's item -->
                  <div class="carousel-item"> 
                    <div class="card mb-3">
                      <div class="row no-gutters">
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Universidad de El Salvador</h5>
                            <p class="card-text">Hacia La Libertad Por La Cultura</p>
                            <p class="card-text"><small class="text-muted"></small></p>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <img src="https://farm5.static.flickr.com/4137/4906071257_edf0cd1554_z.jpg"  class="rounded d-block w-100 h-100" alt="minerva">
                        </div>                        
                      </div>
                    </div>                                       
                  </div>
                  <!-- End of the second carousel's item -->

                  <!-- Third carousel's item -->
                  <div class="carousel-item"> 
                    <div class="card mb-3">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <img src="https://mapio.net/images-p/4610585.jpg" class="rounded d-block w-100 h-100" alt="minerva">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Universidad de El Salvador</h5>
                            <p class="card-text">Hacia La Libertad Por La Cultura</p>
                            <p class="card-text"><small class="text-muted"></small></p>
                          </div>
                        </div>
                      </div>
                    </div>                                     
                  </div>
                  <!-- End of the third carousel's item -->

                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>               
              <!-- End of carousel --> 
               <div class="text-center">            
            <h4>¿Qué deseas realizar?</h4>            
          </div>

          <!-- Card content -->           
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Agregar peticion de servicio social</h5>
                  <p class="card-text">Agrega una peticion para realizar un servicio social segun las necesidades de tu institucion.</p>
                  <inertia-link :href="route('peticiones.create')">                
                    <button class="btn btn-info">Añadir peticion</button>
                  </inertia-link>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Añadir una institucion</h5>
                  <p class="card-text">Añade tu institucion para poder ver la informacion sobre tus peticiones desde nuestro sitio.</p>
                  <inertia-link :href="route('instituciones.create')">                
                    <button class="btn btn-info">Añadir institucion</button>
                  </inertia-link>
                </div>
              </div>
            </div>
          </div>      
          <!-- Estas dos opciones no se para que podemos usarlas pero por si las dudas la dejare -->
          <!-- <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-info">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-info">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>     -->
          <!-- End of the card content -->                         
            </div>
          </div>  
        </div>        
        <!-- End of container card -->                      
      </div>   

      <!-- footer -->
      <nav class="navbar navbar-light bg-light ">
        <div class="col-md-10">

          <p><img src="https://www.ues.edu.sv/storage/app/media/Logos/header.jpg" width="70" height="80" alt="Proyeccion social"> SASS - Sistema de administracion de servicio social</p>
        </div>
        <div class="col-md-2">
          <p>Grupo #07 DSI215 - 2021</p>   
          <p>Ing. Karen Peñate</p> 
        </div>
      </nav>
      <!-- End of footer -->
    <!-- </div>               -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->  
  <!-- </div> -->
</template>

<script>
 export default {
  data() {
    return {
      componentKey: 0,
    };
  },
  methods: {
    forceRerender() {
      this.componentKey += 1;  
    }
  }
 }
</script>
