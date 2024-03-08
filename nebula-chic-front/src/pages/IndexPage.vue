<template>
  <q-page>
    <CarouselView
      imageSrc="src/assets/img/carousel/"
      :images="['slide1.png', 'slide2.png', 'slide3.png']"
      :autoplay="5000"
    />
    <div class="q-pa-md container">
      <section class="q-my-md">
        <GridProductsView endpoint="products?type=1&perPage=8" />
      </section>

      <section class="q-my-lg">
        <q-img
          src="src/assets/img/banner.png"
          alt="image banner"
          class="rounded-borders"
          fit="contain"
        />
      </section>

      <section class="q-my-lg promotions">
        <h2 class="text-center">{{ $t('lblEspecialOffers') }}</h2>
      </section>

      <section class="q-my-md">
        <GridProductsView endpoint="products?type=2&perPage=8" />
      </section>
    </div>
  </q-page>
</template>

<script setup lang="ts">
import CarouselView from 'src/components/CarouselView.vue';
import GridProductsView from 'src/components/GridProductsView.vue';
</script>
