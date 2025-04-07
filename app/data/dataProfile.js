let HOST_URL = "https://mmi.unilim.fr/~mishcherikova1/SAE2.03-mishcherikova/";

let DataProfile = {};
DataProfile.read = async function () {
    let response = await fetch(HOST_URL + "/server/script.php?todo=readProfile");
    let data = await response.json();
    return data;
};

export { DataProfile };
