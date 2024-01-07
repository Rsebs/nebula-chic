<template>
  <q-page padding>
    <div class="form-contact">
      <h2 class="text-center text-weight-bold">{{ $t("lblContactUs") }}</h2>
      <q-form
        class="row q-col-gutter-md"
        @submit.prevent="onSendForm"
        @reset="onResetForm"
        ref="form"
      >
        <q-input
          v-model="name"
          :label="$t('lblName')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[rules.required]"
          lazy-rules
        />

        <q-input
          v-model="lastName"
          :label="$t('lblLastName')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[rules.required]"
          lazy-rules
        />

        <q-input
          v-model="email"
          :label="$t('lblEmail')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
          :rules="[rules.required, rules.email]"
          lazy-rules
        />

        <q-input
          v-model="phone"
          :label="$t('lblPhone')"
          class="col-12 col-sm-6"
          color="secondary"
          outlined
        />

        <q-input
          v-model="address"
          :label="$t('lblAddress')"
          class="col-12"
          color="secondary"
          outlined
        />

        <q-input
          v-model="message"
          :label="$t('lblYourMessageHere')"
          type="textarea"
          class="col-12"
          color="secondary"
          outlined
          :rules="[rules.required]"
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
import { defineComponent } from "vue";
import { ref } from "vue";
import { useQuasar } from "quasar";
import { useTranslation } from "src/services/i18nService";

export default defineComponent({
  name: "ContactPage",
  setup() {
    const form = ref(null),
      name = ref(""),
      lastName = ref(""),
      email = ref(""),
      phone = ref(""),
      address = ref(""),
      message = ref("");

    const $q = useQuasar();
    const { t } = useTranslation();

    const rules = {
      required: (v) => (v && v.length > 0) || t("vRequired"),
      email: (v) =>
        /^$|^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/g.test(v) || t("vEmail"),
    };

    function onSendForm() {
      $q.notify({
        message: t("lblThanksForContact"),
        position: "top-right",
        color: "secondary",
      });

      form.value.resetValidation();
      onResetForm();
    }

    function onResetForm() {
      name.value = null;
      lastName.value = null;
      email.value = null;
      phone.value = null;
      address.value = null;
      message.value = null;
    }

    return {
      form,
      name,
      lastName,
      email,
      phone,
      address,
      message,
      rules,
      onSendForm,
      onResetForm,
    };
  },
});
</script>
src/helpers/functions.js
