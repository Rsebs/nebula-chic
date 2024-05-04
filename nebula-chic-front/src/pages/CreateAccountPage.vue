<template>
  <q-page padding>
    <q-form
      @submit.prevent="onCreateAccount"
      autofocus
      class="form row justify-center items-center"
    >
      <q-card class="form__card row q-py-md col-12 col-md-4 items-center">
        <q-card-section align="center" class="col-12">
          <q-icon name="bi-person-circle" size="10em" color="secondary" />

          <h2 class="text-h4 text-primary text-uppercase text-center">
            {{ $t('txtCreate') }}
            <span class="text-secondary">{{ $t('txtAccount') }}</span>
          </h2>
        </q-card-section>

        <q-card-actions class="col-12">
          <q-input
            v-model="form.name"
            :label="$t('lblName')"
            :rules="[validationRules.required]"
            color="primary"
            outlined
            dense
            class="col-12 col-sm-6 q-px-sm q-mb-sm"
          />
          <q-input
            v-model="form.email"
            :label="$t('lblEmail')"
            :rules="[validationRules.required, validationRules.email]"
            color="primary"
            outlined
            dense
            class="col-12 col-sm-6 q-px-sm q-mb-sm"
          />
          <q-input
            v-model="form.password"
            type="password"
            :label="$t('lblPassword')"
            :rules="[validationRules.required]"
            color="primary"
            outlined
            dense
            class="col-12 col-sm-6 q-px-sm q-mb-sm"
          />
          <q-input
            v-model="form.confirmPassword"
            type="password"
            :label="$t('lblConfirmPassword')"
            :rules="[validationRules.required]"
            color="primary"
            outlined
            dense
            class="col-12 col-sm-6 q-px-sm q-mb-sm"
          />
        </q-card-actions>

        <q-card-actions align="center" class="col-12 q-gutter-y-md">
          <q-btn
            type="submit"
            color="primary"
            :label="$t('btnCreateAccount')"
          />

          <p class="col-12 text-center text-subtitle1">
            {{ $t('txtDoYouAlreadyHaveAnAccount') }}
            <RouterLink :to="{ name: 'login' }" class="form__link">
              {{ $t('btnLogin') }}
            </RouterLink>
          </p>
        </q-card-actions>
      </q-card>
    </q-form>
  </q-page>
</template>

<script setup lang="ts">
import { onShowNotify } from 'src/services/notifyService';
import { ref } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { useI18n } from 'vue-i18n';
import axiosService from 'src/services/axiosService';
import validationRules from 'src/utils/validationRules';

const { t } = useI18n();
const router = useRouter();

const form = ref({
  name: '',
  email: '',
  password: '',
  confirmPassword: '',
});

const onCreateAccount = async () => {
  if (form.value.password !== form.value.confirmPassword)
    return onShowNotify(t('txtPasswordNoMatch'), true);

  const body = {
    name: form.value.name,
    email: form.value.email,
    password: form.value.password,
  };

  try {
    const response = await axiosService.onAxiosPost('createUser', body);

    if (response.statusCode !== 200)
      throw new Error(`Error create user ${body.name}`);

    onShowNotify(response.message);
    router.push({ name: 'login' });
  } catch (error) {
    onShowNotify(`Error create user ${body.name}`, true);
    console.error(error);
  }
};
</script>

<style lang="scss" scoped>
@use '/src/css/quasar.variables.scss' as v;

.form {
  height: 80vh;

  &__card {
    min-height: 600px;
  }

  &__link {
    color: v.$secondary;
    text-decoration: none;
    transition-duration: 0.2s;

    &:hover {
      color: darken(v.$secondary, 20%);
    }
  }
}
</style>
