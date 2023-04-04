import { createApp, h } from "vue"
import { createInertiaApp } from "@inertiajs/vue3"
import DefaultLayout from "@/layouts/default.vue"
import router from "./plugins/router"
import vuetify from "@/vuetify"
// import moment from "moment"
// import "moment/dist/locale/ru"
// moment.locale("ru")

import "../css/app.scss"

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob("./pages/**/*.vue", { eager: true })
    let page = pages[`./pages/${name}.vue`]
    page.default.layout =
      page.default.layout === undefined ? DefaultLayout : page.default.layout
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(router)
      .use(vuetify)
      .use(plugin)
      .mount(el)
  },
})
