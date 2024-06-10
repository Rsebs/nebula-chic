<template>
  <TableCRUD :tableTitle :endpoint :fields />
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import TableCRUD from '@/components/Tables/TableCRUD.vue';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const tableTitle = t('products');
const endpoint = 'products';

const fields: Fields[] = [
  {
    component: 'InputText',
    label: t('name'),
    nameKey: 'name',
  },
  {
    component: 'InputNumber',
    label: t('price'),
    nameKey: 'price',
  },
  {
    component: 'InputTextarea',
    label: t('description'),
    nameKey: 'description',
  },
  {
    component: 'InputSelect',
    label: t('productType'),
    nameKey: 'product_type_id',
    endpointSelect: 'sltProductTypes',
  },
  {
    component: 'InputMultiSelect',
    label: t('sizes'),
    nameKey: 'sizes_id',
    endpointSelect: 'sltSizes',
    required: false,
  },
  {
    component: 'InputMultiFile',
    label: t('images'),
    nameKey: 'images',
    required: false,
  },
];
</script>
