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
          <div class="row mb-2">
            <div class="col-sm-8">                
              <div class="col-sm-4">
                <img class="img-portal" src="https://www.ues.edu.sv/storage/app/media/minerva2.png"/>
              </div>
              <div class="col-sm-8 alinging">
                <h1 class="ml-3">Universidad de El Salvador</h1>
                <h4 class="ml-3">Hacia la libertal por la cultura</h4>
              </div>
            </div>
            <div class="col-md-4">
              <inertia-link type="button" class="btn btn-success float-right mt-2"  
              :href="route('peticiones.index')">
                <i class="fas fa-plus"></i> Añadir petición
              </inertia-link>
            </div>              
          </div>
        </div>   
        <br>        
        <div class="container-fuild card">
          <div class="row mb-2">
            <div class="col-sm-12">
              <div class="col-sm-12">
                <img  class="img-dashboard" src="https://eluniversitario.ues.edu.sv/wp-content/uploads/sites/11/2021/02/Minerva-Universidad-de-El-Salvador-UES.jpg" alt="UES">                          
              </div>              
            </div>
          </div>
        </div>
      </div>   



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
    }    
    
</script>