<template>
  <v-bottom-navigation grow tag="footer" :height="60">
    <v-btn :ripple="false" value="recent" to="/">
      <v-icon>jo-basic-home</v-icon>
    </v-btn>
    <v-btn :ripple="false" value="favorites" to="/profile">
      <v-icon>jo-basic-user</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>
