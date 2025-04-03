let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let MovieCard = {};

MovieCard.format = function (FilmName, Title) {
  let html = template;
  html = html.replace("{{FilmName}}", FilmName);
  html = html.replace("{{Title}}", Title);
  return html;
};

export { MovieCard };
