let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

const templateFile2 = await fetch("./component/NavBar/templateProfile.html");
const templateProfile = await templateFile2.text();

let NavBar = {};

NavBar.format = function (hAbout, profiles, activeProfileId) {
  let html = template;
  let activeName = "";
  let activeAvatar= "default-avatar.svg";
  let optionsHTML = '<option value=""' + (!activeProfileId ? ' selected' : '') + '>-- Choisir un profil --</option>';

  for (let profile of profiles) {
    let option = templateProfile;
    option = option.replace("{{id}}", profile.id);
    option = option.replace("{{name}}", profile.name);
  
    if (String(profile.id) === String(activeProfileId)) {
      option = option.replace(">", " selected>");
      activeName = profile.name;
      activeAvatar = profile.avatar || "default-avatar.svg";
    }
  
    optionsHTML += option;
  }
  

  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{profiles}}", optionsHTML);
  html = html.replace("{{name}}", activeName);
  html = html.replace("{{avatar}}", activeAvatar);

  return html;
};

export { NavBar };
