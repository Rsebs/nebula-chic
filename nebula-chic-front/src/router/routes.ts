import { RouteRecordRaw } from 'vue-router';
import MainLayout from 'layouts/MainLayout.vue';
import ErrorNotFound from 'src/pages/ErrorNotFound.vue';
import IndexPage from 'src/pages/IndexPage.vue';
import AboutPage from 'src/pages/AboutPage.vue';
import ContactPage from 'src/pages/ContactPage.vue';
import ProductPage from 'src/pages/ProductPage.vue';
import LoginPage from 'src/pages/LoginPage.vue';
import CreateAccountPage from 'src/pages/CreateAccountPage.vue';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: MainLayout,
    children: [
      {
        path: '',
        name: 'index',
        component: IndexPage,
      },
      {
        path: '/contact',
        name: 'contact',
        component: ContactPage,
      },
      {
        path: '/about',
        name: 'about',
        component: AboutPage,
      },
      {
        path: '/product/:productId',
        name: 'product',
        component: ProductPage,
      },
      {
        path: '/login',
        name: 'login',
        component: LoginPage,
      },
      {
        path: '/createAccount',
        name: 'createAccount',
        component: CreateAccountPage,
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
