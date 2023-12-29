<template>
  <MenuLinkView
    :title="$t('lblHome')"
    icon="bi-house"
    :link="{ name: 'index' }"
  />

  <MenuLinkView
    :title="$t('lblContactUs')"
    icon="bi-envelope"
    :link="{ name: 'contact' }"
  />

  <MenuLinkView
    :title="$t('lblAboutUs')"
    icon="bi-people"
    :link="{ name: 'about' }"
  />

  <q-separator />
</template>

<script>
import { defineComponent } from "vue";
import MenuLinkView from "./MenuLinkView.vue";

export default defineComponent({
  name: "MenuView",
  components: {
    MenuLinkView,
  },
});
</script>
