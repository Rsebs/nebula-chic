import { useRouter } from 'vue-router';

export function onGetCurrentUrlParams() {
  return useRouter().currentRoute.value.params;
}
