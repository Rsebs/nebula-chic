<template>
  <q-page>
    <CarouselView
      sImgSource="src/assets/img/carousel/"
      :aImages="['slide1.png', 'slide2.png', 'slide3.png']"
      :autoplay="5000"
    />
    <div class="q-pa-md container">
      <Suspense>
        <template #default>
          <GridProductsView sEndpoint="products?type=1&perPage=8" />
        </template>
        <template #fallback>
          <div class="row justify-center q-my-xl">
            <q-spinner-oval color="accent" size="4em" />
          </div>
        </template>
      </Suspense>

      <div class="q-my-xl">
        <q-img
          src="src/assets/img/banner.png"
          alt="image banner"
          fit="contain"
          class="rounded-borders"
        />
      </div>

      <div class="q-my-xl promotions">
        <h2 class="text-center">¡Tenemos ofertas especiales!</h2>
      </div>

      <Suspense>
        <template #default>
          <GridProductsView sEndpoint="products?type=2&perPage=8" />
        </template>
        <template #fallback>
          <div class="row justify-center q-my-xl">
            <q-spinner-oval color="accent" size="4em" />
          </div>
        </template>
      </Suspense>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from 'vue';
import CarouselView from 'components/CarouselView.vue';
import GridProductsView from 'components/GridProductsView.vue';

export default defineComponent({
  name: 'IndexPage',
  components: {
    CarouselView,
    GridProductsView,
  },
});
</script>
