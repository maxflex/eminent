<script setup lang="ts">
const { item } = defineProps<{
  item: Plan
}>()
const emit = defineEmits(["edit"])
const { $today } = useNuxtApp()

const sment = () => console.log("sment")

watch(
  () => item.is_finished,
  (val) =>
    useHttp(`plans/${item.id}`, {
      method: "PUT",
      body: {
        is_finished: val,
      },
    }),
)

const isUnfinished = computed(() => !item.is_finished && item.date < $today)

const rub = (value: Number) =>
  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
</script>

<template>
  <div
    class="plan-item"
    :class="{
      'plan-item--finished': item.is_finished,
      'plan-item--unfinished': isUnfinished,
    }"
  >
    <v-checkbox
      color="success"
      v-model="item.is_finished"
      :label="item.title"
    />
    <div class="plan-item-info">
      <div v-if="item.time" class="plan-item-info-time">{{ item.time }}</div>
      <div v-if="item.comment">
        {{ item.comment }}
      </div>
      <div v-if="item.penalty" class="plan-item-info-penalty">
        {{ rub(item.penalty) }} руб.
      </div>
    </div>
    <div class="plan-item-edit">
      <v-icon @click="emit('edit')"> jo-basic-more-horizontal </v-icon>
    </div>
  </div>
</template>

<style lang="scss">
.plan-item {
  $e: &;
  $transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
  margin: 16px 0;
  position: relative;
  &--finished {
    label {
      color: rgb(var(--v-theme-grey));
      &:before {
        width: 100% !important;
      }
    }
    #{$e}-info-penalty {
      color: rgb(var(--v-theme-grey)) !important;
    }
  }
  &--unfinished {
    label,
    #{$e}-info-penalty {
      color: rgb(var(--v-theme-error)) !important;
    }
  }
  &-info {
    margin-top: 1px;
    margin-left: 35px;
    color: rgb(var(--v-theme-grey));
    display: flex;
    gap: 26px;
    // font-size: 1.17rem;
    &-penalty {
      // color: rgb(var(--v-theme-error));
      transition: $transition;
    }
    &-time {
      width: 43px;
    }
  }
  &-edit {
    position: absolute !important;
    right: 10px;
    top: 0;
    color: rgba(var(--v-theme-on-surface), var(--v-high-emphasis-opacity));
    opacity: 0;
    transition: opacity ease-in-out 0.2s;
    padding: 4px;
    &:hover {
      opacity: 1;
    }
  }
  .v-checkbox {
    display: flex;
    flex: initial;
    .v-icon {
      transition: $transition;
    }
    label {
      transition: $transition;
      opacity: 1;
      margin-left: 10px;
      font-size: 1.17rem;
      position: relative;
      &:before {
        transition: $transition;
        content: "";
        position: absolute;
        width: 0%;
        height: 2px;
        top: 14px;
        left: 0;
        background: rgba(var(--v-theme-error), 0.8);
        border-radius: 8px;
      }
    }
  }
}
</style>
