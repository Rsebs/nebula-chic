<template>
  <q-carousel
    animated
    v-model="slide"
    arrows
    infinite
    :autoplay="5000"
    swipeable
    :transition-duration="700"
  >
    <q-carousel-slide
      v-for="i in 3"
      :key="i"
      :name="i"
      :img-src="`src/assets/img/carousel/slide${i}.png`"
    />
  </q-carousel>
</template>

<script>
import { ref } from "vue";
import { defineComponent } from "vue";

export default defineComponent({
  name: "CarouselView",
  setup() {
    return {
      slide: ref(1),
    };
  },
});
</script>
