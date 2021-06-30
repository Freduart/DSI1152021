<template>
  <jet-authentication-card>
    <template #logo>
      <!-- <jet-authentication-card-logo /> -->
      <i class="fa fa-user-circle fa-10x d-flex justify-content-center mb-4" aria-hidden="true"></i>
    </template>

    <div class="card-body">
      <h1 class="d-flex justify-content-center">INICIAR SESIÓN</h1>
      <hr/>
      <jet-validation-errors class="mb-3" />

      <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
        {{ status }}
      </div>
      <form @submit.prevent="submit">
        <div class="form-group">
          <jet-label for="email" value="Correo" />
          <jet-input id="email" type="email" v-model="form.email" required autofocus />
        </div>

        <div class="form-group">
          <jet-label for="password" value="Contraseña" />
          <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="mb-0 d-flex justify-content-center">
          <div class="d-flex justify-content-end align-items-baseline">
            <!-- <inertia-link v-if="canResetPassword" :href="route('password.request')" class="text-muted mr-3">
              Forgot your password?
            </inertia-link> -->

            <jet-button class="d-flex justify-content-center btn btn-success" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              Iniciar sesión
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
import JetCheckbox from '@/Jetstream/Checkbox'
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

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
}
</script>
