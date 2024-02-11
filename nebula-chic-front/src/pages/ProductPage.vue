<template>
  <q-page>
    <div class="q-pa-md">
      <template v-if="bLoading">
        <div class="row justify-center">
          <q-spinner-oval color="accent" size="4em" />
        </div>
      </template>
      <template v-else>
        <div class="row">
          <div class="col-12 col-md-6">
            <p class="text-h5 text-center q-mb-md text-uppercase text-bold">
              {{ oProduct.name }}
            </p>
            <div>
              <div class="text-overline q-mb-md">
                {{ $t('lblSizes') }}
                <div class="row q-gutter-xs">
                  <q-badge
                    v-for="oSize in oProduct.sizes"
                    :key="oSize.id"
                    color="secondary"
                  >
                    {{ oSize.cod }}
                  </q-badge>
                </div>
              </div>

              <p class="text-body1 q-mb-lg">{{ oProduct.description }}</p>

              <div class="q-mb-md">
                <q-chip size="lg" color="green" text-color="white" dense square>
                  $ {{ oProduct.price }}
                </q-chip>
              </div>

              <q-btn
                :label="$t('btnAddToCart')"
                color="secondary"
                icon="bi-cart2"
                @click="onAddToCart(oProduct)"
              />
            </div>
          </div>
          <div class="col-12 col-md-6">
            <CarouselView
              sImgSource="http://127.0.0.1:8000"
              :aImages="aImagesProduct"
              :thumbnails="true"
            />
          </div>
        </div>
      </template>
    </div>
  </q-page>
</template>
<script>
import { defineComponent, onMounted, ref } from 'vue';
import axiosService from 'src/services/axiosService';
import { onGetCurrentUrlParams } from 'src/services/routerService';
import { onShowNotify } from 'src/services/notifyService';
import { useTranslation } from 'src/services/i18nService';
import { useProductStore } from 'src/stores/product';
import CarouselView from 'src/components/CarouselView.vue';

export default defineComponent({
  name: 'ProductPage',
  components: {
    CarouselView,
  },
  setup() {
    onMounted(() => {
      onGetProduct();
    });

    async function onGetProduct() {
      try {
        bLoading.value = true;
        const oRouteParams = onGetCurrentUrlParams();
        const oResponse = await axiosService.onAxiosGet(
          `products/${oRouteParams.productId}`
        );

        if (oResponse.statusCode !== 200) {
          throw oResponse;
        }

        oProduct.value = oResponse.data;
        aImagesProduct.value = oProduct.value.images.map(
          (oImage) => oImage.path
        );

        bLoading.value = false;
      } catch (error) {
        console.error(error.message, error.statusCode);
        onShowNotify(t('lblMessageError'), true);
      }
    }

    function onAddToCart(oProduct) {
      const oToCart = {
        id: oProduct.id,
        name: oProduct.name,
        price: oProduct.price,
        image: oProduct.images[0].path,
        amount: 1,
      };

      if (
        oProductStore.aCart.some(
          (oProductCart) => oProductCart.id === oProduct.id
        )
      ) {
        oProductStore.onChangeAmountProduct(oProduct);
      } else {
        oProductStore.onAddProductToCart(oToCart);
      }

      onShowNotify(t('lblProductAdd'));
    }

    const { t } = useTranslation();
    const oProductStore = useProductStore();

    const bLoading = ref(false);
    const oProduct = ref({});
    const aImagesProduct = ref([]);

    return {
      bLoading,
      oProduct,
      aImagesProduct,
      onAddToCart,
    };
  },
});
</script>
