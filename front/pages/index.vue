<script setup>
const { $store } = useNuxtApp()
</script>

<template>
  <header>
    <div></div>
    <div>index</div>
    <div></div>
  </header>
  <main>
    <pre
      >{{ $store.user }}
    </pre>
  </main>
</template>
