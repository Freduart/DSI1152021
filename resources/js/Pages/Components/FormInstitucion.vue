<template>
    Formulario Institución

        <jet-authentication-card>
    <template #logo>
      <!-- <jet-authentication-card-logo /> -->
        <i class="fa fa-user-circle fa-10x d-flex justify-content-center mb-4" aria-hidden="true"></i>
    </template>

    <div class="card-body">

      <jet-validation-errors class="mb-3" />

        <!-- Este es el formulario para los estudiantes -->
      <form @submit.prevent="submit">
        <div class="form-group">
          <jet-label for="nombre_institucion" value="Nombre de la institución" />
          <jet-input id="nombre_institucion" type="text" v-model="form.nombre_institucion" required autofocus autocomplete="nombre_institucion" />
        </div>

        <div class="form-group">
          <jet-label for="contacto_institucion" value="Contacto de la institución" />
          <jet-input id="contacto_institucion" type="text" v-model="form.contacto_institucion" required autofocus autocomplete="contacto_institucion" />
        </div>        

        <div class="form-group">
          <jet-label for="correo_institucion" value="Correo de la institución" />
          <jet-input id="correo_institucion" type="text" v-model="form.correo_institucion" required />
        </div>

        <div class="form-group">
          <jet-label for="telefono_institucion" value="Telefono de la institución" />
          <jet-input id="telefono_institucion" type="text" v-model="form.telefono_institucion" required />
        </div>

        <div class="form-group">
          <jet-label for="ubicacion_institucion" value="Ubicacion de la institución" />
          <jet-input id="ubicacion_institucion" type="text" v-model="form.ubicacion_institucion" required />
        </div>

        <div class="form-group">
          <jet-label for="rubro_institucion" value="Rubro" />
          <jet-input id="rubro_institucion" type="text" v-model="form.rubro_institucion" required />
        </div>

        <hr/>
        <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <inertia-link :href="route('login')" class="text-muted mr-3 text-decoration-none">
              Ya estas registrado?
            </inertia-link>

            <button style="padding: 6px" class="ml-4 btn btn-outline-success btn-md" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              Enviar solicitud de registro
            </button>
          </div>
        </div>
      </form>





    </div>
  </jet-authentication-card>

</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors
  },
  props:['facultades','carreras'],
  data() {
    return {
      form: this.$inertia.form({
          nombre_institucion: '',
          contacto_institucion: '',
          correo_institucion: '',
          telefono_institucion: '',
          ubicacion_institucion: '',
          rubro_institucion: '',
      }), carrerasFiltradas:[],
    }
  },

  methods: {
    submit() {
      // this.form.post(this.route('register'), {
      //   onFinish: () => this.form.reset('password', 'password_confirmation'),
      // })
      //this.form.get(this.route('dashboard'));
      // delete this.form.facultad_id;
      console.log(this.form);
      this.form.post(this.route('instituciones.store'));
    },
    buscarCarreras: function(id){
      this.carrerasFiltradas.splice(0, this.carrerasFiltradas.length);
      // console.log(id);
      // console.log(this.facultades);
      // console.log(this.carreras);
      this.facultades.forEach(facultad => {
        // console.log("facultad => " + typeof facultad.id);
        // console.log("id => " + typeof id);
        // console.log(typeof Number(id));
        if(facultad.id == id){
          // console.log(facultad);
          // console.log(facultad.id);
          var facultad = facultad.id;
          console.log(facultad);

          this.carreras.forEach(carrera => {
            if(carrera.facultad_id == facultad){
              console.log(carrera);
              this.carrerasFiltradas.push(carrera); 
            }
            // console.log(carrera);
            // console.log(carrera.facultad_id);
          });

        }
      });
    }
  },
}
</script>
