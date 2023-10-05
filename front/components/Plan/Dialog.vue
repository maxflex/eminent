<script setup lang="ts">
import { OpUnitType } from "dayjs"
import { vMaska } from "maska"

const emit = defineEmits<{
  (event: "updated", plan: Plan): void
  (event: "deleted", plan: Plan): void
}>()
const { $dayjs, $today } = useNuxtApp()
const timeMask = { mask: "##:##" }
const calendarDialog = ref()
const loading = ref(false)
const deleting = ref(false)
const dialog = ref(false)
const errorMessages = ref<{ title?: string }>({})
let plan = reactive<Plan>({
  title: "",
  comment: "",
  date: $today,
  is_finished: false,
})

const open = (date: string) => {
  dialog.value = true
  plan = reactive({
    date,
    title: "",
    comment: "",
    is_finished: false,
  })
}

const edit = (p: Plan) => {
  plan = reactive({ ...p })
  dialog.value = true
}

const storeOrUpdate = async () => {
  loading.value = true
  errorMessages.value = {}
  const url = plan.id ? `plans/${plan.id}` : `plans`
  const method = plan.id ? "PUT" : "POST"
  const { data, error } = await useHttp(url, {
    method,
    body: { ...plan },
  })
  loading.value = false
  if (error.value) {
    errorMessages.value = error.value.data.errors
    return
  }
  emit("updated", data.value as Plan)
  dialog.value = false
}

const destroy = async function () {
  deleting.value = true
  await useHttp(`plans/${plan.id}`, {
    method: "DELETE",
  })
  emit("deleted", plan)
  deleting.value = false
  dialog.value = false
}

const finishBy = (value: OpUnitType) => {
  plan.date = $dayjs().endOf(value).format("YYYY-MM-DD")
  plan.time = undefined
}

defineExpose({ open, edit })
</script>

<template>
  <CalendarDialog ref="calendarDialog" v-model="plan.date" />
  <v-dialog
    fullscreen
    v-model="dialog"
    transition="dialog-right-transition"
    content-class="plan-dialog dialog-right"
  >
    <form @submit.prevent="storeOrUpdate()">
      <div class="mb-6">
        <div class="double-input">
          <div @click="calendarDialog.open()">
            <v-text-field
              :model-value="$dayjs(plan.date).format('dddd D MMMM')"
              readonly
              label="Дата"
            />
          </div>
          <v-text-field v-model="plan.time" label="Время" v-maska:[timeMask] />
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
      <v-btn block color="primary" type="submit" :loading="loading">
        {{ plan.id ? "Сохранить" : "Добавить" }}
      </v-btn>
      <v-btn
        variant="outlined"
        class="mt-5"
        v-if="plan.id"
        block
        color="error"
        :loading="deleting"
        @click="destroy()"
      >
        Удалить
      </v-btn>
    </form>
  </v-dialog>
</template>

<style lang="scss">
.plan-dialog {
  .double-input {
    & > div:first-child {
      cursor: pointer;
      .v-field,
      input {
        cursor: pointer !important;
      }
      .v-field__input {
        padding-right: 0 !important;
      }
    }
  }
}
</style>
