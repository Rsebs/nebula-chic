<template>
  <v-autocomplete
    v-model="value"
    :label
    :items
    item-value="id"
    item-title="name"
    variant="solo"
    density="comfortable"
    clearable
    :loading
    multiple
    chips
    :rules
  />
</template>

<script lang="ts" setup>
import type { SelectResponse } from '@/interfaces/APIResponseInterface/SelectResponse';
import axiosService from '@/services/axiosService';
import { onMounted, ref, watch, type Ref } from 'vue';

const valueModel = defineModel();
const { endpointSelect, nameKey, required } = defineProps({
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
  endpointSelect: {
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
const items: Ref<SelectResponse[]> = ref([]);
const loading = ref(false);

const rules: ((v: []) => boolean | string)[] = [];

if (required)
  rules.push((v: []) => (!!v && v.length) || 'This field is required');

onMounted(() => {
  onFetchOptions();
});

const emits = defineEmits(['onUpdateValue']);

const onFetchOptions = async () => {
  loading.value = true;
  try {
    const { data } = await axiosService.get(endpointSelect);
    items.value = data;

    if (typeof valueModel.value !== 'undefined') value.value = valueModel.value;
  } catch (error) {
    console.error(error);
  }
  loading.value = false;
};

watch(value, (newValue) => {
  emits('onUpdateValue', newValue, nameKey);
});
</script>
