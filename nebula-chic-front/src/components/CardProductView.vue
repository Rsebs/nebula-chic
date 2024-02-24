<template>
  <q-card class="card">
    <q-img :src="`http://127.0.0.1:8000${product.images[0].path}`">
      <div class="absolute-bottom text-h6">
        <p>{{ product.name }}</p>
      </div>
      <template v-slot:loading>
        <q-spinner-dots color="primary" />
      </template>
    </q-img>

    <q-card-section>
      <p class="card__description">
        {{ product.description }}
      </p>
    </q-card-section>

    <q-card-section> $ {{ product.price }} </q-card-section>

    <q-card-actions>
      <q-btn class="col-12" color="secondary" :to="`/product/${product.id}`">
        {{ $t('btnSeeProduct') }}
      </q-btn>
    </q-card-actions>
  </q-card>
</template>

<script setup lang="ts">
import { Product } from 'src/interfaces/Product';

defineProps({
  product: {
    type: Object as () => Product,
    required: true,
  },
});
</script>

<style lang="scss" scoped>
.card {
  width: 100%;
  max-width: 250px;

  &__description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
}
</style>
