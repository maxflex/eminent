<script setup lang="ts">
import { useForm } from "@inertiajs/vue3"
import { ref } from "vue"
const dialog = ref(false)

function open() {
  dialog.value = true
}

const form = useForm({
  title: "",
  comment: "",
})

defineExpose({
  open,
})
</script>

<template>
  <v-dialog
    fullscreen
    v-model="dialog"
    transition="dialog-right-transition"
    content-class="dialog-right"
  >
    <v-card>
      <v-card-text>
        <form @submit.prevent="form.post('/plans')">
          <v-text-field
            v-model="form.title"
            :error-messages="form.errors.title"
            label="Заголовок"
          />
          <v-text-field
            v-model="form.comment"
            :error-messages="form.errors.comment"
            label="Коммент"
          />
          <div class="text-center">
            <v-btn color="primary" type="submit">Войти</v-btn>
          </div>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
