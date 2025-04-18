let HOST_URL = "..";

let DataProfile = {};
DataProfile.read = async function () {
    let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfile");
    let data = await answer.json();
    return data;
  };

  DataProfile.profilePage = async function(id_user) {
    let answer = await fetch(HOST_URL + "/server/script.php?todo=openProfile&id_user=" + id_user);
    let data = await answer.json();
    return data;
  }
  

export { DataProfile };