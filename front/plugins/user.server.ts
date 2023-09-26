import { useMainStore } from "@/store"

export default defineNuxtPlugin(async () => {
  const store = useMainStore()
  const { data } = await useHttp("auth/user")
  if (data.value) {
    store.user = data.value.user
  }
})
