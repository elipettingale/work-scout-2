import api from "./httpService";

export function getResults() {
  return api.get("results");
}

export function getResult(id) {
  return api.get(`results/${id}`);
}

export function dismissResult(result) {
  return api.post(`results/${result.id}/dismiss`);
}
