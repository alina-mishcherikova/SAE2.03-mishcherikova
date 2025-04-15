<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "mishcherikova1");
define("DBLOGIN", "mishcherikova1");
define("DBPWD", "mishcherikova1");


// function getAllMovies(){
//     // Connexion à la base de données
//     $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
//     // Requête SQL pour récupérer le menu avec des paramètres
//     $sql = "SELECT 
//             Movie.id AS id, Movie.name, Movie.image, Category.name AS category
//             FROM Movie
//             INNER JOIN Category ON Movie.id_category = Category.id
//             ORDER BY Category.name";
//     // Prépare la requête SQL
//     $stmt = $cnx->prepare($sql);
//     // Exécute la requête SQL
//     $stmt->execute();
//     // Récupère les résultats de la requête sous forme d'objets
//     $res = $stmt->fetchAll(PDO::FETCH_OBJ);
//     return $res; // Retourne les résultats
// }
function getAllMovies($id_user) {
  $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

  $sql = "SELECT (YEAR(CURDATE()) - YEAR(age)) AS user_age FROM Utilisateur WHERE id = :id_user";
  $stmt = $cnx->prepare($sql);
  $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_OBJ);

  $user_age = $result ? $result->user_age : 99;

  $sql = "SELECT 
              Movie.id, 
              Movie.name, 
              Movie.image, 
              Movie.min_age,
              Category.name AS category
          FROM Movie
          INNER JOIN Category ON Movie.id_category = Category.id
          WHERE Movie.min_age <= :user_age
          ORDER BY Category.name";

  $stmt = $cnx->prepare($sql);
  $stmt->bindParam(':user_age', $user_age, PDO::PARAM_INT);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_OBJ);
}



function addMovie($name, $realisateur, $annee, $duree, $desc, $categorie, $img, $url, $restriction) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age)
            VALUES (:name, :year, :length, :description, :director, :id_category, :image, :trailer, :min_age)";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':year', $annee);
    $stmt->bindParam(':length', $duree);
    $stmt->bindParam(':description', $desc);
    $stmt->bindParam(':director', $realisateur);
    $stmt->bindParam(':id_category', $categorie);
    $stmt->bindParam(':image', $img);
    $stmt->bindParam(':trailer', $url);
    $stmt->bindParam(':min_age', $restriction);

    $stmt->execute();
    return $stmt->rowCount();
}

function addProfile($name, $avatar, $date){
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Utilisateur (name, avatar, age)
            VALUES (:name, :avatar, :date)";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':date', $date);
    
    $stmt->execute();
    return $stmt->rowCount();
}

function updateProfile($id, $name, $avatar, $date){
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "UPDATE Utilisateur 
            SET name = :name, avatar = :avatar, age = :date 
            WHERE id = :id";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':date', $date);

    $stmt->execute();
    return $stmt->rowCount();
}


function MovieDetail($id) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT
                Movie.id,
                Movie.name, 
                year, 
                length, 
                description, 
                director, 
                Category.name AS category, 
                image, 
                trailer, 
                min_age 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id
            WHERE Movie.id = :id";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res;
}

function getProfiles(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT id, name, avatar, age FROM Utilisateur";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function checkFavorite($id_user, $id_movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
  
    $sql = "SELECT * FROM Favorite WHERE id_user = :id_user AND id_movie = :id_movie";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->execute();
  
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return count($res) > 0;
  }
  
  function addToFavorite($id_user, $id_movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
  
    $sql = "INSERT INTO Favorite (id_user, id_movie) VALUES (:id_user, :id_movie)";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->execute();
  
    return $stmt->rowCount();
  }
  
  function getFavorites($userId) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT
                id_user,
                Utilisateur.name AS user_name, 
                Movie.id, 
                Movie.name, 
                Movie.image
            FROM Favorite
            INNER JOIN Movie ON Favorite.id_movie = Movie.id
            INNER JOIN Utilisateur ON Favorite.id_user = Utilisateur.id
            WHERE Favorite.id_user = :user";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':user', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function openProfilPage($userId) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT
            name, avatar 
            FROM Utilisateur
            WHERE id = :user";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':user', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_OBJ); 
}

function deleteFromFavorite($userId, $movieId) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "DELETE FROM Favorite WHERE id_user = :user AND id_movie = :movie";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':user', $userId);
    $stmt->bindParam(':movie', $movieId);
    $stmt->execute();

    return $stmt->rowCount();
}


function getRecommendedMovies() {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
  
    $sql = "SELECT id, name, image, description 
    FROM Movie 
    WHERE recommened = '1'";
  
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  function searchMovies($keyword) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
  
    $sql = "SELECT id, name, image, min_age 
            FROM Movie 
            WHERE name LIKE :keyword
            OR year LIKE :keyword";
  
    $stmt = $cnx->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  
  function searchMoviesApp($keyword) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT id, name, image, min_age, recommened
            FROM Movie 
            WHERE name LIKE :keyword OR year LIKE :keyword";

    $stmt = $cnx->prepare($sql);
    $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function modifyRecommendedMovies($id_movie, $recommended) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    
    $sql = "UPDATE Movie SET recommened = :recommended WHERE id = :id";
    
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':recommended', $recommended, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id_movie, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount();
}

  function addRating($id_user, $id_movie, $score) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Rating (id_user, id_movie, score) VALUES (:id_user, :id_movie, :score)";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([':id_user' => $id_user, ':id_movie' => $id_movie, ':score' => $score]);
    return $stmt->rowCount();
  }
  function checkIfRatingExists($id_user, $id_movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Rating WHERE id_user = :id_user AND id_movie = :id_movie";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([':id_user' => $id_user, ':id_movie' => $id_movie]);
    return $stmt->fetch() != false;
  }
  
  function getAverageRating($id_movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT AVG(score) AS score FROM Rating WHERE id_movie = :id_movie";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->execute();
    $score = $stmt->fetch(PDO::FETCH_OBJ)->score ?? 0;
    return round($score, 1);
}

function getComments($id_movie) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    
    $sql = "SELECT Comment.content, Comment.created_at, Utilisateur.name
            FROM Comment
            INNER JOIN Utilisateur ON Comment.id_user = Utilisateur.id
            WHERE Comment.id_movie = :id_movie
            ORDER BY Comment.created_at DESC";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function addComment($id_user, $id_movie, $content) {
  $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
  $sql = "INSERT INTO Comment (id_user, id_movie, content, created_at) 
          VALUES (:id_user, :id_movie, :content, NOW())"; 
  $stmt = $cnx->prepare($sql);
  $stmt->execute([
      ':id_user' => $id_user,
      ':id_movie' => $id_movie,
      ':content' => $content
  ]);

  return $stmt->rowCount() > 0;
}
