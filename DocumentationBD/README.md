Itération 5 :
– Ajout de l'entité/une table Utilisateur
Une nouvelle entité Utilisateur a été ajoutée avec les attributs suivants : id : identifiant unique clé primaire, type INT, name : nom de l'utilisateur, type VARCHAR(150), avatar : nom du fichier d'avatar, type VARCHAR(250), age : date de naissance, type DATE

Le choix d'utiliser un champ de type DATE permet de calculer dynamiquement l'âge de l'utilisateur au moment de l'utilisation, ce qui garantit l’exactitude des données à long terme.

Itération 9 :
– Association Enregistrer → Table Favorite
Une association nommée Enregistrer a été créée entre les entités Utilisateur et Movie afin de gérer les films ajoutés aux favoris.

Cardinalités définies au niveau du Modèle Entité-Association :Un Utilisateur peut avoir entre 0 et n films en favoris → (0,n). Un Movie peut être présent dans les favoris de 0 à n utilisateurs → (0,n)

Transformation en Modèle Relationnel :
Selon les règles de transformation pour une relation de type n-n, cette association a été transformée en une table relationnelle Favorite, avec les clés primaires composites :

id_utilisateur (INT) → clé étrangère vers Utilisateur.id

id_movie (INT) → clé étrangère vers Movie.id

Cette table ne contient pas d'attributs supplémentaires et permet de faire la correspondance directe entre utilisateurs et films favoris.

Itération 10 
– Ajout d’un champ booléen à Movie
Un nouveau champ a été ajouté à la table Movie : recommened : type BOOLEAN (ou LOGICAL)

Ce champ permet de signaler si un film est mis en avant. Il est utilisé dans la section de recommandations éditoriales de l'application.


Itération 14 :
– Système de notation → Table Rating
Une table Rating a été introduite pour permettre aux utilisateurs de noter les films. Elle représente une association n-n entre Utilisateur et Movie, enrichie par un attribut supplémentaire (score).

Cardinalités : un Utilisateur peut noter de 0 à n films → (0,n). Un Movie peut être noté par 0 à n utilisateurs → (0,n)

Modèle relationnel : id (INT) : identifiant unique, id_user (INT) : clé étrangère vers Utilisateur.id, id_movie (INT) : clé étrangère vers Movie.id, score (INT) : note attribuée par l’utilisateur

Itération 15: 
– Table Commentaire
La table Comment a été ajoutée afin de permettre aux utilisateurs de rédiger des commentaires sur les films.

Cardinalités : un Utilisateur peut écrire de 0 à n commentaires → (0,n). Un Movie peut recevoir de 0 à n commentaires → (0,n)

Modèle relationnel : id (INT) : identifiant unique du commentaire, id_user (INT) : clé étrangère vers Utilisateur.id, id_movie (INT) : clé étrangère vers Movie.id, comment (TEXT) : contenu textuel du commentaire, created_at (DATETIME) : date et heure de création du commentaire

Association Category → Movie via Categoriser
Une relation n-n a été définie entre Category et Movie, une catégorie pouvant contenir plusieurs films, et un film pouvant appartenir à plusieurs catégories.

Cardinalités : un Category contient de 0 à n Movie → (0,n). Un Movie appartient à 1 à n Category → (1,n)

Transformation en modèle relationnel :
Cette association a été transformée en table Categoriser, avec les champs suivants : id_category (INT) : clé étrangère vers Category.id, id_movie (INT) : clé étrangère vers Movie.id