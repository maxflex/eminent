<script setup lang="ts">
const dialog = ref(false)
let loading = ref(false)
const form = reactive({
  title: "",
  comment: "",
})
const open = () => (dialog.value = true)
const submit = async () => {
  loading.value = true
  const { data, error } = await useHttp("plans", {
    method: "POST",
    body: { ...form },
  })
  loading.value = false
  console.log(data.value, error.value)
}

// let errors = ref({})

defineExpose({ open })
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
        <form @submit.prevent="submit()">
          <v-text-field v-model="form.title" label="Заголовок" />
          <v-text-field v-model="form.comment" label="Коммент" />
          <div class="text-center">
            <v-btn color="primary" type="submit" :loading="loading"
              >Войти</v-btn
            >
          </div>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
