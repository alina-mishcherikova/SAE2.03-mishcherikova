let templateFile = await fetch("./component/RecommendedCard/template.html");
let template = await templateFile.text();

const templateFile2 = await fetch("./component/RecommendedCard/templateCard.html");
const templateCards = await templateFile2.text();


let RecommendedCard = {};

RecommendedCard.format = function (obj) {
  let html = template;
  let cardsHTML = "";

  for (let c of obj) {
    let card = templateCards;
    card = card.replace("{{name}}", c.name);
    card = card.replace("{{image}}", c.image);
    card = card.replace("{{desc}}", c.description);
    card = card.replace('{{onclick}}', `C.handlerDetail(${c.id})`);
    card = card.replaceAll('{{id}}', c.id);
    cardsHTML += card;
  }
  
  html = html.replace("{{cards}}", cardsHTML);
  return html;
};

export { RecommendedCard };
