<template>
  <MenuLinkView :title="$t('lblHome')" icon="bi-house" pathName="index" />

  <MenuLinkView
    :title="$t('lblContactUs')"
    icon="bi-envelope"
    pathName="contact"
  />

  <MenuLinkView :title="$t('lblAboutUs')" icon="bi-people" pathName="about" />

  <q-separator />
</template>

<script setup lang="ts">
import MenuLinkView from './MenuLinkView.vue';
</script>
