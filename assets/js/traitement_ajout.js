const sendData = () => {
  var xhr;
  try {
    xhr = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xhr = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e2) {
      try {
        xhr = new XMLHttpRequest();
      } catch (e3) {
        xhr = false;
      }
    }
  }

  var formData = new FormData(myForm);
  console.log(formData);

  xhr.open("POST", "../../inc/traitement_ajout_habit.php");
  xhr.send(formData);
};

var myForm = document.getElementById("myForm");
form.addEventListener("submit", (e) => {
  e.preventDefault();
  sendData();
});
