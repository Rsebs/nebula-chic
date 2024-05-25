import { registerPlugin } from '@/plugins';
import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';

const app = createApp(App);

registerPlugin(app);

app.mount('#app');
