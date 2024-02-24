type NameProductType = 'Accesorio' | 'Prenda';
type CodProductSize = 'XS' | 'S' | 'M' | 'L' | 'XL' | 'XXL';

export interface Product {
  id: number;
  name: string;
  price: number;
  description: string;
  productType: ProductType;
  sizes: Size[];
  images: Image[];
}

export interface ProductCart {
  id: number;
  name: string;
  price: number;
  imagePath: string;
  amount: number;
}

export interface Image {
  id: number;
  path: string;
}

export interface ProductType {
  id: number;
  name: NameProductType;
}

export interface Size {
  id: number;
  name: string;
  cod: CodProductSize;
}

export type ProductId = Pick<Product, 'id'>;
export type ProductName = Pick<Product, 'name'>;
export type ProductPrice = Pick<Product, 'price'>;
export type ProductDescription = Pick<Product, 'description'>;
export type ProductProductType = Pick<Product, 'productType'>;
export type ProductSizes = Pick<Product, 'sizes'>;
export type ProductImages = Pick<Product, 'images'>;
