let HOST_URL = "..";

let DataProfile = {};
DataProfile.add = async function (formData) {
    const response = await fetch(HOST_URL + "/server/script.php?todo=addProfile", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    return data;
  };
DataProfile.read = async function () {
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfile");
    let data = await answer.json();
    return data;
};
DataProfile.update = async function (formData) {
    const response = await fetch(HOST_URL + "/server/script.php?todo=updateProfile", {
      method: "POST",
      body: formData,
    });
    const data = await response.json();
    return data;
  };
  

export { DataProfile };
