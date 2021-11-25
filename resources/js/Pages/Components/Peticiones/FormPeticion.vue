<template>
 <div class="wrapper">
      <Base>
        <template v-slot:header></template>
      </Base>
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row justify-content-center mb-2">
              <div class="col-sm-5">
                <!-- titulo que cambiará conforme a la accion seleccionada -->
                <h1 v-if="this.$props.peticiones.id != null" class="m-2">Modificar peticion de servicio social</h1>
                <h1 v-else class="m-2">Agregar peticion de servicio social</h1>
                
              </div><!-- /.col -->          
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        
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
                                <jet-label for="titulo" value="Titulo" />
                                <jet-input id="nombre" type="text" v-model="form.nombre_peticion"  required  />                                
                              </div>
                            </div>
                            <div class="col">
                              <!-- cantidad estudiantes -->
                              <div class="form-group">
                                <jet-label for="cantidad" value="Cantidad estudiantes " />
                                <jet-input id="cantidadEstudiantes" type="number" v-model="form.cantidad_estudiantes" required autofocus autocomplete="cantidad de estudiantes" />
                              </div>
                            </div>
                          </div> 
                              
                          <!-- Descripcion de peticiones -->
                          <div class="row col-md-12">                            
                            <div class="form-group col-md-12">
                              <jet-label for="descripcion" value="Descripcion de la peticion" />
                              <jet-input id="descripcion" type="text" v-model="form.descripcion_peticion" required autofocus autocomplete="cantidad de estudiantes" />
                            </div>
                          </div>                                                  

                          <!-- Ubicacion de actividades -->
                          <div class="row">
                            <div class="col">
                              <!-- Ubicacion -->
                              <div class="form-group">
                                <jet-label for="ubicacion" value="Ubicacion" />
                                <jet-input id="ubicacion_peticiones" type="text" v-model="form.ubicacion_actividades" required autofocus autocomplete="dui" />
                              </div>
                            </div>

                            <!-- Fecha de la peticion -->
                            <div class="col">
                              <!-- codigo de empleado del encargado -->
                              <div class="form-group">
                                <!-- <jet-label for="cantidad_horas" value="Cantidad de horas" /> -->
                                <jet-input id="cantidad_horas" type="hidden" v-model="form.cantidad_horas"/>
                              </div>
                            </div>
                          </div> 

                          <div class="row">
                            <div class="col">
                              <!-- Ubicacion -->
                              <div class="form-group">
                                <jet-label for="fecha_peticion_inicio" value="Fecha de inicio" />
                                <jet-input id="fecha_peticion_inicio" type="date" v-model="form.fecha_peticion"  placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" required autofocus autocomplete="off"/>
                              </div>
                            </div>

                            <!-- Fecha de la peticion -->
                            <div class="col">
                              <!-- codigo de empleado del encargado -->
                              <div class="form-group">
                                <jet-label for="fecha_peticion_fin" value="Fecha de finalización" />
                                <jet-input id="fecha_peticicion_fin" type="date" v-model="form.fecha_peticion_fin" placeholder="dd-mm-yyyy" min="1997-01-01" max="2030-12-31" required autofocus autocomplete="off"/>
                              </div>
                            </div>
                          </div> 


                          <div class="row">                            
                            <!-- Otros tipos de servicio -->
                            <div class="col">                                
                              <div class="form-group">
                                <jet-label for="otros" value="Otra especificacion" />
                                <jet-input id="otros_tipo_servicio" type="text" v-model="form.otros_tipo_servicio"/>
                              </div>
                            </div>

                            <div class="col">
                              <!-- Correo peticion -->
                              <div class="col">                                
                                <div class="form-group">
                                  <jet-label for="correo" value="Correo" />
                                  <jet-input id="correo_peticion" type="email" v-model="form.correo_peticion" required autofocus autocomplete="email" />
                                </div>
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

                          <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <jet-label for="tipoServicio" value="Tipo de servicio social" />
                                <br/>
                                <!-- select para cargar las facultades -->
                                <select class="custom-select col-md-10" id="tipo_servicio_social_id" v-model="form.tipo_servicio_social_id" required>
                                  <option disabled value="">Seleccione un tipo de servicio social</option>
                                  <option v-for="(tipos, index) in tipoServicios" :key="index" :value="tipos.id">{{ tipos.nombre_tipo_servicio }}</option>
                                </select>
                                <inertia-link :href="route('tipoServicio.index')" type="button" class="btn btn-success  col-md-2">
                                  <i class="fas fa-plus"></i> 
                                </inertia-link>
                              </div>
                            </div>
                            <div class="col">
                              <div class="form-group">
                                <jet-label for="institucion" value="Institucion" />
                                <br/>
                                <!-- select para cargar las facultades -->
                                <select class="custom-select col-md-10" id="institucion" v-model="form.institucion_id" required>
                                  <option disabled value="">Seleccione una institucion</option>
                                  <option v-for="(institucion, index) in instituciones" :key="index" :value="institucion.id">{{ institucion.nombre_institucion }}</option>
                                </select>
                                <inertia-link :href="route('instituciones.create')" type="button" class="btn btn-success col-md-2">
                                  <i class="fas fa-plus"></i> 
                                </inertia-link>
                              </div>
                            </div>
                          </div>                          
                          <hr> 
                        </div>                       

                        <div class="card-footer clearfix"> 
                          <div class="my-2">
                            <div class="d-flex justify-content-center align-items-baseline">
                              <!-- botones de accion -->
                              <jet-button type="submit" class="btn btn-primary float-center" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                              <i class="fas"></i>Guardar</jet-button>
                              <div class="mx-2"></div>
                              <inertia-link :href="route('peticiones.index')" type="button" class="btn btn-danger float-center" >
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
            </div>
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
  props:['peticiones', 'facultades', 'idFacultad', 'carreras', 'tipoServicios', 'instituciones'],
  data(){
    return{
      form: this.$inertia.form({
        nombre_peticion: this.$props.peticiones.nombre_peticion,
        descripcion_peticion: this.$props.peticiones.descripcion_peticion,
        cantidad_estudiantes: this.$props.peticiones.cantidad_estudiantes,
        ubicacion_actividades: this.$props.peticiones.ubicacion_actividades,
        fecha_peticion: this.$props.peticiones.fecha_peticion,
        fecha_peticion_fin: this.$props.peticiones.fecha_peticion_fin,
        cantidad_horas: 0,
        otros_tipo_servicio: this.$props.peticiones.otros_tipo_servicio,
        estado_peticion: this.$props.peticiones.estado_peticion,
        correo_peticion: this.$props.peticiones.correo_peticion,
        carrera_id: this.$props.peticiones.carrera_id,
        facultad_id: this.$props.idFacultad,
        tipo_servicio_social_id: this.$props.peticiones.tipo_servicio_social_id,
        institucion_id: this.$props.peticiones.institucion_id,
      }),
      carrerasFiltradas:[],
      tiposFiltrados:[],
      institucionesFiltradas:[],
    }
  },
  methods: {
    submit(){
      if(this.$props.peticiones.id != null){
        this.$inertia.put(route('peticiones.updateStatus', this.$props.peticiones.id), this.form);
      }
      else{
        this.form.post(route('peticiones.store'));        
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
    },
  },
  
  mounted(){
    // funcion para cargar las carreras de las facultades al cargar la pagina
    if(this.$props.peticiones.id != null){ // validar si es insercion o actualizacion por medio del id
      var idFac = this.form.facultad_id;  // obteniendo la facultad del encargado     
      this.carreras.forEach(carrera => { 
        if(carrera.facultad_id == idFac){
          this.facultades.push(carrera); // llenar las carreras de la facultad
        }        
      });
      this.carreras.forEach(element =>{
        this.carrerasFiltradas.push(element);
      });
    } 
  }
}
</script>