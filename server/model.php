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


function getAllMovies(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "select id, name, image from Movie";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
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

function MovieDetail($id) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    // Requête SQL sécurisée
    $sql = "SELECT name, year, length, description, director, id_category, image, trailer, min_age 
            FROM Movie 
            WHERE id = :id";

    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);

    // Lie le paramètre :id à la variable $id
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécute la requête SQL
    $stmt->execute();

    // Récupère les résultats sous forme d'objet
    $res = $stmt->fetch(PDO::FETCH_OBJ); // тільки один фільм

    return $res; // Retourne les résultats
}
