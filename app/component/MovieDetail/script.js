let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

const templateFile2 = await fetch("./component/MovieDetail/templateInfo.html");
const templateInfo = await templateFile2.text();

let MovieDetail = {};

MovieDetail.format = function (film) {
  let html = template;

  html = html.replace('{{name}}', film.name);
  html = html.replace('{{image}}', film.image);
  html = html.replace('{{desc}}', film.description);
  html = html.replace('{{VideoUrl}}', film.trailer);

  const infos = [
    { title: "Réalisé par", info: film.director },
    { title: "Année de sortie", info: film.year },
    { title: "Durée", info: `${film.length} minutes` },
    { title: "Catégorie", info: film.id_category },
    { title: "Restrictions d'âge", info: `${film.min_age}+` }
  ];

  let infoHTML = "";
  for (let i of infos) {
    let block = templateInfo;
    block = block.replace("{{title}}", i.title);
    block = block.replace("{{info}}", i.info);
    infoHTML += block;
  }

  html = html.replace("{{infos}}", infoHTML);
  return html;
};

export { MovieDetail };
