let templateFile = await fetch('./component/ProfileForm/template.html');
let template = await templateFile.text();

let AddProfile = {};
AddProfile.format = function (handler) {
  let html = template;

  html = html.replaceAll("{{handler}}", handler);
  return html;
};

export { AddProfile };