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
    $movies = getAllMovies();
    return $movies;
}

function MovieDetailController() {

  $id = $_REQUEST['id'];

  $movie = MovieDetail($id);

  return $movie;
}


function AddMovieController(){
    $name = $_REQUEST['name'];
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

function readMoviesByCategoryController() {
  $movies = getAllMovies();
  $grouped = [];

  foreach ($movies as $movie) {
      $category = $movie->category;
      $grouped[$category][] = $movie;
  }
  error_log(json_encode($grouped));
  return $grouped; 
}
