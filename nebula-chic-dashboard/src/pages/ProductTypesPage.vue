<template>
  <TableCRUD :tableTitle :endpoint :fields />
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import { useI18n } from 'vue-i18n';
import TableCRUD from '@/components/Tables/TableCRUD.vue';

const { t } = useI18n();
const tableTitle = t('productTypes');
const endpoint = 'product-types';

const fields: Fields[] = [
  {
    component: 'InputText',
    label: t('name'),
    nameKey: 'name',
  },
];
</script>
