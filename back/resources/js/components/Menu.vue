<template>
  <v-bottom-navigation grow tag="footer" :height="80">
    <v-btn value="recent" to="/">
      <v-icon>jo-basic-home</v-icon>
    </v-btn>
    <v-btn value="favorites" to="/plans">
      <v-icon>jo-time-calendar</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>
