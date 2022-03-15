const jobs = [
  {
    id: 1,
    title: "React Developer",
    rating: 10,
    info: {
      rate: "£300 - £400",
      length: "6 Months",
      ir35: "Outside",
      remote: "Fully",
    },
  },
  {
    id: 2,
    title: "Contract PHP Developer",
    rating: 7.5,
    info: {
      rate: "£300 - £400",
      length: "6 Months",
      ir35: "Inside",
      remote: "Fully",
    },
  },
  {
    id: 3,
    title: "Senior Laravel Developer",
    rating: 2,
    info: {
      rate: "£200 - £300",
      length: "3 Months",
      ir35: "Inside",
      remote: "Partial",
    },
  },
];

export function getJobs() {
  return { data: jobs };
}
