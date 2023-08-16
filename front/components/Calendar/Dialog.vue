<script setup>
const props = defineProps({
  modelValue: String,
})
const emit = defineEmits(["update:modelValue"])
const { $dayjs } = useNuxtApp()
const dialog = ref(false)
const currentYear = new Date().getFullYear()
const today = $dayjs().format("YYYY-MM-DD")
const monthLabels = [
  "январь",
  "февраль",
  "март",
  "апрель",
  "май",
  "июнь",
  "июль",
  "август",
  "сентябрь",
  "октябрь",
  "ноябрь",
  "декабрь",
]
const open = () => {
  dialog.value = true
  setTimeout(
    () =>
      document
        .querySelector(".calendar__selected")
        .scrollIntoView({ block: "center" }),
    100,
  )
}
const zeroPad = (value) => ("0" + value).slice(-2)
// отступ первого дня в календаре
const firstDayOfWeek = (year, month) => new Date(year, month - 1, 0).getDay()
const daysInMonth = (year, month) => new Date(year, month, 0).getDate()
const getDate = (year, month, day) =>
  [year, zeroPad(month), zeroPad(day)].join("-")
const isToday = (year, month, day) => getDate(year, month, day) === today
const isSelected = (year, month, day) =>
  getDate(year, month, day) === props.modelValue
const onClick = (year, month, day) => {
  emit("update:modelValue", getDate(year, month, day))
  dialog.value = false
}

defineExpose({ open })
</script>

<template>
  <v-dialog
    :scrim="false"
    v-model="dialog"
    transition="dialog-bottom-transition"
    fullscreen
  >
    <v-card>
      <div class="dialog-header">
        <v-btn icon @click="dialog = false">
          <v-icon>jo-basic-cross</v-icon>
        </v-btn>
      </div>
      <div
        class="calendar__year"
        v-for="year in [currentYear - 1, currentYear, currentYear + 1]"
      >
        <h2>{{ year }}</h2>
        <div class="calendar">
          <div v-for="month in 12" :key="month" class="calendar__month">
            <div class="calendar__month-label">
              {{ monthLabels[month - 1] }}
            </div>
            <div class="calendar__month-days">
              <div
                v-for="x in firstDayOfWeek(year, month)"
                :key="'x' + x"
                class="no-pointer-events"
              ></div>
              <div
                v-for="day in daysInMonth(year, month)"
                :key="day"
                :class="{
                  calendar__today: isToday(year, month, day),
                  calendar__selected: isSelected(year, month, day),
                }"
                @click="onClick(year, month, day)"
              >
                {{ day }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </v-card>
  </v-dialog>
</template>

<style lang="scss">
.calendar {
  display: flex;
  display: grid;
  grid-template-columns: 1fr 1fr;
  margin-top: 40px;
  // padding-bottom: 40px;
  &__selected {
    background: rgb(var(--v-theme-primary));
    border-color: rgb(var(--v-theme-primary));
    color: white !important;
    pointer-events: none;
  }
  &__today {
    color: rgb(var(--v-theme-primary));
    border: 1px solid rgb(var(--v-theme-primary));
  }
  &__month {
    padding: 0 12px;
    margin-bottom: 20px;
    &-label {
      color: #b6b6b6;
      font-weight: bold;
      padding: 12px;
    }
    &-days {
      display: grid;
      $size: 40px;
      grid-template-columns: repeat(7, $size);
      grid-gap: 3px;
      & > div {
        height: $size;
        // width: $size;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        // font-size: 12px;
        font-weight: 500;
        border-radius: 50%;
        // transition: background cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
        // transition: background linear 0.1s;
        letter-spacing: 0.0892857143em;
        text-indent: 0.0892857143em;
        &:hover {
          background: rgb(var(--v-theme-on-surface-variant));
        }
      }
    }
  }
  &__year {
    & > h2 {
      position: sticky;
      top: 18px;
      z-index: 99;
      margin-left: 18px;
      display: inline;
    }
  }
}
</style>
