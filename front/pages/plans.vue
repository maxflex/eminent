<script setup type="ts">
const planDialog = ref()
const loadMoreRef = ref()
const items = ref([])
const loading = ref(false)
const query = { page: 0, paginate: 20 }
let observer

watch(() => loadMoreRef.value, el => {
  observer = new IntersectionObserver((entries) =>
    entries.forEach((entry) => entry.isIntersecting && loadMore(), {
      rootMargin: "-150px 0px 0px 0px",
    })
  )
  observer.observe(el)
})

const loadMore = async () => {
  if (loading.value) {
    return
  }
  loading.value = true
  query.page++
  const { data } = await useHttp("plans", { query })
  items.value = items.value.concat(data.value.data)
  const { current_page: currentPage, last_page: lastPage } = data.value.meta
  if (currentPage === lastPage) {
    observer.unobserve()
  }
  loading.value = false
}
</script>

<template>
  <header>
    <v-btn icon>
      <v-icon> jo-time-calendar-dates </v-icon>
    </v-btn>
    <div>{{ $dayjs().format("dddd D MMMM") }}</div>
    <v-btn icon @click="() => planDialog.open()">
      <v-icon> jo-basic-plus </v-icon>
    </v-btn>
  </header>
  <main>
    <UiLoader v-if="loading && items.length === 0" />
    <PlanItem :item="item" v-for="item in items" :key="item.id" />
    <span ref="loadMoreRef" />
  </main>
  <client-only>
    <PlanDialog ref="planDialog" />
  </client-only>
</template>

<!-- 
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
 -->
