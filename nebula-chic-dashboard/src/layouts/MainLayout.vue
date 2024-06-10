<template>
  <v-app>
    <v-layout>
      <v-app-bar color="primary" prominent>
        <v-app-bar-nav-icon
          v-if="userStore.login"
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
                    {{ $t('changeTheme') }}
                  </v-btn>
                  <v-btn
                    v-if="userStore.login"
                    prepend-icon="mdi-logout"
                    @click="onLogout"
                  >
                    {{ $t('logout') }}
                  </v-btn>
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </v-btn>
      </v-app-bar>

      <v-navigation-drawer v-if="userStore.login" v-model="drawer">
        <v-list>
          <v-list-item
            :prepend-avatar="userStore.user.avatarUrl"
            :title="userStore.user.name"
            :subtitle="userStore.user.email"
          />
        </v-list>

        <v-divider />

        <MenuView />
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
import MenuView from '@/components/MenuView.vue';

import { ref } from 'vue';
import { useDisplay, useTheme } from 'vuetify';
import { useUserStore } from '../stores/userStore';
import { useRouter } from 'vue-router';

const { mobile } = useDisplay();
const drawer = ref(!mobile.value);
const theme = useTheme();
const userStore = useUserStore();
const router = useRouter();

const onChangeTheme = () => {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark';
};

const onLogout = () => {
  userStore.onLogout();
  router.push({ name: 'LoginSignUp' });
};
</script>
