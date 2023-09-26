import { createVuetify, ThemeDefinition } from "vuetify"

const myTheme: ThemeDefinition = {
  dark: false,
  colors: {
    background: "#FFFFFF",
    surface: "#FFFFFF",
    primary: "#f1e4a5",
    accent: "#f47fcc",
    secondary: "#008ecb",
    error: "#ff7134",
    info: "#2196F3",
    success: "#4CAF50",
    warning: "#FB8C00",
    orange: "#ff7134",
    "on-surface": "#414141",
  },
}

export default defineNuxtPlugin((nuxtApp) => {
  const vuetify = createVuetify({
    defaults: {
      VBtn: {
        variant: "flat",
        ripple: false,
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
