import axios from 'axios';

const oApiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api/',
});

const oConfigBase = {
  headers: {
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*',
  },
};

export default {
  // Method GET
  async onAxiosGet(sEndpoint) {
    try {
      const oResponse = await oApiClient.get(sEndpoint, oConfigBase);
      return oResponse.data;
    } catch (error) {
      return error.response.data;
    }
  },
};
