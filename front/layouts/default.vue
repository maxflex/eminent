<template>
  <v-app class="default-layout elevation-24">
    <slot />
    <Menu />
  </v-app>
</template>

<style lang="scss">
.default-layout {
  // background: #ebebeb !important;
  background-image: url("/img/sky-blurred.jpg") !important;
  background-size: cover !important;
  background-attachment: fixed !important;
  .v-application__wrap {
    background: white;
    max-width: var(--app-width) !important;
    margin: 0 auto;
    box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2),
      0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
  }
}
</style>
