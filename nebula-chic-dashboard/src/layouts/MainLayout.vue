<template>
  <v-app>
    <v-layout>
      <v-app-bar color="primary" prominent>
        <v-app-bar-nav-icon
          variant="text"
          icon="mdi-view-dashboard"
          @click.stop="drawer = !drawer"
        />

        <v-toolbar-title>Nebula Chic Dashboard</v-toolbar-title>

        <v-spacer />

        <v-btn variant="text">
          <v-icon size="x-large">mdi-dots-vertical</v-icon>
          <v-menu activator="parent">
            <v-list>
              <v-list-item>
                <v-list-item-title>
                  <v-btn
                    prepend-icon="mdi-theme-light-dark"
                    @click="onChangeTheme"
                  >
                    Cambiar tema
                  </v-btn>
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-btn>
      </v-app-bar>

      <v-navigation-drawer v-model="drawer">
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
import { useDisplay, useTheme } from 'vuetify';

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
  {
    title: 'Sizes',
    icon: 'mdi-tshirt-v',
    to: { name: 'Sizes' },
  },
]);

const { mobile } = useDisplay();
const drawer = ref(!mobile.value);
const theme = useTheme();

const onChangeTheme = () => {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark';
};
</script>
