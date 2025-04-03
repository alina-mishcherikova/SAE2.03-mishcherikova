let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let MovieCard = {};

MovieCard.format = function (MoviemName, MovieImg) {
  let html = template;
  html = html.replace("{{MovieName}}", MovieName);
  html = html.replace("{{MovieImg}}", MovieImg);
  return html;
};

export { MovieCard };
