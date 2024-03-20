import axios, { isAxiosError } from 'axios';
import { APIResponse } from 'src/interfaces/APIResponse';

const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
});

const configBase = {
  headers: {
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*',
  },
};

export default {
  // GET
  async onAxiosGet(endpoint: string): Promise<APIResponse> {
    try {
      const { data } = await axiosInstance.get<APIResponse>(
        endpoint,
        configBase
      );

      return data;
    } catch (error) {
      if (isAxiosError(error)) return error.response?.data;

      throw new Error(`Error request get ${endpoint}`);
    }
  },

  // POST
  async onAxiosPost(
    endpoint: string,
    body: Array<object> | object
  ): Promise<APIResponse> {
    try {
      const { data } = await axiosInstance.post<APIResponse>(
        endpoint,
        body,
        configBase
      );

      return data;
    } catch (error) {
      if (isAxiosError(error)) return error.response?.data;

      throw new Error(`Error request post ${endpoint}`);
    }
  },
};
