import keywords from "../config/keywords.json";

export function highlightKeywords(html) {
  console.log(keywords);

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
