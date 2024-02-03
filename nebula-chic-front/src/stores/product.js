import { defineStore } from "pinia";

export const useProductStore = defineStore("cart", {
  state: () => ({
    cart: [],
  }),
  actions: {
    onAddProductToCart(oProduct) {
      this.cart.push(oProduct);
    },
  },
});
