<template>
  <q-item :to="{ name: pathName }" clickable v-ripple>
    <q-item-section avatar>
      <q-icon :name="icon" />
    </q-item-section>
    <q-item-section>{{ title }}</q-item-section>
  </q-item>
</template>

<script setup lang="ts">
defineProps({
  title: {
    type: String,
    required: true,
  },
  pathName: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    required: false,
    default: 'bi-dash',
  },
});
</script>
