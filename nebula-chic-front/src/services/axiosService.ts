import axios from 'axios';
import { ApiResponse } from 'src/interfaces/ApiResponse';

const oApiClient = axios.create({
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
  async onAxiosGet(endpoint: string) {
    const response = await oApiClient.get<ApiResponse>(endpoint, configBase);
    return response.data;
  },

  // POST
  async onAxiosPost(endpoint: string, body: Array<object> | object) {
    const response = await oApiClient.post<ApiResponse>(endpoint, body, configBase);
    return response.data;
  },
};
