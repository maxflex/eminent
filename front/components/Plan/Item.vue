<script setup lang="ts">
defineProps<{
  item: Plan
}>()

const rub = (value: Number) =>
  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
</script>

<template>
  <div class="plan-item" :class="{ 'plan-item--finished': item.is_finished }">
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
    <!-- <div class="plan-item-title">
      {{ item.title }}
    </div> -->
  </div>
</template>

<style lang="scss">
.plan-item {
  $e: &;
  $transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
  margin: 16px 0;
  .v-checkbox {
    display: flex;
    flex: initial;
    .v-icon {
      transition: $transition;
    }
    label {
      opacity: 1;
      transition: $transition;
      margin-left: 10px;
      font-size: 1.17rem;
    }
  }
  &--finished {
    .v-checkbox {
      label {
        color: rgb(var(--v-theme-grey));
      }
    }
    #{$e}-info-penalty {
      color: rgb(var(--v-theme-grey)) !important;
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
      color: rgb(var(--v-theme-error));
      transition: $transition;
    }
    &-time {
      width: 43px;
    }
  }
}
</style>
