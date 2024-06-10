<template>
  <TableCRUD :tableTitle :endpoint :fields />
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import TableCRUD from '@/components/Tables/TableCRUD.vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const tableTitle = t('sizes');
const endpoint = 'sizes';

const fields: Fields[] = [
  {
    component: 'InputText',
    label: t('name'),
    nameKey: 'name',
  },
  {
    component: 'InputText',
    label: t('cod'),
    nameKey: 'cod',
  },
];
</script>
