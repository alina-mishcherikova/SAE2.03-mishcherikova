import { MovieCard } from "../Movie/script.js";

let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/MovieCategory/templateCategory.html");
let template2 = await templateFile2.text();

let MovieCategory = {};

MovieCategory.format = function (category, movies) {
  let html = template;
  let categoryHTML = "";
  for (let c of category) {
    let category = template2;
    category = category.replace("{{category}}", c.category);
    categoryHTML += category;
  }
  html = html.replace("{{category}}", category);
  html = html.replace("{{cards}}", MovieCard.format(movies));
  return html;
};

export { MovieCategory };
