import { MovieCard } from "../Movie/script.js";

const templateFile = await fetch("./component/Profile/template.html");
const template = await templateFile.text();


let ProfilePage = {};

ProfilePage.format = function (profile, movies) {
  let html = template;

  html = html.replaceAll("{{name}}", profile.name);
  html = html.replace("{{avatar}}", profile.avatar);

  if (movies.length === 0) {
    html = html.replace("{{cards}}", "<p class='no-movie'>Vous n'avez pas encore de films favoris.</p>");
  } else {
    html = html.replace("{{cards}}", MovieCard.format(movies));
  }

  return html;
};
export { ProfilePage };