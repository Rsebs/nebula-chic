import AboutPage from '@/pages/AboutPage.vue';
import IndexPage from '@/pages/IndexPage.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import type { RouteRecordRaw } from 'vue-router';
import ErrorNotFound from '@/pages/ErrorNotFound.vue';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: '',
        name: 'Index',
        component: IndexPage,
      },
      {
        path: 'about',
        name: 'About',
        component: AboutPage,
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: ErrorNotFound,
  },
];

export default routes;
