import { defineStore } from 'pinia';

export const useProductStore = defineStore('cart', {
  state: () => ({
    aCart: [],
  }),
  actions: {
    onAddProductToCart(oProduct) {
      this.aCart.push(oProduct);
    },
  },
  persist: {
    enabled: true,
  }
});
