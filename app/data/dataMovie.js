let HOST_URL = "https://mmi.unilim.fr/~mishcherikova1/SAE2.03-mishcherikova/";

let DataMovie = {};

 /**
     * @param {string} name - The week parameter to be sent to the server.
     * @param {string} img - The day parameter to be sent to the server.
     * @returns The response from the server.
     * 
**/
DataMovie.requestMovies = async function(name, img){
    let answer = await fetch(HOST_URL + "/server/script.php?name=" + name + "&img=" + img);
    let data = await answer.json();
    return data;
}

export {DataMovie};