<template>
  <button>
    <router-link :to="{ name: 'Index' }"> Index </router-link>
  </button>
  <button>
    <router-link :to="{ name: 'About' }"> About </router-link>
  </button>
  <router-view></router-view>
</template>

<script lang="ts" setup></script>
