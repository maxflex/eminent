import { createVuetify, ThemeDefinition } from "vuetify"

const myTheme: ThemeDefinition = {
  dark: false,
  colors: {
    background: "#FFFFFF",
    surface: "#FFFFFF",
    primary: "#0086BF",
    secondary: "#03DAC6",
    error: "#B00020",
    info: "#2196F3",
    success: "#4CAF50",
    warning: "#FB8C00",
  },
}

export default defineNuxtPlugin((nuxtApp) => {
  const vuetify = createVuetify({
    defaults: {
      VBtn: {
        size: "large",
        variant: "flat",
      },
      VSelect: {
        variant: "solo",
        density: "comfortable",
        hideDetails: true,
      },
      VTextField: {
        variant: "outlined",
        hideDetails: true,
      },
      VTextarea: {
        variant: "outlined",
        hideDetails: true,
      },
    },
    theme: {
      defaultTheme: "myTheme",
      themes: {
        myTheme,
      },
    },
  })
  nuxtApp.vueApp.use(vuetify)
})
