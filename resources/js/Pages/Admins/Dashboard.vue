<template>
   <div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="https://www.ues.edu.sv/storage/app/media/minerva2.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- <section class="content"> -->
        <!-- <div class="container-fluid"> -->
        <!-- Imagenes -->
        <div>
            <md-toolbar class="md-large md-primary">
            <div class="md-toolbar-row">
                <div class="md-toolbar-section-start">
                <md-button class="md-icon-button">
                    <md-icon>menu</md-icon>
                </md-button>
                </div>

                <div class="md-toolbar-section-end">
                <md-button class="md-icon-button">
                    <md-icon>refresh</md-icon>
                </md-button>

                <md-button class="md-icon-button">
                    <md-icon>more_vert</md-icon>
                </md-button>
                </div>
            </div>

                <div class="md-toolbar-row md-toolbar-offset">
                    <h3 class="md-title">Title on a second row</h3>
                </div>
            </md-toolbar>
        </div>
    </div>
    <!-- /.content-wrapper -->

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