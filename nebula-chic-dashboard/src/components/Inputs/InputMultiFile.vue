<template>
  <v-file-input
    v-model="value"
    :label
    variant="solo"
    density="comfortable"
    prepend-icon=""
    append-inner-icon="mdi-file-multiple"
    multiple
    chips
    counter
    show-size
    :rules
  >
    <template v-slot:selection="{ fileNames }">
      <template v-for="(fileName, index) in fileNames" :key="fileName">
        <v-chip v-if="index < 3" class="me-2" size="small">
          {{ fileName }}
        </v-chip>

        <span
          v-else-if="index === 3"
          class="text-overline text-grey-darken-3 mx-2"
        >
          +{{ value.length - 3 }} File(s)
        </span>
      </template>
    </template>
  </v-file-input>
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

const emits = defineEmits(['onUpdateValue']);

const rules: ((v: []) => boolean | string)[] = [];

if (required) rules.push((v: []) => v.length || 'This field is required');

watch(value, (newValue) => {
  emits('onUpdateValue', newValue, nameKey);
});
</script>
