let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

const templateFile2 = await fetch("./component/NavBar/templateProfile.html");
const templateProfile = await templateFile2.text();

let NavBar = {};

NavBar.format = function (hAbout, profiles, activeProfileId) {
  let html = template;
  let optionsHTML = "";
  
  for (let profile of profiles) {
    let option = templateProfile;
    option = option.replace("{{name}}", profile.name);
    option = option.replace("{{id}}", profile.id);

    if (profile.id == activeProfileId) {
      option = option.replace(">", " selected>");
    }

    optionsHTML += option;
  }

  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{profiles}}", optionsHTML);
  return html;
};


export { NavBar };
