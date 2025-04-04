let HOST_URL = "https://mmi.unilim.fr/~mishcherikova1/SAE2.03-mishcherikova/";

let DataMovie = {};

DataMovie.addMovies = async function (fdata) {
    let config = {
        method: "POST",
        body: fdata
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=add", config);
    

    let data = await answer.json();
    return data;
};
DataMovie.update = async function (fdata) {
    let config = {
        method: "POST",
        body: fdata
    };
    let answer = await fetch(HOST_URL + "/server/script.php?todo=add", config);

    if (!answer.ok) {
        let errorText = await answer.text();
        throw new Error("Erreur serveur: " + errorText);
    }
    
    let data = await answer.json();
    return data;
}


export { DataMovie };