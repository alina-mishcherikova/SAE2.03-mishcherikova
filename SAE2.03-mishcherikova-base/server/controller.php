<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");

function readMoviesController($user_id){
  $movies = getAllMovies($user_id);
  $grouped = [];
  foreach ($movies as $movie) {
    $category = $movie->category;
    if (!isset($grouped[$category])) {
        $grouped[$category] = [];
    }
    $grouped[$category][] = $movie;
  }

  return $grouped;
}


function MovieDetailController() {
  $id = $_REQUEST['id'];
  $movie = MovieDetail($id);
  return $movie;
}


function AddMovieController(){
    $name = $_REQUEST['Fname'];
    $realisateur = $_REQUEST['realisateur'];
    $annee = $_REQUEST['annee'];
    $duree = $_REQUEST['duree'];
    $desc = $_REQUEST['desc'];
    $categorie = $_REQUEST['categorie'];
    $img = $_REQUEST['img'];
    $url = $_REQUEST['url'];
    $restriction = $_REQUEST['restriction'];
    $ok = addMovie($name, $realisateur, $annee, $duree, $desc,$categorie, $img,$url, $restriction);
    if ($ok!=0){
        return "Le film $name a été ajouté avec succès.";
      }
      else{
        return false;
      }
}
function AddProfileController(){
  $name = $_REQUEST['name'];
  $avatar = $_REQUEST['avatar'];
  $date = $_REQUEST['date'];
  $ok = addProfile($name, $avatar, $date);
  if ($ok!=0){
      return "Le profil $name a été ajouté avec succès.";
    }
    else{
      return false;
    }
}

// function readMoviesByCategoryController($age) {
//   $movies = getAllMoviesByAge($age);
//   $grouped = [];
//   $movieCount = count($movies);

//   for ($i = 0; $i < $movieCount; $i++) {
//       $movie = $movies[$i];          
//       $category = $movie->category;  

//       if (!isset($grouped[$category])) {
//           $grouped[$category] = [];
//       }

//       $grouped[$category][] = $movie;
//   }
//   error_log(json_encode($grouped));
//   return $grouped; 
// }


function ReadProfileController(){
  $profiles = getProfiles();
  return $profiles;
}


function UpdateProfileController(){
  $id = $_REQUEST['id'];
  $name = $_REQUEST['name'];
  $avatar = $_REQUEST['avatar'];
  $date = $_REQUEST['date'];

  $ok = updateProfile($id, $name, $avatar, $date);

  if ($ok != 0){
      return "Le profil a été modifié avec succès.";
  } else {
      return false;
  }
}

function AddToFavoriteController() {
  $id_user = $_REQUEST['id_user'];
  $id_movie = $_REQUEST['id_movie'];
  $exists = checkFavorite($id_user, $id_movie);

  if ($exists) {
    return ["exists" => true];
  }
  $ok = addToFavorite($id_user, $id_movie);
  if ($ok != 0) {
    return ["success" => true];
  } else {
    return ["success" => false];
  }
}

function openProfileController(){
  $id = $_REQUEST['id_user'];
  $profile = openProfilPage($id);
  return $profile;
}

function readFavoritesController($id_user) {
  $moviesFav = getFavorites($id_user);
  return $moviesFav;
}

function deleteFavoriteController($id_user, $id_movie) {
  $exists = checkFavorite($id_user, $id_movie);

  if (!$exists) {
    return ["exists" => false]; 
  }

  $ok = deleteFromFavorite($id_user, $id_movie);
  
  if ($ok != 0) {
    return ["success" => true];
  } else {
    return ["success" => false];
  }
}

function readRecommendedMoviesController(){
  $movies = getRecommendedMovies();
  error_log(json_encode($movies));
  return $movies;
}

function searchMoviesController() {
  $keyword = $_REQUEST['keyword'];
  $movies = searchMovies($keyword);
  return $movies;
}

function searchMoviesAppController() {
  $keyword = $_REQUEST['keyword'];
  $movies = searchMoviesApp($keyword);
  return $movies;
}
function modifyRecController($id_movie, $recommended) {
  $ok = modifyRecommendedMovies($id_movie, $recommended);

  if ($ok != 0) {
      return ["success" => true];
  } else {
      return ["success" => false];
  }
}

function addRatingController($id_user, $id_movie, $score) {
  if (checkIfRatingExists($id_user, $id_movie)) {
    return ["exists" => true];
  }

  $note = addRating($id_user, $id_movie, $score);

  if ($note != 0) {
    return ["success" => true];
  } else {
    return ["success" => false];
  }
}

function getAverageRatingController($id_movie) {
  $score = getAverageRating($id_movie); 
  return ["score" => $score];  
}


function getCommentsController($id_movie) {
  return getComments($id_movie);
}

function addCommentController($id_user, $id_movie, $content) {
  $success = addComment($id_user, $id_movie, $content);
  return ['success' => $success];
}

function getCommentsAdmController() {
  $comments = getCommentsAdm();
  return $comments;
}

function approveCommentController($id) {
  if (approveComment($id)) {
    return ["success" => true];
  } else {
    return ["success" => false];
  }
}
function deleteCommentController($id) {
  if (deleteComment($id)) {
    return ["success" => true];
  } else {
    return ["success" => false];
  }
}

