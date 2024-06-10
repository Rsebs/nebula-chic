import { defineStore } from 'pinia';
import type { UserResponse } from '@/interfaces/APIResponseInterface/UserResponse';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: {} as UserResponse,
    login: false,
  }),
  actions: {
    onSetUser(user: UserResponse) {
      this.user = user;
      this.login = true;
    },
    onLogout() {
      this.user = {} as UserResponse;
      this.login = false;
    }
  },
  persist: {
    storage: sessionStorage,
    paths: ['user', 'login']
  },
});
