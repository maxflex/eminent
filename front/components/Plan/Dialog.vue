<script setup lang="ts">
const emit = defineEmits<{
  (event: "store", plan: Plan): void
}>()
const data = reactive({
  loading: false,
  dialog: false,
})
const form = reactive({
  title: "",
  comment: "",
})
const open = () => (data.dialog = true)
const submit = async () => {
  data.loading = true
  const { data: plan } = await useHttp("plans", {
    method: "POST",
    body: { ...form },
  })
  emit("store", plan.value as Plan)
  data.loading = false
  data.dialog = false
}
defineExpose({ open })
</script>

<template>
  <v-dialog
    fullscreen
    v-model="data.dialog"
    transition="dialog-right-transition"
    content-class="dialog-right"
  >
    <v-card>
      <v-card-text>
        <form @submit.prevent="submit()">
          <v-text-field v-model="form.title" label="Заголовок" />
          <v-text-field v-model="form.comment" label="Коммент" />
          <div class="text-center">
            <v-btn color="primary" type="submit" :loading="data.loading">
              Добавить
            </v-btn>
          </div>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
