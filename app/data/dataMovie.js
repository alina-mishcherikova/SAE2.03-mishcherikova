let HOST_URL = "https://mmi.unilim.fr/~mishcherikova1/SAE2.03-mishcherikova/";

let DataMovie = {};

DataMovie.requestMovies = async function () {
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readmovies");
    let data = await answer.json();
    return data;
}
DataMovie.requestMovieDetails = async function(id) {
    let response = await fetch(HOST_URL + "/server/script.php?todo=moviedetail&id=" + id);
    let data = await response.json();
    return data;
  };
  

export { DataMovie };