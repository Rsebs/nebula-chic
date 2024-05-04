<template>
  <q-dialog v-model="showModal">
    <q-card class="modal-card">
      <q-bar class="bg-primary text-white">
        <q-icon name="checkroom" />
        <p class="modal-card__title-bar q-my-none q-ml-sm">
          {{ product.name }}
        </p>

        <q-space />

        <q-btn icon="bi-x" flat @click="onCloseModal" />
      </q-bar>
      <q-card-section>
        <h2 class="modal-card__title q-my-md">
          {{ product.name }}
        </h2>
        <hr />
        <p class="q-mb-md">
          {{ product.description }}
        </p>

        <q-chip
          size="md"
          color="accent"
          text-color="white"
          dense
          square
          class="q-mb-md q-mt-none q-mx-none"
        >
          $ {{ product.price }}
        </q-chip>

        <CarouselView
          :images="imagesProduct"
          image-src="http://127.0.0.1:8000"
          thumbnails
          class="modal-card__carousel"
        />
      </q-card-section>

      <q-card-actions align="center">
        <q-btn
          :label="$t('btnAddToCart')"
          color="secondary"
          icon="bi-cart2"
          class="q-mb-md"
          @click="onAddToCart(product)"
        />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script lang="ts" setup>
import { onShowNotify } from 'src/services/notifyService';
import { ProductResponse, ProductCart } from '../interfaces/ProductResponse';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useProductStore } from 'src/stores/product';
import CarouselView from './CarouselView.vue';

const { value, product } = defineProps({
  value: {
    type: Boolean,
    required: true,
  },
  product: {
    type: Object as () => ProductResponse,
    required: true,
  },
});

const { t } = useI18n();
const storeProduct = useProductStore();

const showModal = ref(value);

const imagesProduct = product.images.map((image) => image.path);

const onCloseModal = () => {
  showModal.value = false;
};

const onAddToCart = ({ id, name, price, images }: ProductResponse) => {
  const productCart: ProductCart = {
    id,
    name,
    price,
    imagePath: images[0].path,
    amount: 1,
  };

  if (storeProduct.cart.some(({ id }) => id === product.id)) {
    storeProduct.onChangeAmountProduct(productCart);
  } else {
    storeProduct.onAddProductToCart(productCart);
  }

  onShowNotify(t('lblProductAdd'));
};
</script>

<style lang="scss" scoped>
@use '/src/css/base/mixins' as m;
@use '/src/css/quasar.variables.scss' as v;

.modal-card {
  @include m.desktop {
    min-width: 70%;
  }

  &__title-bar {
    font-size: 11px;

    @include m.tablet {
      font-size: 15px;
    }
  }

  &__title {
    font-size: 20px;
    line-height: 1.5;
    font-weight: 400;
    color: v.$dark-gray;
  }

  &__carousel {
    @include m.desktop {
      max-width: 50%;
      margin: 0 auto;
    }
  }
}
</style>
