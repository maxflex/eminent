<script setup>
const { $store } = useNuxtApp()
const form = reactive({
  email: "",
  password: "",
})

let loading = ref(false)
let errors = ref({})

const cookieToken = useCookie("token")

const submit = async () => {
  loading = true
  const { data, error } = await useHttp("auth/login", {
    method: "post",
    body: { ...form },
  })
  if (error.value !== null) {
    errors.value = error.value.data.errors
    console.log(errors)
  } else {
    const { user, token } = data.value
    console.log(user, token)
    cookieToken.value = token
    $store.user = user
    await navigateTo({ name: "index" })
  }
  loading = false
}

definePageMeta({
  layout: "login",
})
</script>

<template>
  <form @submit.prevent="submit()">
    <div class="text-center">
      <img src="/img/logo.png" />
    </div>
    <v-text-field
      variant="outlined"
      v-model="form.email"
      label="Логин"
      :error-messages="errors.email"
    />
    <v-text-field
      variant="outlined"
      v-model="form.password"
      label="Пароль"
      type="password"
      :error-messages="errors.password"
    />
    <div class="text-center">
      <v-btn color="primary" :loading="loading" type="submit">Войти</v-btn>
    </div>
  </form>
</template>
