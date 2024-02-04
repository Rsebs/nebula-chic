<template>
  <q-card class="card">
    <q-img :src="`http://127.0.0.1:8000${oProduct.images[0].path}`">
      <div class="absolute-bottom text-h6">
        <p>{{ oProduct.name }}</p>
      </div>
      <template v-slot:loading>
        <q-spinner-dots color="primary" />
      </template>
    </q-img>

    <q-card-section>
      <p class="card__description">
        {{ oProduct.description }}
      </p>
    </q-card-section>

    <q-card-section> $ {{ oProduct.price }} </q-card-section>

    <q-card-actions>
      <q-btn class="col-12" color="secondary" :to="`/product/${oProduct.id}`">
        {{ $t('btnSeeProduct') }}
      </q-btn>
    </q-card-actions>
  </q-card>
</template>

<script>
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'CardProductView',
  props: {
    oProduct: {
      type: Object,
      required: true,
    },
  },
});
</script>

<style lang="scss" scoped>
.card {
  width: 100%;
  max-width: 250px;

  .card__description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
}
</style>
