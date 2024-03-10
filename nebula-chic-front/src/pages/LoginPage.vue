<template>
  <q-page padding>
    <q-form
      @submit.prevent="onLogin"
      autofocus
      class="form row justify-center items-center"
    >
      <q-card class="form__card row q-py-md col-12 col-md-4 items-center">
        <q-card-section align="center" class="col-12">
          <q-icon name="bi-person-circle" size="10em" color="secondary" />

          <h2 class="text-h4 text-primary text-uppercase text-center">
            {{ $t('txtLog') }}
            <span class="text-secondary">{{ $t('txtIn') }}</span>
          </h2>
        </q-card-section>

        <q-card-actions class="col-12">
          <q-input
            v-model="email"
            :label="$t('lblEmail')"
            :rules="[validationRules.required, validationRules.email]"
            color="primary"
            outlined
            dense
            class="col-12 col-sm-6 q-px-sm q-mb-sm"
          />
          <q-input
            v-model="password"
            :label="$t('lblPassword')"
            :rules="[validationRules.required]"
            color="primary"
            outlined
            dense
            class="col-12 col-sm-6 q-px-sm q-mb-sm"
          />
        </q-card-actions>

        <q-card-actions align="center" class="col-12 q-gutter-y-md">
          <q-btn type="submit" color="primary" :label="$t('btnLogin')" />

          <p class="col-12 text-center text-subtitle1">
            {{ $t('txtYouDoNotHaveAnAccount') }}
            <RouterLink :to="{ name: 'createAccount' }" class="form__link">
              {{ $t('btnCreateAccount') }}
            </RouterLink>
          </p>
        </q-card-actions>
      </q-card>
    </q-form>
  </q-page>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import validationRules from 'src/utils/validationRules';
import { RouterLink } from 'vue-router';

const email = ref('');
const password = ref('');

const onLogin = () => {
  alert('Login');
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
