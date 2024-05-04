<template>
  <q-carousel
    v-model="slide"
    arrows
    infinite
    :animated
    :autoplay
    :swipeable
    :thumbnails
    :transition-duration="700"
  >
    <q-carousel-slide
      v-for="(image, i) in images"
      :key="i"
      :name="i"
      :img-src="`${imageSrc}${image}`"
    />
  </q-carousel>
</template>

<script setup lang="ts">
import { ref } from 'vue';

defineProps({
  images: {
    type: Array as () => Array<string>,
    required: true,
  },
  imageSrc: {
    type: String,
    required: true,
  },
  animated: {
    type: Boolean,
    required: false,
    default: true,
  },
  swipeable: {
    type: Boolean,
    required: false,
    default: true,
  },
  autoplay: {
    type: Number,
    required: false,
    default: 0,
  },
  thumbnails: {
    type: Boolean,
    required: false,
    default: false,
  },
});

const slide = ref(0);
</script>
