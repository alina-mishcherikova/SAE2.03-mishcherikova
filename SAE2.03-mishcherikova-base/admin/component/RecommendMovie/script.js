let templateFile = await fetch('./component/RecommendMovie/template.html');
let template = await templateFile.text();

let templateFile2 = await fetch('./component/RecommendMovie/templateRecommend.html');
let templateCards = await templateFile2.text();


let Recommendation = {};

Recommendation.format = function (recommendations) {
  let html = template;
  let cardsHTML = "";

  if (!Array.isArray(recommendations)) {
    recommendations = [];
  }

  for (let movie of recommendations) {
    let card = templateCards;
    card = card.replace("{{name}}", movie.name);
    card = card.replace("{{image}}", movie.image);
    card = card.replace("{{id}}", movie.id);

    if (movie.recommened == 1) {
      card = card.replace("{{checked}}", "checked");
    } else {
      card = card.replace("{{checked}}", "");
    }

    cardsHTML += card;
  }

  html = html.replace("{{cards}}", cardsHTML);
  return html;
};

export { Recommendation };
