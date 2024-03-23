import { defineStore } from 'pinia';
import { User } from '../interfaces/User';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: {} as User,
    login: false,
  }),
  actions: {
    setUser(user: User) {
      this.user = user;
    },
    setLogin(login: boolean) {
      this.login = login;
    }
  },
  persist: {
    enabled: true,
  },
});
