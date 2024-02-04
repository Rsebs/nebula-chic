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
import { defineComponent } from 'vue';
import CardProductView from 'components/CardProductView.vue';
import axiosService from 'src/services/axiosService';
import {onShowNotify} from 'src/services/notifyService';
import {useTranslation} from 'src/services/i18nService';

export default defineComponent({
  name: 'GridProductsView',
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
    const {t} = useTranslation();
    try {
      const oResponse = await axiosService.onAxiosGet(props.sEndpoint);

      if (oResponse.statusCode !== 200) {
        throw oResponse;
      }

      const aProducts = oResponse.data;

      return {
        aProducts,
      };
    } catch (error) {
      console.error(error.message, error.statusCode);
      onShowNotify(t('lblMessageError'), true);
    }
  },
});
</script>
