<template>
  <q-page>
    <CarouselView
      imageSrc="src/assets/img/carousel/"
      :images="['slide1.png', 'slide2.png', 'slide3.png']"
      :autoplay="5000"
    />
    <div class="q-pa-md container">
      <GridProductsView endpoint="products?type=1&perPage=8" />

      <div class="q-my-xl">
        <q-img
          src="src/assets/img/banner.png"
          alt="image banner"
          fit="contain"
          class="rounded-borders"
        />
      </div>

      <div class="q-my-xl promotions">
        <h2 class="text-center">{{ $t('lblEspecialOffers') }}</h2>
      </div>

      <GridProductsView endpoint="products?type=2&perPage=8" />
    </div>
  </q-page>
</template>

<script setup lang="ts">
import CarouselView from 'src/components/CarouselView.vue';
import GridProductsView from 'src/components/GridProductsView.vue';
</script>
