<template>
  <q-item :to="{ name: pathName }" clickable v-ripple>
    <q-item-section avatar>
      <q-icon :name="icon" />
    </q-item-section>
    <q-item-section>{{ title }}</q-item-section>
  </q-item>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "MenuLinkView",
  props: {
    title: {
      type: String,
      required: true,
    },

    pathName: {
      type: String,
      default: "#",
    },

    icon: {
      type: String,
      default: "",
    },
  },
});
</script>
