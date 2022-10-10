export function highlightKeywords(html) {
  const goodKeywords = [
    "outside ir35",
    "fully remote",
    "100% remotely",
    "100% remote",
    "javascript",
    "php",
    "laravel",
    "react",
    "vue.js",
    "vue",
    "wordpress",
    "typescript",
    "docker",
  ];
  const badKeywords = [
    "inside ir35",
    "on-site",
    "aws",
    "hybrid",
    "redux",
    "node",
    "java",
    "ruby",
    ".NET",
  ];
  const neutralKeywords = [
    "£\\d+ ?- ?£?\\d+",
    "£\\d+",
    "\\d+-\\d+ months",
    "\\d+-\\d+ month",
    "\\d+ months",
    "\\d+ month",
    "remotely",
    "remote",
    "ir35",
  ];

  goodKeywords.forEach((keyword) => {
    const regex = new RegExp(`(${keyword})`, "gi");
    html = html.replaceAll(regex, '<span class="keyword is-good">$1</span>');
  });

  badKeywords.forEach((keyword) => {
    const regex = new RegExp(`(${keyword})`, "gi");
    html = html.replaceAll(regex, '<span class="keyword is-bad">$1</span>');
  });

  neutralKeywords.forEach((keyword) => {
    const regex = new RegExp(`(${keyword})`, "gi");
    html = html.replaceAll(regex, '<span class="keyword">$1</span>');
  });

  return html;
}
