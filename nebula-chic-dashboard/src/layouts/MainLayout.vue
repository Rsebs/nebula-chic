<template>
  <v-app>
    <v-layout>
      <v-navigation-drawer>
        <v-list>
          <v-list-item
            :prepend-avatar="user.avatar"
            :title="user.name"
            :subtitle="user.email"
          />
        </v-list>

        <v-divider />

        <v-list density="compact" nav>
          <v-list-item
            v-for="item in itemsList"
            :key="item.title"
            :to="item.to"
            :title="item.title"
            :prepend-icon="item.icon"
            exact
          />
        </v-list>
      </v-navigation-drawer>

      <v-main>
        <v-container>
          <router-view />
        </v-container>
      </v-main>
    </v-layout>

    <AppFooter />
  </v-app>
</template>

<script lang="ts" setup>
import AppFooter from '@/components/AppFooter.vue';

import { ref } from 'vue';

const user = ref({
  name: 'Sebs',
  avatar: 'https://github.com/rsebs.png',
  email: 'sebastianruizj2014@gmail.com',
});

const itemsList = ref([
  {
    title: 'Index',
    icon: 'mdi-home',
    to: { name: 'Index' },
  },
  {
    title: 'Products',
    icon: 'mdi-tshirt-v',
    to: { name: 'Products' },
  },
  {
    title: 'ProductTypes',
    icon: 'mdi-tshirt-v',
    to: { name: 'ProductTypes' },
  },
]);
</script>
