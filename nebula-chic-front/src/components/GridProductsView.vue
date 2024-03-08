<template>
  <div v-if="isLoading" class="row justify-center q-my-xl">
    <q-spinner-oval color="accent" size="4em" />
  </div>
  <div v-else class="grid-cards q-gutter-col-lg q-mt-lg">
    <CardProductView
      v-for="product in products"
      :key="product.id"
      :product="product"
    />
  </div>
</template>

<script setup lang="ts">
import { Product } from 'src/interfaces/Product';
import axiosService from 'src/services/axiosService';
import { onMounted, ref, Ref } from 'vue';
import { onShowNotify } from 'src/services/notifyService';
import CardProductView from './CardProductView.vue';
import { useI18n } from 'vue-i18n';

const props = defineProps({
  endpoint: {
    type: String,
    required: true,
  },
});

const products: Ref<Product[]> = ref([]);
const isLoading = ref(false);
const { t } = useI18n();

onMounted(() => {
  onFetchData();
});

const onFetchData = async () => {
  try {
    isLoading.value = true;
    const response = await axiosService.onAxiosGet(props.endpoint);

    if (response.statusCode !== 200) throw new Error('Something went wrong!');

    products.value = response.data;
    isLoading.value = false;
  } catch (error) {
    onShowNotify(t('lblMessageError'), true);
    console.error(error);
    isLoading.value = false;
  }
};
</script>
