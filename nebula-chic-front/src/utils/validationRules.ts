// import { useI18n } from 'vue-i18n';

// function useTranslation() {
//   const { t } = useI18n();

//   return { t };
// }
/** Queda pendiente mostrar las validaciones traducidas */

export default {
  required: (v: string) => (v && v.length > 0) || 'Este campo es requerido',
  email: (v: string) =>
    /^$|^[\w.%+-]+@[\w.-]+\.[a-zA-Z]{2,}$/g.test(v) ||
    'No es un correo electrónico válido',
};
