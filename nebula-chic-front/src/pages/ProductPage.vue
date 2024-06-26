<template>
  <q-page padding>
    <section v-if="isLoading" class="row justify-center">
      <q-spinner-oval color="accent" size="4em" />
    </section>
    <section v-else class="row">
      <div class="col-12 col-md-6">
        <p class="text-h5 text-center q-mb-md text-uppercase text-bold">
          {{ product.name }}
        </p>
        <div>
          <div class="text-overline q-mb-md">
            {{ $t('lblSizes') }}
            <div class="row q-gutter-xs">
              <q-badge
                v-for="{ id, cod } in product.sizes"
                :key="id"
                color="secondary"
              >
                {{ cod }}
              </q-badge>
            </div>
          </div>

          <p class="text-body1 q-mb-lg">{{ product.description }}</p>

          <div class="q-mb-md">
            <q-chip size="lg" color="green" text-color="white" dense square>
              $ {{ product.price }}
            </q-chip>
          </div>

          <q-btn
            :label="$t('btnAddToCart')"
            color="secondary"
            icon="bi-cart2"
            @click="onAddToCart(product)"
            class="q-mb-md"
          />
        </div>
      </div>
      <div class="col-12 col-md-6">
        <CarouselView
          imageSrc="http://127.0.0.1:8000"
          :images="imagesProduct"
          :thumbnails="true"
        />
      </div>
    </section>
  </q-page>
</template>

<script setup lang="ts">
import { onGetCurrentUrlParams } from 'src/services/routerService';
import { onMounted, ref, Ref } from 'vue';
import { onShowNotify } from 'src/services/notifyService';
import { productDefault } from '../interfaces/defaults/ProductDefault';
import { ProductResponse, ProductCart } from 'src/interfaces/ProductResponse';
import { useI18n } from 'vue-i18n';
import { useProductStore } from 'src/stores/product';
import axiosService from 'src/services/axiosService';
import CarouselView from 'src/components/CarouselView.vue';

const { t } = useI18n();
const storeProduct = useProductStore();

const isLoading = ref(false);
const product: Ref<ProductResponse> = ref(productDefault);
const imagesProduct: Ref<string[]> = ref([]);

onMounted(() => {
  onGetProduct();
});

const onGetProduct = async () => {
  try {
    isLoading.value = true;
    const routeParams = onGetCurrentUrlParams();

    const response = await axiosService.onAxiosGet(
      `products/${routeParams.productId}`
    );

    if (response.statusCode !== 200) throw new Error('Something went wrong!');

    product.value = response.data;
    imagesProduct.value = product.value.images.map(({ path }) => path);

    isLoading.value = false;
  } catch (error) {
    onShowNotify(t('lblMessageError'), true);
    console.error(error);
  }
};

const onAddToCart = ({ id, name, price, images }: ProductResponse) => {
  const productCart: ProductCart = {
    id,
    name,
    price,
    imagePath: images[0].path,
    amount: 1,
  };

  if (storeProduct.cart.some(({ id }) => id === product.value.id)) {
    storeProduct.onChangeAmountProduct(productCart);
  } else {
    storeProduct.onAddProductToCart(productCart);
  }

  onShowNotify(t('lblProductAdd'));
};
</script>
