<script setup lang="ts">
const { items, isToday } = defineProps<{
  items: Plan[]
  isToday: Boolean
}>()
const { $dayjs } = useNuxtApp()
const today = $dayjs().format("YYYY-MM-DD")
const tomorrow = $dayjs().add(1, "day").format("YYYY-MM-DD")
const endOfWeek = $dayjs().endOf("week").format("YYYY-MM-DD")
// test
// const today = "2023-08-16"
// const tomorrow = "2023-08-17"
// const endOfWeek = "2023-08-20"
const groups = computed(() => {
  if (!isToday) {
    return [
      {
        title: "",
        plans: items,
      },
    ]
  }
  const result = []
  let plans = items.filter(({ date }) => date === today)
  if (plans.length) {
    result.push({
      title: "сегодня",
      plans,
    })
  }
  plans = items.filter(({ date }) => date === tomorrow)
  if (plans.length) {
    result.push({
      title: "завтра",
      plans,
    })
  }
  plans = items.filter(({ date }) => date > tomorrow && date <= endOfWeek)
  if (plans.length) {
    result.push({
      title: "на этой неделе",
      plans,
    })
  }
  plans = items.filter(({ date }) => date > endOfWeek)
  if (plans.length) {
    result.push({
      title: "в этом месяце",
      plans,
    })
  }
  return result
})
</script>

<template>
  <div class="plan-list">
    <div v-for="{ title, plans } in groups" :key="title">
      <h3 v-if="title">{{ title }}</h3>
      <PlanItem :item="plan" v-for="plan in plans" :key="plan.id" />
    </div>
  </div>
</template>

<style lang="scss">
.plan-list {
  div + div {
    h3 {
      margin-top: 30px;
    }
  }
  h3 {
    text-align: center;
    // color: rgb(var(--v-theme-grey));
  }
}
</style>
