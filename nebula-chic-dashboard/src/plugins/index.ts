// Plugins
import vuetify from '@/plugins/vuetify';
import router from '@/router';
import pinia from '@/stores';
import i18n from '@/plugins/i18n';

// Types
import type { App } from 'vue';

export function registerPlugin(app: App) {
  app
    .use(vuetify)
    .use(router)
    .use(pinia)
    .use(i18n);
}
