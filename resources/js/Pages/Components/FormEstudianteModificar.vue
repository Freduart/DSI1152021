<template>
      <h1 class="d-flex justify-content-center">Formulario de modificación de estudiante</h1>
        <jet-authentication-card>
        
    <template #logo>
      <!-- <jet-authentication-card-logo /> -->
      <i class="fa fa-user-circle fa-10x d-flex justify-content-center mb-4" aria-hidden="true"></i>
    </template>

    <div class="card-body">

      <jet-validation-errors class="mb-3" />

        <!-- Este es el formulario para los estudiantes -->
      <form @submit.prevent="submit">
        <!-- <div class="form-group">
          <jet-label for="nombre_estudiante" value="Nombres" />
          <jet-input id="nombre_estudiante" type="text" v-model="form.nombre_estudiante" required autofocus autocomplete="nombre_estudiante" />
        </div>

        <div class="form-group">
          <jet-label for="apellido_estudiante" value="Apellidos" />
          <jet-input id="apellido_estudiante" type="text" v-model="form.apellido_estudiante" required autofocus autocomplete="apellido_estudiante" />
        </div>        

        <div class="form-group">
          <jet-label for="carnet_estudiante" value="Carnet" />
          <jet-input id="carnet_estudiante" type="text" v-model="form.carnet_estudiante" required />
        </div>

        <div class="form-group">
          <jet-label for="sexo_estudiante" value="Sexo" />
          <br/>
          <jet-label for="masculino" value="masculino" />
          <input id="masculino" type="radio" v-model="form.sexo_estudiante" value="masculino" name="sexo_estudiante" required aria-label="Radio button for following text input"/>
          <br/>
          <jet-label for="femenino" value="femenino" />
          <input id="femenino" type="radio" v-model="form.sexo_estudiante" value="femenino" name="sexo_estudiante" required aria-label="Radio button for following text input"/>
        </div>

        <div class="form-group">
          <jet-label for="correo_estudiante" value="Correo" />
          <jet-input id="correo_estudiante" type="text" v-model="form.correo_estudiante" required />
        </div>

        <div class="form-group">
          <jet-label for="telefono_estudiante" value="Telefono" />
          <jet-input id="telefono_estudiante" type="text" v-model="form.telefono_estudiante" required />
        </div>

        <div class="form-group">
          <jet-label for="dui_estudiante" value="DUI" />
          <jet-input id="dui_estudiante" type="text" v-model="form.dui_estudiante" required />
        </div>

        <div class="form-group">
          <jet-label for="nit_estudiante" value="NIT" />
          <jet-input id="nit_estudiante" type="text" v-model="form.nit_estudiante" required />
        </div>

        <div class="form-group">
          <jet-label for="avance_estudiante" value="Materias Aprobadas" />
          <jet-input id="avance_estudiante" type="text" v-model="form.materias_cursadas" required />
        </div> -->

        <!-- <div class="form-group">
          <jet-label for="facultad" value="Facultad" />
          <br/>
          <select id="facultad_id" v-model="form.facultad_id" v-on:change="buscarCarreras(form.facultad_id)" required> -->
            <!-- <option value="" selected>Seleccionar</option> -->
            <!-- <option disabled value="">Seleccione una facultad</option>
            <option v-for="(facultad, index) in facultades" :key="index" :value="facultad.id">{{ facultad.nombre_facultad }}</option>
          </select>
        </div> -->

        <!-- <div class="form-group" v-if="form.facultad_id != ''">
          <jet-label for="carrera" value="Carrera" />
          <br/>
          <select id="carrera_id" v-model="form.carrera_id" required>
            <option disabled value="">Seleccione una carrera</option>
            <option v-for="(carrera, index) in carrerasFiltradas" :key="index" :value="carrera.id">{{ carrera.nombre_carrera }}</option>
          </select>
        </div> -->

        <hr/>
        <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <inertia-link :href="route('carreras.index')" class="text-muted mr-3 text-decoration-none">
              Cancelar
            </inertia-link>

            <!-- <button class="ml-4 btn btn-primary" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              Enviar solicitud de registro
            </button> -->
            <button style="padding: 6px" class="ml-4 btn btn-success btn-md">
              <i class="fa fa-paper-plane" aria-hidden="true"></i>
              Actualizar
            </button>
          </div>
        </div>
      </form>





    </div>
  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
export default {
     components: {
        JetAuthenticationCard,
     }
}
</script>