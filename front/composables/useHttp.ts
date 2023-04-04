import { UseFetchOptions } from "#app"
import { NitroFetchRequest } from "nitropack"
import { KeyOfRes } from "nuxt/dist/app/composables/asyncData"

export function useHttp<T>(
  request: NitroFetchRequest,
  opts?:
    | UseFetchOptions<
        T extends void ? unknown : T,
        (res: T extends void ? unknown : T) => T extends void ? unknown : T,
        KeyOfRes<
          (res: T extends void ? unknown : T) => T extends void ? unknown : T
        >
      >
    | undefined,
) {
  const config = useRuntimeConfig()

  return useFetch<T>(request, {
    baseURL: config.public.baseUrl,
    headers: {
      Authorization: "Bearer " + useCookie("token").value,
    },
    ...opts,
  })
}
