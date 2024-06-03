<template>
  <v-file-input
    v-model="value"
    :label
    variant="solo"
    density="comfortable"
    prepend-icon=""
    append-inner-icon="mdi-file"
    chips
    counter
    show-size
    :rules
  />
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue';

const { nameKey, required } = defineProps({
  label: {
    type: String,
    required: true,
    default: '',
  },
  nameKey: {
    type: String,
    required: true,
    default: '',
  },
  required: {
    type: Boolean,
    required: false,
    default: true,
  },
});

const value = ref();

const rules: ((v: []) => boolean | string)[] = [];

if (required) rules.push((v: []) => v.length || 'This field is required');

const emits = defineEmits(['onUpdateValue']);

watch(value, (newValue) => {
  emits('onUpdateValue', newValue, nameKey);
});
</script>
