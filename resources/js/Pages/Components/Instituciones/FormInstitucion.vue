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
            <h1 v-if="this.$props.instituciones.id != null" class="m-2">Modificar institucion</h1>
            <h1 v-else class="m-2">Agregar institucion</h1>   
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
                <div class="card">                

                  <!-- Formulario para la institucion -->
                  <form @submit.prevent="submit">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <!-- Nombre de la institucion -->
                          <div class="form-group">
                            <jet-label for="nombre" value="Nombre" />
                            <jet-input id="nombre_institucion" type="text" v-model="form.nombre_institucion" required autofocus autocomplete="nombre" />
                          </div>
                        </div>
                        <div class="col">
                          <!-- Contacto de la institucion -->
                          <div class="form-group">
                            <jet-label for="Contacto" value="Contacto" />
                            <jet-input id="contacto_institucion" type="text" v-model="form.contacto_institucion" required autofocus autocomplete="contacto" />
                          </div>
                        </div>
                      </div> 
                          
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                            <!-- Correo de la institucion -->
                            <jet-label for="correo" value="Correo" />
                            <jet-input id="correo_institucion" type="email" v-model="form.correo_institucion" required />
                          </div>
                        </div>
                        <div class="col">
                          <!-- Telefono de la institucion -->
                          <div class="form-group">
                            <jet-label for="telefono" value="Telefono" />
                            <jet-input id="telefono_institucion" type="text" v-model="form.telefono_institucion" required autofocus autocomplete="telefono" />
                          </div>
                        </div>
                      </div> 

                      <div class="row">
                        <div class="col">
                          <!-- Ubicacion de la institucion -->
                          <div class="form-group">
                            <jet-label for="ubicacion" value="Ubicacion" />
                            <jet-input id="ubicacion_institucion" type="text" v-model="form.ubicacion_institucion" required autofocus autocomplete="dui" />
                          </div>
                        </div>
                        <div class="col">
                          <!-- Rubro de la empresa -->
                          <div class="form-group">
                            <jet-label for="Rubro" value="Rubro de la empresa" />
                            <jet-input id="rubro_institucion" type="text" v-model="form.rubro_institucion" required autofocus autocomplete="Rubro" />
                          </div>
                        </div>
                      </div>                       
                      <hr>
                    </div>

                    <div class="card-footer clearfix"> 
                      <div class="my-2">
                        <div class="d-flex justify-content-center align-items-baseline">
                          <!-- botones de accion  -->
                          <jet-button type="submit" class="btn btn-success float-center" :class="{ 'text-white-50': form.processing }" :disabled="form.processing" >
                            <!-- <inertia-link class="float-center" title="Editar institucion" :href="route('instituciones.edit', this.instituciones.id)"></inertia-link> -->
                            <i class="fas"></i> 
                            Guardar
                          </jet-button>

                          <!-- Espacio entre botones -->
                          <div class="mx-2"></div>

                          <inertia-link :href="route('instituciones.index')" type="button" class="btn btn-danger float-center" >
                            <i class="fas"></i> 
                            Cancelar
                          </inertia-link>
                          <!-- Fin de los botones de accion -->
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

    // La propiedad tiene que ser llamada del mismo modo que en el metodo del controlador
    props: ['instituciones'],

    data(){
      return{
        // Esta data esta generando problemas a la hora de querer crear una nueva institucion
        form: this.$inertia.form({          
          nombre_institucion: this.instituciones.nombre_institucion,
          contacto_institucion: this.instituciones.contacto_institucion,
          correo_institucion: this.instituciones.correo_institucion,
          telefono_institucion: this.instituciones.telefono_institucion,
          ubicacion_institucion: this.instituciones.ubicacion_institucion,
          rubro_institucion: this.instituciones.rubro_institucion
        }),
        institucionesFiltradas:[],
      }
    },

    mounted(){

    },

    methods:{
      submit(){
        // Se evalua si la institucion tiene un id entonces se ejecutara la ruta de actualizar
        if(this.$props.instituciones.id != null){
          this.$inertia.put(route('instituciones.update', this.$props.instituciones.id), this.form);
        }
        // Si no tiene un id entonces se ejecuta la ruta de crear
        else{
          this.form.post(route('instituciones.store'));
        }
      }
    },
  }
</script>