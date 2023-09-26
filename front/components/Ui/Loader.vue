<template>
  <div class="ui-loader">
    <v-progress-circular
      :size="80"
      :width="4"
      indeterminate
    ></v-progress-circular>
  </div>
</template>

<style>
.ui-loader {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
