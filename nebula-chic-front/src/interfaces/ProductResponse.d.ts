type NameProductType = 'Accesorio' | 'Prenda';
type CodProductSize = 'XS' | 'S' | 'M' | 'L' | 'XL' | 'XXL';

export interface ProductResponse {
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

export type ProductId = Pick<ProductResponse, 'id'>;
export type ProductName = Pick<ProductResponse, 'name'>;
export type ProductPrice = Pick<ProductResponse, 'price'>;
export type ProductDescription = Pick<ProductResponse, 'description'>;
export type ProductProductType = Pick<ProductResponse, 'productType'>;
export type ProductSizes = Pick<ProductResponse, 'sizes'>;
export type ProductImages = Pick<ProductResponse, 'images'>;
