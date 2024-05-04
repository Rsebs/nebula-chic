<template>
  <div v-if="isLoading" class="row justify-center q-my-xl">
    <q-spinner-oval color="accent" size="4em" />
  </div>
  <div v-else class="grid-cards q-gutter-col-lg q-mt-lg">
    <CardProductView
      v-for="product in products"
      :key="product.id"
      :product
    />
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref, Ref } from 'vue';
import { onShowNotify } from 'src/services/notifyService';
import { ProductResponse } from 'src/interfaces/ProductResponse';
import { useI18n } from 'vue-i18n';
import axiosService from 'src/services/axiosService';
import CardProductView from './CardProductView.vue';

const { endpoint } = defineProps({
  endpoint: {
    type: String,
    required: true,
  },
});

const products: Ref<ProductResponse[]> = ref([]);
const isLoading = ref(false);
const { t } = useI18n();

onMounted(() => {
  onFetchData();
});

const onFetchData = async () => {
  try {
    isLoading.value = true;
    const response = await axiosService.onAxiosGet(endpoint);

    if (response.statusCode !== 200)
      throw new Error(`Error fetching products ${endpoint}`);

    products.value = response.data;
    isLoading.value = false;
  } catch (error) {
    onShowNotify(t('lblMessageError'), true);
    isLoading.value = false;
    console.error(error);
  }
};
</script>
