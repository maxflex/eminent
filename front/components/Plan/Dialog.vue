<script setup lang="ts">
import { OpUnitType } from "dayjs"
import { vMaska } from "maska"

const emit = defineEmits<{
  (event: "store", plan: Plan): void
}>()
const { $dayjs } = useNuxtApp()
const timeMask = { mask: "##:##" }
const calendarDialog = ref()
const loading = ref(false)
const dialog = ref(false)
const errorMessages = ref<{ title?: string }>({})
const plan = reactive<Plan>({
  title: "",
  comment: "",
  date: $dayjs().format("YYYY-MM-DD"),
  is_finished: false,
})

const open = (date: string) => {
  dialog.value = true
  plan.date = date
}

const submit = async () => {
  loading.value = true
  errorMessages.value = {}
  const { data, error } = await useHttp("plans", {
    method: "POST",
    body: { ...plan },
  })
  loading.value = false
  if (error.value) {
    errorMessages.value = error.value.data.errors
    return
  }
  emit("store", data.value as Plan)
  dialog.value = false
}

const finishBy = (value: OpUnitType) => {
  plan.date = $dayjs().endOf(value).format("YYYY-MM-DD")
}

defineExpose({ open })
</script>

<template>
  <CalendarDialog ref="calendarDialog" v-model="plan.date" />
  <v-dialog
    fullscreen
    v-model="dialog"
    transition="dialog-right-transition"
    content-class="dialog-right"
  >
    <v-card>
      <v-card-text>
        <form @submit.prevent="submit()">
          <div class="mb-6">
            <div class="double-input">
              <div @click="calendarDialog.open()">
                <v-text-field
                  :model-value="$dayjs(plan.date).format('dddd D MMMM')"
                  readonly
                  label="Дата"
                  class="cursor--pointer"
                />
              </div>
              <v-text-field
                v-model="plan.time"
                label="Время"
                v-maska:[timeMask]
              />
            </div>
            <div class="preselects">
              <span @click="finishBy('week')">на этой неделе</span>
              <span @click="finishBy('month')">в этом месяце</span>
            </div>
          </div>
          <v-text-field
            v-model="plan.title"
            label="Заголовок"
            :error-messages="errorMessages.title"
          />
          <v-textarea v-model="plan.comment" label="Коммент" no-resize />
          <v-text-field
            color="error"
            v-model="plan.penalty"
            label="Штраф"
            suffix="руб."
            type="number"
          />
          <div class="text-center mt-6">
            <v-btn block color="primary" type="submit" :loading="loading">
              Добавить
            </v-btn>
          </div>
        </form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>
