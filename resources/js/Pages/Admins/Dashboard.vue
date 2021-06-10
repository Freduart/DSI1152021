<template>
               <div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">            
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Opcion 1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Opcion 2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Opcion 3</p>
                        </a>
                    </li>
                    </ul>
                </li>            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Titulo</h1>
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
            <section class="col-lg-7 connectedSortable">
                <!-- TO DO List -->
                <!-- Ejemplo de como podria ser una tabla pero se tendria que añadir al width del 100% -->
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    To Do List
                    </h3>

                    <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                    </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <!-- drag handle -->
                        <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <!-- checkbox -->
                        <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo1" id="todoCheck1">
                        <label for="todoCheck1"></label>
                        </div>
                        <!-- todo text -->
                        <span class="text">Design a nice theme</span>
                        <!-- Emphasis label -->
                        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
                        <!-- General tools such as edit or delete-->
                        <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo2" id="todoCheck2" checked>
                        <label for="todoCheck2"></label>
                        </div>
                        <span class="text">Make the theme responsive</span>
                        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
                        <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo3" id="todoCheck3">
                        <label for="todoCheck3"></label>
                        </div>
                        <span class="text">Let theme shine like a star</span>
                        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
                        <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo4" id="todoCheck4">
                        <label for="todoCheck4"></label>
                        </div>
                        <span class="text">Let theme shine like a star</span>
                        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
                        <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo5" id="todoCheck5">
                        <label for="todoCheck5"></label>
                        </div>
                        <span class="text">Check your messages and notifications</span>
                        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
                        <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <span class="handle">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v"></i>
                        </span>
                        <div  class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo6" id="todoCheck6">
                        <label for="todoCheck6"></label>
                        </div>
                        <span class="text">Let theme shine like a star</span>
                        <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
                        <div class="tools">
                        <i class="fas fa-edit"></i>
                        <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
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
    export default {
        
    }
</script>