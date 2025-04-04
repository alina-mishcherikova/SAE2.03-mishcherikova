let templateFile = await fetch('./component/AddNewFilm/template.html');
let template = await templateFile.text();


let AddNewFilm = {};

  AddNewFilm.format = function (handler) {
    let html = template;
    html = html.replaceAll("{{handler}}", handler);
    return html;
  };

export {AddNewFilm};

