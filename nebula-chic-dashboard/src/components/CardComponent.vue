<template>
  <v-card ref="card">
    <template v-slot:title>
      <div class="d-flex justify-space-between align-center">
        <span class="font-weight-black text-center">{{ title }}</span>
        <v-icon size="x-small" @click="onClose">mdi-window-close</v-icon>
      </div>
    </template>

    <v-card-text class="bg-surface-light pt-4">
      <slot />
    </v-card-text>

    <v-card-actions class="d-flex justify-space-evenly">
      <slot name="actions" />
    </v-card-actions>
  </v-card>

  <v-dialog v-model="loading" persistent>
    <div class="d-flex justify-center">
      <SpinnerLoader :size="70" :width="4" />
    </div>
  </v-dialog>
</template>

<script lang="ts" setup>
import SpinnerLoader from '@/components/Loaders/SpinnerLoader.vue';

const loading = defineModel('loading', { required: false, default: false });

defineProps({
  title: {
    type: String,
  },
  width: {
    type: Number,
    default: 700,
  },
});

const emits = defineEmits(['onClose']);

const onClose = () => {
  emits('onClose', false);
};
</script>
