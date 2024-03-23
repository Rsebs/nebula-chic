import { ProductResponse } from './ProductResponse';
import { User } from './User';

type DataResponse = ProductResponse & User;

export interface APIResponse {
  message: string;
  statusCode: number;
  data: DataResponse & DataResponse[];
  paginate: Paginate | null;
}

export interface Paginate {
  current_page: number;
  first_page_url: string | null;
  from: number;
  last_page: number;
  last_page_url: string | null;
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
