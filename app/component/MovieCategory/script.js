import { MovieCard } from "../Movie/script.js";

let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function (category, movies) {
  let html = template;
  html = html.replace("{{category}}", category);
  html = html.replace("{{cards}}", MovieCard.format(movies));
  return html;
};

export { MovieCategory };
