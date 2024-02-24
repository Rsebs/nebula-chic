import { Product } from './Product';

type DataResponse = Product

export interface ApiResponse {
  message: string;
  statusCode: number;
  data: DataResponse & DataResponse[];
  paginate: Paginate;
}

export interface Paginate {
  current_page: number;
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: Link[];
  next_page_url: null;
  per_page: number;
  prev_page_url: null;
  to: number;
  total: number;
}

export interface Link {
  url: null | string;
  label: string;
  active: boolean;
}
