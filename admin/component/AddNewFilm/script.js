let templateFile = await fetch('./component/AddNewFilm/template.html');
let template = await templateFile.text();


let AddNewFilm = {};

  AddNewFilm.format = function (handlerC, handlerU) {
    let html = template;
    html = html.replaceAll("{{handlerChange}}", handlerC);
    html = html.replace("{{handlerUpdate}}", handlerU);
    return html;
  };

export {AddNewFilm};

