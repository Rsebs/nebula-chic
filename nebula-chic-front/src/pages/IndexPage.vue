<template>
  <q-page>
    <CarouselView />
    <div class="q-pa-md">
      <Suspense>
        <template #default>
          <GridProductsView sEndpoint="products?type=1&perPage=8" />
        </template>
        <template #fallback>
          <div class="row justify-center q-pt-md">
            <q-spinner-oval color="accent" size="4em" />
          </div>
        </template>
      </Suspense>

      <h1 class="text-center">Banner</h1>

      <Suspense>
        <template #default>
          <GridProductsView sEndpoint="products?type=2&perPage=8" />
        </template>
        <template #fallback>
          <div class="row justify-center q-pt-md">
            <q-spinner-oval color="accent" size="4em" />
          </div>
        </template>
      </Suspense>
    </div>
  </q-page>
</template>

<script>
import { defineComponent } from "vue";
import CarouselView from "components/CarouselView.vue";
import GridProductsView from "components/GridProductsView.vue";

export default defineComponent({
  name: "IndexPage",
  components: {
    CarouselView,
    GridProductsView,
  },
});
</script>
