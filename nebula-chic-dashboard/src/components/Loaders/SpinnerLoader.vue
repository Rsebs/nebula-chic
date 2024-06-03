<template>
  <v-progress-circular
    :model-value="progress"
    :indeterminate
    :size
    :width
    :color
  >
    <template #default v-if="withProgress"> {{ progress }} % </template>
  </v-progress-circular>
</template>

<script setup lang="ts">
defineProps({
  progress: {
    type: Number,
    default: 0,
  },
  indeterminate: {
    type: Boolean,
    default: true,
  },
  size: {
    type: Number,
    default: 32,
  },
  width: {
    type: Number,
    default: 3,
  },
  color: {
    type: String,
    default: 'primary',
  },
  withProgress: {
    type: Boolean,
    default: false,
  },
});
</script>
