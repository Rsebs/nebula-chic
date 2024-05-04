<template>
  <q-page padding>
    <div class="form-contact">
      <h2 class="text-center text-weight-bold">{{ $t('lblContactUs') }}</h2>
      <q-form
        class="row q-col-gutter-md"
        @submit.prevent="onSendForm"
        @reset="onResetForm"
      >
        <q-input
          v-model="form.name"
          :label="$t('lblName')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[validationRules.required]"
          lazy-rules
        />

        <q-input
          v-model="form.lastName"
          :label="$t('lblLastName')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[validationRules.required]"
          lazy-rules
        />

        <q-input
          v-model="form.email"
          :label="$t('lblEmail')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[validationRules.required, validationRules.email]"
          lazy-rules
        />

        <q-input
          v-model="form.phone"
          :label="$t('lblPhone')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
        />

        <q-input
          v-model="form.address"
          :label="$t('lblAddress')"
          class="col-12"
          color="secondary"
          outlined
        />

        <q-input
          v-model="form.message"
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

<script setup lang="ts">
import { onShowNotify } from 'src/services/notifyService';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';
import validationRules from 'src/utils/validationRules';

const { t } = useI18n();

const form = ref({
  name: '',
  lastName: '',
  email: '',
  phone: '',
  address: '',
  message: '',
});

const onSendForm = () => {
  onShowNotify(t('lblThanksForContact'));
  onResetForm();
};

const onResetForm = () => {
  form.value.name = '';
  form.value.lastName = '';
  form.value.email = '';
  form.value.phone = '';
  form.value.address = '';
  form.value.message = '';
};
</script>
