import { defineStore } from 'pinia';

const onCheckCart = (aCart) => aCart.filter((oProduct) => oProduct.amount > 0);

export const useProductStore = defineStore('cart', {
  state: () => ({
    aCart: [],
  }),
  actions: {
    onAddProductToCart(oProduct) {
      this.aCart.push(oProduct);
    },
    onChangeAmountProduct(oProduct, bAdd = true) {
      this.aCart = this.aCart.map((oProductCart) => {
        if (oProductCart.id === oProduct.id)
          bAdd ? oProductCart.amount++ : oProductCart.amount--;

        return oProductCart;
      });

      this.aCart = onCheckCart(this.aCart);
    },
    onRemoveProduct(oProduct) {
      this.aCart = this.aCart.filter(
        (oProductCart) => oProductCart.id !== oProduct.id
      );
    },
  },
  persist: {
    enabled: true,
  },
});
