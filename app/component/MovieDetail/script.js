let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let MovieDetail = {};

MovieDetail.format = function (film) {
  let html = template;

  html = html.replaceAll("{{id}}", film.id);
  html = html.replace("{{name}}", film.name);
  html = html.replace("{{image}}", film.image);
  html = html.replace("{{desc}}", film.description);
  html = html.replace("{{realisateur}}", film.director);
  html = html.replace("{{year}}", film.year);
  html = html.replace("{{category}}", film.category);
  html = html.replace("{{min_age}}", film.min_age + "+");
  html = html.replace("{{VideoUrl}}", film.trailer);
  console.log(film.score);
  html = html.replace("{{score}}", film.score);
  html = html.replace("{{onclick}}", `C.sendRating(${film.id})`);
  return html;
};

export { MovieDetail };
