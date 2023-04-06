<script setup>
const dialog = ref(false)
const open = () => (dialog.value = true)
defineExpose({ open })
</script>

<template>
  <v-dialog
    v-model="dialog"
    :scrim="false"
    transition="dialog-bottom-transition"
    fullscreen
  >
    <v-card>
      <v-card-text>
        <h1>test</h1>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
