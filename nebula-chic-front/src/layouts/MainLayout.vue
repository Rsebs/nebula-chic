<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-btn flat @click="drawer = !drawer" round dense icon="bi-list" />

        <q-toolbar-title>
          <q-avatar>
            <img src="~assets/logo.svg" />
          </q-avatar>
          Nebula Chic
        </q-toolbar-title>

        <q-btn-dropdown icon="bi-cart2" :title="$t('lblCart')">
          <q-list>
            <template v-if="oProductStore.cart.length">
              <template
                v-for="oProduct in oProductStore.cart"
                :key="oProduct.id"
              >
                <q-item>
                  <q-item-section avatar>
                    <q-avatar rounded>
                      <img
                        :src="`http://127.0.0.1:8000${oProduct.imagePath}`"
                      />
                    </q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">
                      {{ oProduct.name }}
                    </q-item-label>
                    <q-item-label caption lines="1">
                      ${{ oProduct.price }}
                    </q-item-label>
                    <q-item-label caption lines="1">
                      {{ $t('lblAmount') }}: {{ oProduct.amount }}
                    </q-item-label>
                  </q-item-section>

                  <q-item-section side top>
                    <q-btn
                      @click="oProductStore.onChangeAmountProduct(oProduct)"
                      size="sm"
                      flat
                      color="green"
                      icon="bi-plus"
                    />
                    <q-btn
                      @click="
                        oProductStore.onChangeAmountProduct(oProduct, false)
                      "
                      size="sm"
                      flat
                      color="red"
                      icon="bi-dash"
                    />
                    <q-btn
                      @click="oProductStore.onRemoveProduct(oProduct)"
                      size="sm"
                      flat
                      color="red"
                      icon="bi-x"
                    />
                  </q-item-section>
                </q-item>
                <q-separator />
              </template>
              <q-item>
                <q-item-section>
                  <q-btn
                    @click="onBuyProducts"
                    :label="$t('lblBuy')"
                    color="secondary"
                  />
                </q-item-section>
              </q-item>
            </template>
            <template v-else>
              <q-item>
                <q-item-section>
                  <q-item-label>
                    <strong>{{ $t('lblNoProducts') }}</strong>
                  </q-item-label>
                </q-item-section>
              </q-item>
            </template>
          </q-list>
        </q-btn-dropdown>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="drawer"
      show-if-above
      :mini="miniState"
      @mouseover="miniState = false"
      @mouseout="miniState = true"
      mini-to-overlay
      :width="200"
      :breakpoint="500"
      bordered
      :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'"
    >
      <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: '0' }">
        <q-list padding>
          <MenuView />
        </q-list>
      </q-scroll-area>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">
import MenuView from 'src/components/MenuView.vue';
import { ref } from 'vue';
import { useProductStore } from 'src/stores/product';
import { onShowNotify } from 'src/services/notifyService';
import axiosService from 'src/services/axiosService';
import { useI18n } from 'vue-i18n';

const { t } = useI18n();

const drawer = ref(false);
const miniState = ref(true);
const oProductStore = useProductStore();

const onBuyProducts = async () => {
  const cart = oProductStore.cart.map((oProduct) => {
    return {
      product_id: oProduct.id,
      amount: oProduct.amount,
      user_id: 1, // User temporal hasta crear el login
    };
  });

  const aBody = {
    cart: cart,
  };

  try {
    const oResponse = await axiosService.onAxiosPost('purchases', aBody);

    if (oResponse.statusCode !== 201) throw new Error('Something went wrong!');

    onShowNotify(oResponse.message);
    oProductStore.cart = []; // Revisar eliminar el carrito al realizar compra
  } catch (error) {
    onShowNotify(t('lblMessageError'));
    console.error(error);
  }
};
</script>
