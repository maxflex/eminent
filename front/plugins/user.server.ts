import { useMainStore } from "@/store"

export default defineNuxtPlugin(async () => {
  const store = useMainStore()
  const { data, error } = await useHttp("auth/user")
  if (error.value === null) {
    store.user = data.value.user
  }
})
