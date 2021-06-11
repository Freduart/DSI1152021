<template>
    Formulario Estudiante

        <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <div class="card-body">

      <jet-validation-errors class="mb-3" />

        <!-- Este es el formulario para los estudiantes -->
      <form @submit.prevent="submit">
        <div class="form-group">
          <jet-label for="nombre" value="Nombres" />
          <jet-input id="nombre" type="text" v-model="form.nombre" required autofocus autocomplete="nombre" />
        </div>

        <div class="form-group">
          <jet-label for="apellido" value="Apellidos" />
          <jet-input id="apellido" type="text" v-model="form.apellido" required autofocus autocomplete="apellido" />
        </div>        

        <div class="form-group">
          <jet-label for="carnet" value="Carnet" />
          <jet-input id="carnet" type="text" v-model="form.carnet" required />
        </div>

        <div class="form-group">
          <jet-label for="sexo" value="Sexo" />
          <br/>
          <jet-label for="masculino" value="masculino" />
          <jet-input id="masculino" type="radio" v-model="form.sexo" value="masculino" name="sexo" required aria-label="Radio button for following text input"/>
          <jet-label for="femenino" value="femenino" />
          <jet-input id="femenino" type="radio" v-model="form.sexo" value="femenino" name="sexo" required aria-label="Radio button for following text input"/>
        </div>

        <div class="form-group">
          <jet-label for="facultad" value="Facultad" />
          <br/>
          <select id="facultad_id" v-model="form.facultad_id" v-on:change="buscarCarreras(form.facultad_id)" required>
            <!-- <option value="" selected>Seleccionar</option> -->
            <option disabled value="">Seleccione una facultad</option>
            <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
          </select>
        </div>

        <div class="form-group" v-if="form.facultad_id != ''">
          <jet-label for="carrera" value="Carrera" />
          <br/>
          <select id="carrera_id" v-model="form.carrera_id" required>
            <option disabled value="">Seleccione una carrera</option>
            <option v-for="(carrera, index) in carrerasFiltradas" :key="index" :value="carrera.id">{{ carrera.nombre_carrera }}</option>
          </select>
        </div>

        <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <inertia-link :href="route('login')" class="text-muted mr-3 text-decoration-none">
              Ya estas registrado?
            </inertia-link>

            <jet-button class="ml-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              Enviar solicitud de registro
            </jet-button>
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
        nombre: '',
        apellido:'',
        carnet: '',
        facultad_id: '',
        carrera_id: '',
        estado: 'En espera',
        persona_id: null,
        cantidad_horas_ss: 0,
        materias_cursadas: 0,
        sexo: '',
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
      this.form.post(this.route('estudiantes.store'));
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
