let templateFile = await fetch("./component/Comment/template.html");
let template = await templateFile.text();
let templateFile2 = await fetch("./component/Comment/templateComments.html");
let templateComments= await templateFile2.text();

let Comment = {};

Comment.format = function (comments) {
  let html = template;

  if(comments.length === 0){
    html = html.replace("{{coms}}", "<p class='comment__content'>Aucun commentaire pour ce film. Soyez le premier à en laisser un !</p>");
  } else {
    let commentHTML = "";

    for(let com of comments){
      let c= templateComments;
      c = c.replace("{{name}}", com.user_name);
      c = c.replace("{{date}}", com.created_at);
      c = c.replace("{{content}}", com.content);      
      commentHTML +=c;
    }

    html= html.replace("{{coms}}", commentHTML);
  }
;
  return html;
};

export { Comment };