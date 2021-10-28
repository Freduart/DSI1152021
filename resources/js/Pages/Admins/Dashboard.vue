<template>
  <div class="wrapper">
    <!-- Navbar -->
    <Base>
      <template v-slot:header></template>
    </Base> 

    <!-- content-wrapper -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fuild">
          <div class="row sm-2">
            <div class="col-sm-8">                
              <div class="col-sm-4">
                <img class="img-portal" src="https://www.ues.edu.sv/storage/app/media/minerva2.png"/>
              </div>
              <div class="col-sm-8 alinging">
                <h1 class="sm-3">Universidad de El Salvador</h1>
                <h4 class="sm-3">Hacia la libertad por la cultura</h4>
              </div>
            </div>
            <div class="col-sm-4">
              <inertia-link type="button" class="btn btn-success float-right md-2"  
              :href="route('peticiones.index')">
                <i class="fas fa-plus"></i> Añadir petición
              </inertia-link>
            </div>              
          </div>
          <br>
        </div>                 
        <!-- Container card -->
        <div class="container-fuild card">
          <div class="row mb-2">
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
                          <img src="https://pbs.twimg.com/media/EkT1vmxWAAQzbAs.jpg" class="d-block w-100 h-100" alt="minerva">                    
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <img src="https://farm5.static.flickr.com/4137/4906071257_edf0cd1554_z.jpg"  class="d-block w-100 h-100" alt="minerva">
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
                          <img src="https://mapio.net/images-p/4610585.jpg" class="d-block w-100 h-100" alt="minerva">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
            </div>
          </div>  

          <div class="text-center">            
            <h4>Antes de empezar debes saber esto:</h4>            
          </div>

          <!-- Card content -->           
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>      
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>    
          <!-- End of the card content -->

        </div>        
        <!-- End of container card -->                      
      </div>   

      <!-- footer -->
      <footer>
        <div class="container-fuild">
          <div class="row sm-2">
            <div class="col-sm-8">                
              <div class="col-sm-4">
                <img class="img-portal" src="https://www.ues.edu.sv/storage/app/media/minerva2.png"/>
              </div>
              <div class="col-sm-8 alinging">
                <h1 class="sm-3">Universidad de El Salvador</h1>
                <h4 class="sm-3">Hacia la libertad por la cultura</h4>
              </div>
            </div>           
          </div>
        </div>
      </footer>
      <!-- End of footer -->
    </div>              
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->  
  </div>
</template>

<style lang="scss" scoped>
  .md-toolbar + .md-toolbar {
    margin-top: 16px;
  }
</style>

<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetDropdownLink from '@/Jetstream/DropdownLink'

    import Base from "@/Pages/Base.vue";

    export default {

        name: 'ContentActions',
        components:{
            JetNavLink,
            JetDropdownLink,
            Base
        },
          props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        },
        methods:{
            logout() {
                this.$inertia.post(route('logout'));
             },
        },
        mounted() {
            //this.$forceUpdate();
            
        },
        /*watch: {
                     // Si la ruta cambia, el método se ejecutará nuevamente
          "$route" (to, from){
              //location.reload();
            if(to !== from ) {
                this.siteData = this.getSiteData();
            }
          },
        },*/
        /*beforeRouteEnter (to, from, next) { 
            location.reload()
        } */
    }    
    
</script>