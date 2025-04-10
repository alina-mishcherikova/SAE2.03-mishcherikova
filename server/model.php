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
function getAllMovies($age = null) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT 
                Movie.id, 
                Movie.name, 
                Movie.image, 
                Movie.min_age,
                Category.name AS category
            FROM Movie
            INNER JOIN Category ON Movie.id_category = Category.id";

    if ($age !== null && $age < 99) {
        $sql .= " WHERE Movie.min_age <= :userAge";
    }

    $sql .= " ORDER BY Category.name";

    $stmt = $cnx->prepare($sql);

    if ($age !== null && $age < 99) {
        $stmt->bindParam(':userAge', $age, PDO::PARAM_INT);
    }

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

    $sql = "SELECT id, name, avatar, YEAR(CURDATE()) - YEAR(age) AS age 
            FROM Utilisateur";

    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function addToFavorite($id_movie, $id_profile){
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Favorite (id_movie, id_profile)
            VALUES (:id_movie, :id_profile)";

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_movie', $id_movie);
    $stmt->bindParam(':id_profile', $id_profile);
        
    $stmt->execute();
    return $stmt->rowCount();

}

function getFavorites($userId) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
  
    $sql = "SELECT Movie.id, Movie.name, Movie.image,  Category.name AS category
            FROM Favorite
            JOIN Movie ON Favorite.id_movie = Movie.id
            JOIN Category ON Movie.id_category = Category.id
            WHERE Favorite.id_user = :user";
  
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':user', $userId);
    $stmt->execute();
  
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }
  