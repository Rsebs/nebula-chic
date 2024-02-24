import { defineStore } from 'pinia';
import { ProductCart } from 'src/interfaces/Product';

const onCheckCart = (cart: Array<ProductCart>) =>
  cart.filter((oProduct) => oProduct.amount > 0);

export const useProductStore = defineStore('cart', {
  state: () => ({
    cart: [] as Array<ProductCart>,
  }),
  actions: {
    onAddProductToCart(oProduct: ProductCart) {
      this.cart.push(oProduct);
    },
    onChangeAmountProduct(oProduct: ProductCart, bAdd: boolean = true) {
      this.cart = this.cart.map((oProductCart) => {
        if (oProductCart.id === oProduct.id)
          bAdd ? oProductCart.amount++ : oProductCart.amount--;

        return oProductCart;
      });

      this.cart = onCheckCart(this.cart);
    },
    onRemoveProduct(oProduct: ProductCart) {
      this.cart = this.cart.filter(
        (oProductCart) => oProductCart.id !== oProduct.id
      );
    },
  },
  persist: {
    enabled: true,
  },
});
