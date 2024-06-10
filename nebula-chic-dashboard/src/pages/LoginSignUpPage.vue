<template>
  <v-row>
    <v-col v-for="type in formTypes" :key="type" cols="12" md="6">
      <v-card class="h-100">
        <v-toolbar color="primary">
          <v-toolbar-title>{{ type }}</v-toolbar-title>
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
            <v-btn type="submit" flat color="primary">{{ type }}</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-col>
  </v-row>
</template>

<script setup lang="ts">
import type { Fields } from '@/interfaces/ComponentInterface/ModalFormInterface';
import { morphComponent } from '@/components/Inputs';
import { reactive } from 'vue';

interface FormData {
  formValid: boolean;
  dataFields: Record<string, unknown>;
  inputFields: Fields[];
}

interface FormType {
  login: FormData;
  signup: FormData;
}

const formTypes = ['login', 'signup'] as const;

const formType = reactive<FormType>({
  login: {
    formValid: false,
    dataFields: reactive({}),
    inputFields: [
      {
        component: 'InputText',
        label: 'Email',
        nameKey: 'email',
      },
      {
        component: 'InputPassword',
        label: 'Password',
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
        label: 'Name',
        nameKey: 'name',
      },
      {
        component: 'InputText',
        label: 'Email',
        nameKey: 'email',
      },
      {
        component: 'InputPassword',
        label: 'Password',
        nameKey: 'password',
      },
      {
        component: 'InputPassword',
        label: 'Confirm Password',
        nameKey: 'confirmPassword',
      },
    ],
  },
});

const onSubmit = (type: keyof FormType) => {
  if (!formType[type].formValid) return;

  alert(type);
};

const onUpdateValue = (type: keyof FormType, value: unknown, key: unknown) => {
  if (typeof key === 'string') formType[type].dataFields[key] = value;
};
</script>
