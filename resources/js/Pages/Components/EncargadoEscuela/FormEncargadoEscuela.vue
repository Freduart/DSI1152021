<template>
    <div class="wrapper">
      <Base>
        <template v-slot:header></template>
      </Base>

      <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row justify-content-center mb-2">
          <div class="col-sm-5">
            <!-- titulo que cambiará conforme a la accion seleccionada -->
            <h1 v-if="this.$props.encargadoE.id != null" class="m-2">Modificar encargado de escuela</h1>
            <h1 v-else class="m-2">Agregar encargado de escuela</h1>
            <jet-validation-errors class="mb-3" />
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row justify-content-center my-2">
            <!-- Left col -->
            <section class="col-lg-9 connectedSortable">
                <!-- TO DO List -->
                <!-- Ejemplo de como podria ser una tabla pero se tendria que añadir al width del 100% -->
                <div class="card">
 
                <!-- /.card-header -->
                  <form @submit.prevent="submit">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                           <!-- nombres del encargado -->
                          <div class="form-group">
                            <jet-label for="nombre" value="Nombres" />
                            <jet-input id="nombre" type="text" v-model="form.nombre_encargado_escuela" required autofocus autocomplete="nombre" />
                          </div>
                        </div>
                        <div class="col">
                          <!-- apellidos del encargado -->
                          <div class="form-group">
                            <jet-label for="apellido" value="Apellidos" />
                            <jet-input id="apellido" type="text" v-model="form.apellido_encargado_escuela" required autofocus autocomplete="apellido" />
                          </div>
                        </div>
                      </div> 
                          
                      <div class="row">
                        <div class="col">
                          <!-- correo del encargado -->
                          <div class="form-group">
                            <jet-label for="correo" value="Correo" />
                            <jet-input id="correo" type="email" v-model="form.correo_encargado_escuela" required />
                          </div>
                        </div>
                        <div class="col">
                          <!-- telefono del encargado -->
                          <div class="form-group">
                            <jet-label for="telefono" value="Telefono" />
                            <jet-input id="telefono" type="text" v-model="form.telefono_encargado_escuela" required autofocus autocomplete="telefono" />
                          </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col">
                          <!-- dui del encargado -->
                          <div class="form-group">
                            <jet-label for="dui" value="Dui" />
                            <jet-input id="dui" type="text" v-model="form.dui_encargado_escuela" required autofocus autocomplete="dui" />
                          </div>
                        </div>
                        <div class="col">
                          <!-- codigo de empleado del encargado -->
                          <div class="form-group">
                            <jet-label for="Codigo" value="Codigo empleado" />
                            <jet-input id="Codigo" type="text" v-model="form.codigo_encargado_escuela" required autofocus autocomplete="Codigo" />
                          </div>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col">
                          <!-- facultad del encargado -->
                          <div class="form-group">
                            <jet-label for="facultad" value="Facultad" />
                            <br/>
                            <!-- select para cargar las facultades -->
                            <select class="custom-select" id="facultad_id" v-model="form.facultad_id" v-on:change="buscarCarreras(form.facultad_id)" required>
                              <option disabled value="">Seleccione una facultad</option>
                              <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
                            </select>
                          </div>
                        </div>
                        <div class="col">
                          <!-- escuela del encargado -->
                          <div class="form-group" v-if="form.facultad_id != ''">
                            <jet-label for="carrera" value="Carrera" />
                            <br/>
                            <!-- select para cargar las carreras de la facultad seleccionada -->
                            <select class="custom-select" id="carrera_id" v-model="form.carrera_id" required>
                              <option disabled value="">Seleccione una carrera</option>
                              <option v-for="(carrera, index) in carrerasFiltradas" :key="index" :value="carrera.idC">{{ carrera.nombre_carrera }}</option>
                            </select>
                          </div>
                        </div>
                      </div> 

                      <hr>
                    </div>

                    <div class="card-footer clearfix"> 
                      <div class="my-2">
                        <div class="d-flex justify-content-center align-items-baseline">
                          <!-- botones de accion -->
                          <jet-button type="submit" class="btn btn-primary float-center" :class="{ 'text-white-50': form.processing }" :disabled="form.processing" >
                          <i class="fas"></i> Guardar</jet-button>
                          <div class="mx-2"></div>
                          <inertia-link :href="route('encargadosescuela.index')" type="button" class="btn btn-danger float-center" >
                          <i class="fas"></i> Cancelar</inertia-link>
                        </div>
                      </div>
                    </div>
                  </form>


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
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'
import Base from "@/Pages/Base.vue"

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Base
  },
  props:['encargadoE', 'facultades', 'carreras', 'idFacultad', 'escuela'],

  // data a utilizar
  data() {
    return {
      form: this.$inertia.form({
        codigo_encargado_escuela: this.$props.encargadoE.codigo_encargado_escuela,
        nombre_encargado_escuela: this.$props.encargadoE.nombre_encargado_escuela,
        apellido_encargado_escuela: this.$props.encargadoE.apellido_encargado_escuela,
        correo_encargado_escuela: this.$props.encargadoE.correo_encargado_escuela,
        facultad_id: this.$props.idFacultad,
        carrera_id: this.$props.encargadoE.carrera_id,
        estado_encargado_escuela: this.$props.encargadoE.estado_encargado_escuela,
        dui_encargado_escuela: this.$props.encargadoE.dui_encargado_escuela,
        telefono_encargado_escuela: this.$props.encargadoE.telefono_encargado_escuela
      }), carrerasFiltradas:[],
    }
  },

  // lineas a ser ejecutadas al inicio 
  mounted(){

    // funcion para cargar las carreras de las facultades al cargar la pagina
    if(this.$props.encargadoE.id != null){ // validar si es insercion o actualizacion por medio del id
      var idFac = this.form.facultad_id;  // obteniendo la facultad del encargado
      this.carreras.forEach(carrera => { 
        if(carrera.facultad_id == idFac){
          this.carrerasFiltradas.push(carrera); // llenar las carreras de la facultad
        }
      });

      this.escuela.forEach(element => {
        this.carrerasFiltradas.push(element); //agregar la facultad del encargado al arreglo
      });
    } 
  },

  methods: {
    // funcion guardar (insert o update)
    submit() {
      if (this.$props.encargadoE.id != null){
        // actualizar
        this.$inertia.put(route('encargadosescuela.update', this.$props.encargadoE.id), this.form);
      } else {
        // insertar
        console.log(this.form);
        this.form.post(route('encargadosescuela.store'));
      }
    },

    // funcion para cargar las carreras de la facultad seleccionada
    buscarCarreras(id){
      this.carrerasFiltradas.length = 0; // vaciar arreglo
      this.carreras.forEach(carrera => {
        if(carrera.facultad_id == id){ 
          this.carrerasFiltradas.push(carrera); // llenar las carreras de la facultad
        }
      });          

      // compara la facultad seleccionada con la facultad del encargado 
      if (id == this.$props.idFacultad){
        this.escuela.forEach(element => {
          this.carrerasFiltradas.push(element); //agrega la escuela del encargado
        });
      }
    }
  },
}
</script>
