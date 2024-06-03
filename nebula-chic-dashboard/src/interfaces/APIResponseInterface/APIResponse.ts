import type { Product } from './ProductResponse';
import type { SelectResponse } from './SelectResponse';

export type DataResponse = Product | SelectResponse;

export interface APISuccessResponse {
  message: string;
  statusCode: number;
  data: DataResponse[];
  paginate: Paginate;
}

export interface Paginate {
  current_page: number;
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: Link[];
  next_page_url: string;
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

export interface APIErrorResponse {
  message: string;
  statusCode: number;
  errors: unknown[];
}

export class APIError extends Error {
  public data: APIErrorResponse;

  constructor(message: string = 'Error request API', data?: APIErrorResponse) {
    super(message);
    this.data = data || {
      message: 'Error request API',
      statusCode: 500,
      errors: [],
    };
  }
}
