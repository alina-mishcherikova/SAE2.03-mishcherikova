import { ProfilePage } from "../Movie/script.js";

const templateFile = await fetch("./component/Profile/template.html");
const template = await templateFile.text();


let ProfilePage = {};

ProfilePage.format = function (profile, movies) {
  let html = template;

  html = html.replace("{{cards}}", MovieCard.format(movies));
  html = html.replace("{{name}}", profile.name);
  html = html.replace("{{avatar}}", profile.avatar);
  return html;
};
export { ProfilePage };
