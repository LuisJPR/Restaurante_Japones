document.getElementById("modify-btn").addEventListener("click", function() {
  var inputs = document.getElementsByTagName("input");
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].readOnly = false;
  }

  document.getElementById("save-btn").disabled = false;
  this.disabled = true;
});

document.getElementById("save-btn").addEventListener("click", function() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  var address = document.getElementById("address").value;

  // Crear un objeto de datos con los valores del perfil de usuario
  var userData = {
    nombre: name,
    correo: email,
    clave: password,
    direccion: address
  };

  // Enviar los datos del perfil de usuario al archivo PHP usando Axios
  axios.post("../PHP/update_data.php", userData)
    .then(function(response) {
      // Manejar la respuesta del archivo PHP si es necesario
      console.log(response.data);
      // Mensaje de estado de la data
      if (response.data.success) {
        alert("Los datos se actualizaron exitosamente en el servidor !");
      } else {
        alert("Hubo un error al guardar los datos. Intente de nuevo.");
      }
    })
    .catch(function(error) {
      // Manejar errores en caso de que ocurra alguno
      console.error(error);
      alert("Ocurrió un error en la comunicación con el servidor. Intente de nuevo más tarde.");
      // Recargar la página
      location.reload();
    });

  var inputs = document.getElementsByTagName("input");
  for (var i = 0; i < inputs.length; i++) {
    inputs[i].readOnly = true;
  }

  this.disabled = true;
  document.getElementById("modify-btn").disabled = false;
});