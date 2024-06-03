<template>
  <TableCRUD :tableTitle :endpoint :fields />
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import TableCRUD from '@/components/Tables/TableCRUD.vue';

const tableTitle = 'Productos';
const endpoint = 'products';

const fields: Fields[] = [
  {
    component: 'InputText',
    label: 'Nombre',
    nameKey: 'name',
  },
  {
    component: 'InputNumber',
    label: 'Precio',
    nameKey: 'price',
  },
  {
    component: 'InputTextarea',
    label: 'Descripción',
    nameKey: 'description',
  },
  {
    component: 'InputSelect',
    label: 'Tipo de producto',
    nameKey: 'product_type_id',
    endpointSelect: 'sltProductTypes',
  },
  {
    component: 'InputMultiSelect',
    label: 'Talla',
    nameKey: 'sizes_id',
    endpointSelect: 'sltSizes',
    required: false,
  },
  {
    component: 'InputMultiFile',
    label: 'Imágenes',
    nameKey: 'images',
    required: false,
  },
];
</script>
