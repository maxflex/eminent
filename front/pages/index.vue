<script setup lang="ts">
const { $dayjs, $today } = useNuxtApp()
const date = ref($today)
const planDialog = ref()
const calendarDialog = ref()
const plans = ref<Plan[]>([])
const loading = ref(false)

const onUpdated = (plan: Plan) => {
  const index = plans.value.findIndex(({ id }) => plan.id === id)
  if (index === -1) {
    return plans.value.unshift(plan)
  }
  plans.value.splice(index, 1, plan)
}

const onDeleted = function (plan: Plan) {
  const index = plans.value.findIndex(({ id }) => plan.id === id)
  plans.value.splice(index, 1)
}

const loadData = async () => {
  if (loading.value) {
    return
  }
  loading.value = true
  const params = isToday.value ? { today: 1 } : { date: date.value }
  const { data } = await useHttp<PlanResponse>("plans", { params })
  if (data.value) {
    plans.value = data.value.data
  }
  loading.value = false
}

const isToday = computed(() => date.value === $today)
watch(date, () => loadData())
loadData()
</script>
<template>
  <header>
    <v-btn :size="48" icon @click="calendarDialog.open()">
      <v-icon> jo-time-calendar-dates </v-icon>
    </v-btn>
    <div class="text-grey">
      {{ $dayjs(date).format("dddd D MMMM") }}
    </div>
    <v-btn :size="48" icon @click="() => planDialog.open(date)">
      <v-icon> jo-basic-plus </v-icon>
    </v-btn>
  </header>
  <main>
    <PlanList
      :items="plans"
      v-if="!loading"
      :is-today="isToday"
      @edit="(plan) => planDialog.edit(plan)"
    />
  </main>
  <client-only>
    <PlanDialog ref="planDialog" @updated="onUpdated" @deleted="onDeleted" />
    <CalendarDialog ref="calendarDialog" v-model="date" load-events />
  </client-only>
</template>

<!-- 
  ---- 4 апреля:
  Понимания недостаточно. Я охуенен в теории. Я всё, блять, знаю.
  Но практика страдает. Страдает пиздец. Знаю, как нужно делать,
  но нихуя не делаю. И так всегда: знаю, что нужно сообщить Косте,
  что я отошел с работы – но нихуя не говорю. Знаю, что нужно сказать,
  что опоздаю или не приду – но нихуя не пишу. Знаю, как нужно поступить
  в какой-нибудь ситуации, знаю наверняка, потому что читал в книге – но
  нихуя не следую. ПРАКТИКА СТРАДАЕТ. Впизду теорию. Хватит. Отрабатывай
  весь материал, который накопил до сих пор – на практике. Не еблань

  И сейчас. Ты, еблана кусок, знаешь, что тебе оказали знак внимания, 
  поставив стакан с водой рядом. Хуле ты блять сидишь, барана ты кусок?
  Что бы сделал Мэтью Мэкконахе? Бенджамин Франклин? Другие твои кумиры?
  НЕ БУДЬ ШЫДЗЕ. ЕСЛИ ПОНИМАЕШЬ, КАК СДЕЛАЙТЬ ПРАВИЛЬНО - НЕУКОСНИТЕЛЬНО ДЕЛАЙ.
  СМЕЛОСЬ – НЕ ОТСУТСТВИЕ СТРАХА, А ОСОЗНАНИЕ ТОГО, ЧТО ЕСТЬ ВЕЩИ ВАЖНЕЕ, ЧЕМ СТРАХ.
  


  ---- обновление от 14 августа:

  Написанное выше было 4 месяца назад. В итоге я не очконул – подкатил. И моя жизнь
  радикально изменилась: я расстался с Лизой, начал встречаться с Олей. Тайланд 🏝️
  Охуенный незабываемый курортный роман. Много новых ощущений. Сейчас Оля живёт 
  у меня с Розой. Ощутил каково это жить по-семейному с ребёнком. И всё это потому
  что ты тогда собрал волю в кулак и не очконул. Смелость вознаграждается с лихвой.

  Знай впредь: минута смелости может изменить жизнь на годы вперёд. Оно того стоит. 

  Другое дело, что Оля оказалась тупая, с кучей зависимостей и с прицепом. А я 
  сейчас все усилия прилагаю, чтобы выгнать её нахуй из дома :D 
 -->
