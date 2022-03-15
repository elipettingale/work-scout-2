const results = [
  {
    id: 1,
    title: "React Developer",
    rate: "£300 - £400",
    length: "6 Months",
    ir35: "Outside",
    remote: "Fully",
    description: "",
    score: 10,
  },
  {
    id: 2,
    title: "Contract PHP Developer",
    rate: "£300 - £400",
    length: "6 Months",
    ir35: "Outside",
    remote: "Fully",
    description: "",
    score: 8,
  },
  {
    id: 3,
    title: "Senior PHP Developer",
    rate: "£200 - £300",
    length: "3 Months",
    ir35: "Inside",
    remote: "Partial",
    description: "",
    score: 2,
  },
];

export function getResults() {
  return { data: results };
}

export function dismissResult(result) {
  let index = results.findIndex((item) => item.id === result.id);
  results.splice(index, 1);
}
