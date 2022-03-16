import axios from "axios";

axios.defaults.baseURL = "http://localhost:8001/api/";

export default {
  get: axios.get,
  post: axios.post,
  put: axios.put,
  delete: axios.delete,
};
