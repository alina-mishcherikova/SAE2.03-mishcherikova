Itération 5 :
- J'ai ajouté la table Utilisateur avec les champs suivants : id, nom, avatar et âge. Dans ce champ âge, je vais enregistrer la date de naissance de l'utilisateur afin de pouvoir calculer son âge par la suite.

Itération 9 :
- Au début, une association Enregistrer a été créée avec les champs id_utilisateur et id_movie. Cette association permettait de stocker les informations des films ajoutés en favoris (entre Utilisateur et Movie).

Les relations étaient les suivantes :
Un Utilisateur peut avoir entre 0 et un nombre illimité de films en favoris (cardinalité 0,n).
Un Movie peut être dans les favoris de 0 à un nombre illimité d’utilisateurs (cardinalité 0,n).

Ensuite, en appliquant les règles de transformation, cette association a été transformée en une table indépendante appelée Favorite, qui contient les clés primaires des tables Movie et Utilisateur.

Itération 10 :
- La table Movie a été modifiée. J’ai ajouté un nouveau champ recommened de type booléen. Ce champ permet d’indiquer si le film est utilisé ou non dans la section Mise en avant.
ALTER TABLE Movie
ADD recommened boolean;

Itération 14 :
- Une nouvelle table de cotation a été créée, qui contient les champs id, id_movie, id_user et rating. Tous les champs sont int.

Itération 15 :
- Une nouvelle table Commentaire a été créée pour relier le film et l'utilisateur. Elle comporte les champs suivants : id, id_user,id_film - Int, comment - text, created_at DATETIME;
