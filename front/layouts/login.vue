<template>
  <v-app>
    <div class="login-layout">
      <slot />
    </div>
  </v-app>
</template>

<style lang="scss">
.login-layout {
  background: linear-gradient(0deg, #f0faf8, #0086bf);
  height: 100vh;
  width: 100vw;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  form {
    // background: rgba(white, 0.4);
    background: white;
    border-radius: 20px;
    width: 400px;
    padding: 30px;
    // text-align: center;
    box-shadow: 0 11px 34px 0 rgb(0 0 0 / 20%);
    img {
      width: 100px;
      margin: 0 auto 30px;
    }
    & > .v-text-field {
      margin-bottom: 20px;
    }
  }
}
</style>
