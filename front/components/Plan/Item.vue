<script setup lang="ts">
defineProps<{
  item: Plan
}>()
</script>

<template>
  <div class="plan-item">
    <h2>
      {{ item.title }}
    </h2>
    <div>
      {{ item.comment }}
    </div>
  </div>
</template>

<style>
.plan-item {
  border-bottom: 1px solid #f1f1f1;
  padding-bottom: 30px;
  margin-bottom: 30px;
}
</style>
