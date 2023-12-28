<script setup>
import { RouterView } from "vue-router";
</script>

<template>
  <header></header>

  <img
    src="@/assets/logo.svg"
    alt="Logo Nebula Chic"
    width="250"
    height="250"
  />

  <RouterView />

  <footer></footer>
</template>
