import keywords from "../config/keywords.json";

export function highlightKeywords(html) {
  keywords.good.forEach((keyword) => {
    const regex = new RegExp(`(${keyword})`, "gi");
    html = html.replaceAll(regex, '<span class="keyword is-good">$1</span>');
  });

  keywords.bad.forEach((keyword) => {
    const regex = new RegExp(`(${keyword})`, "gi");
    html = html.replaceAll(regex, '<span class="keyword is-bad">$1</span>');
  });

  keywords.neutral.forEach((keyword) => {
    const regex = new RegExp(`(${keyword})`, "gi");
    html = html.replaceAll(regex, '<span class="keyword">$1</span>');
  });

  return html;
}
