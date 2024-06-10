import { createRouter, createWebHistory } from 'vue-router';
import { useUserStore } from '@/stores/userStore';
import routes from './routes';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  // const token = to.query.token;
  const token = '';
  const ip = to.query.ip;
  if (token && ip) {
    // Guardar el valor login como true en el store
    // Guardar el token en el store
    // Guardar el ip en el store
  }

  const userStore = useUserStore();

  switch (to.name) {
    case 'LoginSignUp':
      next();
      break;
    default:
      if (!userStore.login) {
        next({ name: 'LoginSignUp' });
      } else {
        next();
      }
      break;
  }
});

export default router;
