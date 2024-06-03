import { APIError, type APISuccessResponse } from '@/interfaces/APIResponseInterface/APIResponse';
import axios, { AxiosError, type AxiosRequestConfig } from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
  headers: {
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*',
  },
});

export default {
  async get(
    url: string,
    config: AxiosRequestConfig = {}
  ): Promise<APISuccessResponse & void> {
    try {
      const { data } = await axiosInstance.get(url, config);
      return data;
    } catch (error) {
      if (error instanceof AxiosError)
        throw new APIError(
          `Error get response url: /${url}`,
          error.response?.data
        );
    }
  },

  async post(
    url: string,
    body: object,
    config: AxiosRequestConfig = {}
  ): Promise<APISuccessResponse & void> {
    try {
      const { data } = await axiosInstance.post(url, body, config);
      return data;
    } catch (error) {
      if (error instanceof AxiosError)
        throw new APIError(
          `Error post response url: /${url}`,
          error.response?.data
        );
    }
  },

  async put(
    url: string,
    body: object,
    config: AxiosRequestConfig = {}
  ): Promise<APISuccessResponse & void> {
    try {
      const { data } = await axiosInstance.put(url, body, config);
      return data;
    } catch (error) {
      if (error instanceof AxiosError)
        throw new APIError(
          `Error put response url: /${url}`,
          error.response?.data
        );
    }
  },

  async delete(
    url: string,
    config: AxiosRequestConfig = {}
  ): Promise<APISuccessResponse & void> {
    try {
      const { data } = await axiosInstance.delete(url, config);
      return data;
    } catch (error) {
      if (error instanceof AxiosError)
        throw new APIError(
          `Error delete response url: /${url}`,
          error.response?.data
        );
    }
  },
};
