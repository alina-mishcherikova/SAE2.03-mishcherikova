let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let MovieDetail = {};

MovieDetail.format = function (film) {
  let html = template;

  html = html.replace("{{name}}", film.name);
  html = html.replace("{{image}}", film.image);
  html = html.replace("{{desc}}", film.description);
  html = html.replace("{{realisateur}}", film.director);
  html = html.replace("{{year}}", film.year);
  html = html.replace("{{category}}", film.id_category);
  html = html.replace("{{min_age}}", film.min_age + "+");
  html = html.replace("{{VideoUrl}}", film.trailer);

  return html;
};

export { MovieDetail };
