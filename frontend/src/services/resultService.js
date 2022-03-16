import api from "./httpService";

export function getResults() {
  return api.get("results");
}

export function dismissResult(result) {}
