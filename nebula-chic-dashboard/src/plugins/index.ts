// Plugins
import vuetify from '@/plugins/vuetify';
import router from '@/router';
import pinia from '@/stores';

// Types
import type { App } from 'vue';

export function registerPlugin(app: App) {
  app
    .use(vuetify)
    .use(router)
    .use(pinia);
}
