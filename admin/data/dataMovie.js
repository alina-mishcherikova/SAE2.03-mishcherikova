let HOST_URL = "..";

let DataMovie = {};

DataMovie.addMovies = async function (fdata) {
    let config = {
        method: "POST",
        body: fdata
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addMovie", config);
    

    let data = await answer.json();
    return data;
};

DataMovie.update = async function (fdata) {
    let config = {
        method: "POST",
        body: fdata
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addMovie", config);
    let data = await answer.json();
    return data;
};

DataMovie.addProfile = async function (fdata) {
    let config = {
        method: "POST",
        body: fdata
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=addProfile", config);
    

    let data = await answer.json();
    return data;
};

DataMovie.searchMoviesApp =async function (keyword){
  let response = await fetch(HOST_URL + '/server/script.php?todo=searchMoviesApp&keyword=' + keyword);
  let data = await response.json();
  return data;
}

DataMovie.modifyRec = async function (id, recommended) {
    let config = {
      method: "POST"
    };

    let answer = await fetch(HOST_URL + '/server/script.php?todo=modifyRec&id=' + id + '&recommended=' + recommended, config);
  
    let data = await answer.json();
  
    return data;
  }
  
export { DataMovie };