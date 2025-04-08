let templateFile = await fetch('./component/ProfileForm/template.html');
let template = await templateFile.text();

let templateFile2 = await fetch('./component/ProfileForm/templateOptions.html');
let templateOption = await templateFile2.text();

let AddProfile = {};

/**
 * Autofill inputs with profile data
 * @param {Object} profile - The profile object (name, avatar, age/date)
 */
AddProfile.autoFill = function (profile) {
  let inputName = document.querySelector("input[name=name]");
  inputName.value = profile.name;

  let inputAvatar = document.querySelector("input[name=avatar]");
  inputAvatar.value = profile.avatar;

  let inputAge = document.querySelector("input[name=date]");
  inputAge.value = profile.age; // should be formatted 'YYYY-MM-DD'
};

/**
 * Format the profile form with dynamic event handlers and profile options
 * @param {String} handlerC - JavaScript handler function for select onchange
 * @param {String} handlerU - JavaScript handler function for button onclick
 * @param {Array} profiles - Array of profile objects to populate the <select>
 * @returns {String} formatted HTML
 */
AddProfile.format = function (handlerC, handlerU, profiles = []) {
  let html = template;
  let optionsHTML = '<option value="">-- Choisir un profil --</option>';

  for (let profile of profiles) {
    let option = templateOption;
    option = option.replace("{{id}}", profile.id);
    option = option.replace("{{name}}", profile.name);
    optionsHTML += option;
  }

  html = html.replace("{{options}}", optionsHTML);
  html = html.replaceAll("{{handlerChange}}", handlerC);
  html = html.replace("{{handlerUpdate}}", handlerU);

  return html;
};

export { AddProfile };
