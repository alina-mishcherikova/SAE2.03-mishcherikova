let HOST_URL = "https://mmi.unilim.fr/~mishcherikova1/SAE2.03-mishcherikova";

let DataMovie = {};

DataMovie.requestMovies = async function (age = 99) {
  const response = await fetch(HOST_URL + "/server/script.php?todo=readMovies&age=" + age);
  const data = await response.json();
  return data;
};

DataMovie.requestMovieDetails = async function(id) {
  let response = await fetch(HOST_URL + '/server/script.php?todo=movieDetail&id=' + id);
  let data = await response.json();
  return data;
};
DataMovie.requestMoviesByCategory = async function (age) {
  const response = await fetch(HOST_URL + "/server/script.php?todo=moviesByCategory&age=" + age);
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
  
export { DataMovie };