import { createI18n } from 'vue-i18n';
import messages from '@/i18n';

export default createI18n({
  locale: navigator.language.split('-')[0],
  legacy: false,
  messages,
});
