<script>
export default {
  layout: null,
}
</script>

<script setup>
import { useForm } from "@inertiajs/vue3"

const form = useForm({
  email: "",
  password: "",
})
</script>

<template>
  <v-app>
    <div class="login">
      <form @submit.prevent="form.post('/login')">
        <div class="text-center">
          <img src="/img/logo.png" />
        </div>
        <v-text-field
          variant="outlined"
          v-model="form.email"
          :error-messages="form.errors.email"
          label="Логин"
        />
        <v-text-field
          variant="outlined"
          v-model="form.password"
          :error-messages="form.errors.password"
          label="Пароль"
          type="password"
        />
        <div class="text-center">
          <v-btn color="primary" type="submit">Войти</v-btn>
        </div>
      </form>
    </div>
  </v-app>
</template>

<style lang="scss">
.login {
  background: linear-gradient(0deg, #f0faf8, #0086bf);
  height: 100vh;
  width: 100vw;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  form {
    // background: rgba(white, 0.4);
    background: white;
    border-radius: 20px;
    width: 400px;
    padding: 30px;
    // text-align: center;
    box-shadow: 0 11px 34px 0 rgb(0 0 0 / 20%);
    img {
      width: 100px;
      margin: 0 auto 30px;
    }
    & > .v-text-field {
      margin-bottom: 20px;
    }
  }
}
</style>
