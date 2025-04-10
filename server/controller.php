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

function readMoviesController(){
  $age = isset($_REQUEST['age']) ? intval($_REQUEST['age']) : null;
  $movies = getAllMovies($age);
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

function readMoviesByCategoryController($age) {
  $movies = getAllMovies($age);
  $grouped = [];
  $movieCount = count($movies);

  for ($i = 0; $i < $movieCount; $i++) {
      $movie = $movies[$i];          
      $category = $movie->category;  

      if (!isset($grouped[$category])) {
          $grouped[$category] = [];
      }

      $grouped[$category][] = $movie;
  }
  error_log(json_encode($grouped));
  return $grouped; 
}


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

function AddToFavoriteController(){
  $id_movie = $_REQUEST['id_movie'];
  $id_profile = $_REQUEST['id_profile'];
  $ok = addToFavorite($id_movie, $id_profile);
  if ($ok != 0){
    ?><script>alert('Movie successfully added)'); </script><?php
  }
}

function readFavoritesController(){
  $userId = $_REQUEST['id_user'];
  $movies = getFavorites($userId);
  return $movies;
}