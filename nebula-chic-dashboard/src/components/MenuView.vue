<template>
  <v-list density="compact" nav>
    <v-list-item
      v-for="item in itemsList"
      :key="item.title"
      :to="item.to"
      :title="item.title"
      :prepend-icon="item.icon"
      exact
    />
  </v-list>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const itemsList = ref([
  {
    title: 'Index',
    icon: 'mdi-home',
    to: { name: 'Index' },
  },
  {
    title: t('products'),
    icon: 'mdi-tshirt-v',
    to: { name: 'Products' },
  },
  {
    title: t('productTypes'),
    icon: 'mdi-tshirt-v',
    to: { name: 'ProductTypes' },
  },
  {
    title: t('sizes'),
    icon: 'mdi-tshirt-v',
    to: { name: 'Sizes' },
  },
]);
</script>
