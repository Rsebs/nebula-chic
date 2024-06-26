<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated class="bg-primary text-white">
      <q-toolbar>
        <q-btn flat @click="drawer = !drawer" round dense icon="bi-list" />

        <q-btn :to="{ name: 'index' }">
          <div class="row items-center q-col-gutter-x-sm">
            <q-img
              src="~assets/logo.svg"
              alt="Nebula Chic Logo"
              width="3.5em"
              fit="contain"
            />
            <span class="text-capitalize">Nebula Chic</span>
          </div>
        </q-btn>

        <q-space />

        <q-btn-dropdown v-if="userStore.login" :label="userStore.user.name">
          <q-list>
            <q-item>
              <q-item-section>
                <q-btn
                  :label="$t('btnLogout')"
                  flat
                  icon="logout"
                  @click="onLogout"
                />
              </q-item-section>
            </q-item>
          </q-list>
        </q-btn-dropdown>

        <q-btn v-else icon="bi-person-circle" :to="{ name: 'login' }" flat />

        <q-btn-dropdown icon="bi-cart2" :title="$t('lblCart')">
          <q-list>
            <template v-if="productStore.cart.length">
              <template
                v-for="oProduct in productStore.cart"
                :key="oProduct.id"
              >
                <q-item>
                  <q-item-section avatar>
                    <q-avatar rounded>
                      <q-img
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
                      @click="productStore.onChangeAmountProduct(oProduct)"
                      size="sm"
                      flat
                      color="green"
                      icon="bi-plus"
                    />
                    <q-btn
                      @click="
                        productStore.onChangeAmountProduct(oProduct, false)
                      "
                      size="sm"
                      flat
                      color="red"
                      icon="bi-dash"
                      :disabled="oProduct.amount === 1 ? true : false"
                    />
                    <q-btn
                      @click="onRemoveProduct(oProduct)"
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
import { onShowNotify, onShowNotifyActions } from 'src/services/notifyService';
import { ProductCart } from 'src/interfaces/ProductResponse';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useProductStore } from 'src/stores/product';
import { useUserStore } from '../stores/userStore';
import axiosService from 'src/services/axiosService';
import MenuView from 'src/components/MenuView.vue';

const { t } = useI18n();

const drawer = ref(false);
const miniState = ref(true);
const productStore = useProductStore();
const userStore = useUserStore();

const onBuyProducts = async () => {
  if (!userStore.login) {
    onShowNotify(t('lblPleaseRegisterOrLogin'), true);
    return;
  }

  const cart = productStore.cart.map(({ id, amount }) => {
    return {
      product_id: id,
      amount,
      user_id: userStore.user.id,
    };
  });

  const aBody = {
    cart,
  };

  try {
    const response = await axiosService.onAxiosPost('purchases', aBody);

    if (response.statusCode !== 201) throw new Error('Something went wrong!');

    onShowNotify(response.message);
    productStore.cart = []; // Revisar eliminar el carrito al realizar compra
  } catch (error) {
    onShowNotify(t('lblMessageError'));
    console.error(error);
  }
};

const onRemoveProduct = (product: ProductCart) => {
  onShowNotifyActions(t('lblRemoveProductCart'), () =>
    productStore.onRemoveProduct(product)
  );
};

const onLogout = () => {
  userStore.setLogin(false);
  userStore.setUser({
    id: 0,
    name: '',
    email: '',
    email_verified_at: '',
    created_at: '',
    updated_at: '',
  });
};
</script>
