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
              <img class="img-portal" src="https://www.ues.edu.sv/storage/app/media/minerva2.png"/>
              <h1 class="ml-3">Universidad de El Salvador</h1>
              <h4 class="ml-3">Hacia la libertal por la cultura</h4>
            </div>
            <div class="col-md-4">
              <inertia-link type="button" class="btn btn-success float-right mt-2"  
              :href="route('encargadosescuela.create')">
                <i class="fas fa-plus"></i> Añadir petición
              </inertia-link>
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