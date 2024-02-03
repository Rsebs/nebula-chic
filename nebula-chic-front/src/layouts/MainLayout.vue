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
            <template v-for="oProduct in oProductStore.cart" :key="oProduct.id">
              <q-item v-ripple>
                <q-item-section>
                  <q-item-label>{{ oProduct.name }}</q-item-label>
                  <q-item-label>{{ oProduct.price }}</q-item-label>
                </q-item-section>
                <q-item-section avatar>
                  <q-avatar rounded>
                    <img :src="`http://127.0.0.1:8000${oProduct.image}`" />
                  </q-avatar>
                </q-item-section>
              </q-item>
              <q-separator />
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
      <q-scroll-area class="fit" :horizontal-thumb-style="{ opacity: 0 }">
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

<script>
import { ref } from "vue";
import MenuView from "src/components/MenuView.vue";
import { defineComponent } from "vue";
import { useProductStore } from "src/stores/product";

export default defineComponent({
  name: "MainLayout",
  components: {
    MenuView,
  },
  setup() {
    const oProductStore = useProductStore();
    console.log(process.env.SERVER_URL);

    return {
      drawer: ref(false),
      miniState: ref(true),
      oProductStore,
    };
  },
});
</script>
