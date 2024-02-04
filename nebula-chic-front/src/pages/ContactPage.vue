<template>
  <q-page padding>
    <div class="form-contact">
      <h2 class="text-center text-weight-bold">{{ $t('lblContactUs') }}</h2>
      <q-form
        class="row q-col-gutter-md"
        @submit.prevent="onSendForm"
        ref="rForm"
      >
        <q-input
          v-model="sName"
          :label="$t('lblName')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[validationRules.required]"
          lazy-rules
        />

        <q-input
          v-model="sLastName"
          :label="$t('lblLastName')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[validationRules.required]"
          lazy-rules
        />

        <q-input
          v-model="sEmail"
          :label="$t('lblEmail')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[validationRules.required, validationRules.email]"
          lazy-rules
        />

        <q-input
          v-model="sPhone"
          :label="$t('lblPhone')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
        />

        <q-input
          v-model="sAddress"
          :label="$t('lblAddress')"
          class="col-12"
          color="secondary"
          outlined
        />

        <q-input
          v-model="sMessage"
          :label="$t('lblYourMessageHere')"
          type="textarea"
          class="col-12"
          color="secondary"
          outlined
          :rules="[validationRules.required]"
          lazy-rules
        />

        <div class="col-12 row justify-center">
          <q-btn
            :label="$t('btnSubmit')"
            type="submit"
            icon="bi-send"
            color="accent"
          />
          <q-btn
            :label="$t('btnReset')"
            type="reset"
            icon="bi-x"
            class="q-ml-md"
            color="accent"
          />
        </div>
      </q-form>
    </div>
  </q-page>
</template>

<script>
import { defineComponent, ref } from 'vue';
import { useTranslation } from 'src/services/i18nService';
import { onShowNotify } from 'src/services/notifyService';
import validationRules from 'src/utils/validationRules';

export default defineComponent({
  name: 'ContactPage',
  setup() {
    function onSendForm() {
      onShowNotify(t('lblThanksForContact'));
      rForm.value.resetValidation();
      onResetForm();
    }

    function onResetForm() {
      sName.value = null;
      sLastName.value = null;
      sEmail.value = null;
      sPhone.value = null;
      sAddress.value = null;
      sMessage.value = null;
    }

    const { t } = useTranslation();

    const rForm = ref(null);
    const sName = ref('');
    const sLastName = ref('');
    const sEmail = ref('');
    const sPhone = ref('');
    const sAddress = ref('');
    const sMessage = ref('');

    return {
      rForm,
      sName,
      sLastName,
      sEmail,
      sPhone,
      sAddress,
      sMessage,
      validationRules,
      onSendForm,
    };
  },
});
</script>
