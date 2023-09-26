<script setup>
const { $store } = useNuxtApp()
const loading = ref(false)
const cookieToken = useCookie("token")

const logout = () => {
  loading.value = true
  setTimeout(() => {
    cookieToken.value = null
    $store.user = null
    navigateTo({ name: "login" })
  }, 1000)
}
</script>

<template>
  <header>
    <div></div>
    <div>Профиль</div>
    <div></div>
  </header>
  <main>
    <UiLoader v-if="loading" />
    <template v-else>
      <pre
        >{{ $store.user }}
    </pre
      >
      <div class="mt-12">
        <v-btn :ripple="false" block color="primary" @click="logout()">
          Выйти
        </v-btn>
      </div>
    </template>
  </main>
</template>
