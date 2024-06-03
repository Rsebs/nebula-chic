import type { RouteRecordRaw } from 'vue-router';
import ErrorNotFound from '@/pages/ErrorNotFound.vue';
import IndexPage from '@/pages/IndexPage.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import ProductsPage from '@/pages/ProductsPage.vue';
import ProductTypesPage from '@/pages/ProductTypesPage.vue';
import SizesPage from '@/pages/SizesPage.vue';

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
        path: 'products',
        name: 'Products',
        component: ProductsPage,
      },
      {
        path: 'product-types',
        name: 'ProductTypes',
        component: ProductTypesPage,
      },
      {
        path: 'sizes',
        name: 'Sizes',
        component: SizesPage,
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
