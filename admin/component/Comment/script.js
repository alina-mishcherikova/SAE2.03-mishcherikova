let templateFile = await fetch("./component/Comment/template.html");
let template = await templateFile.text();

let Comment = {};

Comment.format = function (comments) {
  // Якщо немає коментарів
  if (comments.length === 0) {
    return `<p class="no-comment">Aucun commentaire à modérer pour le moment.</p>`;
  }

  let commentHTML = "";

  for (let com of comments) {
    let c = template;

    c = c.replace("{{id}}", com.id);
    c = c.replace("{{name}}", com.user_name);
    c = c.replace("{{date}}", com.created_at);
    c = c.replace("{{movie}}", com.movie_name);
    c = c.replace("{{status}}", com.status);
    c = c.replace("{{content}}", com.content);
    c = c.replace("{{handlerApprouved}}", `C.approveComment(${com.id})`);
    c = c.replace("{{handlerDelete}}", `C.deleteComment(${com.id})`);

    commentHTML += c;
  }

  return commentHTML;
};

export { Comment };
