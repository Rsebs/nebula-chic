<template>
  <v-switch v-model="value" :label color="primary" hide-details />
</template>

<script lang="ts" setup>
import { onMounted, ref, watch } from 'vue';

const { nameKey } = defineProps({
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
});

const value = ref(false);

const emits = defineEmits(['onUpdateValue']);

onMounted(() => {
  onEmitValue(value);
});

const onEmitValue = (value: unknown) => {
  emits('onUpdateValue', value, nameKey);
};

watch(value, (newValue) => {
  onEmitValue(newValue);
});
</script>
