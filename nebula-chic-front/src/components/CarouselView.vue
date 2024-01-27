<template>
  <q-carousel
    :animated="animated"
    v-model="slide"
    arrows
    infinite
    :autoplay="autoplay"
    :swipeable="swipeable"
    :thumbnails="thumbnails"
    :transition-duration="700"
  >
    <q-carousel-slide
      v-for="(sImage, i) in aImages"
      :key="i"
      :name="i"
      :img-src="`${sImgSource}${sImage}`"
    />
  </q-carousel>
</template>

<script>
import { ref } from "vue";
import { defineComponent } from "vue";

export default defineComponent({
  name: "CarouselView",
  props: {
    aImages: {
      type: Array,
      required: true,
    },
    sImgSource: {
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
  },
  setup() {
    return {
      slide: ref(0),
    };
  },
});
</script>
