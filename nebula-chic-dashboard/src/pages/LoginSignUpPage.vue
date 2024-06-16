<template>
  <v-row>
    <v-col v-for="type in formTypes" :key="type" cols="12" md="6">
      <v-card class="h-100">
        <v-toolbar color="primary">
          <v-toolbar-title>{{ $t(type) }}</v-toolbar-title>
        </v-toolbar>
        <v-form
          v-model="formType[type].formValid"
          @submit.prevent="onSubmit(type)"
        >
          <v-card-text class="py-10 d-flex flex-column ga-4">
            <component
              v-for="(value, index) in formType[type].inputFields"
              :key="`${value.component}-${index}`"
              v-model="formType[type].dataFields[value.nameKey]"
              :is="morphComponent[value.component]"
              :label="value.label"
              :nameKey="value.nameKey"
              @onUpdateValue="
                (newValue, nameKey) => onUpdateValue(type, newValue, nameKey)
              "
            />
          </v-card-text>
          <v-card-actions class="d-flex justify-end">
            <v-btn type="submit" flat color="primary" :loading>
              {{ $t(type) }}
            </v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import { APIError } from '@/interfaces/APIResponseInterface/APIResponse';
import { isUserResponse } from '@/interfaces/APIResponseInterface/UserResponse';
import { morphComponent } from '@/components/Inputs';
import { onError } from '@/mixins/notifications';
import { reactive, ref } from 'vue';
import { useI18n } from 'vue-i18n';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/stores/userStore';
import axiosService from '@/services/axiosService';

interface FormData {
  formValid: boolean;
  dataFields: Record<string, string>;
  inputFields: Fields[];
}

interface FormType {
  login: FormData;
  signup: FormData;
}

const router = useRouter();
const { t } = useI18n();
const formTypes = ['login', 'signup'] as const;

const formType = reactive<FormType>({
  login: {
    formValid: false,
    dataFields: reactive({}),
    inputFields: [
      {
        component: 'InputText',
        label: t('email'),
        nameKey: 'email',
      },
      {
        component: 'InputPassword',
        label: t('password'),
        nameKey: 'password',
      },
    ],
  },
  signup: {
    formValid: false,
    dataFields: reactive({}),
    inputFields: [
      {
        component: 'InputText',
        label: t('name'),
        nameKey: 'name',
      },
      {
        component: 'InputText',
        label: t('email'),
        nameKey: 'email',
      },
      {
        component: 'InputPassword',
        label: t('password'),
        nameKey: 'password',
      },
      {
        component: 'InputPassword',
        label: t('confirmPassword'),
        nameKey: 'confirmPassword',
      },
    ],
  },
});
const loading = ref(false);

const onSubmit = async (type: keyof FormType) => {
  loading.value = true;
  if (!formType[type].formValid) return;

  if (type === 'signup') {
    const { password, confirmPassword } = formType[type].dataFields;
    if (password !== confirmPassword) {
      onError('Passwords do not match');
      return;
    }
  }

  try {
    const endpoint = type === 'login' ? 'login' : 'createUser';
    const { data } = await axiosService.post(
      endpoint,
      formType[type].dataFields
    );

    const userStore = useUserStore();
    if (isUserResponse(data)) {
      userStore.onSetUser(data);
      router.push({ name: 'Index' });
    }
  } catch (error) {
    console.error(error);
    if (error instanceof APIError) onError(t('error'), error.data.message);
  }
  loading.value = false;
};

const onUpdateValue = (type: keyof FormType, value: string, key: string) => {
  formType[type].dataFields[key] = value;
};
</script>
