<template>
  <v-data-table-server
    v-model:items-per-page="itemsPerPage"
    :headers
    :items-length="totalItems"
    :items="dataTable"
    :loading
    density="comfortable"
    fixed-header
    height="65vh"
    @update:options="onFetchData"
  >
    <template #top>
      <v-toolbar flat>
        <v-toolbar-title>{{ tableTitle }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn color="primary" @click="onShowModal()">
          {{ $t('newRegistration') }}
        </v-btn>
      </v-toolbar>
    </template>
    <template #item.actions="{ item }: { item: ItemTable }">
      <div class="d-flex">
        <v-btn
          variant="text"
          color="primary"
          icon="mdi-pencil"
          @click="onShowModal(item.id)"
        />
        <v-btn
          variant="text"
          color="red"
          icon="mdi-delete"
          @click="onDeleteItem(item.id)"
        />
      </div>
    </template>
  </v-data-table-server>

  <ModalForm
    v-model="showModal"
    :key="showModalKey"
    :title="tableTitle"
    :idItemEdit
    :fields
    :endpoint
    @onClose="onClose"
  />
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import type {
  HeaderDataTable,
  ItemTable,
} from '@/interfaces/ComponentInterface/TableComponentInterface';
import {
  APIError,
  type DataResponse,
} from '@/interfaces/APIResponseInterface/APIResponse';
import { onError, onSuccess, onWarning } from '@/mixins/notifications';
import { ref, type Ref } from 'vue';
import { useI18n } from 'vue-i18n';
import axiosService from '@/services/axiosService';
import ModalForm from '@/components/Modals/ModalForm.vue';

const { endpoint, paramsEndpoint } = defineProps({
  tableTitle: {
    type: String,
    required: true,
  },
  endpoint: {
    type: String,
    required: true,
  },
  paramsEndpoint: {
    type: Object,
    default: () => ({}),
    required: false,
  },
  fields: {
    type: Array as () => Fields[],
    default: () => [],
  },
});

const dataTable: Ref<DataResponse[]> = ref([]);
const headers: Ref<HeaderDataTable[]> = ref([]);
const loading = ref(false);
const showModal = ref(false);
const showModalKey = ref(0);
const idItemEdit = ref(0);
const itemsPerPage = ref(10);
const pageTable = ref(1);
const sortTable = ref({});
const totalItems = ref(0);
const { t } = useI18n();

const onFetchData = async ({
  page,
  itemsPerPage,
  sortBy,
}: {
  page: number;
  itemsPerPage: number;
  sortBy: object;
}) => {
  loading.value = true;
  try {
    const { data, paginate } = await axiosService.get(endpoint, {
      params: {
        ...paramsEndpoint,
        page,
        perPage: itemsPerPage,
        sortBy,
      },
    });

    sortTable.value = sortBy;
    pageTable.value = page;
    totalItems.value = paginate.total;

    onSetTable(data);
  } catch (error) {
    console.error(error);
    if (error instanceof APIError) {
      const { data } = error;
      onError(data.message);
    }
  }
  loading.value = false;
};

const onSetTable = (data: DataResponse[]) => {
  dataTable.value = data;

  headers.value = [];
  headers.value.push({
    title: '',
    align: 'center',
    sortable: false,
    key: 'actions',
  });

  Object.keys(dataTable.value[0]).forEach((key) => {
    if (key.endsWith('_id')) return;

    headers.value.push({
      title: t(key),
      align: 'center',
      sortable: true,
      key: key,
    });
  });
};

const onDeleteItem = async (idItem: number) => {
  try {
    const result = await onWarning(t('warning'), t('delete'), t('cancel'));

    if (!result) return;

    if (result.isConfirmed) {
      const { message } = await axiosService.delete(`${endpoint}/${idItem}`);

      onSuccess(message);
      onReloadData();
    }
  } catch (error) {
    console.error(error);
    if (error instanceof APIError) {
      const { data } = error;
      onError(data.message);
    }
  }
};

const onShowModal = (idItem: number = 0) => {
  if (idItem !== 0) idItemEdit.value = idItem;

  showModal.value = true;
  showModalKey.value += 1;
};

const onClose = (value: boolean) => {
  showModal.value = value;
  idItemEdit.value = 0;
  onReloadData();
};

const onReloadData = () => {
  onFetchData({
    page: pageTable.value,
    itemsPerPage: itemsPerPage.value,
    sortBy: sortTable.value,
  });
};
</script>
