<script setup>
const { $store } = useNuxtApp()
</script>

<template>
  <header>
    <div></div>
    <div>Профиль</div>
    <div></div>
  </header>
  <main>
    <pre
      >{{ $store.user }}
    </pre>
  </main>
</template>
