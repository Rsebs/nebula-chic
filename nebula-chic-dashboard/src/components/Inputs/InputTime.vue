<template>
  <v-text-field
    v-model="value"
    :label
    type="time"
    variant="solo"
    density="comfortable"
    :rules
  />
</template>

<script lang="ts" setup>
import type { FunctionValidation } from '@/interfaces/ComponentInterface/ModalFormInterface';
import { fieldRequired } from '@/mixins/validationRules';
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

const rules: FunctionValidation[] = [];

if (required) rules.push(fieldRequired);

const emits = defineEmits(['onUpdateValue']);

watch(value, (newValue) => {
  emits('onUpdateValue', newValue, nameKey);
});
</script>
