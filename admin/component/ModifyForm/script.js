let templateFile = await fetch('./component/ModifyForm/template.html');
let template = await templateFile.text();

let templateFile2 = await fetch('./component/ModifyForm/templateOptions.html');
let templateOption = await templateFile2.text();

let ModifyProfile = {};

/**
 * Autofill inputs with profile data
 * @param {Object} profile - The profile object (name, avatar, age/date)
 */
ModifyProfile.autoFill = function (profile) {
  let form = document.querySelector(".Profile__form--edit");

  const nameInput = form.querySelector("input[name=name]");
  const avatarInput = form.querySelector("input[name=avatar]");
  const dateInput = form.querySelector("input[name=date]");

  nameInput.value = profile.name;
  avatarInput.value = profile.avatar;
  dateInput.value = profile.age;
};

/**
 * Format the profile form with dynamic event handlers and profile options
 * @param {String} handlerC - JavaScript handler function for select onchange
 * @param {String} handlerU - JavaScript handler function for button onclick
 * @param {Array} profiles - Array of profile objects to populate the <select>
 * @returns {String} formatted HTML
 */
ModifyProfile.format = function (handlerC, handlerU, profiles = []) {
  let html = template;
  let optionsHTML = '<option value="">-- Choisir un profil --</option>';

  for (let profile of profiles) {
    let option = templateOption;
    option = option.replace("{{id}}", profile.id);
    option = option.replace("{{name}}", profile.name);
    optionsHTML += option;
  }

  html = html.replace("{{options}}", optionsHTML);
  html = html.replaceAll("{{handlerChange}}", `${handlerC}()`);
  html = html.replace("{{handlerUpdate}}", `${handlerU}()`);

  return html;
};

export { ModifyProfile };