<template>
  <v-footer height="40" app>
    <a
      v-for="item in items"
      :key="item.title"
      :href="item.href"
      :title="item.title"
      class="d-inline-block mx-2 social-link"
      rel="noopener noreferrer"
      target="_blank"
    >
      <v-icon :icon="item.icon" :size="item.icon === '$vuetify' ? 24 : 16" />
    </a>

    <div
      class="text-caption text-disabled"
      style="position: absolute; right: 16px"
    >
      &copy; 2018-{{ new Date().getFullYear() }}
      <span class="d-none d-sm-inline-block">Rsebs, DEV</span>
      —
      <span
        class="text-decoration-none on-surface"
        rel="noopener noreferrer"
        target="_blank"
      >
        all rights reserved {{ new Date().getFullYear() }}
      </span>
    </div>
  </v-footer>
</template>

<script setup lang="ts">
const items = [
  {
    title: 'Vuetify Documentation',
    icon: '$vuetify',
    href: 'https://vuetifyjs.com/',
  },
  {
    title: 'Rsebs GitHub',
    icon: 'mdi-github',
    href: 'https://github.com/Rsebs',
  },
];
</script>

<style scoped lang="scss">
.social-link :deep(.v-icon) {
  color: rgba(var(--v-theme-on-background), var(--v-disabled-opacity));
  text-decoration: none;
  transition: 0.2s ease-in-out;

  &:hover {
    color: rgba(25, 118, 210, 1);
  }
}
</style>
