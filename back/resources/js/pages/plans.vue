<script setup lang="ts">
import { ref, onMounted } from "vue"
import moment from "moment"
import Dialog from "@/components/Plan/Dialog.vue"
import Item from "@/components/Plan/Item.vue"
import type { Plan } from "@/components/Plan"
// import axios from "axios"
import { router } from "@inertiajs/vue3"

const DialogRef = ref()
const loadMoreRef = ref()

const today = moment().format("dddd D MMMM")
const observer = new IntersectionObserver((entries) =>
  entries.forEach((entry) => entry.isIntersecting && loadMore(), {
    rootMargin: "-150px 0px 0px 0px",
  }),
)

onMounted(() => {
  observer.observe(loadMoreRef.value)
})

const loadMore = () => {
  router.get(
    props.links.next,
    {},
    {
      preserveState: true,
      preserveScroll: true,
      preserveUrl: true,
      replace: true,
      onSuccess({ props }) {
        const data = props.data as Plan[]
        // const { data }: { data: Array<Plan> } = props
        // const { data, meta }: { data: Plan[] } = props
        // console.log("loadMore", data)
        // data.forEach((e) => items.push(e))
        items.push(...data)
      },
    },
  )
}

const props = defineProps<{
  data: Plan[]
  links: any
}>()

const { data: items } = props
</script>

<template>
  <header>
    <v-btn icon>
      <v-icon> jo-time-calendar-dates </v-icon>
    </v-btn>
    <div>{{ today }}</div>
    <v-btn icon @click="() => DialogRef.open()">
      <v-icon> jo-basic-plus </v-icon>
    </v-btn>
  </header>
  <main>
    <!-- <pre>
      {{ links }}
    </pre> -->
    <Item v-for="item in items" :item="item" />
    <span ref="loadMoreRef" />
  </main>
  <Dialog ref="DialogRef" />
</template>
