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
  loading.value = true
  const { data, error } = await useHttp("auth/login", {
    method: "post",
    body: { ...form },
  })
  setTimeout(() => (loading.value = false), 300)
  if (error.value) {
    errors.value = error.value.data.errors
    return
  }
  const { user, token } = data.value
  console.log(user, token)
  cookieToken.value = token
  $store.user = user
  await navigateTo({ name: "index" })
}

definePageMeta({
  layout: "login",
})
</script>

<template>
  <form @submit.prevent="submit()">
    <div class="text-center mb-0">
      <img src="/img/logo.svg" />
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
    <v-btn color="primary" :loading="loading" block type="submit">
      Войти
    </v-btn>
  </form>
</template>
