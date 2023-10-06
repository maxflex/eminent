import { createVuetify, ThemeDefinition } from "vuetify"

const myTheme: ThemeDefinition = {
  dark: false,
  colors: {
    background: "#ffffff",
    surface: "#ffffff",
    primary: "#f1e4a5",
    accent: "#f47fcc",
    secondary: "#008ecb",
    error: "#ff7134",
    info: "#2196f3",
    success: "#4caf50",
    warning: "#ff4600",
    orange: "#ff7134",
    grey: "#9e9e9e",
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
      VCheckbox: {
        falseIcon: "jo-basic-circle",
        trueIcon: "jo-basic-circle-checked",
        hideDetails: true,
        ripple: false,
        density: "dense",
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
