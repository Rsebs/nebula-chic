<template>
  <div class="row grid-cards q-gutter-lg q-mt-lg">
    <CardProductView
      v-for="oProduct in aProducts"
      :key="oProduct.id"
      :oProduct="oProduct"
    />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CardProductView from "components/CardProductView.vue";
import axiosService from "src/services/axiosService";

export default defineComponent({
  name: "GridProductsView",
  components: {
    CardProductView,
  },
  props: {
    sEndpoint: {
      type: String,
      required: true,
    },
  },
  async setup(props) {
    const aProducts = await axiosService
      .onAxiosGet(props.sEndpoint)
      .then((oResponse) => oResponse.data);

    return {
      aProducts,
    };
  },
});
</script>
