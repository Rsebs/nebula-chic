export interface Product {
  id: number;
  name: string;
  price: number;
  description: string;
  productType: ProductType;
  sizes: Size[];
  images: Image[];
}

export interface Image {
  id: number;
  path: string;
}

export interface ProductType {
  id: number;
  name: string;
}

export interface Size {
  id: number;
  name: string;
  cod: string;
}
