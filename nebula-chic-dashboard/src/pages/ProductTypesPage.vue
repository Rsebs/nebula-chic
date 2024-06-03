<template>
  <TableCRUD :tableTitle :endpoint :fields />
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import TableCRUD from '@/components/Tables/TableCRUD.vue';

const tableTitle = 'Productos';
const endpoint = 'product-types';

const fields: Fields[] = [
  {
    component: 'InputText',
    label: 'Nombre',
    nameKey: 'name',
  },
];
</script>
