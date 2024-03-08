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
      <div class="card__content">
        <p class="card__description">
          {{ product.description }}
        </p>
      </div>
    </q-card-section>

    <q-card-section>
      <p class="card__price">$ {{ product.price }}</p>
    </q-card-section>

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
@use '/src/css/quasar.variables.scss' as v;

.card {
  max-width: 250px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  &__price {
    background: transparentize(v.$info, 0.7%);
    display: inline;
    padding: 5px;
    border-radius: 3px;
  }

  &__description {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
}
</style>
