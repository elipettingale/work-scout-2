import keywords from "../config/keywords.json";

export function highlightKeywords(html) {
  keywords.forEach((set) => {
    set.words.forEach((word) => {
      const regex = new RegExp(`(${word})`, "gi");
      html = html.replaceAll(
        regex,
        `<span class="keyword is-${set.key}">$1</span>`
      );
    });
  });

  return html;
}

export function getScore(html) {
  let score = 3;

  keywords.forEach((set) => {
    set.words.forEach((word) => {
      const regex = new RegExp(`(${word})`, "gi");

      if (html.match(regex)) {
        if (set.key === "good") {
          score += 1;
        }

        if (set.key === "bad") {
          score -= 1;
        }
      }
    });
  });

  if (score < 0) {
    return 0;
  }

  if (score > 10) {
    return 10;
  }

  return score;
}
