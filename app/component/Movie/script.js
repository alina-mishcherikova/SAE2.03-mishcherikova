let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

const templateFile2 = await fetch("./component/Movie/templateCard.html");
const templateCards = await templateFile2.text();


let MovieCard = {};

MovieCard.format = function (obj) {
  let html = template;
  let cardsHTML = "";

  for (let c of obj) {
    let card = templateCards;
    card = card.replace("{{name}}", c.name);
    card = card.replace("{{image}}", c.image);
    cardsHTML += card;
  }

  html = html.replace("{{cards}}", cardsHTML);
  return html;
};

export { MovieCard };
