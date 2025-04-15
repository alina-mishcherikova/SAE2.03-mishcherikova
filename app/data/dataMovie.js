let HOST_URL = "..";

let DataMovie = {};

// DataMovie.requestMovies = async function (age = 99) {
//   const response = await fetch(HOST_URL + "/server/script.php?todo=readMovies&age=" + age);
//   const data = await response.json();
//   return data;
// };

DataMovie.requestMovieDetails = async function(id) {
  let response = await fetch(HOST_URL + '/server/script.php?todo=movieDetail&id=' + id);
  let data = await response.json();
  return data;
};
DataMovie.requestMoviesByCategory = async function (user_id) {
  const response = await fetch(HOST_URL + "/server/script.php?todo=moviesByCategory&user_id=" + user_id);
  const data = await response.json();
  return data;}

DataMovie.addToFavorite = async function(id_user, id_movie) {
  let response = await fetch(`${HOST_URL}/server/script.php?todo=addToFavorite&id_user=${id_user}&id_movie=${id_movie}`);
  let data = await response.json();
  return data;
};
DataMovie.getFavorites = async function(id_user) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readFavorites&id_user=" + id_user);
  let data = await answer.json();
  return data;
}
DataMovie.deleteFavorite = async function(id_user, id_movie) {
  let response = await fetch(`${HOST_URL}/server/script.php?todo=deleteFavorite&id_user=${id_user}&id_movie=${id_movie}`);
  let data = await response.json();
  return data;
}
DataMovie.requestRecommendedMovies = async function() {
let response = await fetch(HOST_URL + '/server/script.php?todo=readRecommendedMovies');
let data = await response.json();
return data;
};

DataMovie.searchMovies= async function(keyword){
  let response = await fetch(HOST_URL + '/server/script.php?todo=searchMovies&keyword=' + keyword);
  let data = await response.json();
  return data;
}

DataMovie.addRating = async function (id_user, id_movie, score){
  let response = await fetch(`${HOST_URL}/server/script.php?todo=addRating&id_user=${id_user}&id_movie=${id_movie}&score=${score}`);
  let data = await response.json();
  return data;
}

DataMovie.getAverageRating = async function (id_movie){
  let response = await fetch(HOST_URL+'/server/script.php?todo=getAverageRating&id_movie='+ id_movie);
  let data = await response.json();
  return data;
}


export { DataMovie };