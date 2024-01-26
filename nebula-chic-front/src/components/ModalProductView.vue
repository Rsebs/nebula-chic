<template>
  <q-dialog v-model="showModal">
    <q-card dark>
      <q-card-section>
        <div class="text-overline">
          {{ $t("lblSizes") }}
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
        <div class="text-h5 q-mt-sm q-mb-xs">{{ oProduct.name }}</div>
        <div class="text-caption text-grey">{{ oProduct.description }}</div>
        <div>$ {{ oProduct.price }}</div>
      </q-card-section>
      <q-card-section>
        <q-carousel
          animated
          v-model="slide"
          arrows
          infinite
          swipeable
          :transition-duration="700"
          thumbnails
        >
          <q-carousel-slide
            v-for="(oImage, i) in oProduct.images"
            :key="i"
            :name="i"
            :img-src="`http://127.0.0.1:8000${oImage.path}`"
          />
        </q-carousel>
      </q-card-section>
      <q-card-actions align="center">
        <q-btn :label="$t('btnAddToCart')" color="secondary" icon="bi-cart2" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>
<script>
import { ref, watch } from "vue";
import { defineComponent } from "vue";

export default defineComponent({
  name: "ModalProductView",
  props: {
    oProduct: {
      type: Object,
      default: null,
      required: true,
    },
    bShowModal: {
      type: Boolean,
      required: true,
    },
  },
  setup(props, { emit }) {
    const showModal = ref(false);

    watch(
      () => props.bShowModal,
      (newValue) => {
        showModal.value = newValue;
      }
    );

    watch(showModal, (newValor) => {
      emit("update:bShowModal", newValor);
    });

    const slide = ref(0);

    return {
      showModal,
      slide,
    };
  },
});
</script>
