<template>
  <v-dialog v-model="valueModel" persistent max-width="500px">
    <v-form v-model="formValid" @submit.prevent="onSaveOrUpdate(idItemEdit)">
      <CardComponent
        v-model:loading="loading"
        :title="titleCard"
        @onClose="onClose"
      >
        <v-row>
          <v-col
            v-for="(value, index) in fields"
            :key="`${value.component}-${index}`"
            cols="12"
          >
            <component
              v-model="dataFields[value.nameKey]"
              :is="morphComponent[value.component]"
              :label="value.label"
              :nameKey="value.nameKey"
              :endpointSelect="value.endpointSelect"
              :required="value.required"
              @onUpdateValue="onUpdateValue"
            />
          </v-col>
        </v-row>

        <template #actions>
          <v-btn color="red" variant="text" @click="onClose"> Cancel </v-btn>
          <v-btn type="submit" color="success" variant="tonal" :loading>
            {{ saveOrEdit }}
          </v-btn>
        </template>
      </CardComponent>
    </v-form>
  </v-dialog>
</template>

<script lang="ts" setup>
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import { APIError } from '@/interfaces/APIResponseInterface/APIResponse';
import { computed, onMounted, ref, type Ref } from 'vue';
import { morphComponent } from '@/components/Inputs';
import { onError, onSuccess } from '@/mixins/notifications';
import { useI18n } from 'vue-i18n';
import axiosService from '@/services/axiosService';
import CardComponent from '@/components/CardComponent.vue';

const valueModel = defineModel();
const { title, idItemEdit, endpoint } = defineProps({
  title: {
    type: String,
    required: true,
    default: '',
  },
  idItemEdit: {
    type: Number,
    required: false,
    default: 0,
  },
  fields: {
    type: Array as () => Fields[],
    default: () => [],
  },
  endpoint: {
    type: String,
    required: true,
    default: '',
  },
});

const dataFields: Ref<Record<string, unknown>> = ref({});
const loading = ref(false);
const formValid = ref(false);

const { t } = useI18n();

const emits = defineEmits(['onClose']);

onMounted(() => {
  if (idItemEdit !== 0) onGetFormData();
});

const onClose = () => {
  emits('onClose', false);
};

const onUpdateValue = (value: unknown, key: unknown) => {
  if (typeof key === 'string') dataFields.value[key] = value;
};

const onSaveOrUpdate = async (idItemEdit: number = 0) => {
  if (!formValid.value) return;

  const modeEdit = idItemEdit !== 0 ? true : false;

  loading.value = true;
  try {
    const { message } = modeEdit
      ? await axiosService.put(`${endpoint}/${idItemEdit}`, dataFields.value)
      : await axiosService.post(endpoint, dataFields.value);

    onSuccess(message);
    onClose();
  } catch (error) {
    console.error(error);
    if (error instanceof APIError) {
      const { data } = error;
      onError(data.message);
    }
  }
  loading.value = false;
};

const onGetFormData = async () => {
  loading.value = true;
  try {
    const { data } = await axiosService.get(`${endpoint}/${idItemEdit}`);

    for (const key in data) {
      dataFields.value[key] = data[key];
    }
  } catch (error) {
    console.error(error);
  }
  loading.value = false;
};

const titleCard = computed(() =>
  idItemEdit === 0 ? `${t('new')} ${title}` : `${t('edit')} ${title}`
);

const saveOrEdit = computed(() => (idItemEdit === 0 ? t('save') : t('edit')));
</script>
