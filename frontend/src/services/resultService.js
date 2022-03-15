const results = [
  {
    id: 1,
    title: "React Developer",
    rate: "£300 - £400",
    length: "6 Months",
    ir35: "Outside",
    remote: "Fully",
    description:
      "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?",
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
